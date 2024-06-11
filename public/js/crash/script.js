var CrashGame = /** @class */ (function () {
    function CrashGame() {
        this.rodada = 0;
        this.num = 0;
        //GERA ABERTURA DA VELA RANDOMICAMENTE DE 1 A 1000
        this.abertura_da_vela = 1;
        this.inPlay = false;
        this.resDist = [
            [1.01, 1.50],
            [1.51, 2.50],
            [2.51, 4.00],
            [4.01, 6.00],
            [6.01, 10.00],
            [10.01, 20.00],
            [20.01, 40.00]
        ];
        this.dist = [];
        this.gDst();
        this.velas = [];
        // pang eject ng alien
        // this.ejected_alien = document.querySelector('.ejetct_alien_trigger');
        //initalize game vars
        this.rocket = document.querySelector('.rocket');
        this.rastro = document.querySelector('.rastro');
        this.rocketContainer = document.querySelector('.rocketContainer');
        this.rocketImg = document.querySelector('.rocketImg');
        this.rocks = document.querySelector('.rocks');
        this.parallax_bg = document.querySelector('.parallax_bg')
        this.moon = document.querySelector('.moon');
        this.rock1 = document.querySelector('.rock1');
        this.rock2 = document.querySelector('.rock2');
        this.sat = document.querySelector('.sat');
        this.sky = document.querySelector('.sky');
        this.barraprog = document.querySelector('.barraprog');
        this.barratimer = document.querySelector('.barratimer');
        this.box = document.querySelector('.box');
        // this.ejected_alien =  document.querySelector('.ejected_alien');

        //modal
        this.mul = document.querySelector('#mul');
        this.val = document.querySelector('#val');
        this.winModal = document.querySelector('.btn_outcome');
        this.loseModal = document.querySelector('.btn_outcome_lose');
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
        this.ghid = 0;
        this.carteiraButton = document.querySelector('#_payin');
        //jogadores
        this.apsts = document.querySelector('.jogadores');
        this.cpU = document.getElementById('copyUsername');

        this.cntdrNtrval = 0;
        this.init();
    }
    CrashGame.prototype.init = function () {
        // clearInterval(this.main_interval);
        this.cntdrNtrval = 100;
        this.initiated = true;
        this.cl = false;
        this.playCrash.innerHTML = gBtT("jogar");
        $('#playCrash').attr('disabled', false);
        this.betMulti = 0;

        const crash_segundos = localStorage.getItem('crsh_segundos');
        if (crash_segundos != null) {
            this.sec = crash_segundos;
        } else {
            this.sec = 10;
        }

        this.mil = 60;
        this.num1 = 0;
        this.num2 = 0;

        const crash_num = JSON.parse(localStorage.getItem('crsh_num'));
        if (localStorage.getItem('crsh_num') != null) {
            this.num = this.numhash(crash_num[1]);
        } else {
            this.num = 1.00;
        }

        this.num = parseInt(this.num.toFixed(2));
        this.betMoney = 0;
        this.betMulti = 0;
        this.rodada++;
        this.hasWin = false;
        //initiate result distribution
        this.game_id = document.querySelector('#game_id');
        //pegar
        this.payOutActive = false;
        //EVENTS
        //jogadores
        this.apsts.innerHTML = "";
        this.apArr = [];
        this.actionListener();
        this.countDown();
        this.gapts();
    };
    CrashGame.prototype.countDown = function () {
        var _this = this;

        if (_this.apArr.length == 0 && localStorage.getItem('crsh_res') !== null && _this.num == 1.00) {
            _this.rCRG();
        }

        let totalMilissegundos 	= this.sec * 1000;
        let start				= new Date().getTime();

        _this.barratimer.style.display = 'block';
        $('.barraprog').attr('style', 'animation: bar-animation ' + _this.sec + 's linear');

        var countDown = setInterval(function () {
            let now				= new Date().getTime();
            let tempoDecorrido = now - start;
            let tempoRestante = totalMilissegundos - tempoDecorrido;
            let segundos = Math.floor((tempoRestante % 60000) / 1000);
            let milissegundos = tempoRestante % 1000;
            let texto = ("" + segundos).slice(-2) + "." + ("" + milissegundos).slice(0, 2);

            const crash_num = JSON.parse(localStorage.getItem('crsh_num'));
            if (crash_num !== null) {
                _this.num = crash_num[0];
                _this.velaAtual = _this.numhash(crash_num[1]);
                _this.mimicCntdwn();
                clearInterval(countDown);
            }

            localStorage.setItem('crsh_segundos', segundos);

            _this.newTimer.innerText = texto;
            _this.barraprog.classList.add('animabarra');

            //Real timeout
            if (tempoRestante <= 10) {
                localStorage.removeItem('crsh_segundos');
                clearTimeout(_this.givl);
                _this.inPlay = true;
                _this.playCrash.classList.add('disabled');
                _this.barratimer.style.display = 'none';
                _this.newTimer.style.display = 'none';
                clearInterval(countDown);
                _this.velaAtual = _this.generateResult(); //abertura da vela
                _this.velaAtual = Number(_this.velaAtual.toFixed(2));
                _this.rocket.classList.add('lancado');
                _this.rastro.classList.add('rastro_anim');
                // _this.rocketImg.classList.add('motor');
                _this.rocketContainer.classList.add('nitro');
                if (_this.velaAtual > 1.20) {
                    _this.rocks.classList.add('partida');
                    _this.parallax_bg.classList.add('parallax_bg_ani');
                    _this.moon.classList.add('buwan');
                    _this.rock1.classList.add('rock1down');
                    _this.rock2.classList.add('rock2down');
                    _this.sky.classList.add('fadein');
                    _this.sat.classList.remove('float');
                    _this.sat.classList.add('satdescida');
                }
                //PEGA OS NUMEROS DA VELA E SEPARA EM DOIS
                var velaText = _this.velaAtual.toString();
                var sVela = velaText.split(".");
                _this.nVela1 = parseInt(sVela[0]);
                _this.nVela2 = parseInt(sVela[1]);
                var betText = _this.betMulti.toString();
                var sBet = betText.split(".");
                _this.nBet1 = parseInt(sBet[0]);
                _this.nBet2 = parseInt(sBet[1]);
                _this.contador();
                if (_this.betMoney < 0.1) {
                    _this.playCrash.innerHTML = gBtT("aguarde");
                    $('#playCrash').attr('disabled', true);
                }

                if (_this.betMoney >= 0.1) {
                    _this.payOutActive = true;
                }
            }
        }, 1);
    };
    CrashGame.prototype.mimicCntdwn = function() {
        var _this = this;
        localStorage.removeItem('crsh_segundos');
        clearTimeout(_this.givl);
        _this.inPlay = true;
        _this.playCrash.classList.add('disabled');
        _this.barratimer.style.display = 'none';
        _this.newTimer.style.display = 'none';
        _this.velaAtual = Number(_this.velaAtual.toFixed(2));
        _this.rocket.classList.add('lancado');
        _this.rastro.classList.add('rastro_anim');
        // _this.rocketImg.classList.add('motor');
        _this.rocketContainer.classList.add('nitro');
        if (_this.velaAtual > 1.20) {
            _this.rocks.classList.add('partida');
            _this.parallax_bg.classList.add('parallax_bg_ani');
            _this.moon.classList.add('buwan');
            _this.rock1.classList.add('rock1down');
            _this.rock2.classList.add('rock2down');
            _this.sky.classList.add('fadein');
            _this.sat.classList.remove('float');
            _this.sat.classList.add('satdescida');
        }
        //PEGA OS NUMEROS DA VELA E SEPARA EM DOIS
        var velaText = _this.velaAtual.toString();
        var sVela = velaText.split(".");
        _this.nVela1 = parseInt(sVela[0]);
        _this.nVela2 = parseInt(sVela[1]);
        var betText = _this.betMulti.toString();
        var sBet = betText.split(".");
        _this.nBet1 = parseInt(sBet[0]);
        _this.nBet2 = parseInt(sBet[1]);
        _this.contador();
        if (_this.betMoney < 0.1) {
            _this.playCrash.innerHTML = gBtT("aguarde");
            $('#playCrash').attr('disabled', true);
        }
    };
    CrashGame.prototype.rCRG = function() {
        var _this = this;
        const crash_res = JSON.parse(localStorage.getItem('crsh_res'));

        crash_res.forEach((result) => {
            if (_this.apArr.length > 20) {
                _this.apArr.shift();
                _this.apsts.removeChild(_this.apsts.children[_this.apsts.children.length - 1]);
            }
            _this.apArr.push(result);
            var d = document.createElement('div');
            var cId = result[1].replace(/\./g, "-");
            const mc = "bet-" + cId;
            const flex = "d-flex";
            const between = "justify-content-between";
            const centered = "align-items-center";
            const my = "my-2";

            d.classList.add(my);
            d.classList.add(flex);
            d.classList.add(between);
            d.classList.add(centered);

            var d1 = document.createElement('div');

            d1.className = 'crash__player--username';
            d1.textContent = result[0];
            d.appendChild(d1);

            var d2 = document.createElement('div');
            d2.classList.add('crash__player--multiplier');

            let vela_class;

            if (result[1] >= 1.00 && result[1] <= 1.50) {
                vela_class = "vela--item3";
            }
            else if (result[1] >= 1.51 && result[1] <= 2.50) {
                vela_class = "vela--item1";
            }
            else {
                vela_class = "vela--item2";
            }

            d2.classList.add(vela_class);

            d2.textContent = 'x' + result[1];
            d.appendChild(d2);

            var d3 = document.createElement('div');
            d3.classList.add('crash__player--bet');

            var s1 = document.createElement('span');
            s1.textContent = "R$";
            s1.classList.add('crash__player__bet--rs');

            var s2 = document.createElement('span');
            s2.textContent = result[2];
            s2.classList.add(mc);
            s2.classList.add('crash__player__bet--value');

            if (_this.num >= result[1]) {
                s2.classList.add('game__color--win');
            } else {
                s2.classList.add('game__color--initial');
            }

            d3.appendChild(s1);
            d3.appendChild(s2);

            d.appendChild(d3);
            _this.apsts.prepend(d);
        });
    }
    CrashGame.prototype.numhash = function (inNum) {
        return (((0x0000FFFF & inNum) << 16) + ((0xFFFF0000 & inNum) >> 16));
    }
    CrashGame.prototype.contador = function () {
        setTimeout(() => {
            if (this.num > 2.00 && this.num <= 3.50) {
                this.cntdrNtrval -= 0.5;
            } else if (this.num > 4.00 && this.num <= 5.00) {
                this.cntdrNtrval -= 0.3;
            } else if (this.num > 5.50 && this.num <= 7.00) {
                this.cntdrNtrval -= 0.1;
            } else if (this.num > 10) {
                this.cntdrNtrval -= 0.1;
            }


            var _this = this;

            if (_this.apArr.length == 0 && localStorage.getItem('crsh_res') !== null && _this.num != 1.00) {
                _this.rCRG();
            }

            let shouldStop = false;

            var _a;

            if (_this.initiated == true) {
                _this.num += 0.01;
                const crash_num = [_this.num, _this.numhash(_this.velaAtual)];
                localStorage.setItem('crsh_num', JSON.stringify(crash_num));
            }
            else {
                // clearInterval(_this.main_interval);
                shouldStop = true;
            }

            if (_this.num > 0) {
                _this.cl = false;
            }

            var cid = _this.num.toFixed(2).replace(/\./g, "-");
            $('.bet-' + cid).each(function(index, element) {
                $(this).removeClass('game__color--initial')
                $(this).addClass('game__color--win');
            });
            if (_this.betMulti == parseFloat(_this.num.toFixed(2))) {
                if (_this.payOutActive == true) {
                    _this.payOutActive = false;
                    _this.playCrash.classList.add('disabled');
                    _this.playCrash.innerHTML = gBtT("aguarde");
                    $('#playCrash').attr('disabled', true);
                    if (_this.betMulti !== 0 && _this.betMoney !== 0) {
                        _this.hasWin = true;
                        _this.newTimer.innerText = 'Você ganha!';
                        _this.numberInit.classList.add('nFinishSuccess');
                        _this.mul.innerHTML = 'x' + _this.num.toFixed(2);
                        _this.val.innerHTML = (_this.num * _this.betMoney).toFixed(2);
                        _this.winModal.style.display = 'block';
                        $('.btn_outcome').click();
                        _this.numberInit.style.display = 'none';
                        var creditInterval_1 = setInterval(function () {
                            _this.winModal.style.display = 'none';
                            _this.mul.innerHTML = 0;
                            _this.val.innerHTML = 0;
                            _this.numberInit.style.display = 'block';
                            _this.newTimer.innerText = '';
                            _this.numberInit.classList.remove('nFinishSuccess');
                            _this.addWinCredits(_this.betMoney, _this.betMulti);
                            clearInterval(creditInterval_1);
                        }, 2000);
                    }
                }
            }
            else if (_this.velaAtual <= parseFloat(_this.num.toFixed(2))) {
                $('.game__color--initial').each(function(index, element) {
                    $(this).removeClass('game__color--initial');
                    $(this).addClass('game__color--lose');
                });
                _this.payOutActive = false;
                _this.playCrash.innerHTML = gBtT("aguarde");
                $('#playCrash').attr('disabled', true);
                // clearInterval(_this.main_interval);
                shouldStop = true;
                if (_this.betMulti != 0 && !_this.hasWin) {
                    $('.btn_outcome_lose').click();
                    _this.loseModal.style.display = 'block';
                    _this.numberInit.style.display = 'none';
                }
                _this.numberInit.innerText = _this.velaAtual + 'x';
                if (_this.velaAtual < 1.2) {
                    _this.box.style.visibility = 'hidden';

                }
                _this.numberInit.classList.add('nFinish');
                _this.rocket.classList.add('destruct');
                _this.rastro.classList.add('d-none');
                var estouro_1 = setTimeout(function () {
                    _this.crash.classList.add('estouro');
                    // _this.ejected_alien.classList.add('ejected_alien_trigger');
                    _this.newTimer.innerText = 'Agora jogue pra valer!';
                    clearInterval(estouro_1);
                }, 200);
                //RESETANDO VARIÁVEIS E CLASSES
                _this.resetGame();
            }
            else {
                if (_this.betMoney > 0 && _this.payOutActive == true && _this.cl == false) {
                    _this.playCrash.classList.remove('disabled');
                    $('#playCrash').attr('disabled', false);
                    _this.playCrash.innerHTML = gBtT("pegar") + "<br><i class='fa fa-coins'></i> " + (_this.betMoney * _this.num).toFixed(2);
                    (_a = _this.playCrash) === null || _a === void 0 ? void 0 : _a.addEventListener("click", function () {
                        if (_this.payOutActive == true) {
                            _this.payOutActive = false;
                            _this.cl = true;
                            _this.payOut();
                        }
                    });
                }
            }
            _this.numberInit.innerText = _this.num.toFixed(2) + 'x';

            if (shouldStop == false) {
                this.contador();
            }
        }, this.cntdrNtrval);
    };
    CrashGame.prototype.payOut = function () {
        var _this = this;

        //jogadores
        $('.bet-self').each(function(index, element) {
            $(this).removeClass()
            $(this).css('color', '#F9FF2B');
        });

        _this.hasWin = true;

        //modal
        this.mul.innerHTML = 'x' + this.num.toFixed(2);
        this.val.innerHTML = (this.num * this.betMoney).toFixed(2);
        this.winModal.style.display = 'block';
        $('.btn_outcome').click();
        this.numberInit.style.display = 'none';
        this.playCrash.classList.add('disabled');
        this.playCrash.innerHTML = gBtT("aguarde");
        $('#playCrash').attr('disabled', true);
        this.betMulti = parseFloat(this.num.toFixed(2));
        this.payOutActive = false;
        var creditInterval = setInterval(function () {
            _this.winModal.style.display = 'none';
            _this.numberInit.style.display = 'block';
            _this.addWinCredits(_this.betMoney, _this.betMulti);
            _this.betMulti = 0;
            _this.betMoney = 0;
            clearInterval(creditInterval);
        }, 2000);
    };
    CrashGame.prototype.resetGame = function () {
        localStorage.removeItem('crsh_num');
        localStorage.removeItem('crsh_res');
        var _this = this;
        var resetInterval = setTimeout(function () {
            //modal
            _this.loseModal.style.display = 'none';
            _this.winModal.style.display = 'none';
            _this.mul.innerHTML = 0;
            _this.val.innerHTML = 0;
            //counter
            _this.numberInit.style.display = 'block';
            _this.newTimer.style.display = 'block';
            _this.rocket.classList.remove('lancado');
            _this.rastro.classList.remove('rastro_anim');
            // _this.rocketImg.classList.remove('motor');
            _this.rocks.classList.remove('partida');
            _this.parallax_bg.classList.remove('parallax_bg_ani');
            _this.moon.classList.remove('buwan');
            _this.sat.classList.remove('descida');
            _this.sat.classList.add('float');
            _this.rock1.classList.remove('rock1down');
            _this.rock2.classList.remove('rock2down');
            _this.numberInit.classList.remove('nFinish');
            _this.box.style.visibility = 'visible';
            _this.rocket.classList.remove('destruct');
            _this.rastro.classList.remove('d-none');
            _this.sky.classList.remove('fadein');
            _this.crash.classList.remove('estouro');
            _this.barraprog.classList.remove('animabarra');
            _this.rocketContainer.classList.remove('nitro');
            if (_this.hasWin) {
                _this.numberInit.classList.remove('nFinishSuccess');
            }
            //VARIÁVEIS PARA O CONTADOR DO NUMBER-INIT
            _this.numberInit.innerText = '1.00x';
            _this.inPlay = false;
            _this.playCrash.classList.remove('disabled');
            _this.storeVelas(_this.velaAtual.toFixed(2));
            _this.init();
            clearInterval(resetInterval);
        }, 5000); // Espera 5 segundos antes de iniciar uma nova rodada
    };
    CrashGame.prototype.storeVelas = function (vela) {
        var vela_items = document.querySelector('#vela_items');
        if (this.velas.length > 7) {
            this.velas.shift();
        }
        this.velas.push(vela);
        localStorage.setItem('ovls', JSON.stringify(this.velas));
        var vela_elements = "";
        this.velas.forEach(function (vela, key) {
            if (vela >= 1.00 && vela <= 1.50) {
                vela_elements += '<div class="vela--item vela--item3">' + vela + '</div>';
            }
            else if (vela >= 1.51 && vela <= 2.50) {
                vela_elements += '<div class="vela--item vela--item1">' + vela + '</div>';
            }
            else {
                vela_elements += '<div class="vela--item vela--item2">' + vela + '</div>';
            }
        });
        if (vela_items != null) {
            vela_items.innerHTML = vela_elements;
        }
    };
    CrashGame.prototype.actionListener = function () {
        var _this = this;
        var _a;
        (_a = this.playCrash) === null || _a === void 0 ? void 0 : _a.addEventListener("click", function () {
            if (!_this.inPlay && _this.betMulti == 0 && _this.cl == false) {
                _this.cl = true;
                _this.betMoney = _this.betMoneyElmnt.value;
                if (_this.betMoney >= 1) {
                    _this.playCrash.innerHTML = gBtT("aguarde");
                    $('#playCrash').attr('disabled', true);
                    _this.checkFunds();
                } else {
                    return iziToast.info({
                        message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                        icon: "fa fa-info"
                    }), setTimeout(function() {
                        clicked = !1
                    }, 100);
                }
            }
        });
    };
    CrashGame.prototype.deductBalance = function (bet) {
        var _this = this;
        var game_id = this.game_id.getAttribute('data-game-id');
        var data = {
            bet: bet,
            game_id: game_id
        };
        var xhr = new XMLHttpRequest();
        xhr.open('POST', "/api/balance/deduct");
        xhr.setRequestHeader('Content-Type', 'application/json');
        var csrfToken = this.csrfToken.getAttribute('content');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 200) {
                    _this.ghid = response.ghid;
                    _this.mainMoney.setAttribute('data-current-balance', response.new_balance);
                    _this.money_update.innerHTML = "-$" + parseFloat(bet).toFixed(2);
                    _this.div_money_update.style.display = "block";
                    _this.money_update.style.color = "red";
                    _this.hUN();
                    _this.hideMoneyUpdate();

                    setTimeout(function() {
                        _this.mainMoney.innerHTML = response.new_balance;
                        $('.lessmoney__gif').fadeIn(200);
                        $('#money_gif__lose').attr('src', 'https://cdn.29bet.com/assets/img/all/icons/coin-gif.gif');

                        setTimeout(() => {
                            $('.lessmoney__gif').fadeOut(0);
                            $('#money_gif__lose').attr('src', '');
                        }, 1300);
                    }, 3000);
                }
                else {
                    _this.carteiraButton.click();
                }
            } else if (xhr.status == 419) {
                $('#modal_please_login').addClass('md-show');
            } else {
                console.log(new Error(xhr.statusText));
            }
        };
        xhr.send(JSON.stringify(data));
    };
    CrashGame.prototype.addWinCredits = function (bet, multi) {
        var _this = this;
        var game_id = this.game_id.getAttribute('data-game-id');
        var winnings = parseFloat(bet) * parseFloat(multi);
        var data = {
            winnings: winnings,
            game_id: game_id,
            ghid: _this.ghid
        };
        var xhr = new XMLHttpRequest();
        xhr.open('PUT', "/api/balance/add");
        xhr.setRequestHeader('Content-Type', 'application/json');
        var csrfToken = this.csrfToken.getAttribute('content');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 200) {
                    _this.mainMoney.setAttribute('data-current-balance', response.new_balance);
                    _this.money_update.innerHTML = "+$" + (bet * multi).toFixed(2);
                    _this.div_money_update.style.display = "block";
                    _this.money_update.style.color = "yellow";
                    _this.hideMoneyUpdate();

                    setTimeout(function() {
                        $('.moremoney__gif').fadeIn(200);
                        $('#money_gif__gain').attr('src', 'https://cdn.29bet.com/assets/img/all/icons/coin-gif.gif');

                        setTimeout(() => {
                            _this.mainMoney.innerHTML = response.new_balance;
                            $('.moremoney__gif').fadeOut(0);
                            $('#money_gif__gain').attr('src', '');
                        }, 1300);
                    }, 3000);
                }
            } else if (xhr.status == 419) {
                $('#modal_please_login').addClass('md-show');
            } else {
                console.log(new Error(xhr.statusText));
            }
        };
        xhr.send(JSON.stringify(data));
    };
    CrashGame.prototype.hideMoneyUpdate = function () {
        var moneyInterval = setInterval(function () {
            this.div_money_update.style.display = "none";
            clearInterval(moneyInterval);
        }, 3000);
    };
    CrashGame.prototype.generateResult = function () {
        function gRN(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        function gRD(min, max) {
          return (Math.random() * (max - min) + min).toFixed(2);
        }

        const rN = gRN(0, 99);
        const rDt = this.dist[rN];
        const rD = gRD(this.resDist[rDt][0], this.resDist[rDt][1]);

        return parseFloat(rD);
    };
    CrashGame.prototype.checkFunds = function () {
        var _this = this;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', "/api/balance/check");
        xhr.setRequestHeader('Content-Type', 'application/json');
        var csrfToken = this.csrfToken.getAttribute('content');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 200) {
                    if (parseFloat(parseFloat(response.account.control_balance).toFixed(2)) >= _this.betMoney && parseFloat(parseFloat(response.account.control_balance).toFixed(2)) > 0) {
                        _this.betMoney = _this.betMoneyElmnt.value;
                        _this.betMulti = _this.betMultiElmnt.value;
                        _this.playCrash.classList.add('disabled');
                        _this.deductBalance(_this.betMoney);
                    }
                    else {
                        _this.betMoney = 0;
                        _this.betMulti = 0;
                        _this.carteiraButton.click();
                    }
                }
            } else if (xhr.status == 419) {
                $('#modal_please_login').addClass('md-show');
            } else {
                console.log(new Error(xhr.statusText));
            }
        };
        xhr.send();
    };
    CrashGame.prototype.hUN = function () {
        var ign = "";
        ign += "User";
        var cU = this.cpU.textContent;
        var u2 = cU.length - 2;
        for (var i = 1; i <= u2; i++) {
            ign += '*';
        }
        ign += cU[cU.length - 1];
        ign += cU[cU.length - 2];
        var result = [
            ign,
            'x' + this.betMulti,
            'R$ ' + this.betMoney
        ];
        if (this.apArr.length > 20) {
            this.apArr.shift();
            this.apsts.removeChild(this.apsts.children[this.apsts.children.length - 1]);
        }
        this.apArr.push(result);
        localStorage.setItem('crsh_res', JSON.stringify(this.apArr));
        var d = document.createElement('div');
        var cId = parseFloat(this.betMulti).toFixed(2).replace(/\./g, "-");
        const mc = "bet-" + cId;
        const flex = "d-flex";
        const between = "justify-content-between";
        const centered = "align-items-center";
        const my = "my-2";

        d.classList.add(my);
        d.classList.add(flex);
        d.classList.add(between);
        d.classList.add(centered);

        var d1 = document.createElement('div');

        d1.className = 'crash__player--username';
        d1.textContent = "User" + $('#uid').attr('data-uid') + "...";
        d.appendChild(d1);

        var d2 = document.createElement('div');
        d2.classList.add('crash__player--multiplier');

        let vela_class;

        if (this.betMulti >= 1.00 && this.betMulti <= 1.50) {
            vela_class = "vela--item3";
        }
        else if (this.betMulti >= 1.51 && this.betMulti <= 2.50) {
            vela_class = "vela--item1";
        }
        else {
            vela_class = "vela--item2";
        }

        d2.classList.add(vela_class);

        d2.textContent = 'x' + parseFloat(this.betMulti).toFixed(2);
        d.appendChild(d2);

        var d3 = document.createElement('div');
        d3.classList.add('crash__player--bet');

        var s1 = document.createElement('span');
        s1.textContent = "R$";
        s1.classList.add('crash__player__bet--rs');

        var s2 = document.createElement('span');
        s2.textContent = parseFloat(this.betMoney).toFixed(2);
        s2.classList.add('crash__player__bet--value');
        s2.classList.add('game__color--initial');
        s2.classList.add(mc);

        d3.appendChild(s1);
        d3.appendChild(s2);

        d.appendChild(d3);
        this.apsts.prepend(d);
    };
    CrashGame.prototype.gapts = function () {
        var _this = this;
        var interval = Math.floor(Math.random() * 500) + 300;
        this.givl = setTimeout(function () {
            var result = _this.gApsts();
            if (_this.apArr.length > 20) {
                _this.apArr.shift();
                _this.apsts.removeChild(_this.apsts.children[_this.apsts.children.length - 1]);
            }
            _this.apArr.push(result);
            localStorage.setItem('crsh_res', JSON.stringify(_this.apArr));
            var d = document.createElement('div');
            var cId = result[1].replace(/\./g, "-");
            const mc = "bet-" + cId;
            const flex = "d-flex";
            const between = "justify-content-between";
            const centered = "align-items-center";
            const my = "my-2";

            d.classList.add(my);
            d.classList.add(flex);
            d.classList.add(between);
            d.classList.add(centered);

            var d1 = document.createElement('div');

            d1.className = 'crash__player--username';
            d1.textContent = result[0];
            d.appendChild(d1);

            var d2 = document.createElement('div');
            d2.classList.add('crash__player--multiplier');

            let vela_class;

            if (result[1] >= 1.00 && result[1] <= 1.50) {
                vela_class = "vela--item3";
            }
            else if (result[1] >= 1.51 && result[1] <= 2.50) {
                vela_class = "vela--item1";
            }
            else {
                vela_class = "vela--item2";
            }

            d2.classList.add(vela_class);

            d2.textContent = 'x' + result[1];
            d.appendChild(d2);

            var d3 = document.createElement('div');
            d3.classList.add('crash__player--bet');

            var s1 = document.createElement('span');
            s1.textContent = "R$";
            s1.classList.add('crash__player__bet--rs');

            var s2 = document.createElement('span');
            s2.textContent = result[2];
            s2.classList.add('crash__player__bet--value');
            s2.classList.add('game__color--initial');
            s2.classList.add(mc);

            d3.appendChild(s1);
            d3.appendChild(s2);

            d.appendChild(d3);
            _this.apsts.prepend(d);
            _this.gapts();
        }, interval);
    };
    CrashGame.prototype.gApsts = function () {
        var user = "";
        var fword = "User";
        var lword = this.mkId(4);
        user += fword;
        user += lword;
        user += '...';
        var mul = this.mkRdI(1, 25);

        if (mul == 1) {
            mul += '.';
            mul += this.mkRdI(1, 9);
            mul += 0;
        } else {
            mul += '.';
            mul += this.mkRdI(0, 9);
            mul += 0;
        }

        var val = "";
        val += this.mkRdI(0, 9);

        if (val == 0) {
            val = this.mkRdI(1, 9);
        } else {
            val += this.mkRdI(0, 9);
        }

        return [
            user,
            mul,
            parseFloat(val).toFixed(2)
        ];
    };
    CrashGame.prototype.mkRdIi = function () {
        const randomDecimal = Math.random();
        const randomNumber = randomDecimal < 0.5 ? 0 : 5;

        return randomNumber;
     }
    CrashGame.prototype.mkRdI = function (mn, mx) {
        mn = Math.ceil(mn);
        mx = Math.floor(mx);
        return Math.floor(Math.random() * (mx - mn + 1)) + mn;
    };
    CrashGame.prototype.mkId = function (length) {
        var result = '';
        var characters = '0123456789';
        var characters2 = '0123456789a0123456789b0123456789c0123456789d0123456789e0123456789f0123456789g0123456789h0123456789i0123456789j0123456789kl0123456789m0123456789n0123456789o0123456789p0123456789q0123456789r0123456789s0123456789t0123456789u0123456789v0123456789w0123456789x0123456789y0123456789z0123456789';
        var counter = 0;
        while (counter < length) {
            if (counter > 1) {
                result += characters2.charAt(Math.floor(Math.random() * characters2.length));
            } else {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            counter += 1;
        }
        return result;
    };
    CrashGame.prototype.gRsltds = function () {
        if (this.velas.length == 0) {
            const ovls = localStorage.getItem('ovls');

            if (ovls == null) {
                for (let i = 1;i <= 8;i++) {
                    this.storeVelas(this.generateResult().toFixed(2));
                }
            } else {
                const vls = JSON.parse(ovls);

                vls.forEach((lmnt) => {
                    this.storeVelas(lmnt);
                });
            }
        }
    }
    CrashGame.prototype.gDst = function () {
        const xhr = new XMLHttpRequest();
        const csrfToken = $('meta[name=csrf-token]').attr('content');

        const data = {
            game_id: 2
        };

        xhr.open("POST", "/api/crash/init");

        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

        xhr.onload = () => {
            if (xhr.status >= 200 && xhr.status < 300) {
                const response = JSON.parse(xhr.responseText);

                response.cf.forEach((value, key) => {
                    for (let i = 1;i <= value;i++) {
                        this.dist.push(key);
                    }
                });

                this.gRsltds();
            } else if (xhr.status == 419) {
                $('#modal_please_login').addClass('md-show');
            } else {
                console.log(new Error(xhr.statusText));
            }
        };

        xhr.send(JSON.stringify(data));
    }
    return CrashGame;
}());


window.onload = function() {
    new CrashGame();
}
