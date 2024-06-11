! function(e) {
    var t = {};

    function a(o) {
        if (t[o]) return t[o].exports;
        var i = t[o] = {
            i: o,
            l: !1,
            exports: {}
        };
        return e[o].call(i.exports, i, i.exports, a), i.l = !0, i.exports
    }
    a.m = e, a.c = t, a.d = function(e, t, o) {
        a.o(e, t) || Object.defineProperty(e, t, {
            enumerable: !0,
            get: o
        })
    }, a.r = function(e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }, a.t = function(e, t) {
        if (1 & t && (e = a(e)), 8 & t) return e;
        if (4 & t && "object" == typeof e && e && e.__esModule) return e;
        var o = Object.create(null);
        if (a.r(o), Object.defineProperty(o, "default", {
                enumerable: !0,
                value: e
            }), 2 & t && "string" != typeof e)
            for (var i in e) a.d(o, i, function(t) {
                return e[t]
            }.bind(null, i));
        return o
    }, a.n = function(e) {
        var t = e && e.__esModule ? function() {
            return e.default
        } : function() {
            return e
        };
        return a.d(t, "a", t), t
    }, a.o = function(e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }, a.p = "/", a(a.s = 8)
}({
    8: function(e, t, a) {
        e.exports = a("kqEK")
    },
    kqEK: function(e, t) {
        $.on("/roulette", function() {
            var e = .1,
                t = [0, 32, 15, 19, 4, 21, 2, 25, 17, 34, 6, 27, 13, 36, 11, 30, 8, 23, 10, 5, 24, 16, 33, 1, 20, 14, 31, 9, 22, 18, 29, 7, 28, 12, 35, 3, 26],
                a = [32, 19, 21, 25, 34, 27, 36, 30, 23, 5, 16, 1, 14, 9, 18, 7, 12, 3],
                o = [15, 4, 2, 17, 6, 13, 11, 8, 10, 24, 33, 20, 31, 22, 29, 28, 35, 26],
                i = [0],
                n = [],
                s = {},
                r = [],
                d = 0,
                c = 15,
                u = !1,
                p = 0,
                clI = null,
                cli = null,
                outside_values = {
                    "row1": [
                        3, 6, 9, 12, 15, 18, 21, 24, 27, 30, 33, 36
                    ],
                    "row2": [
                        2, 5, 8, 11, 14, 17, 20, 23, 26, 29, 32, 35
                    ],
                    "row3": [
                        1, 4, 7, 10, 13, 16, 19, 22, 25, 28, 31, 34
                    ],
                    "1-12": [
                        1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12
                    ],
                    "13-24": [
                        13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24
                    ],
                    "25-36": [
                        25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36
                    ],
                    "1-18": [
                        1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18
                    ],
                    "19-36": [
                        19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36
                    ],
                    "even": [
                        2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 34, 36
                    ],
                    "odd": [
                        1, 3, 5, 7, 9, 11, 13, 15, 17, 19, 21, 23, 25, 27, 29, 31, 33, 35
                    ],
                    "red": [
                        1, 3, 5, 7, 9, 12, 14, 16, 18, 19, 21, 23, 25, 27, 30, 32, 34, 36
                    ],
                    "black": [
                        2, 4, 6, 8, 10, 11, 13, 15, 17, 20, 22, 24, 26, 28, 29, 31, 33, 35
                    ]
                },
                insides = [
                    0,
                    1,
                    2,
                    3,
                    4,
                    5,
                    6,
                    7,
                    8,
                    9,
                    10,
                    11,
                    12,
                    13,
                    14,
                    15,
                    16,
                    17,
                    18,
                    19,
                    20,
                    21,
                    22,
                    23,
                    24,
                    25,
                    26,
                    27,
                    28,
                    29,
                    30,
                    31,
                    32,
                    33,
                    34,
                    35,
                    36
                ],
                outsides_double = [
                    'row1',
                    'row2',
                    'row3',
                    '1-12',
                    '13-24',
                    '25-36'
                ],
                outsides_single = [
                    '1-18',
                    '19-36',
                    'even',
                    'odd',
                    'red',
                    'black'
                ],
                pos = {
                    '26': 5, '3': 15, '35': 25, '12': 35, '28': 44, '7': 53.8, '29': 63.6, '18': 73.4, '22': 83.2, '9': 93, 31: 102.8, 14: 112.6, 20: 122.4, 1: 132.2, 33: 142, 16: 151.8, 24: 161.6, 5: 171.4, 10: 181.2, 23: 198.8, 8: 208.6, 30: 218.4, 11: 228.2, 36: 238, 13: 247.8, 27: 257.6, 6: 267.4, 34: 277.2, 17: 287, 25: 296.8, 2: 306.6, 21: 316.4, 4: 326.2, 19: 336, 15: 345, 32: 355, 0: 365
                },
                fhalf = [
                    0, 32, 15, 19, 4, 21, 2, 25, 17, 34, 6, 27, 13, 36, 11, 30, 8, 23
                ],
                shalf = [
                    10, 5, 24, 16, 33, 1, 20, 14, 31, 9, 22, 18, 29, 7, 28, 12, 35, 3, 26
                ],
                land_in = 0,
                apArr = [],
                urs = [],
                expenses = 0, isSoundOn = true, ghid = 0;
            victory = 0, stopped = 0, gamemode = 0, winstatus = 0, clicked = !1, l = null, betAudio = new Audio, spinAudio = new Audio, clickAudio = new Audio, winAudio = new Audio, loseAudio = new Audio, $("*[data-games]").on("click", function() {
                $("*[data-games]").toggleClass("bc_active", !1), $(this).toggleClass("bc_active", !0), c = parseInt($(this).attr("data-games")), $(".games_input").val(c)
            }), $("#change_games").on("click", function() {
                u || (u = !0, $("#change_games span").toggleClass("dn", !0), $("#change_games input").toggleClass("dn", !1), $(".bomb_input").on("input", function() {
                    var e = parseInt($(this).val());
                    if (isNaN(e) || e < 1 || e > 240) return $(this).toggleClass("bad", !0), void(n = !0);
                    $(this).toggleClass("bad", !1), n = !1, c = e, $("*[data-games]").toggleClass("bc_active", !1), $('*[data-games="' + c + '"]').toggleClass("bc_active", !0)
                }).focus())
            }), $("*[data-victory]").on("click", function() {
                $(this).attr("*[data-victory]"), $(".buttons-3-selected").removeClass("buttons-3-selected"), $(this).addClass("buttons-3-selected"), victory = parseInt($(this).attr("data-victory"))
            }), window.setMode = function(e, t) {
                0 == d && ($("*[data-tab]").toggleClass("active", !1), $("*[data-tab=" + e + "]").toggleClass("active", !0)), "default" === e && 0 == d && ($("#auto").fadeOut(0), $("#gamestext").fadeOut(0), $("#gamesvalue").fadeOut(0), $("#gamesvictory").fadeOut(0), $("#gamesvictoryvalue").fadeOut(0), $("#play").fadeIn(0)), "auto" === e && ($("#play").fadeOut(0), $("#gamestext").fadeIn(0), $("#gamesvalue").fadeIn(0), $("#gamesvictory").fadeIn(0), $("#gamesvictoryvalue").fadeIn(0), $("#auto").fadeIn(0))
            }, window.createWheel = function() {
                for (var e = 360 / t.length, s = 0; s < t.length; s++) n[t[s]] = [], n[t[s]][0] = s * e, n[t[s]][1] = s * e + e, newSlice = document.createElement("div"), $(newSlice).addClass("r-hold"), newHold = document.createElement("div"), $(newHold).addClass("r-pie"), newNumber = document.createElement("div"), $(newNumber).addClass("r-num"), newNumber.innerHTML = t[s], $(newSlice).attr("id", "rSlice" + s), $(newSlice).css("transform", "rotate(" + n[t[s]][0] + "deg)"), $(newHold).css("transform", "rotate(9.73deg)"), $(newHold).css("-webkit-transform", "rotate(9.73deg)"), $.inArray(t[s], i) > -1 ? $(newHold).addClass("r-greenbg") : $.inArray(t[s], a) > -1 ? $(newHold).addClass("r-redbg") : $.inArray(t[s], o) > -1 && $(newHold).addClass("r-greybg"), $(newNumber).appendTo(newSlice), $(newHold).appendTo(newSlice), $(newSlice).appendTo($("#rcircle"))
            }, window.resetAni = function() {
                var e = $.keyframe.getVendorPrefix();
                animationPlayState = "animation-play-state", playStateRunning = "running", $(".r-ball").css(e + animationPlayState, playStateRunning).css(e + "animation", "none"), $(".r-pieContainer").css(e + animationPlayState, playStateRunning).css(e + "animation", "none"), $("#toppart").css(e + animationPlayState, playStateRunning).css(e + "animation", "none"), $("#rotate2").html(""), $("#rotate").html("")
            }, window.spinTo = function(e) {
                let land = 0;

                if (fhalf.includes(e)) {
                    land = (pos[e] + 180) - 10;
                } else {
                    land = pos[e] + 180;
                }

                resetAni(), setTimeout(function() {
                    bgrotateTo(land)
                }, 300)
            }, window.ballrotateTo = function(e) {
                var t = -1800 - (360 - e);
                $.keyframe.define({
                    name: "rotate2",
                    from: {
                        transform: "rotate(0deg)"
                    },
                    to: {
                        transform: "rotate(" + t + "deg)"
                    }
                }), $(".r-ball").playKeyframe({
                    name: "rotate2",
                    duration: isQuick ? "1.2s" : "8s",
                    timingFunction: "ease-in-out",
                    complete: function() {
                        0 == gamemode && finishSpin(), 1 == gamemode && finishSpinAuto()
                    }
                })
            }, window.bgrotateTo = function(e) {
                var t = (isQuick, 2160 + e);
                $.keyframe.define({
                    name: "rotate",
                    from: {
                        transform: "rotate(0deg)"
                    },
                    to: {
                        transform: "rotate(" + t + "deg)"
                    }
                }), $(".r-pieContainer").playKeyframe({
                    name: "rotate",
                    duration: isQuick ? "1s" : "7s",
                    timingFunction: "ease-in-out",
                    complete: function() {}
                }), $("#toppart").playKeyframe({
                    name: "rotate",
                    duration: isQuick ? "1s" : "7s",
                    timingFunction: "ease-in-out",
                    complete: function() {
                        0 == gamemode && finishSpin(), 1 == gamemode && finishSpinAuto()
                    }
                })
            }, window.roulette = function() {
                $('.outcome-window').fadeOut(200);
                clearInterval(clI);
                $('.outcome-window-lose').fadeOut(200);
                clearInterval(cli);
                if (!1 !== clicked) return iziToast.info({
                    message: iziGTr(1),
                    icon: "fa fa-info"
                }), setTimeout(function() {
                    clicked = !1
                }, 100);
                clicked = !0, null == l && $.get("/game/roulette/" + JSON.stringify(s) + "?demo", function(e) {
                    expenses = processBet(s).toFixed(2);

                    var t = JSON.parse(e);

                    if (expenses >= 1 && expenses <= 1000) {
                        const xhr = new XMLHttpRequest();
                        const csrfToken = $('meta[name=csrf-token]').attr('content');

                        const data = {
                            bet: expenses,
                            game_id: 6
                        };

                        xhr.open("POST", "/api/balance/deduct");

                        xhr.setRequestHeader('Content-Type', 'appication/json');
                        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                        xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

                        xhr.onload = () => {
                            if (xhr.status >= 200 && xhr.status < 300) {
                                const response = JSON.parse(xhr.responseText);

                                if (response.status === 200) {
                                    b2 = response.new_balance;
                                    urs.push("User" + response.uid + "...");
                                    ghid = response.ghid;

                                    $('#money').attr('data-current-balance', response.new_balance);
                                    $('#money_update').html("-$" + parseFloat(data.bet).toFixed(2));
                                    $('#div_money_update').css('display', "block");
                                    $('#money_update').css('color', "red");

                                    setTimeout(function() {
                                        $('#money').html(response.new_balance);
                                        $('#div_money_update').css('display', "none");
                                        $('.lessmoney__gif').fadeIn(200);
                                        $('#money_gif__lose').attr('src', 'https://cdn.29bet.com/assets/img/all/icons/coin-gif.gif');

                                        setTimeout(() => {
                                            $('.lessmoney__gif').fadeOut(0);
                                            $('#money_gif__lose').attr('src', '');
                                        }, 1300);
                                    }, 3000);

                                    initExec(t);
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
                    } else if (expenses > 1000) {
                        return iziToast.info({
                            message: iziGTr(5) + '&nbsp;<i class="fad fa-coins"></i>',
                            icon: "fa fa-info"
                        }), setTimeout(function() {
                            clicked = !1
                        }, 100);
                    } else if (expenses < 1) {
                        return iziToast.info({
                            message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                            icon: "fa fa-info"
                        }), setTimeout(function() {
                            clicked = !1
                        }, 100);
                    }
                })
            }, window.initExec = function(t) {
                if (null != t.error) return "$" === t.error && load("/"), -1 === t.error && $("#b_si").click(), 1 === t.error && iziToast.error({
                    message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                    icon: "fa fa-times"
                }), clicked = !1, 2 === t.error && $("#_payin").click(), void(clicked = !1);
                betAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/bet.mp3" : "", $('#play').addClass('disabled').text(gBtT("aguarde")), isSoundOn ? betAudio.play() : null, gamemode = 0, $(".roulette-result").fadeOut(250, function() {
                    $(this).delay(250).toggleClass("roulette-result-lose", !1).toggleClass("roulette-result-win", !1), $("#toppart").fadeIn(250, function() {
                        l = t, spinTo(parseInt(l.response.number)), spinAudio.src = isQuick ? isAudioGame ? "https://cdn.29bet.com/assets/media/spinfast.mp3" : "" : isAudioGame ? "https://cdn.29bet.com/assets/media/spin.mp3" : "", isSoundOn ? spinAudio.play() : null, setTimeout(function() {
                            clicked = !1
                        }, 350)
                    })
                })
            }, window.rouletteauto = function() {
                !1 === clicked && (clicked = !0, null == l && $.get("/game/roulette/" + JSON.stringify(s) + "?demo", function(e) {
                    expenses = processBet(s);

                    var t = JSON.parse(e);

                    if (expenses > 0 && 1000 > expenses) {
                        const xhr = new XMLHttpRequest();
                        const csrfToken = $('meta[name=csrf-token]').attr('content');

                        const data = {
                            bet: expenses,
                            game_id: 6
                        };

                        xhr.open("PUT", "/api/balance/deduct");

                        xhr.setRequestHeader('Content-Type', 'appication/json');
                        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                        xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

                        xhr.onload = () => {
                            if (xhr.status >= 200 && xhr.status < 300) {
                                const response = JSON.parse(xhr.responseText);

                                if (response.status === 200) {
                                    b2 = response.new_balance;

                                    $('#money').html(response.new_balance);
                                    $('#money').attr('data-current-balance', response.new_balance);
                                    $('#money_update').html("-$" + parseFloat(data.bet).toFixed(2));
                                    $('#div_money_update').css('display', "block");
                                    $('#money_update').css('color', "red");

                                    let interval = setInterval(function() {
                                        this.div_money_update.style.display = "none";
                                        clearInterval(interval);
                                    }, 3000);

                                    initExecAuto(t);
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
                    } else {
                        iziToast.error({
                            message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                            icon: "fa fa-times"
                        })
                    }
                }))
            }, window.initExecAuto = function(t) {
                if (null != t.error) return "$" === t.error && load("/"), -1 === t.error && $("#b_si").click(), 1 === t.error && iziToast.error({
                    message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                    icon: "fa fa-times"
                }), clicked = !1, 2 === t.error && $("#_payin").click(), void(clicked = !1);
                betAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/bet.mp3" : "", isSoundOn ? betAudio.play() : null, $(".roulette-result").fadeOut(250, function() {
                    $(this).delay(250).toggleClass("roulette-result-lose", !1).toggleClass("roulette-result-win", !1), $("#toppart").fadeIn(250, function() {
                        l = t, spinTo(parseInt(l.response.number)), spinAudio.src = isQuick ? isAudioGame ? "https://cdn.29bet.com/assets/media/spinfast.mp3" : "" : isAudioGame ? "https://cdn.29bet.com/assets/media/spin.mp3" : "", isSoundOn ? spinAudio.play() : null, d = 1, gamemode = 1, winstatus = 0, retrygame(), setTimeout(function() {
                            clicked = !1
                        }, 350)
                    })
                })
            }, window.finishSpin = function() {
                processWin(l.response.number);
                $("#toppart").fadeOut("fast", function() {
                    $(".roulette-result").html(l.response.number).fadeIn("fast").toggleClass(!1 === l.response.win ? "roulette-result-lose" : "roulette-result-win", !0), !1 === l.response.win ? (loseAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/lose.mp3" : "", isSoundOn ? loseAudio.play() : null) : (winAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/win.mp3" : "", isSoundOn ? winAudio.play() : null), l.response.win && isDemo && isGuest() && showDemoTooltip(), -1 === l.response.id || isDemo || sendDrop(l.response.id), l = null, updateBalanceN()
                })
            }, window.finishSpinAuto = function() {
                processWin(l.response.number);
                $("#toppart").fadeOut("fast", function() {
                    $(".roulette-result").html(l.response.number).fadeIn("fast").toggleClass(!1 === l.response.win ? "roulette-result-lose" : "roulette-result-win", !0), !1 === l.response.win ? (loseAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/lose.mp3" : "", isSoundOn ? loseAudio.play() : null, winstatus = 0) : (winAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/win.mp3" : "", isSoundOn ? winAudio.play() : null, winstatus = 1), l.response.win && isDemo && isGuest() && showDemoTooltip(), -1 === l.response.id || isDemo || sendDrop(l.response.id), l = null, updateBalanceN(), c -= 1, d = 1, 1 == stopped && stopauto(), 0 == stopped && (0 == victory && (0 == winstatus ? c > 0 && retrygame() : (stopauto(), c = parseInt($("*[data-games]").attr("data-games")))), 1 == victory && (0 == stopped && (c > 0 ? retrygame() : (stopauto(), c = parseInt($("*[data-games]").attr("data-games")))), 1 == stopped && stopauto()), 2 == victory && (0 == winstatus ? c > 0 ? retrygame() : (stopauto(), p = 0, c = parseInt($("*[data-games]").attr("data-games"))) : (c > 0 && (p < 4 ? (p += 1, retrygame()) : (stopauto(), p = 0, c = parseInt($("*[data-games]").attr("data-games"))), c = parseInt($("*[data-games]").attr("data-games"))), 0 == c && (stopauto(), p = 0, c = parseInt($("*[data-games]").attr("data-games"))))))
                })
            }, window.retrygame = function() {
                0 == stopped && ($("#auto").fadeIn(0).attr("onclick", "stopauto()"), setAutoText("Остановить"), setTimeout(function() {
                    rouletteauto()
                }, 350)), 1 == stopped && stopauto()
            }, window.rouletteautotry = function() {
                stopped = 0, d = 1, rouletteauto()
            }, window.stopauto = function() {
                stopped = 1, d = 0, $("#auto").fadeIn(0).attr("onclick", "rouletteautotry()"), setAutoText("Запустить"), c = parseInt($("*[data-games]").attr("data-games"))
            }, processBet = function(s) {
                const chips = Object.values(s);
                let expenses = 0;
                chips.forEach(function(chip, key) {
                    expenses += chip;
                });

                return expenses;
            }, processWin = function(result) {
                const chips = Object.values(s);
                const bets = Object.keys(s);
                const outside_bets = Object.keys(outside_values);
                const outside_bet_values = Object.values(outside_values);

                let stakes = 0;

                bets.forEach(function(bet, bet_key) {
                    if (inArray(bet, outsides_single)) {
                        const key = getKeyByValue(outside_bets, bet);
                        if (inArray(result, outside_bet_values[key])) {
                            stakes += chips[bet_key] * 2;
                        }
                    } else if (inArray(bet, outsides_double)) {
                        const key = getKeyByValue(outside_bets, bet);
                        if (inArray(result, outside_bet_values[key])) {
                            stakes += chips[bet_key] * 3;
                        }
                    } else {
                        if (result == bet) {
                            stakes += chips[bet_key] * 37;
                        }
                    }
                });

                r_history_clear();

                if (stakes > 0) {
                    execTake(stakes, result);
                } else {
                    $('#play').removeClass('disabled').text(gBtT("jogar"));
                    $('.outcome-window-lose').fadeIn(200);
                    uapts(0);
                    setInterval(() => {
                        $('.outcome-window-lose').fadeOut(200);
                        clearInterval(cli);
                    }, 3000);
                }
            }, window.execTake = function(stakes, result) {
                const xhr = new XMLHttpRequest();
                const csrfToken = $('meta[name=csrf-token]').attr('content');
                const data = {
                    winnings: stakes,
                    game_id: 6,
                    ghid: ghid
                };

                xhr.open("PUT", "/api/balance/add");

                xhr.setRequestHeader('Content-Type', 'appication/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

                xhr.onload = () => {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        const response = JSON.parse(xhr.responseText);

                        if (response.status === 200) {
                            uapts(1);
                            $('.outcome-window__coeff').html(result);
                            $('.outcome-window_won__sum').html(stakes.toFixed(2));
                            $('.outcome-window').fadeIn(200);
                            setInterval(() => {
                                $('#play').removeClass('disabled').text(gBtT("jogar"));
                                $('.outcome-window').fadeOut(200);
                                clearInterval(clI);
                            }, 3000);

                            $('#money').attr('data-current-balance', response.new_balance);
                            $('#money_update').html("+$" + parseFloat(stakes).toFixed(2));
                            $('#div_money_update').css('display', "block");
                            $('#money_update').css('color', "yellow");

                            setTimeout(function() {
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
            }, window.uapts = function (status) {
                urs.push(expenses);

                var result = urs;
                if (apArr.length > 21) {
                    apArr.shift();
                    $('.bet_jogadores').children().last().remove();
                }
                apArr.push(result);
                localStorage.setItem('rlt_res', JSON.stringify(apArr));
                var d = document.createElement('div');
                const flex = "d-flex";
                const between = "justify-content-around";
                const centered = "align-items-center";

                d.classList.add(flex);
                d.classList.add(between);
                d.classList.add(centered);

                var d1 = document.createElement('div');

                d1.className = 'crash__player--username';
                d1.textContent = result[0];
                d.appendChild(d1);

                var d3 = document.createElement('div');
                d3.classList.add('crash__player--bet');

                var s1 = document.createElement('span');
                s1.textContent = "R$";
                s1.classList.add('crash__player__bet--rs');

                var s2 = document.createElement('span');
                s2.textContent = result[1];
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
            }, window.ggapts = function() {
                const rlt_res = localStorage.getItem('rlt_res');
                if (rlt_res == null) {
                    for (let i = 1;i <= 22;i++) {
                        var result = gApsts();
                        apArr.push(result);
                        localStorage.setItem('rlt_res', JSON.stringify(apArr));
                        var d = document.createElement('div');
                        const flex = "d-flex";
                        const between = "justify-content-around";
                        const centered = "align-items-center";

                        d.classList.add(flex);
                        d.classList.add(between);
                        d.classList.add(centered);

                        var d1 = document.createElement('div');

                        d1.className = 'crash__player--username';
                        d1.textContent = result[0];
                        d.appendChild(d1);

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
                    const aapr = JSON.parse(localStorage.getItem('rlt_res'));

                    aapr.forEach((result) => {
                        apArr.push(result);
                        localStorage.setItem('rlt_res', JSON.stringify(apArr));
                        var d = document.createElement('div');
                        const flex = "d-flex";
                        const between = "justify-content-around";
                        const centered = "align-items-center";

                        d.classList.add(flex);
                        d.classList.add(between);
                        d.classList.add(centered);

                        var d1 = document.createElement('div');

                        d1.className = 'crash__player--username';
                        d1.textContent = result[0];
                        d.appendChild(d1);

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
                    localStorage.setItem('rlt_res', JSON.stringify(apArr));
                    var d = document.createElement('div');
                    const flex = "d-flex";
                    const between = "justify-content-around";
                    const centered = "align-items-center";

                    d.classList.add(flex);
                    d.classList.add(between);
                    d.classList.add(centered);

                    var d1 = document.createElement('div');

                    d1.className = 'crash__player--username';
                    d1.textContent = result[0];
                    d.appendChild(d1);

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

                var val = "";
                val += mkRdI(0, 9);

                if (val == 0) {
                    val = mkRdI(1, 9);
                } else {
                    val += mkRdI(0, 9);
                }

                val += '.';

                val += mkRdI(0, 9);

                return [
                    user,
                    0,
                    parseFloat(val).toFixed(2)
                ];
            }, window.mkRdI = function(mn, mx) {
                mn = Math.ceil(mn);
                mx = Math.floor(mx);
                return Math.floor(Math.random() * (mx - mn + 1)) + mn;
            }, window.mkId = function(length) {
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
            }, window.checkSound = function() {
                if ($('#roulette_music').attr('data-music') == 'on') {
                    isSoundOn = true;
                } else {
                    isSoundOn = false;
                }
            }, ggapts(), gapts(), checkSound(), $('#roulette_music').on("click", function() {
                if ($('#roulette_music').attr('data-music') == 'on') {
                    spinAudio.muted = true;
                    isSoundOn = false;
                    $('#roulette_music').attr('data-music', 'off');
                } else {
                    spinAudio.muted = false;
                    isSoundOn = true;
                    $('#roulette_music').attr('data-music', 'on');
                }
            }), inArray = function(needle, haystack) {
                var length = haystack.length;
                for(var i = 0; i < length; i++) {
                    if(haystack[i] == needle) return true;
                }
                return false;
            }, getKeyByValue = function (array, value) {
                for (let key in array) {
                    if (array[key] === value) {
                        return key;
                    }
                }
                return null; // Value not found
            }, $(".token").on("click", function() {
                e = parseFloat($(this).attr("data-value")), $(".token-active").removeClass("token-active"), $(this).addClass("token-active")
            }), $(".tokens").slick({
                dots: !1,
                infinite: false,
                slidesToShow: 14,
                arrows: false,
                responsive: [{
                    breakpoint: 991,
                    settings: {
                        slidesToScroll: 13,
                        slidesToShow: 13,
                        infinite: !0
                    }
                }, {
                    breakpoint: 768,
                    settings: {
                        slidesToScroll: 4,
                        slidesToShow: 6,
                        infinite: !1,
                        arrows: false
                    }
                }],
                slidesToScroll: 4
            });
            var m = function(e, t) {
                    $(e).on("mouseover", function() {
                        $.each($(".chip"), function(e, a) {
                            t.includes($(this).attr("data-chip")) && $(this).addClass("chip-disabled")
                        })
                    }), $(e).on("mouseleave", function() {
                        $(".chip").removeClass("chip-disabled")
                    })
                },
                f = {
                    first: ["3", "6", "9", "12", "15", "18", "21", "24", "27", "30", "33", "36"],
                    second: ["2", "5", "8", "11", "14", "17", "20", "23", "26", "29", "32", "35"],
                    third: ["1", "4", "7", "10", "13", "16", "19", "22", "25", "28", "31", "34"],
                    red: ["3", "9", "12", "18", "21", "27", "30", "36", "5", "14", "23", "32", "1", "7", "16", "19", "25", "34"],
                    black: ["6", "15", "24", "33", "2", "8", "11", "17", "20", "26", "29", "35", "4", "10", "13", "22", "28", "31"],
                    numeric: {
                        first: ["3", "6", "9", "12", "2", "5", "8", "11", "1", "4", "7", "10"],
                        second: ["15", "18", "21", "24", "14", "17", "20", "23", "13", "16", "19", "22"],
                        third: ["27", "30", "33", "36", "26", "29", "32", "35", "25", "28", "31", "34"]
                    },
                    half: {
                        first: ["3", "6", "9", "12", "15", "18", "2", "5", "8", "11", "14", "17", "1", "4", "7", "10", "13", "16"],
                        second: ["21", "24", "27", "30", "33", "36", "20", "23", "26", "29", "32", "35", "19", "22", "25", "28", "31", "34"]
                    },
                    e: {
                        even: ["6", "12", "18", "24", "30", "36", "2", "8", "14", "20", "26", "32", "4", "10", "16", "22", "28", "34"],
                        opposite: ["3", "9", "15", "21", "27", "33", "5", "11", "17", "23", "29", "35", "1", "7", "13", "19", "25", "31"]
                    }
                };
            m("#row1", f.second.concat(f.third)), m("#row2", f.first.concat(f.third)), m("#row3", f.first.concat(f.second)), m("#red", f.black), m("#black", f.ndred), m("#1-12", f.numeric.second.concat(f.numeric.third)), m("#13-24", f.numeric.first.concat(f.numeric.third)), m("#25-36", f.numeric.first.concat(f.numeric.second)), m("#1-18", f.half.seco), m("#19-36", f.half.first), m("#e", f.e.opposite), m("#eo", f.e.even), $(".chip").on("click", function() {
                var o = $(this).attr("data-chip");
                const bv = getBetFor(o) + e;
                const nb = processBet(s) + bv;

                if (Number(nb) > Number(1000)) {
                    return iziToast.info({
                        message: iziGTr(5),
                        icon: "fa fa-info"
                    }), setTimeout(function() {
                        clicked = !1
                    }, 100);
                } else {
                    clickAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/click.mp3" : "", isSoundOn ? clickAudio.play() : null;
                    var t = $(this).find(".bet-stack");
                    0 === t.length && ((t = $('<div class="bet-stack"></div>')).hide().fadeIn("fast"));
                    var a = $('<div class="token bet-token" data-token-value="' + e + '" style="margin-top: -' + 2 * t.children().length + 'px">' + abbreviateNumber(e) + "</div>");
                    t.append(a), r.push(a);

                    $(this).append(t);
                    setBetFor(o, getBetFor(o) + e);
                }
            }), createWheel(), setTimeout(function() {
                $.getScript("/js/vendor/jquery.keyframes.min.js")
            }, 1e3), window.getBetFor = function(e) {
                return null == s[e] ? 0 : s[e]
            }, window.setBetFor = function(e, t) {
                s[e] = t;
                for (var a = 0, o = 0; o < Object.keys(s).length; o++) a += s[Object.keys(s)[o]];
                $("#token_bet").html(a.toFixed(2) + '&nbsp;<i class="fad fa-coins"></i>')
            }, window.r_history_back = function() {
                if (0 !== r.length) {
                    var e = r[r.length - 1];
                    setBetFor(e.parent().parent().attr("data-chip"), getBetFor(e.parent().parent().attr("data-chip")) - parseFloat(e.attr("data-token-value"))), 1 === e.parent().children().length ? e.parent().fadeOut("fast", function() {
                        $(this).remove()
                    }) : e.remove(), r.splice(r.length - 1, 1), clickAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/click.mp3" : "", isSoundOn ? clickAudio.play() : null
                }
            }, window.r_history_clear = function() {
                r = [], s = {}, $(".bet-stack").fadeOut("fast", function() {
                    $(this).remove()
                }), $("#token_bet").html('0.00&nbsp;<i class="fad fa-coins"></i>'), clickAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/click.mp3" : "", isSoundOn ? clickAudio.play() : null
            }
        })
    }
});
