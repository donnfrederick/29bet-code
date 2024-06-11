! function (e) {
    var i = {};

    function o(s) {
        if (i[s]) return i[s].exports;
        var t = i[s] = {
            i: s,
            l: !1,
            exports: {}
        };
        return e[s].call(t.exports, t, t.exports, o), t.l = !0, t.exports
    }
    o.m = e, o.c = i, o.d = function (e, i, s) {
        o.o(e, i) || Object.defineProperty(e, i, {
            enumerable: !0,
            get: s
        })
    }, o.r = function (e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }, o.t = function (e, i) {
        if (1 & i && (e = o(e)), 8 & i) return e;
        if (4 & i && "object" == typeof e && e && e.__esModule) return e;
        var s = Object.create(null);
        if (o.r(s), Object.defineProperty(s, "default", {
                enumerable: !0,
                value: e
            }), 2 & i && "string" != typeof e)
            for (var t in e) o.d(s, t, function (i) {
                return e[i]
            }.bind(null, t));
        return s
    }, o.n = function (e) {
        var i = e && e.__esModule ? function () {
            return e.default
        } : function () {
            return e
        };
        return o.d(i, "a", i), i
    }, o.o = function (e, i) {
        return Object.prototype.hasOwnProperty.call(e, i)
    }, o.p = "/", o(o.s = 13)
}({
    13: function (e, i, o) {
        e.exports = o("1Vy0")
    },
    "1Vy0": function (e, i) {
        $.on("/coinflip", function () {
            var e = null,
                i = !1,
                o = !1
            b = 0,
                clI = null
            cli = null,
                cl = 1,
                mulArr = [1.90, 3.80, 1.90, 3.80, 7.60, 3.80, 1.90, 15.20, 1.90, 3.80, 30.40, 1.90, 3.80, 1.90, 3.80, 3.80, 60.80, 1.90, 3.80, 1.90, 3.80, 121.60, 243.20, 1.90, 3.80, 1.90, 3.80, 7.60, 3.80, 1.90, 15.20, 1.90, 3.80, 30.40, 1.90, 3.80, 1.90, 3.80, 3.80, 60.80, 1.90, 3.80, 1.90, 3.80, 121.60, 1.90, 3.80, 1.90, 3.80, 7.60, 3.80, 1.90, 15.20, 1.90, 3.80, 30.40, 1.90, 3.80, 1.90, 486.40, 1.90, 3.80, 1.90, 3.80, 7.60, 3.80, 1.90, 15.20, 1.90, 3.80, 30.40, 1.90, 3.80, 1.90, 3.80, 3.80, 60.80, 1.90, 3.80, 1.90, 3.80, 121.60, 1.90, 3.80, 1.90, 3.80, 7.60, 3.80, 1.90, 15.20, 1.90, 3.80, 30.40, 1.90, 3.80, 1.90, 972.80, 1.90, 3.80, 1.90, 3.80, 7.60, 3.80, 1.90, 15.20, 1.90, 3.80, 30.40, 1.90, 3.80, 1.90, 3.80, 3.80, 60.80, 1.90, 3.80, 1.90, 3.80, 121.60, 1.90, 3.80, 1.90, 3.80, 7.60, 3.80, 1.90, 15.20, 1.90, 3.80, 30.40, 1.90, 3.80, 1.90, 1945.60, 1.90, 3.80, 1.90, 3.80, 7.60, 3.80, 1.90, 15.20, 1.90, 3.80, 30.40, 1.90, 3.80, 1.90, 3.80, 3.80, 60.80, 1.90, 3.80, 1.90, 3.80, 121.60, 1.90, 3.80, 1.90, 3.80, 7.60, 3.80, 1.90, 15.20, 1.90, 3.80, 30.40, 1.90, 3.80, 1.90], cor = null, lgl_cor = ["red", "black"], flpn = 0, cfp_prs = [],
                apArr = [], urs = [], mml = parseFloat(mulArr[0]).toFixed(2), isSoundOn = true, ghid = 0;
            betAudio = new Audio, swooshAudio = new Audio, winAudio = new Audio, loseAudio = new Audio, window.coinflip = function () {
                if ($('#bet').val() >= 1) {
                    if (cor != null && lgl_cor.includes(cor)) {
                        document.querySelector('.pangalawang_kamay').style.display = 'block';
                        document.querySelector('.unang_kamay').style.visibility = 'hidden';
                        // document.querySelector('.coin_pang_kamay').style.visibility = 'visible';


                    // var rotations = ['90deg', '270deg'];
                    // var spins = 5;
                    // var spinCount = 0;
                    // var isButtonClicked = false;

                    // function spinCoin() {
                    //     var selectedRotation = rotations[Math.floor(Math.random() * rotations.length)];
                    //     document.querySelector('.coin_flip').style.setProperty('--final-rotation', selectedRotation);
                    //     document.querySelector('.coin_flip').classList.remove('final-state');

                    //     // Check if the button is clicked
                    //     var spinDuration = isButtonClicked ? 2 : 9;

                    //     // Dynamically set animation duration based on button click
                    //     document.querySelector('.coin_flip').style.animationDuration = `${spinDuration}s`;

                    //     document.querySelector('.coin_flip').classList.add('spin-animation');

                    //     setTimeout(() => {
                    //         document.querySelector('.coin_flip').classList.remove('spin-animation');
                    //         spinCount++;

                    //         if (spinCount < spins) {
                    //             setTimeout(() => {
                    //                 spinCoin();
                    //             }, 100);
                    //         } else {
                    //             document.querySelector('.coin_flip').classList.add('final-state');
                    //         }
                    //     }, spinDuration * 1000);
                    // }

                    // function resetCoinAnimation() {
                    //     document.querySelector('.coin_flip').classList.remove('final-state');
                    //     document.querySelector('.coin_flip').classList.remove('spin-animation');
                    //     document.querySelector('.coin_flip').style.animationDuration = '9s';
                    //     spinCount = 0;
                    //     isButtonClicked = false;
                    // }
                    // document.getElementById('play').addEventListener('click', function () {
                    //     resetCoinAnimation();
                    //     isButtonClicked = true;
                    //     spinCoin();
                    // });


                        // pang determine ng side
                        // var rotations = ['90deg', '270deg'];
                        // var selectedRotation = rotations[Math.floor(Math.random() * rotations.length)];
                        // document.querySelector('.coin_flip').style.setProperty('--final-rotation', selectedRotation);
                        // document.querySelector('.coin_flip').classList.remove('final-state');
                        // document.querySelector('.coin_flip').classList.add('spin-animation');
                        // setTimeout(() => {
                        //     document.querySelector('.coin_flip').classList.remove('spin-animation');
                        //     document.querySelector('.coin_flip').classList.add('final-state');
                        // }, 3000);

                        // pang reset ng spini animation
                        // function resetCoinAnimation() {
                        //     document.querySelector('.coin_flip').classList.remove('final-state');
                        //     document.querySelector('.coin_flip').classList.remove('spin-animation');
                        //     spinCount = 0;
                        // }
                        // document.getElementById('yourButtonId').addEventListener('click', function() {
                        //     resetCoinAnimation();
                        //     spinCoin();
                        // });



                        b = $('#bet').val();

                        const xhr = new XMLHttpRequest();
                        const csrfToken = $('meta[name=csrf-token]').attr('content');

                        const data = {
                            bet: b,
                            game_id: 8
                        };

                        xhr.open("POST", "/api/balance/deduct");

                        xhr.setRequestHeader('Content-Type', 'application/json');
                        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                        xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

                        xhr.onload = () => {
                            if (xhr.status >= 200 && xhr.status < 300) {
                                const response = JSON.parse(xhr.responseText);

                                if (response.status === 200) {
                                    cl = 0;
                                    b2 = response.new_balance;
                                    urs.push("User" + response.uid + "...");
                                    ghid = response.ghid;

                                    $('#money').attr('data-current-balance', response.new_balance);
                                    $('#money_update').html("-$" + parseFloat(b).toFixed(2));
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

                                    null == e && !0 !== i && $.get("/game/coinflip/" + $("#bet").val(), function (i) {
                                        var o = JSON.parse(i);
                                        if (null != o.error) return "$" === o.error && load("/"), -1 === o.error && $("#b_si").click(), 0 === o.error && iziToast.error({
                                            message: "Não foi possível encontrar o jogo.",
                                            icon: "fa fa-times"
                                        }), 1 === o.error && iziToast.error({
                                            message: 'Минимальная ставка: 0.01&nbsp;<i class="fad fa-coins"></i>',
                                            icon: "fa fa-times"
                                        }), void(2 === o.error && $("#_payin").click());
                                        betAudio.src = isAudioGame ? "/assets/media/bet.mp3" : "", isSoundOn ? betAudio.play() : null,
                                        $(".outcome-window").fadeOut("fast"),
                                        $(".outcome-window-lose").fadeOut("fast"),
                                        $(".coin").toggleClass("game-disabled", !1).fadeIn("fast"),
                                        $("#play").attr("disabled", true).attr("onclick", "take()"), clearInterval(clI), clearInterval(cli), updateBalanceN(), e = o, flip(cor), _disableDemo = !0
                                    });
                                } else {
                                    b = 0;
                                    b2 = 0;
                                    $('#_payin').click();
                                }
                            } else if (xhr.status == 419) {
                                $('#modal_please_login').addClass('md-show');
                            } else {
                                console.log(new Error(xhr.statusText));
                            }
                        };

                        xhr.send(JSON.stringify(data));
                    }
                } else {
                    return iziToast.info({
                        message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                        icon: "fa fa-info"
                    }), setTimeout(function () {
                        clicked = !1
                    }, 100);
                }
            }, window.flip = function (s) {
                if (!cl == !0) {
                    flpn = !0;
                    $('#play').attr('disabled', true);
                    null != e && !0 !== i && $.get("/game/coinflip/flip/" + e.id + "/" + s, function (s) {
                        cl = 1;
                        var t = JSON.parse(s);
                        if (null != t.error) return -1 === t.error && iziToast.error({
                                message: "Игра не найдена.",
                                icon: "fa fa-times"
                            }),

                            void(0 === t.error && console.log("Server cancelled input"));
                            i = !0, $("#coin").attr("class", ""), setTimeout(function () {

                            // pang triger ng thumb
                            document.querySelector('.thumb_2').classList.add('thumb_2_flick');
                            // pang hideng coin_section
                            // document.querySelector('.coin_pang_kamay').style.visibility = 'visible';
                            document.querySelector('.coin_flip').style.visibility = 'visible';
                            document.querySelector('.coin_pang_kamay').style.visibility = 'hidden';

                            // coin rotation animation section
                            // var rotations = ['90deg', '270deg'];
                            // TODO 5:47 am ayusin ung arrangement ng animation accordingly
                            var spins = 5;
                            var spinCount = 5;
                            function spinCoin() {
                                var selectedRotation = t.side === 'black' ? '270deg' : '90deg';
                                console.log(selectedRotation);
                                document.querySelector('.coin_flip').style.setProperty('--final-rotation', selectedRotation);
                                document.querySelector('.coin_flip').classList.remove('final-state');
                                // document.querySelector('.coin_flip').classList.add('spin-animation');


                                setTimeout(() => {

                                    // document.querySelector('.coin_flip').classList.remove('spin-animation');
                                    spinCount++;
                                    if (spinCount < spins) {
                                        setTimeout(() => {
                                            spinCoin();
                                        }, 100);
                                    } else {
                                        document.querySelector('.coin_flip').classList.add('final-state');
                                        // document.querySelector('.unang_kamay').style.visibility = 'visible';
                                         // pang triger ng thumb
                                         document.querySelector('.thumb_2').classList.remove('thumb_2_flick');
                                         document.querySelector('.coin_section').style.visibility = 'hidden';
                                        // document.querySelector('.pangalawang_kamay').style.display = 'none';
                                    }
                                }, 3000);
                            }
                            spinCoin();

                            // end of animation section
                            $("#coin").toggleClass("heads", "red" === t.side && !isQuick), $("#coin").toggleClass("tails", "black" === t.side && !isQuick), $("#coin").toggleClass("quick-heads", "red" === t.side && isQuick), $("#coin").toggleClass("quick-tails", "black" === t.side && isQuick);
                            var s = parseFloat(t.multiplier).toFixed(2),
                                a = [(s > 0 ? Math.floor(s) : Math.ceil(s)).toFixed(2).split(".")[0], (s % 1).toFixed(2).split(".")[1]];
                            setTimeout(function () {
                                flpn = !1;
                                $('.coin').removeClass('active');
                                if (cfp_prs.length >= 12) {
                                    cfp_prs.shift();
                                }
                                cfp_prs.push(t.side);
                                localStorage.setItem('cfp_prs', JSON.stringify(cfp_prs));
                                $(".cf_history").prepend('<div class="cf cf_' + t.side + ' side-icon"></div>');
                                    // lose trigger event
                                if (i = !1, "lose" === t.status) cor = null, $('#play').attr('disabled', true), uapts(0), 0 == t.demo && ($('.outcome-window-lose').fadeIn(200), cli = setInterval(() => {
                                        $('.outcome-window-lose').fadeOut(200);
                                        clearInterval(cli)
                                    }, 2000)), 1 == t.demo && ($('.outcome-window-lose').fadeIn(200), cli = setInterval(() => {
                                        $('.outcome-window-lose').fadeOut(200);
                                        clearInterval(cli)
                                    }, 2000)),
                                    $('.btn_outcome_lose').click(),
                                    loseAudio.src = isAudioGame ? "/assets/media/lose.mp3" : "", isSoundOn ? loseAudio.play() : null, isDemo || sendDrop(e.id), validateTask(e.id), clear(), updateBalanceN();
                                else {
                                    cl = 0, $(".coin").toggleClass("game-disabled", !1), $("#games").prop("number", p_n("#games")).animateNumber({
                                            number: t.games
                                        }), $("#mul").prop("number", p_n("#mul")).animateNumber({
                                            number: a[0]
                                        }), $("#mul_m").prop("number", p_n("#mul_m")).animateNumber({
                                            number: a[1]
                                        }),
                                        $('#play').attr('disabled', false);
                                    mml = parseFloat(t.multiplier).toFixed(2);
                                    var s = (parseFloat(e.bet) * mml).toFixed(2);
                                    o ? $("#cf_profit").html(s) : (setBetText(gBtT("pegar") + '<br><span id="cf_profit">' + s + '</span> &nbsp;<i class="fad fa-coins"></i>'), o = !0)
                                }
                            }, isQuick ? 300 : 3e3, isQuick ? (swooshAudio.src = isAudioGame ? "/assets/media/swoosh-fast.mp3" : "", isSoundOn ? swooshAudio.play() : null) : (swooshAudio.src = isAudioGame ? "/assets/media/swoosh.mp3" : "", isSoundOn ? swooshAudio.play() : null))
                        }, 100)
                    });
                }
            }, window.take = function () {
                !1 == cl && null != e && !0 !== i && $.get("/game/coinflip/take/" + e.id, function (i) {
                    var o = JSON.parse(i);

                    const xhr = new XMLHttpRequest();
                    const csrfToken = $('meta[name=csrf-token]').attr('content');

                    const data = {
                        winnings: o.profit,
                        game_id: 8,
                        ghid: ghid
                    };

                    xhr.open("PUT", "/api/balance/add");

                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

                    xhr.onload = () => {
                        if (xhr.status >= 200 && xhr.status < 300) {
                            cl = 1;
                            const response = JSON.parse(xhr.responseText);

                            if (response.status === 200) {
                                execTake(o);
                                uapts(1);
                                cor = null;
                                $('#play').attr('disabled', true);

                                $('#money').attr('data-current-balance', response.new_balance);
                                $('#money_update').html("+$" + parseFloat(o.profit).toFixed(2));
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
                })
            }, window.clear = function () {
                e = null, i = !1, o = !1, _disableDemo = !1, setBetText(gBtT("jogar")), $("#play").attr("onclick", "coinflip()"), $("#games").animateNumber({
                    number: 0
                }), $("#mul").animateNumber({
                    number: 0
                }), $("#mul_m").animateNumber({
                    number: 0
                })
            }, window.execTake = function (o) {
                if (null != o.error) return -1 === o.error && iziToast.error({
                    message: "Требуется авторизация.",
                    icon: "fa fa-times"
                }), 0 === o.error && console.log("Server cancelled input"), void(1 === o.error && iziToast.error({
                    message: "Jogo não encontrado.",
                    icon: "fa fa-times"
                }));
                // trigger event for win/won
                winAudio.src = isAudioGame ? "/assets/media/win.mp3" : "", isSoundOn ? winAudio.play() : null, isDemo || sendDrop(e.id), validateTask(e.id), isDemo && isGuest() && showDemoTooltip(), clear(), updateBalanceN(), parseFloat(o.profit) > 0 && $('.btn_outcome').click(), $('.outcome-window_won__sum').text(o.profit), $('.outcome-window').fadeIn(200), clI = setInterval(() => {
                    $('.outcome-window').fadeOut(200);
                    clearInterval(clI)
                }, 2000);
            }, window.uapts = function (status) {
                urs.push('x' + mml);
                urs.push(b);

                var result = urs;
                if (apArr.length > 21) {
                    apArr.shift();
                    $('.bet_jogadores').children().last().remove();
                }
                apArr.push(result);
                localStorage.setItem('cfp_res', JSON.stringify(apArr));
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

                d2.textContent = result[1];
                d.appendChild(d2);

                var d3 = document.createElement('div');
                d3.classList.add('crash__player--bet');

                var s1 = document.createElement('span');
                s1.textContent = "R$";
                s1.classList.add('crash__player__bet--rs');

                var s2 = document.createElement('span');
                s2.textContent = result[2];
                s2.classList.add('crash__player__bet--value');

                if (status == 1) {
                    s2.classList.add('game__color--win');
                } else {
                    s2.classList.add('game__color--lose');
                }

                d3.appendChild(s1);
                d3.appendChild(s2);

                d.appendChild(d3);
                $('.bet_jogadores').prepend(d);

                urs = [];
                mml = parseFloat(mulArr[0]).toFixed(2);
            }, window.ggapts = function () {
                const cfp_res = localStorage.getItem('cfp_res');
                if (cfp_res == null) {
                    for (let i = 1; i <= 22; i++) {
                        var result = gApsts();
                        apArr.push(result);
                        localStorage.setItem('cfp_res', JSON.stringify(apArr));
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

                        if (mkRdI(0, 1) == 1) {
                            s2.classList.add('game__color--win');
                        } else {
                            s2.classList.add('game__color--lose');
                        }

                        d3.appendChild(s1);
                        d3.appendChild(s2);

                        d.appendChild(d3);
                        $('.bet_jogadores').prepend(d);
                    }
                } else {
                    const aapr = JSON.parse(localStorage.getItem('cfp_res'));

                    aapr.forEach((result) => {
                        apArr.push(result);
                        localStorage.setItem('cfp_res', JSON.stringify(apArr));
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

                        if (mkRdI(0, 1) == 1) {
                            s2.classList.add('game__color--win');
                        } else {
                            s2.classList.add('game__color--lose');
                        }

                        d3.appendChild(s1);
                        d3.appendChild(s2);

                        d.appendChild(d3);
                        $('.bet_jogadores').prepend(d);
                    });
                }
            }, window.gapts = function () {
                var interval = Math.floor(Math.random() * 2000) + 1000;

                setTimeout(function () {
                    var result = gApsts();
                    if (apArr.length > 21) {
                        apArr.shift();
                        $('.bet_jogadores').children().last().remove();
                    }
                    apArr.push(result);
                    localStorage.setItem('cfp_res', JSON.stringify(apArr));
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

                    if (mkRdI(0, 1) == 1) {
                        s2.classList.add('game__color--win');
                    } else {
                        s2.classList.add('game__color--lose');
                    }

                    d3.appendChild(s1);
                    d3.appendChild(s2);

                    d.appendChild(d3);
                    $('.bet_jogadores').prepend(d);
                    gapts();
                }, interval);
            }, window.gApsts = function () {
                var user = "";
                var fword = "User";
                var lword = mkId(4);
                user += fword;
                user += lword;
                user += '...';
                var mul = parseFloat(mulArr[mkRdI(0, mulArr.length)]).toFixed(2);

                var val = "";
                val += mkRdI(0, 9);

                if (val == 0) {
                    val = mkRdI(1, 9);
                } else {
                    val += mkRdI(0, 9);
                }

                return [
                    user,
                    mul,
                    parseFloat(val).toFixed(2)
                ];
            }, window.mkRdI = function (mn, mx) {
                mn = Math.ceil(mn);
                mx = Math.floor(mx);
                return Math.floor(Math.random() * (mx - mn + 1)) + mn;
            }, window.mkId = function (length) {
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
            }, window.Gcfpprs = function () {
                if (localStorage.getItem('cfp_prs') != null) {
                    cfp_prs = JSON.parse(localStorage.getItem('cfp_prs'));
                    cfp_prs.forEach((v) => {
                        $(".cf_history").prepend('<div class="cf cf_' + v + ' side-icon"></div>');
                    });
                }
            }, ggapts(), gapts(), clear(), Gcfpprs(), $('.coin').click(function () {
                if (flpn == !1) {
                    $('.coin').removeClass('active');
                    $(this).addClass('active');
                    cor = $(this).attr('data-cor');
                    $('#play').attr('disabled', false);
                    flip(cor);
                }
            }), $('#play').click(function () {
                if (cor == null) {
                    const msgTr = [
                        "Please select a color",
                        "Por favor selecione uma cor",
                        "请选择颜色"
                    ];

                    let msg;

                    if ($('#frm_brand').val() == 'en') {
                        msg = msgTr[0];
                    } else if ($('#frm_brand').val() == 'pt') {
                        msg = msgTr[1];
                    } else {
                        msg = msgTr[2];
                    }

                    return iziToast.error({
                        message: msg,
                        icon: "fa fa-times"
                    });
                }
            });
        }), window.checkSound = function () {
            if ($('#coinflip_music').attr('data-music') == 'on') {
                isSoundOn = true;
            } else {
                isSoundOn = false;
            }
        }, $('#coinflip_music').on("click", function () {
            if ($('#coinflip_music').attr('data-music') == 'on') {
                swooshAudio.muted = true;
                isSoundOn = false;
                $('#coinflip_music').attr('data-music', 'off');
            } else {
                swooshAudio.muted = false;
                isSoundOn = true;
                $('#coinflip_music').attr('data-music', 'on');
            }
        })
    }
});
var __profit = function () {};
document.querySelector('.coin_flip').style.visibility = 'hidden';
