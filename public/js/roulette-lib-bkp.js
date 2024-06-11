const Roulette = (function () {

    const rotationStopEventName = "rotationStop";
    const rotationStartEventName = "rotationStart";

    const rouletteClass = "roulette-wheel";
    const rouletteListClass = "roulette__list";
    const roulettePrizeClass = "roulette__prize";

    const PrizeNotFoundException = "Prize not found";
    const ItemsNotFoundException = "Items not found";
    const NotImplementedException = "Not implemented";
    const NotEnoughArgumentsException = "Not enough arguments";
    const ContainerUndefinedException = "Container was undefined";
    const RotationIsAlreadyActiveException = "Rotation is already active";

    const rotationTokens = new WeakMap();

    class Prize {

        constructor(element, index, spacing, width, height) {
            this.index = index;
            this.element = element;

            let wrapper = document.createElement("li");
            wrapper.classList.add(roulettePrizeClass);
            // wrapper.style.marginRight = `${spacing}px`;
            wrapper.style.marginRight = `clamp(3px, 2vw, 15px)`;
            // wrapper.style.minWidth = `115px`;
            wrapper.style.minWidth = `${width}px`;
            // wrapper.style.minHeight = `115px`;
            wrapper.style.minHeight = `${height}px`;
            wrapper.appendChild(element);

            this.wrapper = wrapper;
        }

    }

    class Roulette {

        constructor(container, options) {
            let {
                spacing = 10,
                acceleration = 350,
                fps = 40,
                audio = "libs/vanillaRoulette/click.wav",
                selector = ":scope > *",
                stopCallback = null,
                startCallback = null
            } = options || {};

            let node =
                typeof container === "string" ?
                    document.querySelector(container) :
                container instanceof HTMLElement ?
                    container :
                container && container[0] instanceof HTMLElement ?
                    container[0] :
                    undefined;

            if (!node)
                throw ContainerUndefinedException;

            node.classList.add(rouletteClass);

            let list = document.createElement("ul");
            list.classList.add(rouletteListClass);

            let childNodes = [...node.querySelectorAll(selector)];
            if (!childNodes.length)
                throw ItemsNotFoundException;
            let injector = childNodes[0].parentElement
            let maxWidth = Math.max(...childNodes.map(x => x.clientWidth));
            let maxHeight = Math.max(...childNodes.map(x => x.clientHeight));
            let prizes = childNodes.map((el, i) => new Prize(el, i, spacing, maxWidth, maxHeight));
            for (let prize of prizes)
                list.appendChild(prize.wrapper);

            node.style.padding = `${spacing}px`;
            injector.appendChild(list);

            let player = typeof audio === "string" ? new Audio(audio) : audio && audio.play ? audio : null;
            if (player && !player.clone)
                player.clone = player.cloneNode ? player.cloneNode : () => player;

            this.container = node;
            this.list = list;
            this.prizes = prizes;
            this.spacing = spacing;
            this.acceleration = acceleration;
            this.width = (spacing + maxWidth) * prizes.length;
            this.prizeWidth = maxWidth;
            this.audio = player;
            this.fps = fps;
            this.shdStp = false;
            rotationTokens.set(this, -1);

            if (startCallback)
                this.container.addEventListener(rotationStartEventName, startCallback);
            if (stopCallback)
                this.container.addEventListener(rotationStopEventName, stopCallback);
        }

        muteAudio(entity) {
            if (entity != null) {
                let player = entity;
                player.clone = player.cloneNode;
                this.audio = player;
            } else {
                this.audio = null;
            }
        }

        rotate(pixels = 0) {
            if (this.rotates)
                throw RotationIsAlreadyActiveException;
            if (pixels > 0)
                rotateForward.bind(this)(pixels);
            else if (pixels < 0)
                rotateBackward.bind(this)(pixels);
        }

        rotateTo(block, options) {
            if (this.rotates)
                throw RotationIsAlreadyActiveException;
            let numBlock = Number(block);
            let prize = Number.isNaN(numBlock) ? this.findPrize({ element: block }) : this.findPrize({ index: numBlock });
            if (!prize)
                throw PrizeNotFoundException;
            let { tracks = 0, time = 0, random = true, backward = false } = options || {};
            time |= 0;
            tracks |= 0;
            if (time) {
                rotateByTime.bind(this)(prize, time, random, backward);
            } else {
                rotateByTracks.bind(this)(prize, tracks, random, backward);
            }
        }

        playClick() {
            if (this.audio !== null)
            {
                let promise = this.audio.clone().play();
                if (promise && promise.catch)
                    promise.catch(() => {});
            }
        }

        findPrize(options) {
            let { index, element } = options || {};
            if ((typeof index !== "number" || Number.isNaN(index)) && !element)
                throw NotEnoughArgumentsException;
            return element ? this.prizes.find(x => x.element === element) : this.prizes[index];
        }

        stop() {
            if (this.shdStp != true) {
                this.shdStp = true;

                rotateForward.bind(this)(0);
            }
            if (this.rotates) {
                clearInterval(rotationTokens.get(this));
                rotationTokens.set(this, -1);
                this.container.dispatchEvent(new CustomEvent(rotationStopEventName, { detail: { prize: this.selectedPrize } }));
            }
        }

        get selectedPrize() {
            let afterCenterIndex =
                this.prizes.concat()
                    .sort((a, b) => a.wrapper.offsetLeft - b.wrapper.offsetLeft)
                    .find(prize => prize.wrapper.offsetLeft > this.center).index;
            return this.prizes[(this.prizes.length + afterCenterIndex - 1) % this.prizes.length];
        }

        get firstBlock() {
            return this.findPrize({ element: this.list.querySelector(`:scope > .${roulettePrizeClass} > *`) });
        }

        get lastBlock() {
            let nodes = this.list.querySelectorAll(`:scope > .${roulettePrizeClass} > *`);
            return this.findPrize({ element: nodes[nodes.length - 1] });
        }

        get rotates() {
            return rotationTokens.get(this) > -1;
        }

        get center() {
            return this.list.offsetLeft + this.list.clientWidth / 2;
        }

        static get version() {
            return "1.1.0";
        }
    }

    function rotateForward(pixels) {
        this.container.dispatchEvent(new CustomEvent(rotationStartEventName, { detail: { prize: this.selectedPrize } }));

        pixels = Math.abs(pixels);
        let starter = Math.abs(Number(this.firstBlock.wrapper.style.marginLeft.replace("px", "")));

        let k = this.acceleration;
        let v0 = Math.sqrt(2 * k * pixels);
        let totalTime = v0 / k;

        let intervalMS = 1000 / this.fps;
        let intervalS = intervalMS / 1000;

        let blockWidth = this.prizeWidth + this.spacing;
        let t = 0;
        let currentBlock = 0;
        let played = false;
        let halfBlock = this.spacing + this.prizeWidth / 2;

        let token = setInterval(() => {
            if (t > totalTime) {
                this.stop();
                return;
            }

            let currentPos = (starter + (v0 * t - k * t * t / 2)) % this.width;

            if (Math.floor(currentPos / blockWidth) != currentBlock) {
                let block = this.firstBlock;
                this.list.appendChild(block.wrapper);
                block.wrapper.style.marginLeft = "0px";
                currentBlock = (currentBlock + 1) % this.prizes.length;
                played = false;
            }
            let margin = currentPos % blockWidth;
            this.firstBlock.wrapper.style.marginLeft = `-${margin}px`;
            if (margin > halfBlock && !played) {
                played = true;
                this.playClick();
            }

            t += intervalS;

        }, intervalMS);

        rotationTokens.set(this, token);
    }

    function rotateBackward(pixels) {
        // TODO
        throw NotImplementedException;
    }


    function rotateByTracks(prize, tracks, random, backward) {
        const blockWidth = this.prizeWidth + this.spacing;
        const winWidth = window.innerWidth;

        const objSpacing = {
            280: 105,
            285: 102,
            290: 100,
            295: 98,
            300: 96,
            305: 93,
            310: 91,
            315: 89,
            320: 87,
            325: 85,
            330: 83,
            335: 80,
            340: 77,
            345: 75,
            350: 74,
            355: 71,
            360: 68,
            365: 65,
            370: 64,
            375: 62,
            400: 43,
            405: 41,
            410: 39,
            415: 37,
            420: 35,
            425: 32,
            430: 30,
            435: 28,
            440: 26,
            445: 24,
            450: 22,
            455: 19,
            460: 17,
            465: 15,
            470: 13,
            475: 11,
            480: 9,
            485: 7,
            490: 3,
            500: 1,
            505: -3,
            510: -5,
            515: -7,
            520: -9,
            525: -11,
            530: -13,
            535: -16,
            540: -18,
            550: -21,
            555: -25,
            560: -27,
            570: -30,
            575: -33,
            600: -14,
            645: -12,
            680: -10,
            720: -6,
            767: -6,
            820: -95,
            870: -95,
            880: -93,
            890: -90,
            900: -89,
            920: -75,
            945: -69,
            970: -63,
            991: -57,
            1020: 29,
            1045: -5,
            1070: 1,
            1085: 5,
            1100: 11,
            1125: 14,
            1145: 19,
            1170: 26,
            1200: 32,
            1220: 26,
            1250: 30,
            1270: 36,
            1285: 41,
            1300: 46,
            1330: 50,
            1345: 55,
            1370: 58,
            1377: 63,
            1399: 66,
            1400: 88,
            1420: 92,
            1440: 95,
            1470: 95,
            1520: 95
        };

        const objAdjust = {};
        
        let spacing = 0;

        if (winWidth > 1520) {
            spacing = 97;
        } else {
            if (objAdjust[winWidth] != undefined) {
                spacing = objAdjust[winWidth];
            } else {
                Object.entries(objSpacing).forEach((element, key) => {
                    if (spacing == 0 && winWidth <= element[0]) {
                        spacing = element[1];
                    }
                });
            }
        }

        length = tracks * this.width;

        if (prize.index > 2) {
            length += ((blockWidth * prize.index) - (blockWidth / 2) - (blockWidth * 2) + spacing);
        } else {
            length += (((blockWidth * 20) - (blockWidth / 2) - (blockWidth * 2) + spacing) + (blockWidth * (prize.index + 1)));
        }
        this.rotate(length);
    }

    function rotateByTime(prize, time, random, backward) {
        let v0 = this.acceleration * time;
        let l = v0 * v0 / (2 * this.acceleration);
        let tracks = Math.ceil(l / this.width);
        rotateByTracks.bind(this)(prize, tracks, random, backward);
    }

    return Roulette;
})();
