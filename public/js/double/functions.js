//  (function(){
newWheel = {
    vars: {},
    roulette: [],
    prizes: 21,
    interval: 1,
    reqAjax: false,
    aposta: false,
    rouletteNode: document.querySelector(".roulette-wheel"),
    tempoPausa: $('#waiting_time').attr('data-game-waiting'),
    colors: ["white", "red", "black"],
    eq: {
        0: 'black',
        1: 'red',
        2: 'black',
        3: 'red',
        4: 'black',
        5: 'red',
        6: 'black',
        7: 'red',
        8: 'black',
        9: 'red',
        10: 'black',
        11: 'red',
        12: 'black',
        13: 'red',
        14: 'black',
        15: 'red',
        16: 'black',
        17: 'red',
        18: 'black',
        19: 'red',
        20: 'white'
    },
    prizesColors: [],
    hasWhite: false,
    resultados: [],
    offset: 0,
    probabilidade: 8,
    betMoney: 0,
    betMulti: '',
    speed: $('#speed').attr('data-game-speed'),
    isI: false,
    givl: null,
    apArr: [],
    prvRslt: null,
    prvSts: null,
    rdd: 0,
    sndMt: false,
    shldWt: false,
    ghid: 0,

    options: {
        spacing: 15,
        acceleration: 450,
        fps: 45,
        audio: "https://cdn.29bet.com/assets/assets/media/click.mp3",
        selector: ":scope > *",
        stopCallback: function ({
            detail: {
                prize
            }
        }) {
            newWheel.verificaGanhoPerca();
            newWheel.verificaAjax(function () {
                newWheel.exibirResultados();
                let dNtrvl = 2000;
                if (newWheel.prvSts != null) {
                    dNtrvl = 3500;
                }
                setTimeout(() => {
                    newWheel.doubleReset();
                }, dNtrvl);
                newWheel.initCron(newWheel.tempoPausa);
            });
        },
        startCallback: function ({
            detail: {
                prize
            }
        }) {
            newWheel.playToAwait();
        }
    },

    PXadjust: {
        280: "-62.4321px",
        285: "-60.424px",
        290: "-58.424px",
        295: "-56.424px",
        300: "-54.424px",
        305: "-50.424px",
        310: "-48.424px",
        315: "-46.424px",
        320: "-44.424px",
        325: "-42.424px",
        330: "-40.424px",
        335: "-37.424px",
        340: "-34.424px",
        345: "-32.424px",
        350: "-31.424px",
        355: "-28.424px",
        360: "-25.424px",
        365: "-23.4356px",
        370: "-21.4356px",
        375: "-20.4356px",
        390: "-12.4717px",
        393: "-11.4051px",
        400: "-8px",
        405: "-5px",
        410: "-3px",
        415: "-1px",
        420: "1px",
        425: "5px",
        430: "7px",
        435: "9px",
        440: "11px",
        445: "13px",
        450: "15px",
        455: "18px",
        460: "20px",
        465: "22px",
        470: "24px",
        475: "27px",
        480: "29px",
        485: "31px",
        490: "34px",
        495: "36px",
        500: "38px",
        505: "41px",
        510: "43px",
        515: "45px",
        520: "47px",
        525: "50px",
        530: "52px",
        540: "55px",
        550: "60px",
        555: "64px",
        560: "66px",
        565: "68px",
        570: "70px",
        575: "72px",
        582: "55px",
        600: "54px",
        645: "52px",
        680: "50px",
        720: "48px",
        767: "48px",
        870: "137.4923px",
        880: "136.4923px",
        890: "134.4923px",
        900: "132.4923px",
        920: "118.4923px",
        945: "112.4923px",
        970: "108.4923px",
        991: "103.4923px",
        1020: "18.4925px",
        1045: "53.4925px",
        1070: "49.4925px",
        1085: "45.4925px",
        1100: "41.4925px",
        1125: "38.4925px",
        1145: "33.4925px",
        1170: "29.4925px",
        1200: "24.4925px",
        1220: "29.4925px",
        1250: "26.4493px",
        1265: "21.4493px",
        1270: "19.4493px",
        1285: "17.4692px",
        1300: "14.4692px",
        1330: "10.4692px",
        1345: "4.9952px",
        1370: "1.9952px",
        1377: "1",
        1399: "-2.9952px",
        1400: "-23.9952px",
        1420: "-27.9952px",
        1440: "-30.9952px",
        1470: "-30.9952px",
        1520: "-30.9952px"
    },

    doubleReset: function () {
        let spacing = 0;
        const winWidth = window.innerWidth;

        // console.log(winWidth);

        if (winWidth > 1520) {
            spacing = "-30.9952px";
        } else {
            if (newWheel.PXadjust[winWidth] != undefined) {
                spacing = newWheel.PXadjust[winWidth];
            } else {
                Object.entries(newWheel.PXadjust).forEach((element, key) => {
                    if (spacing == 0 && winWidth <= element[0]) {
                        spacing = element[1];
                    }
                });
            }
        }

        const items = {
            0: {
                "classes": {
                    "color": "prize-item--black",
                    "element": "element-18"
                },
                "number": "18"
            },
            1: {
                "classes": {
                    "color": "prize-item--red",
                    "element": "element-19"
                },
                "number": "19"
            },
            2: {
                "classes": {
                    "color": "prize-item--white",
                    "element": "element-20"
                },
                "number": "20"
            },
            3: {
                "classes": {
                    "color": "prize-item--black",
                    "element": "element-0"
                },
                "number": "0"
            },
            4: {
                "classes": {
                    "color": "prize-item--red",
                    "element": "element-1"
                },
                "number": "1"
            },
            5: {
                "classes": {
                    "color": "prize-item--black",
                    "element": "element-2"
                },
                "number": "2"
            },
            6: {
                "classes": {
                    "color": "prize-item--red",
                    "element": "element-3"
                },
                "number": "3"
            },
            7: {
                "classes": {
                    "color": "prize-item--black",
                    "element": "element-4"
                },
                "number": "4"
            },
            8: {
                "classes": {
                    "color": "prize-item--red",
                    "element": "element-5"
                },
                "number": "5"
            },
            9: {
                "classes": {
                    "color": "prize-item--black",
                    "element": "element-6"
                },
                "number": "6"
            },
            10: {
                "classes": {
                    "color": "prize-item--red",
                    "element": "element-7"
                },
                "number": "7"
            },
            11: {
                "classes": {
                    "color": "prize-item--black",
                    "element": "element-8"
                },
                "number": "8"
            },
            12: {
                "classes": {
                    "color": "prize-item--red",
                    "element": "element-9"
                },
                "number": "9"
            },
            13: {
                "classes": {
                    "color": "prize-item--black",
                    "element": "element-10"
                },
                "number": "10"
            },
            14: {
                "classes": {
                    "color": "prize-item--red",
                    "element": "element-11"
                },
                "number": "11"
            },
            15: {
                "classes": {
                    "color": "prize-item--black",
                    "element": "element-12"
                },
                "number": "12"
            },
            16: {
                "classes": {
                    "color": "prize-item--red",
                    "element": "element-13"
                },
                "number": "13"
            },
            17: {
                "classes": {
                    "color": "prize-item--black",
                    "element": "element-14"
                },
                "number": "14"
            },
            18: {
                "classes": {
                    "color": "prize-item--red",
                    "element": "element-15"
                },
                "number": "15"
            },
            19: {
                "classes": {
                    "color": "prize-item--black",
                    "element": "element-16"
                },
                "number": "16"
            },
            20: {
                "classes": {
                    "color": "prize-item--red",
                    "element": "element-17"
                },
                "number": "17"
            },
        };

        document.querySelector('.roulette__list').innerHTML = "";

        Object.values(items).forEach((item, key) => {
            let styleTxt = "margin-right: clamp(3px, 2vw, 15px); min-width: 115px; min-height: 115px;";
            if (key == 0) {
                styleTxt += " margin-left: " + spacing;
            } else {
                styleTxt += " margin-left: 0px;";
            }

            const pli = document.createElement('li');
            pli.classList.add('roulette__prize');
            pli.style.cssText = styleTxt;

            const mdv = document.createElement('div');
            mdv.classList.add('prize-item');
            mdv.classList.add(item.classes.color);
            mdv.classList.add(item.classes.element);


            let ep = document.createElement('p');
            ep.classList.add('prize-item-element');
            const nd = document.createTextNode(item.number);
            ep.appendChild(nd);

            if (key == 2) {
                ep = document.createElement('img');
                ep.setAttribute('src', "https://cdn.29bet.com/assets/img/all/pages/layout/favicon.png");
            }

            mdv.appendChild(ep);

            pli.appendChild(mdv);

            document.querySelector('.roulette__list').append(pli);
        });
    },

    verificaGanhoPerca: function () {
        const eqArr = Object.values(newWheel.eq);
        const result = eqArr[newWheel.itemRoulette];
        var cor = newWheel.betMulti;
        newWheel.prvRslt = result;

        if (result == cor) {
            newWheel.setGanho();
        } else {
            newWheel.setDerrota();
        }
    },
    corSelected: 'red',
    pickColor: function (COR) {
        newWheel.corSelected = COR
        $('[data-wheel-color]').removeClass('active');
        $('[data-wheel-color="' + COR + '"]').addClass('active');
    },
    distribuirArrays: function (arr1, arr2) {
        var maiorArray = arr1.length > arr2.length ? arr1 : arr2;
        var menorArray = arr1.length <= arr2.length ? arr1 : arr2;
        var resultado = [];
        var qtdDistribuir = Math.ceil(maiorArray.length / menorArray.length);
        var indexMenor = 0;
        for (var i = 0; i < maiorArray.length; i++) {
            resultado.push(maiorArray[i]);
            if (i % qtdDistribuir === qtdDistribuir - 1 && indexMenor < menorArray.length) {
                resultado.push(menorArray[indexMenor]);
                indexMenor++;
            }
        }
        return resultado;
    },

    shuffleArray: function (array) {
        array.sort(() => Math.random() - 0.5);
        return array;
    },

    getArrayRange: function (myArray, qtdd) {
        let startIndex = Math.floor(Math.random() * (myArray.length - (qtdd)));
        let range = myArray.slice(startIndex, startIndex + (qtdd));
        return range;
    },

    mergeArrays: function (array1, array2) {
        const mergedArray = [...array1, ...array2];
        const shuffledArray = newWheel.shuffleArray(mergedArray);
        return shuffledArray;
    },

    multiplyArray: function (array, qtdd) {
        let multipliedArray = [];
        for (let i = 0; i < qtdd; i++) {
            multipliedArray = multipliedArray.concat(array);
        }
        return multipliedArray;
    },

    formataArrays: function (CONT) {

        var black = newWheel.arrayProbab['black'];
        var white = newWheel.arrayProbab['white'];
        var red = newWheel.arrayProbab['red'];

        if (newWheel.corSelected == 'red') {

            var newRed = newWheel.shuffleArray(newWheel.multiplyArray(red, 50));
            var arrayChances = newWheel.getArrayRange(newRed, newWheel.probabilidade)
            var white = newWheel.getArrayRange(newWheel.arrayProbab['white'], 4);
            var arrays_para_sorteio = newWheel.distribuirArrays(black, white);

        } else if (newWheel.corSelected == 'black') {

            var newBlack = newWheel.shuffleArray(newWheel.multiplyArray(black, 50));
            var arrayChances = newWheel.getArrayRange(newBlack, newWheel.probabilidade)
            var white = newWheel.getArrayRange(newWheel.arrayProbab['white'], 4);
            var arrays_para_sorteio = newWheel.distribuirArrays(red, white);

        } else if (newWheel.corSelected == 'white') {

            var newWhite = newWheel.shuffleArray(newWheel.multiplyArray(white, 50));
            var arrayChances = newWheel.getArrayRange(newWhite, newWheel.probabilidade)
            var arrays_para_sorteio = newWheel.distribuirArrays(red, black);

        }

        newWheel.arrays_para_sorteio = newWheel.distribuirArrays(arrayChances, arrays_para_sorteio);

    },

    updateInfosForm: function (CONT) {
        newWheel.vars.valorAposta = parseFloat($("#bet").val());
        newWheel.vars.corApostada = newWheel.corSelected;
        newWheel.vars.fatorX = $('[data-wheel-color="' + newWheel.corSelected + '"]').data('x');
    },

    upKeyForm: function () {
        $("#bet").on("change", function () {
            newWheel.updateInfosForm(0);
        });
        $("#00").off("click").on("click", function () {
            $("#bet").val(0);
            $("#bet").change();
        });

        $(".add-valor").off("click").on("click", function () {
            var valor1 = parseFloat($("#bet").val())
            var valor2 = parseFloat($(this).data('add'))
            var valor3 = parseFloat(valor1 + valor2).toFixed(2);
            if (valor1 > 9999999 || valor1 < 0 || isNaN(valor1)) {
                $("#bet").val(0);
            } else {
                $("#bet").val(valor3);
            }
            $("#bet").change();
        });
    },

    arrayProbab: {},

    criaCards: function () {
        var arrayProbab = {
            'white': [],
            'red': [],
            'black': []
        };
        $('.roulette-wheel').html('');

        for (let i = 0; i <= (newWheel.prizes - 1); ++i) {
            let limit = (newWheel.prizes - 1)
            let el = document.createElement("div");
            let color;
            if (i == limit) {
                color = "white";
            } else {
                color = i % 2 === 0 ? "black" : "red";
            }
            el.classList.add("prize-item");
            $(".roulette-wheel").append(el);
            newWheel.prizesColors.push(color);
            switch (color) {
                case 'white':
                    arrayProbab.white.push([limit, 'white']);
                    break;
                case 'black':
                    arrayProbab.black.push([i, 'black']);
                    break;
                case 'red':
                    arrayProbab.red.push([i, 'red']);
                    break;
                default:
                    break;
            }

            if (i === limit) {
                el.classList.add(`prize-item--white`);
                let img = document.createElement("img");
                img.classList.add("prize-item-element");
                img.src = "https://cdn.29bet.com/assets/img/all/pages/layout/favicon.png"; // substitua pelo caminho para a imagem desejada
                el.appendChild(img);
            } else {
                el.classList.add(`prize-item--${color}`);
                el.classList.add(`element-${i}`);
                let p = document.createElement("p");
                p.classList.add("prize-item-element");
                p.innerText = i;
                el.appendChild(p);
            }
        }
        newWheel.arrayProbab = arrayProbab;
        newWheel.formataArrays();
    },

    verificaAjax: function (FN = function () {}) {
        if (newWheel.reqAjax == true) {
            setTimeout(function () {
                newWheel.verificaAjax(FN);
            }, 500);
        } else {
            FN();
        }
    },

    stopCronometro: function () {
        clearInterval(newWheel.interval);
    },

    cronometro: function (segundos, callback) {
        newWheel.roulette = [];
        const nsec = localStorage.getItem('dblnsec');

        if (nsec == null) {
            if (newWheel.isI) {
                segundos = segundos;
            } else {
                segundos = 0;
                newWheel.rCRG();
            }
        } else {
            segundos = nsec;
            newWheel.rCRG();
        }

        if (newWheel.rdd != 0) {
            let dNtrvl = 2000;
            if (newWheel.prvSts != null) {
                dNtrvl = 3500;
            }
            let delay = setInterval(() => {
                newWheel.shldWt = false;
                newWheel.AwaitToPlay();
                newWheel.apArr = [];
                localStorage.removeItem('dbl_res');
                $('.jogadores').html('');
                newWheel.gapts();
                clearInterval(delay);
                $('#backgroundTimer').show();
                $('#timer_init').css('width', '100%');
                var totalMilissegundos = segundos * 1000;
                var start = new Date().getTime();
                if (typeof (newWheel.interval) == 'number') {
                    clearInterval(newWheel.interval);
                }
                $('#timer_init').animate({
                    width: 0 + 'px'
                }, segundos * 1000);

                let tsc = 0;

                let scI = setInterval(() => {
                    if (tsc > 0) {
                        localStorage.setItem('dblnsec', tsc);
                    } else {
                        localStorage.removeItem('dblnsec');
                        clearInterval(scI);
                    }
                }, 1000);

                newWheel.interval = setInterval(function () {
                    var now = new Date().getTime();
                    var tempoDecorrido = now - start;
                    var tempoRestante = totalMilissegundos - tempoDecorrido;
                    if (tempoRestante <= 0) {
                        clearInterval(newWheel.givl);
                        clearInterval(newWheel.interval);
                        if (callback) {
                            $('#backgroundTimer').hide();
                            callback();
                        }
                        return;
                    }
                    var segundos = Math.floor((tempoRestante % 60000) / 1000);
                    let milissegundos = tempoRestante % 1000;
                    let texto = ("" + segundos).slice(-2);
                    tsc = segundos;
                    $("#timer").text(`Iniciando em ${texto} segundos`);
                }, 1);
            }, dNtrvl);
        } else {
            newWheel.shldWt = false;
            newWheel.AwaitToPlay();

            if (localStorage.getItem('dbl_res') == null) {
                newWheel.apArr = [];
                localStorage.removeItem('dbl_res');
                $('.jogadores').html('');
            }

            newWheel.gapts();

            $('#backgroundTimer').show();
            $('#timer_init').css('width', '100%');
            var totalMilissegundos = segundos * 1000;
            var start = new Date().getTime();
            if (typeof (newWheel.interval) == 'number') {
                clearInterval(newWheel.interval);
            }
            $('#timer_init').animate({
                width: 0 + 'px'
            }, segundos * 1000);

            let tsc = 0;

            let scI = setInterval(() => {
                if (tsc > 0) {
                    localStorage.setItem('dblnsec', tsc);
                } else {
                    localStorage.removeItem('dblnsec');
                    clearInterval(scI);
                }
            }, 1000);

            newWheel.interval = setInterval(function () {
                var now = new Date().getTime();
                var tempoDecorrido = now - start;
                var tempoRestante = totalMilissegundos - tempoDecorrido;
                if (tempoRestante <= 0) {
                    clearInterval(newWheel.givl);
                    clearInterval(newWheel.interval);
                    if (callback) {
                        $('#backgroundTimer').hide();
                        callback();
                    }
                    return;
                }
                var horas = Math.floor(tempoRestante / 3600000);
                var minutos = Math.floor((tempoRestante % 3600000) / 60000);
                var segundos = Math.floor((tempoRestante % 60000) / 1000);
                var milissegundos = tempoRestante % 1000;
                var texto = ("" + segundos).slice(-2); //+ "." + ("00" + milissegundos).slice(-2);
                tsc = segundos;
                $("#timer").text(`Iniciando em ${texto} segundos`);
            }, 1);
        }
    },

    exibirResultados: function () {
        $("#resultados").html("");

        if (newWheel.resultados.length >= 14) {
            newWheel.resultados.splice(0, 1);
        }

        newWheel.resultados.slice(newWheel.offset, newWheel.offset + 140).forEach(function (resultado, index) {
            //execute account changes here
            let color = newWheel.prizesColors[resultado];

            let div;

            if (resultado == 20) {
                div = `<div class="prize-item--${color} preview-latest-box" id="${resultado}"><img src="https://cdn.29bet.com/assets/img/all/pages/layout/favicon.png"></div>`;
            } else {
                div = `<div class="prize-item--${color} preview-latest-box" id="${resultado}"><p class="preview-latest-number" style="border-radius:50%">${resultado}</p></div>`;
            }
            $("#resultados").append(div);
        });

        $('.bet_double__' + newWheel.prvRslt).removeClass('game__color--initial').addClass('game__color--win');
        $('.game__color--initial').each(function (index, element) {
            $(this).removeClass('game__color--initial');
            $(this).addClass('game__color--lose');
        });

        localStorage.setItem('arOra', JSON.stringify(newWheel.resultados));
    },

    exibirResultadosIniciar: function () {
        //put initial resultados anteriores
        const ora = localStorage.getItem('arOra');

        if (ora == null) {
            let res = [];
            for (let i = 0; i <= 14; i++) {
                let resultado = Math.floor(Math.random() * (20 - 0 + 1)) + 0;
                newWheel.resultados.push(resultado);
                res.push(resultado);

                let color;
                if (resultado == 20) {
                    color = "white";
                } else {
                    color = resultado % 2 === 0 ? "black" : "red";
                }

                let div;

                if (resultado == 20) {
                    div = `<div class="prize-item--${color} preview-latest-box" id="${resultado}"><img src="https://cdn.29bet.com/assets/img/all/pages/layout/favicon.png"></div>`;
                } else {
                    div = `<div class="prize-item--${color} preview-latest-box" id="${resultado}"><p class="preview-latest-number" style="border-radius:50%">${resultado}</p></div>`;
                }
                $("#resultados").append(div);
            }

            localStorage.setItem('arOra', JSON.stringify(res));
        } else {
            const arrOra = JSON.parse(ora);

            arrOra.forEach((element) => {
                let resultado = element;
                newWheel.resultados.push(resultado);

                let color;
                if (resultado == 20) {
                    color = "white";
                } else {
                    color = resultado % 2 === 0 ? "black" : "red";
                }

                let div;

                if (resultado == 20) {
                    div = `<div class="prize-item--${color} preview-latest-box" id="${resultado}"><img src="https://cdn.29bet.com/assets/img/all/pages/layout/favicon.png"></div>`;
                } else {
                    div = `<div class="prize-item--${color} preview-latest-box" id="${resultado}"><p class="preview-latest-number" style="border-radius:50%">${resultado}</p></div>`;
                }
                $("#resultados").append(div);
            });
        }
    },

    adicionarResultado: function (resultado) {
        resultados.push(resultado);
        if (newWheel.offset <= resultados.length - 40) {
            newWheel.exibirResultados();
        }
    },

    sendXHRdeduct: function (url, method, data) {
        const xhr = new XMLHttpRequest();
        const csrfToken = $('meta[name=csrf-token]').attr('content');

        xhr.open(method, url);

        xhr.setRequestHeader('Content-Type', 'appication/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

        xhr.onload = () => {
            if (xhr.status >= 200 && xhr.status < 300) {
                const response = JSON.parse(xhr.responseText);

                if (response.status === 200) {
                    newWheel.playToAwait()
                    newWheel.updateInfosForm(0);

                    newWheel.betMoney = $('#bet').val();
                    newWheel.betMulti = newWheel.corSelected;

                    newWheel.ghid = response.ghid;
                    $('#money').attr('data-current-balance', response.new_balance);
                    $('#money_update').html("-$" + parseFloat(data.bet).toFixed(2));
                    $('#div_money_update').css('display', "block");
                    $('#money_update').css('color', "red");

                    setTimeout(function () {
                        $('#money').html(response.new_balance);
                        $('#div_money_update').css('display', "none");
                        $('.lessmoney__gif').fadeIn(200);
                        $('#money_gif__lose').attr('src', 'https://cdn.29bet.com/assets/img/all/icons/coin-gif.gif');

                        setTimeout(() => {
                            $('.lessmoney__gif').fadeOut(0);
                            $('#money_gif__lose').attr('src', '');
                        }, 1300);
                    }, 3000);
                } else {
                    newWheel.betMoney = 0;
                    newWheel.betMulti = '';
                    $('#bet').val(0);
                    $('#bet_profit').html(0.00);
                }
            } else if (xhr.status == 419) {
                $('#modal_please_login').addClass('md-show');
            } else {
                $('#_payin').click();
            }
        };

        xhr.send(JSON.stringify(data));
    },

    sendXHRadd: function (url, method, data) {
        const xhr = new XMLHttpRequest();
        const csrfToken = $('meta[name=csrf-token]').attr('content');

        xhr.open(method, url);

        xhr.setRequestHeader('Content-Type', 'appication/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

        xhr.onload = () => {
            if (xhr.status >= 200 && xhr.status < 300) {
                const response = JSON.parse(xhr.responseText);

                if (response.status === 200) {
                    $('#money').attr('data-current-balance', response.new_balance);
                    $('#money_update').html("+$" + parseFloat(data.winnings).toFixed(2));
                    $('#div_money_update').css('display', "block");
                    $('#money_update').css('color', "yellow");

                    setTimeout(function () {
                        $('#div_money_update').css('display', "none");
                        $('.moremoney__gif').fadeIn(200);
                        $('#money_gif__gain').attr('src', 'https://cdn.29bet.com/assets/img/all/icons/coin-gif.gif');

                        setTimeout(() => {
                            $('#money').html(response.new_balance);
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
    },

    setAposta: function () {
        const data = {
            bet: $('#bet').val(),
            game_id: 1
        };

        newWheel.sendXHRdeduct("/api/balance/deduct", "POST", data);
    },

    setDerrota: function () {
        newWheel.playToAwait();
        newWheel.updateInfosForm(0);

        if (newWheel.betMoney != 0 && newWheel.betMulti != '') {
            $('.btn_outcome_lose').click();
            $('.outcome-window-lose').fadeIn(200);
            let cWL = setInterval(() => {
                $('.outcome-window-lose').fadeOut(200);
                clearInterval(cWL);
            }, 3500);
            newWheel.resetBet('lose');
        }
    },

    setGanho: function () {
        newWheel.playToAwait();
        newWheel.updateInfosForm(0);

        if (newWheel.betMoney != 0 && newWheel.betMulti != '') {

            let multiplier;

            if (newWheel.betMulti == 'white') {
                multiplier = 14;
            } else {
                multiplier = 2;
            }

            const winnings = (multiplier * newWheel.betMoney).toFixed(2);

            $('.outcome-window_won__sum').html(winnings);
            // $('.outcome-window').fadeIn(200);
            $('.btn_outcome').click();
            // let cWW = setInterval(() => {
            //     $('.outcome-window').fadeOut(200);
            //     clearInterval(cWW);
            // }, 3500);

            const data = {
                winnings: winnings,
                game_id: 1,
                ghid: newWheel.ghid
            };

            newWheel.sendXHRadd("/api/balance/add", "PUT", data);

            newWheel.resetBet('win');
        }
    },

    resetBet: function (sts) {
        newWheel.prvSts = sts;
        newWheel.betMoney = 0;
        newWheel.betMulti = '';
        let interval = setInterval(function () {
            $('#game_result').css('color', 'white');
            $('#game_result').html('');
            clearInterval(interval);
        }, 5000);
    },

    playToAwait: function () {
        $("#play").off('click').text(gBtT("aguarde")).attr('disabled', true);
    },

    AwaitToPlay: function () {
        $('.w_color_btn').removeClass('w_active');
        $('.w_color_btn').click(function () {
            if (newWheel.shldWt == false) {
                $('.w_color_btn').removeClass('w_active');
                $(this).addClass('w_active');
                $('#play').attr('disabled', false);

                const color_selected = $(this).attr('data-wheel-color');

                const tcor = [
                    [
                        "Red",
                        "Vermelho",
                        "红色的"
                    ],
                    [
                        "White",
                        "Branco",
                        "白色的"
                    ],
                    [
                        "Black",
                        "Preto",
                        "黑色的"
                    ]
                ];

                function translate(key) {
                    if ($('#frm_brand').val() == 'en') {
                        return tcor[key][0];
                    } else if ($('#frm_brand').val() == 'pt') {
                        return tcor[key][1];
                    } else {
                        return tcor[key][2];
                    }
                }

                if (color_selected == 'white') {
                    multiplier = 14;
                    $('#w_color').html(translate(1));
                } else {
                    multiplier = 2;

                    if (color_selected == 'red') {
                        $('#w_color').html(translate(0));
                    } else {
                        $('#w_color').html(translate(2));
                    }
                }

                const bet = $('#bet').val();

                $('#bet_profit').html((bet * multiplier).toFixed(2));
            }
        });

        $("#play").off('click').on('click', function () {
            if ($('#bet_profit').text() != 0.00 && $('#bet').val() != 0) {
                newWheel.shldWt = true;
                if ($('#bet').val() >= 1) {
                    newWheel.setAposta();
                    newWheel.hUN();
                } else {
                    return iziToast.info({
                        message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                        icon: "fa fa-info"
                    }), setTimeout(function () {
                        clicked = !1
                    }, 100);
                }

                $('#play').attr('disabled', true);
            } else {
                const clrTr = [
                    "Please select a color",
                    "Por favor selecione uma cor",
                    "请选择颜色"
                ];

                let clr;

                if ($('#frm_brand').val() == 'en') {
                    clr = clrTr[0];
                } else if ($('#frm_brand').val() == 'pt') {
                    clr = clrTr[1];
                } else {
                    clr = clrTr[2];
                }

                return iziToast.info({
                    message: clr,
                    icon: "fa fa-info"
                }), setTimeout(function () {
                    clicked = !1
                }, 100);
            }
        }).text(gBtT("jogar"))
    },

    randomWeighted: function (min, max, lambda) {
        if (this !== crashGame) {
            return;
        }
        const r = Math.random();
        const x = -Math.log(1 - r) / lambda;
        const value = min + (max - min) * (x / (x + 1));
        return value;
    },

    hUN: function () {
        console.log(newWheel.corSelected);

        var result = [
            "User" + $('#uid').attr('data-uid') + "...",
            parseFloat(this.betMoney).toFixed(2),
            'double__' + newWheel.corSelected
        ];
        if (newWheel.apArr.length > 20) {
            newWheel.apArr.shift();
            $('.jogadores').children().first().remove();
        }
        newWheel.apArr.push(result);
        localStorage.setItem('dbl_res', JSON.stringify(newWheel.apArr));
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
        d2.classList.add('double__' + newWheel.corSelected);
        d2.style.textAlign = 'center';
        if ("white" == newWheel.corSelected) {
            var c1 = document.createElement('img');
            c1.setAttribute('src', 'https://cdn.29bet.com/assets/img/all/pages/layout/favicon.png');
            c1.setAttribute('width', '15px');
            d2.appendChild(c1);
        }
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
        s2.classList.add('bet_double__' + newWheel.corSelected);

        d3.appendChild(s1);
        d3.appendChild(s2);

        d.appendChild(d3);
        $('.jogadores').prepend(d);
    },

    rCRG: function () {
        const results = JSON.parse(localStorage.getItem('dbl_res'));

        if (results != null) {
            results.forEach((result) => {
                const gRC = result[2];
                if (newWheel.apArr.length > 20) {
                    newWheel.apArr.shift();
                    $('.jogadores').children().first().remove();
                }
                newWheel.apArr.push(result);
                var d = document.createElement('div');
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
                d2.classList.add(gRC);
                d2.style.textAlign = 'center';
                if ("double__white" == gRC) {
                    var c1 = document.createElement('img');
                    c1.setAttribute('src', 'https://cdn.29bet.com/assets/img/all/pages/layout/favicon.png');
                    c1.setAttribute('width', '15px');
                    d2.appendChild(c1);
                }
                d.appendChild(d2);

                var d3 = document.createElement('div');
                d3.classList.add('crash__player--bet');

                var s1 = document.createElement('span');
                s1.textContent = "R$";
                s1.classList.add('crash__player__bet--rs');

                var s2 = document.createElement('span');
                s2.textContent = result[1];
                s2.classList.add('crash__player__bet--value');
                s2.classList.add('game__color--initial');
                s2.classList.add('bet_' + gRC);

                d3.appendChild(s1);
                d3.appendChild(s2);

                d.appendChild(d3);
                $('.jogadores').prepend(d);
            });
        } else {
            const mx = newWheel.mkRdI(12, 16);
            for (let i = 0; i <= mx; i++) {
                var result = newWheel.gApsts();
                const gRC = newWheel.gRC();
                result.push(gRC);
                if (newWheel.apArr.length > 20) {
                    newWheel.apArr.shift();
                    $('.jogadores').children().first().remove();
                }
                newWheel.apArr.push(result);
                localStorage.setItem('dbl_res', JSON.stringify(newWheel.apArr));
                var d = document.createElement('div');
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
                d2.classList.add(gRC);
                d2.style.textAlign = 'center';
                if ("double__white" == gRC) {
                    var c1 = document.createElement('img');
                    c1.setAttribute('src', 'https://cdn.29bet.com/assets/img/all/pages/layout/favicon.png');
                    c1.setAttribute('width', '15px');
                    d2.appendChild(c1);
                }
                d.appendChild(d2);

                var d3 = document.createElement('div');
                d3.classList.add('crash__player--bet');

                var s1 = document.createElement('span');
                s1.textContent = "R$";
                s1.classList.add('crash__player__bet--rs');

                var s2 = document.createElement('span');
                s2.textContent = result[1];
                s2.classList.add('crash__player__bet--value');
                s2.classList.add('game__color--initial');
                s2.classList.add('bet_' + gRC);

                d3.appendChild(s1);
                d3.appendChild(s2);

                d.appendChild(d3);
                $('.jogadores').prepend(d);
            }
        }
    },

    gapts: function () {
        var interval = Math.floor(Math.random() * 500) + 300;
        newWheel.givl = setTimeout(function () {
            var result = newWheel.gApsts();
            const gRC = newWheel.gRC();
            result.push(gRC);
            if (newWheel.apArr.length > 20) {
                newWheel.apArr.shift();
                $('.jogadores').children().last().remove();
            }
            newWheel.apArr.push(result);
            localStorage.setItem('dbl_res', JSON.stringify(newWheel.apArr));
            var d = document.createElement('div');
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
            d2.classList.add(gRC);
            d2.style.textAlign = 'center';
            if ("double__white" == gRC) {
                var c1 = document.createElement('img');
                c1.setAttribute('src', 'https://cdn.29bet.com/assets/img/all/pages/layout/favicon.png');
                c1.setAttribute('width', '15px');
                d2.appendChild(c1);
            }
            d.appendChild(d2);

            var d3 = document.createElement('div');
            d3.classList.add('crash__player--bet');

            var s1 = document.createElement('span');
            s1.textContent = "R$";
            s1.classList.add('crash__player__bet--rs');

            var s2 = document.createElement('span');
            s2.textContent = result[1];
            s2.classList.add('crash__player__bet--value');
            s2.classList.add('game__color--initial');
            s2.classList.add('bet_' + gRC);

            d3.appendChild(s1);
            d3.appendChild(s2);

            d.appendChild(d3);
            $('.jogadores').prepend(d);
            newWheel.gapts();
        }, interval);
    },

    gRC: function () {
        const i = Math.floor(Math.random() * (20 - 1 + 1)) + 1;
        let color;
        if (i == 20) {
            color = "double__white";
        } else {
            color = i % 2 === 0 ? "double__black" : "double__red";
        }

        return color;
    },

    gApsts: function () {
        var user = "";
        var fword = "User";
        var lword = newWheel.mkId(4);
        user += fword;
        user += lword;
        user += '...';

        var val = "";
        const fn = newWheel.mkRdI(0, 9);
        val += fn;

        if (fn == 0) {
            val = newWheel.mkRdI(0, 9);
        } else {
            val += newWheel.mkRdI(0, 9);
        }

        return [
            user,
            parseFloat(val).toFixed(2)
        ];
    },

    mkId: function (length) {
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
    },

    mkRdI: function (mn, mx) {
        mn = Math.ceil(mn);
        mx = Math.floor(mx);
        return Math.floor(Math.random() * (mx - mn + 1)) + mn;
    },

    snMtListener: function () {
        $('#toggleAudio').click(function () {
            if (newWheel.roulette.length == 0) {
                if (newWheel.sndMt == true) {
                    newWheel.sndMt = false;
                    newWheel.options.audio = "https://cdn.29bet.com/assets/assets/media/click.mp3";
                } else {
                    newWheel.sndMt = true;
                    newWheel.options.audio = null
                }
            } else {
                if (newWheel.sndMt == true) {
                    newWheel.sndMt = false;
                    newWheel.options.audio = "https://cdn.29bet.com/assets/assets/media/click.mp3";
                    newWheel.roulette.muteAudio(new Audio("https://cdn.29bet.com/assets/assets/media/click.mp3"));
                } else {
                    newWheel.sndMt = true;
                    newWheel.options.audio = null
                    newWheel.roulette.muteAudio(null);
                }
            }
        });
    },

    initCron: function (timer = newWheel.tempoPausa) {
        newWheel.stopCronometro();
        if (newWheel.reqAjax == true) {
            newWheel.playToAwait();
        }
        newWheel.cronometro(timer, function () {
            newWheel.shldWt = true;
            if (newWheel.reqAjax == false) {
                $('.outcome-window').fadeOut(200);
                $('.outcome-window-lose').fadeOut(200);
                if (!newWheel.isI) {
                    newWheel.isI = true;
                    newWheel.generateResult(Math.floor(Math.random() * (4 - 1 + 1)) + 1);
                } else {
                    newWheel.generateResult(newWheel.speed);
                }
            } else {
                $('#timer').text("Aguardando server")
                console.log("%c Aguardando server...", "background-color: #303030;color:#ff9000;padding:3px")
                newWheel.initCron(5);
            }
        })
    },

    init: function () {
        console.clear()
        newWheel.upKeyForm();
        newWheel.initCron(newWheel.tempoPausa);
        newWheel.exibirResultadosIniciar();
        newWheel.snMtListener();
    },

    generateResult(trackSpeed) {
        const xhr = new XMLHttpRequest();
        const csrfToken = $('meta[name=csrf-token]').attr('content');

        xhr.open('POST', '/api/double/result');

        xhr.setRequestHeader('Content-Type', 'appication/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

        xhr.onload = () => {
            if (xhr.status >= 200 && xhr.status < 300) {
                const response = JSON.parse(xhr.responseText);

                if (response.status === 200) {
                    newWheel.rdd++;
                    newWheel.criaCards();
                    newWheel.itemRoulette = response.result;
                    newWheel.roulette = new Roulette(".roulette-wheel", newWheel.options);
                    newWheel.roulette.rotateTo(newWheel.itemRoulette, {
                        tracks: trackSpeed,
                        random: true
                    });
                    newWheel.resultados.push(newWheel.itemRoulette);
                }
            } else if (xhr.status == 419) {
                $('#modal_please_login').addClass('md-show');
            } else {
                console.log(new Error(xhr.statusText));
            }
        };

        const data = {
            game_id: 1
        }

        xhr.send(JSON.stringify(data));
    }
}
newWheel.init();
