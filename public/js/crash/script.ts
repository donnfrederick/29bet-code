class crashGame {
    private rodada:number = 0;

    //CRASH result multiplier
    //VARTIÁVEL DA VELA ATUAL
    private velaAtual:number;

    //HTML COMPONENTS
    //game vars
    private rocket:any;
    private rocketContainer:any;
    private rocketImg:any;
    private rocks:any;
    private sky:any;
    private barraprog:any;
    private barratimer:any;
    private box:any;
    //modals
    private mul:any;
    private val:any;
    private winModal:any;
    private loseModal:any;

    //timer
    private newTimer:any;

    private numberInit:any;

    //main game
    private crash:any;

    //timer variables
    //CONTADOR REGRESSIVO INICIAL
    private sec:number;
    private mil:number;

    //VARIÁVEIS PARA O CONTADOR DO NUMBER-INIT
    private num1:number;
    private num2:number;
    private num:number = 0;

    //GERA ABERTURA DA VELA RANDOMICAMENTE DE 1 A 1000
    private abertura_da_vela:number = 1;

    private nVela1:any;
    private nVela2:any;

    private hasWin:boolean;

    //-------------------------------------------//
    //EVENTS
    private playCrash:any;

    private inPlay:boolean = false;

    private betMoney:any;
    private betMulti:number;

    private betMoneyElmnt:any;
    private betMultiElmnt:any;

    private nBet1:any;
    private nBet2:any;

    //for XHR
    private csrfToken:any;
    private money_update:any;
    private div_money_update:any;
    private mainMoney:any;
    private carteiraButton:any;

    private zeroes:any;
    private ones:any;
    private twos:any;
    private game_id:any;

    private resDist = [
        [1.01, 1.02, 1.03, 1.04, 1.05, 1.06, 1.07, 1.08, 1.09, 1.10, 1.11, 1.12, 1.13, 1.14, 1.15, 1.16, 1.17, 1.18, 1.19, 1.20, 1.21, 1.22, 1.23, 1.24, 1.25, 1.26, 1.27, 1.28, 1.29, 1.30, 1.31, 1.32, 1.33, 1.34, 1.35, 1.36, 1.37, 1.38, 1.39, 1.40, 1.41, 1.42, 1.43, 1.44, 1.45, 1.46, 1.47, 1.48, 1.49, 1.50],
		[1.51, 1.52, 1.53, 1.54, 1.55, 1.56, 1.57, 1.58, 1.59, 1.60, 1.61, 1.62, 1.63, 1.64, 1.65, 1.66, 1.67, 1.68, 1.69, 1.70, 1.71, 1.72, 1.73, 1.74, 1.75, 1.76, 1.77, 1.78, 1.79, 1.80, 1.81, 1.82, 1.83, 1.84, 1.85, 1.86, 1.87, 1.88, 1.89, 1.90, 1.91, 1.92, 1.93, 1.94, 1.95, 1.96, 1.97, 1.98, 1.99, 2.00, 2.01, 2.02, 2.03, 2.04, 2.05, 2.06, 2.07, 2.08, 2.09, 2.10, 2.11, 2.12, 2.13, 2.14, 2.15, 2.16, 2.17, 2.18, 2.19, 2.20, 2.21, 2.22, 2.23, 2.24, 2.25, 2.26, 2.27, 2.28, 2.29, 2.30, 2.31, 2.32, 2.33, 2.34, 2.35, 2.36, 2.37, 2.38, 2.39, 2.40, 2.41, 2.42, 2.43, 2.44, 2.45, 2.46, 2.47, 2.48, 2.49, 2.50],
		[2.51, 2.52, 2.53, 2.54, 2.55, 2.56, 2.57, 2.58, 2.59, 2.60, 2.61, 2.62, 2.63, 2.64, 2.65, 2.66, 2.67, 2.68, 2.69, 2.70, 2.71, 2.72, 2.73, 2.74, 2.75, 2.76, 2.77, 2.78, 2.79, 2.80, 2.81, 2.82, 2.83, 2.84, 2.85, 2.86, 2.87, 2.88, 2.89, 2.90, 2.91, 2.92, 2.93, 2.94, 2.95, 2.96, 2.97, 2.98, 2.99, 3.00, 3.01, 3.02, 3.03, 3.04, 3.05, 3.06, 3.07, 3.08, 3.09, 3.10, 3.11, 3.12, 3.13, 3.14, 3.15, 3.16, 3.17, 3.18, 3.19, 3.20, 3.21, 3.22, 3.23, 3.24, 3.25, 3.26, 3.27, 3.28, 3.29, 3.30, 3.31, 3.32, 3.33, 3.34, 3.35, 3.36, 3.37, 3.38, 3.39, 3.40, 3.41, 3.42, 3.43, 3.44, 3.45, 3.46, 3.47, 3.48, 3.49, 3.50, 3.51, 3.52, 3.53, 3.54, 3.55, 3.56, 3.57, 3.58, 3.59, 3.60, 3.61, 3.62, 3.63, 3.64, 3.65, 3.66, 3.67, 3.68, 3.69, 3.70, 3.71, 3.72, 3.73, 3.74, 3.75, 3.76, 3.77, 3.78, 3.79, 3.80, 3.81, 3.82, 3.83, 3.84, 3.85, 3.86, 3.87, 3.88, 3.89, 3.90, 3.91, 3.92, 3.93, 3.94, 3.95, 3.96, 3.97, 3.98, 3.99, 4.00]
    ];

    private velas:any = [];

    //for payout(Pegar)
    private payOutActive:boolean;

    private cl:boolean;
    private initiated:boolean;
    private main_interval:any;

    //jogdores
    private apsts:any;
    private apArr:Array<any>;
    private givl:any;
    private cpU:any;

    constructor() {
        //initalize game vars
        this.rocket = document.querySelector('.rocket');
        this.rocketContainer = document.querySelector('.rocketContainer');
        this.rocketImg = document.querySelector('.rocketImg');
        this.rocks = document.querySelector('.rocks');
        this.sky = document.querySelector('.sky');
        this.barraprog = document.querySelector('.barraprog');
        this.barratimer = document.querySelector('.barratimer');
        this.box = document.querySelector('.box');
        //modal
        this.mul = document.querySelector('#mul');
        this.val = document.querySelector('#val');
        this.winModal = document.querySelector('.outcome-window');
        this.loseModal = document.querySelector('.outcome-window-lose');

        this.newTimer = document.getElementById('newtimer');

        this.numberInit = document.querySelector('.number-init');

        this.crash = document.querySelector('.crash');

        this.betMoneyElmnt = document.querySelector('#bet');
        this.betMultiElmnt = document.querySelector('#betout');

        //play button
        this.playCrash = document.querySelector('#playCrash');

        //for events
        this.csrfToken = document.querySelector('meta[name="csrf-token"]');
        this.money_update = document.querySelector('#money_update');
        this.div_money_update = document.querySelector('#div_money_update');
        this.mainMoney = document.querySelector('#money');
        this.carteiraButton = document.querySelector('#_payin');

        //jogadores
        this.apsts = document.querySelector('.jogadores');
        this.cpU = document.getElementById('copyUsername');

        this.init();
    }

    private init() {
        clearInterval(this.main_interval);
        this.initiated = true;
        this.cl = false;
        this.playCrash.innerHTML = 'Jogar';

        this.betMulti = 0;

        this.sec = 9;
        this.mil = 60;

        this.num1 = 0;
        this.num2 = 0;
        this.num = 1.00;
        this.num = parseInt(this.num.toFixed(2));

        this.betMoney = 0;
        this.betMulti = 0;

        this.rodada++;

        this.hasWin = false;

        //initiate result distribution
        this.zeroes = document.querySelector('#zeroes');
        this.ones = document.querySelector('#ones');
        this.twos = document.querySelector('#twos');
        this.game_id = document.querySelector('#game_id');

        //pegar
        this.payOutActive = false;

        //EVENTS
        this.actionListener();

        this.countDown();

        if (this.velas.length == 0) {
            for (let i = 1;i <= 7;i++) {
                this.storeVelas(this.generateResult().toFixed(2));
            }
        }

        this.apsts.innerHTML = "";
        this.apArr = [];
        this.gapts();
    }

    private countDown() {
        let countDown = setInterval(() => {
            if (this.num > 1.00) {
                clearInterval(countDown);
                this.init();
            }

            this.mil--;
            if (this.mil == 0) {
                this.sec--;
                this.mil = 60;
            }

            this.newTimer.innerText = this.sec + ':' + this.mil;

            this.barraprog.classList.add('animabarra');

            if (this.sec == 0) {
                clearTimeout(this.givl);
                this.inPlay = true;
                this.playCrash.classList.add('disabled');

                this.barratimer.style.display = 'none';
                this.newTimer.style.display = 'none';

                clearInterval(countDown);

                // `this.v`elaAtual = this.abertura_da_vela * Math.random() + 0.4; //numeros de 1.4 a abertura da vela
                this.velaAtual = this.generateResult(); //abertura da vela
                this.velaAtual = Number(this.velaAtual.toFixed(2));

                this.rocket.classList.add('lancado');
                this.rocketImg.classList.add('motor');
                this.rocketContainer.classList.add('nitro');

                if (this.velaAtual > 1.20) {
                    this.rocks.classList.add('partida');
                    this.sky.classList.add('fadein');
                }

                //PEGA OS NUMEROS DA VELA E SEPARA EM DOIS
                var velaText = this.velaAtual.toString();
                var sVela = velaText.split(".");

                this.nVela1 =  parseInt(sVela[0]);
                this.nVela2 =  parseInt(sVela[1]);

                var betText = this.betMulti.toString();
                var sBet = betText.split(".");

                this.nBet1 =  parseInt(sBet[0]);
                this.nBet2 =  parseInt(sBet[1]);

                this.contador();

                if (this.betMoney < 0.1) {
                    this.playCrash.innerHTML = "Aguarde";
                }
            }
        }, 10)
    }

    private contador() {
        if (this.betMoney >= 0.1) {
            this.payOutActive = true;
        }
        //CHAMADA DO CONTADOR NUMBER-INIT
        this.main_interval = setInterval (() => {
            if (this.initiated == true) {
                this.num += 0.01;
            } else {
                clearInterval(this.main_interval);
            }

            if (this.num > 0) {
                this.cl = false;
            }

            const cid = this.num.toFixed(2).replace(/\./g, "-");
            const wElms = document.querySelectorAll('bet-x' + cid) as NodeListOf<HTMLElement>;

            if (wElms != null) {
                wElms.forEach((e:HTMLElement) => {
                    console.log(e);
                    e.style.color = '#F9FF2B';
                });
            }

            if (this.betMulti == parseFloat(this.num.toFixed(2))) {
                this.payOutActive = false;
                this.playCrash.classList.add('disabled');
                this.playCrash.innerHTML = "Aguarde";
                if (this.betMulti !== 0 && this.betMoney !== 0) {
                    this.hasWin = true;
                    this.newTimer.innerText='Você ganha!';
                    this.numberInit.classList.add('nFinishSuccess');

                    this.mul.innerHTML = 'x' + this.num.toFixed(2);
                    this.val.innerHTML = (this.num * this.betMoney).toFixed(2);
                    this.winModal.style.display = 'block';
                    this.numberInit.style.display = 'none';

                    let creditInterval = setInterval(() => {
                        this.winModal.style.display = 'none';
                        this.mul.innerHTML = 0;
                        this.val.innerHTML = 0;
                        this.numberInit.style.display = 'block';

                        this.newTimer.innerText='';
                        this.numberInit.classList.remove('nFinishSuccess');
                        this.addWinCredits(this.betMoney, this.betMulti);
                        clearInterval(creditInterval);
                    }, 2000);
                }
            } else if (this.velaAtual <= parseFloat(this.num.toFixed(2))) {
                this.payOutActive = false;
                this.playCrash.innerHTML = "Aguarde";
                clearInterval(this.main_interval);

                if (this.betMulti != 0 && !this.hasWin) {
                    this.loseModal.style.display = 'block';
                    this.numberInit.style.display = 'none';
                }

                this.numberInit.innerText = this.velaAtual + 'x';

                if (this.velaAtual < 1.2) {
                    this.box.style.visibility = 'hidden';
                }

                this.numberInit.classList.add('nFinish');
                this.rocket.classList.add('destruct');

                let estouro = setTimeout(()=> {
                    this.crash.classList.add('estouro');
                    this.newTimer.innerText='Agora jogue pra valer!';
                    clearInterval(estouro);
                }, 200);

                //RESETANDO VARIÁVEIS E CLASSES
                this.resetGame();
            } else {
                if (this.betMoney > 0 && this.payOutActive == true && this.cl == false) {
                    this.playCrash.classList.remove('disabled');
                    this.playCrash.innerHTML = "Pegar<br><i class='fa fa-coins'></i> "+(this.betMoney  * this.num).toFixed(2);
                    this.playCrash?.addEventListener("click", () => {
                        if (this.payOutActive == true) {
                            this.cl = true;
                            this.payOut();
                        }
                    });
                }
            }

            this.numberInit.innerText = this.num.toFixed(2) + 'x';
        }, 100);
    }

    private payOut() {
        //modal
        this.mul.innerHTML = 'x' + this.num.toFixed(2);
        this.val.innerHTML = (this.num * this.betMoney).toFixed(2);
        this.winModal.style.display = 'block';
        this.numberInit.style.display = 'none';

        this.playCrash.classList.add('disabled');
        this.playCrash.innerHTML = "Aguarde";

        this.betMulti = parseFloat(this.num.toFixed(2));

        this.payOutActive = false;

        let creditInterval = setInterval(() => {
            this.winModal.style.display = 'none';
            this.numberInit.style.display = 'block';
            this.addWinCredits(this.betMoney, this.betMulti);
            this.betMulti = 0;
            this.betMoney = 0;
            clearInterval(creditInterval);
        }, 2000);
    }

    private resetGame() {
        let resetInterval = setTimeout(() => {
            //modal
            this.loseModal.style.display = 'none';
            this.winModal.style.display = 'none';
            this.mul.innerHTML = 0;
            this.val.innerHTML = 0;

            //counter
            this.numberInit.style.display = 'block';
            this.barratimer.style.display = 'block';
            this.newTimer.style.display = 'block';

            this.rocket.classList.remove('lancado');
            this.rocketImg.classList.remove('motor');
            this.rocks.classList.remove('partida');

            this.numberInit.classList.remove('nFinish');
            this.box.style.visibility = 'visible';
            this.rocket.classList.remove('destruct');
            this.sky.classList.remove('fadein');

            this.crash.classList.remove('estouro');
            this.barraprog.classList.remove('animabarra');
            this.rocketContainer.classList.remove('nitro');

            if (this.hasWin) {
                this.numberInit.classList.remove('nFinishSuccess');
            }

            //VARIÁVEIS PARA O CONTADOR DO NUMBER-INIT
            this.numberInit.innerText='1.00x';

            this.inPlay = false;
            this.playCrash.classList.remove('disabled');

            this.storeVelas(this.velaAtual.toFixed(2));

            this.init();
            clearInterval(resetInterval);
        }, 5000); // Espera 5 segundos antes de iniciar uma nova rodada
    }

    private storeVelas(vela) {
        const vela_items = document.querySelector('#vela_items');

        if (this.velas.length > 6) {
            this.velas.shift();
        }

        this.velas.push(vela);

        let vela_elements = "";

        this.velas.forEach((vela, key) => {
            if (vela >= 1.00 && vela <= 1.50) {
                vela_elements += '<div class="vela--item vela--item3">' + vela + '</div>';
            } else if (vela >= 1.51 && vela <= 2.50) {
                vela_elements += '<div class="vela--item vela--item1">' + vela + '</div>';
            } else {
                vela_elements += '<div class="vela--item vela--item2">' + vela + '</div>';
            }
        });

        if (vela_items != null) {
            vela_items.innerHTML = vela_elements;
        }
    }

    private actionListener() {
        this.playCrash?.addEventListener("click", () => {
            if (!this.inPlay && this.betMulti == 0 && this.cl == false) {
                this.cl = true;
                this.betMoney = this.betMoneyElmnt.value;

                if (this.betMoney >= 0.1) {
                    this.playCrash.innerHTML = 'Aguarde';
                    this.checkFunds();
                }
            }
        });
    }

    private deductBalance(bet) {
        const game_id = this.game_id.getAttribute('data-game-id');

        const data = {
            bet: bet,
            game_id: game_id
        };

        const xhr = new XMLHttpRequest();

        xhr.open('PUT', "/api/balance/deduct");
        xhr.setRequestHeader('Content-Type', 'appication/json');

        const csrfToken = this.csrfToken.getAttribute('content');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

        xhr.onload = () => {
            if (xhr.status >= 200 && xhr.status < 300) {
                const response = JSON.parse(xhr.responseText);

                if (response.status === 200) {
                    this.mainMoney.innerHTML = response.new_balance;
                    this.mainMoney.setAttribute('data-current-balance', response.new_balance);
                    this.money_update.innerHTML = "-$" + parseFloat(bet).toFixed(2);
                    this.div_money_update.style.display = "block";
                    this.money_update.style.color = "red";

                    this.hUN();

                    this.hideMoneyUpdate();
                } else {
                    this.carteiraButton.click();
                }
            } else {
                console.log(new Error(xhr.statusText));
            }
        };

        xhr.send(JSON.stringify(data));
    }

    private hUN() {
        let ign = "";

        ign += "User";

        const cU = this.cpU.textContent;
        const u2 = cU.length - 2;

        for (let i = 1;i <= u2;i++) {
            ign += '*';
        }

        ign += cU[cU.length - 1];
        ign += cU[cU.length - 2];

        const result = [
            ign,
            'x' + this.betMulti,
            'R$ ' + this.betMoney
        ]

        if (this.apArr.length > 18) {
            this.apArr.shift();
            this.apsts.removeChild(this.apsts.children[this.apsts.children.length - 1]);
        }

        this.apArr.push(result);

        const d = document.createElement('div');
        d.className = 'bet-self';
        const d1 = document.createElement('div');
        d1.className = 'col-md-4';
        d1.textContent = result[0];
        d.appendChild(d1);
        const d2 = document.createElement('div');
        d2.className = 'col-md-4';
        d2.textContent = result[1];
        d.appendChild(d2);
        const d3 = document.createElement('div');
        d3.className = 'col-md-4';
        d3.textContent = result[2];
        d.appendChild(d3);

        this.apsts.prepend(d);
    }

    private addWinCredits(bet, multi) {
        const game_id = this.game_id.getAttribute('data-game-id');

        const winnings = parseFloat(bet) * parseFloat(multi);

        const data = {
            winnings: winnings,
            game_id: game_id
        };

        const xhr = new XMLHttpRequest();

        xhr.open('POST', "/api/balance/add");
        xhr.setRequestHeader('Content-Type', 'appication/json');

        const csrfToken = this.csrfToken.getAttribute('content');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

        xhr.onload = () => {
            if (xhr.status >= 200 && xhr.status < 300) {
                const response = JSON.parse(xhr.responseText);

                if (response.status === 200) {
                    this.mainMoney.innerHTML = response.new_balance;
                    this.mainMoney.setAttribute('data-current-balance', response.new_balance);
                    this.money_update.innerHTML = "+$" + (bet * multi).toFixed(2);
                    this.div_money_update.style.display = "block";
                    this.money_update.style.color = "yellow";

                    this.hideMoneyUpdate();
                }
            } else {
                console.log(new Error(xhr.statusText));
            }
        };

        xhr.send(JSON.stringify(data));
    }

    private hideMoneyUpdate() {
        let moneyInterval = setInterval(function() {
            this.div_money_update.style.display = "none";
            clearInterval(moneyInterval);
        }, 3000);
    }

    private generateResult() {
        const zeroes = this.zeroes.getAttribute('data-perc-zeroes');
        const ones = this.ones.getAttribute('data-perc-ones');
        const twos = this.twos.getAttribute('data-perc-twos');

        let arrVelas = [];
		for (let zero = 1;zero <= zeroes;zero++) {
			arrVelas.push(0);
		}

		for (let one = 1;one <= ones;one++) {
			arrVelas.push(1);
		}

		for (let two = 1;two <= twos;two++) {
			arrVelas.push(2);
		}

		arrVelas.sort(function(a, b) {
			return 0.5 - Math.random();
		});

		const randNum = Math.ceil(Math.random());
		const velaNew = arrVelas[randNum * 99];
		const newRandNum = (Math.random() * this.resDist[velaNew].length) - 1;
		return this.resDist[velaNew][Math.ceil(newRandNum)];
    }

    private checkFunds() {
        const xhr = new XMLHttpRequest();

        xhr.open('GET', "/api/balance/check");
        xhr.setRequestHeader('Content-Type', 'appication/json');

        const csrfToken = this.csrfToken.getAttribute('content');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

        xhr.onload = () => {
            if (xhr.status >= 200 && xhr.status < 300) {
                const response = JSON.parse(xhr.responseText);

                if (response.status === 200) {
                    if (parseFloat(parseFloat(response.account.normal_balance).toFixed(2)) >= this.betMoney && parseFloat(parseFloat(response.account.normal_balance).toFixed(2)) > 0) {
                        this.betMoney = this.betMoneyElmnt.value;
                        this.betMulti = this.betMultiElmnt.value;

                        this.playCrash.classList.add('disabled');

                        this.deductBalance(this.betMoney);
                    } else {
                        console.log(parseFloat(parseFloat(response.account.normal_balance).toFixed(2)));
                        this.betMoney = 0;
                        this.betMulti = 0;

                        this.carteiraButton.click();
                    }
                }
            } else {
                console.log(new Error(xhr.statusText));
            }
        };

        xhr.send();
    }

    private gapts() {
        const interval = Math.floor(Math.random() * 500) + 250;

        this.givl = setTimeout(() => {
            const result = this.gApsts();

            if (this.apArr.length > 18) {
                this.apArr.shift();
                this.apsts.removeChild(this.apsts.children[this.apsts.children.length - 1]);
            }

            this.apArr.push(result);

            const d = document.createElement('div');
            const cId = result[1].replace(/\./g, "-");
            d.className = 'bet-' + cId;
            const d1 = document.createElement('div');
            d1.className = 'col-md-4';
            d1.textContent = result[0];
            d.appendChild(d1);
            const d2 = document.createElement('div');
            d2.className = 'col-md-4';
            d2.textContent = result[1];
            d.appendChild(d2);
            const d3 = document.createElement('div');
            d3.className = 'col-md-4';
            d3.textContent = result[2];
            d.appendChild(d3);

            this.apsts.prepend(d);
            this.gapts();
        }, interval);
    }

    private gApsts() {
        let user = "";

        let fword = "User";
        let hide = this.mkRdI(2, 4);
        let lword = this.mkId(2);

        user += fword;

        for (let i = 1;i <= hide;i++) {
            user += '*';
        }

        user += lword;

        let mul = 'x';
        mul += this.mkRdI(1, 3);
        mul += '.';
        mul += this.mkRdI(0, 100);

        let val = "R$ ";
        val += this.mkRdI(1, 100);

        return [
            user,
            mul,
            val
        ];
    }

    private mkRdI(mn,mx) {
        mn = Math.ceil(mn);
        mx = Math.floor(mx);
        return Math.floor(Math.random() * (mx - mn + 1)) + mn;
    }

    private mkId(length) {
        let result = '';
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        const charactersLength = characters.length;
        let counter = 0;
        while (counter < length) {
          result += characters.charAt(Math.floor(Math.random() * charactersLength));
          counter += 1;
        }
        return result;
    }
}
