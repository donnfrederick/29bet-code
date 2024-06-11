! function (e) {
    var t = {};

    function a(s) {
        if (t[s]) return t[s].exports;
        var n = t[s] = {
            i: s,
            l: !1,
            exports: {}
        };
        return e[s].call(n.exports, n, n.exports, a), n.l = !0, n.exports
    }
    a.m = e, a.c = t, a.d = function (e, t, s) {
        a.o(e, t) || Object.defineProperty(e, t, {
            enumerable: !0,
            get: s
        })
    }, a.r = function (e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }, a.t = function (e, t) {
        if (1 & t && (e = a(e)), 8 & t) return e;
        if (4 & t && "object" == typeof e && e && e.__esModule) return e;
        var s = Object.create(null);
        if (a.r(s), Object.defineProperty(s, "default", {
                enumerable: !0,
                value: e
            }), 2 & t && "string" != typeof e)
            for (var n in e) a.d(s, n, function (t) {
                return e[t]
            }.bind(null, n));
        return s
    }, a.n = function (e) {
        var t = e && e.__esModule ? function () {
            return e.default
        } : function () {
            return e
        };
        return a.d(t, "a", t), t
    }, a.o = function (e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }, a.p = "/", a(a.s = 8)
}({
    8: function (e, t, a) {
        e.exports = a("kqEK")
    },
    kqEK: function (e, t) {
        $.on("/roulette", function () {
            var e = .1,
                t = [0, 32, 15, 19, 4, 21, 2, 25, 17, 34, 6, 27, 13, 36, 11, 30, 8, 23, 10, 5, 24, 16, 33, 1, 20, 14, 31, 9, 22, 18, 29, 7, 28, 12, 35, 3, 26],
                a = [32, 19, 21, 25, 34, 27, 36, 30, 23, 5, 16, 1, 14, 9, 18, 7, 12, 3],
                s = [15, 4, 2, 17, 6, 13, 11, 8, 10, 24, 33, 20, 31, 22, 29, 28, 35, 26],
                n = [0],
                o = [],
                i = {},
                r = [],
                d = 0,
                c = 15,
                u = !1,
                m = 0,
                p = {
                    row1: [3, 6, 9, 12, 15, 18, 21, 24, 27, 30, 33, 36],
                    row2: [2, 5, 8, 11, 14, 17, 20, 23, 26, 29, 32, 35],
                    row3: [1, 4, 7, 10, 13, 16, 19, 22, 25, 28, 31, 34],
                    "1-12": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                    "13-24": [13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24],
                    "25-36": [25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36],
                    "1-18": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18],
                    "19-36": [19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36],
                    even: [2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 34, 36],
                    odd: [1, 3, 5, 7, 9, 11, 13, 15, 17, 19, 21, 23, 25, 27, 29, 31, 33, 35],
                    red: [1, 3, 5, 7, 9, 12, 14, 16, 18, 19, 21, 23, 25, 27, 30, 32, 34, 36],
                    black: [2, 4, 6, 8, 10, 11, 13, 15, 17, 20, 22, 24, 26, 28, 29, 31, 33, 35]
                },
                f = ["row1", "row2", "row3", "1-12", "13-24", "25-36"],
                g = ["1-18", "19-36", "even", "odd", "red", "black"],
                h = {
                    26: 5,
                    3: 15,
                    35: 25,
                    12: 35,
                    28: 44,
                    7: 53.8,
                    29: 63.6,
                    18: 73.4,
                    22: 83.2,
                    9: 93,
                    31: 102.8,
                    14: 112.6,
                    20: 122.4,
                    1: 132.2,
                    33: 142,
                    16: 151.8,
                    24: 161.6,
                    5: 171.4,
                    10: 181.2,
                    23: 198.8,
                    8: 208.6,
                    30: 218.4,
                    11: 228.2,
                    36: 238,
                    13: 247.8,
                    27: 257.6,
                    6: 267.4,
                    34: 277.2,
                    17: 287,
                    25: 296.8,
                    2: 306.6,
                    21: 316.4,
                    4: 326.2,
                    19: 336,
                    15: 345,
                    32: 355,
                    0: 365
                },
                _ = [0, 32, 15, 19, 4, 21, 2, 25, 17, 34, 6, 27, 13, 36, 11, 30, 8, 23],
                y = [],
                w = [],
                v = 0,
                k = !0,
                A = 0;
            victory = 0, stopped = 0, gamemode = 0, winstatus = 0, clicked = !1, l = null, betAudio = new Audio, spinAudio = new Audio, clickAudio = new Audio, winAudio = new Audio, loseAudio = new Audio, $("*[data-games]").on("click", function () {
                $("*[data-games]").toggleClass("bc_active", !1), $(this).toggleClass("bc_active", !0), c = parseInt($(this).attr("data-games")), $(".games_input").val(c)
            }), $("#change_games").on("click", function () {
                u || (u = !0, $("#change_games span").toggleClass("dn", !0), $("#change_games input").toggleClass("dn", !1), $(".bomb_input").on("input", function () {
                    var e = parseInt($(this).val());
                    if (isNaN(e) || e < 1 || e > 240) return $(this).toggleClass("bad", !0), void(o = !0);
                    $(this).toggleClass("bad", !1), o = !1, c = e, $("*[data-games]").toggleClass("bc_active", !1), $('*[data-games="' + c + '"]').toggleClass("bc_active", !0)
                }).focus())
            }), $("*[data-victory]").on("click", function () {
                $(this).attr("*[data-victory]"), $(".buttons-3-selected").removeClass("buttons-3-selected"), $(this).addClass("buttons-3-selected"), victory = parseInt($(this).attr("data-victory"))
            }), window.setMode = function (e, t) {
                0 == d && ($("*[data-tab]").toggleClass("active", !1), $("*[data-tab=" + e + "]").toggleClass("active", !0)), "default" === e && 0 == d && ($("#auto").fadeOut(0), $("#gamestext").fadeOut(0), $("#gamesvalue").fadeOut(0), $("#gamesvictory").fadeOut(0), $("#gamesvictoryvalue").fadeOut(0), $("#play").fadeIn(0)), "auto" === e && ($("#play").fadeOut(0), $("#gamestext").fadeIn(0), $("#gamesvalue").fadeIn(0), $("#gamesvictory").fadeIn(0), $("#gamesvictoryvalue").fadeIn(0), $("#auto").fadeIn(0))
            }, window.createWheel = function () {
                for (var e = 360 / t.length, i = 0; i < t.length; i++) o[t[i]] = [], o[t[i]][0] = i * e, o[t[i]][1] = i * e + e, newSlice = document.createElement("div"), $(newSlice).addClass("r-hold"), newHold = document.createElement("div"), $(newHold).addClass("r-pie"), newNumber = document.createElement("div"), $(newNumber).addClass("r-num"), newNumber.innerHTML = t[i], $(newSlice).attr("id", "rSlice" + i), $(newSlice).css("transform", "rotate(" + o[t[i]][0] + "deg)"), $(newHold).css("transform", "rotate(9.73deg)"), $(newHold).css("-webkit-transform", "rotate(9.73deg)"), $.inArray(t[i], n) > -1 ? $(newHold).addClass("r-greenbg") : $.inArray(t[i], a) > -1 ? $(newHold).addClass("r-redbg") : $.inArray(t[i], s) > -1 && $(newHold).addClass("r-greybg"), $(newNumber).appendTo(newSlice), $(newHold).appendTo(newSlice), $(newSlice).appendTo($("#rcircle"))
            }, window.resetAni = function () {
                var e = $.keyframe.getVendorPrefix();
                animationPlayState = "animation-play-state", playStateRunning = "running", $(".r-ball").css(e + animationPlayState, playStateRunning).css(e + "animation", "none"), $(".r-pieContainer").css(e + animationPlayState, playStateRunning).css(e + "animation", "none"), $("#toppart").css(e + animationPlayState, playStateRunning).css(e + "animation", "none"), $("#rotate2").html(""), $("#rotate").html("")
            }, window.spinTo = function (e) {
                let t = 0;
                t = _.includes(e) ? h[e] + 180 - 10 : h[e] + 180, resetAni(), setTimeout(function () {
                    bgrotateTo(t)
                }, 300)
            }, window.ballrotateTo = function (e) {
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
                    complete: function () {
                        0 == gamemode && finishSpin(), 1 == gamemode && finishSpinAuto()
                    }
                })
            }, window.bgrotateTo = function (e) {
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
                    complete: function () {}
                }), $("#toppart").playKeyframe({
                    name: "rotate",
                    duration: isQuick ? "1s" : "7s",
                    timingFunction: "ease-in-out",
                    complete: function () {
                        0 == gamemode && finishSpin(), 1 == gamemode && finishSpinAuto()
                    }
                })
            }, window.roulette = function () {
                if ($(".outcome-window").fadeOut(200), clearInterval(null), $(".outcome-window-lose").fadeOut(200), clearInterval(null), !1 !== clicked) return iziToast.info({
                    message: iziGTr(1),
                    icon: "fa fa-info"
                }), setTimeout(function () {
                    clicked = !1
                }, 100);
                clicked = !0, null == l && $.get("/game/roulette/" + JSON.stringify(i) + "?demo", function (e) {
                    v = processBet(i).toFixed(2);
                    var t = JSON.parse(e);
                    if (v >= 1 && v <= 1e3) {
                        const e = new XMLHttpRequest,
                            a = $("meta[name=csrf-token]").attr("content"),
                            s = {
                                bet: v,
                                game_id: 6
                            };
                        e.open("POST", "/api/balance/deduct"), e.setRequestHeader("Content-Type", "appication/json"), e.setRequestHeader("X-CSRF-TOKEN", a), e.setRequestHeader("Authorization", "Bearer " + a), e.onload = (() => {
                            if (e.status >= 200 && e.status < 300) {
                                const a = JSON.parse(e.responseText);
                                200 === a.status ? (b2 = a.new_balance, w.push("User" + a.uid + "..."), A = a.ghid, $("#money").attr("data-current-balance", a.new_balance), $("#money_update").html("-$" + parseFloat(s.bet).toFixed(2)), $("#div_money_update").css("display", "block"), $("#money_update").css("color", "red"), setTimeout(function () {
                                    $("#money").html(a.new_balance), $("#div_money_update").css("display", "none"), $(".lessmoney__gif").fadeIn(200), $("#money_gif__lose").attr("src", "https://cdn.29bet.com/assets/img/all/icons/coin-gif.gif"), setTimeout(() => {
                                        $(".lessmoney__gif").fadeOut(0), $("#money_gif__lose").attr("src", "")
                                    }, 1300)
                                }, 3e3), initExec(t)) : (b = 0, b2 = 0, $("#_payin").click())
                            } else 419 == e.status ? $("#modal_please_login").addClass("md-show") : console.log(new Error(e.statusText))
                        }), e.send(JSON.stringify(s))
                    } else {
                        if (v > 1e3) return iziToast.info({
                            message: iziGTr(5) + '&nbsp;<i class="fad fa-coins"></i>',
                            icon: "fa fa-info"
                        }), setTimeout(function () {
                            clicked = !1
                        }, 100);
                        if (v < 1) return iziToast.info({
                            message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                            icon: "fa fa-info"
                        }), setTimeout(function () {
                            clicked = !1
                        }, 100)
                    }
                })
            }, window.initExec = function (e) {
                if (null != e.error) return "$" === e.error && load("/"), -1 === e.error && $("#b_si").click(), 1 === e.error && iziToast.error({
                    message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                    icon: "fa fa-times"
                }), clicked = !1, 2 === e.error && $("#_payin").click(), void(clicked = !1);
                betAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/bet.mp3" : "", $("#play").addClass("disabled").text(gBtT("aguarde")), k && betAudio.play(), gamemode = 0, $(".roulette-result").fadeOut(250, function () {
                    $(this).delay(250).toggleClass("roulette-result-lose", !1).toggleClass("roulette-result-win", !1), $("#toppart").fadeIn(250, function () {
                        l = e, spinTo(parseInt(l.response.number)), spinAudio.src = isQuick ? isAudioGame ? "https://cdn.29bet.com/assets/media/spinfast.mp3" : "" : isAudioGame ? "https://cdn.29bet.com/assets/media/spin.mp3" : "", k && spinAudio.play(), setTimeout(function () {
                            clicked = !1
                        }, 350)
                    })
                })
            }, window.rouletteauto = function () {
                !1 === clicked && (clicked = !0, null == l && $.get("/game/roulette/" + JSON.stringify(i) + "?demo", function (e) {
                    v = processBet(i);
                    var t = JSON.parse(e);
                    if (v > 0 && 1e3 > v) {
                        const e = new XMLHttpRequest,
                            a = $("meta[name=csrf-token]").attr("content"),
                            s = {
                                bet: v,
                                game_id: 6
                            };
                        e.open("PUT", "/api/balance/deduct"), e.setRequestHeader("Content-Type", "appication/json"), e.setRequestHeader("X-CSRF-TOKEN", a), e.setRequestHeader("Authorization", "Bearer " + a), e.onload = (() => {
                            if (e.status >= 200 && e.status < 300) {
                                const a = JSON.parse(e.responseText);
                                if (200 === a.status) {
                                    b2 = a.new_balance, $("#money").html(a.new_balance), $("#money").attr("data-current-balance", a.new_balance), $("#money_update").html("-$" + parseFloat(s.bet).toFixed(2)), $("#div_money_update").css("display", "block"), $("#money_update").css("color", "red");
                                    let e = setInterval(function () {
                                        this.div_money_update.style.display = "none", clearInterval(e)
                                    }, 3e3);
                                    initExecAuto(t)
                                } else b = 0, b2 = 0, $("#_payin").click()
                            } else 419 == e.status ? $("#modal_please_login").addClass("md-show") : console.log(new Error(e.statusText))
                        }), e.send(JSON.stringify(s))
                    } else iziToast.error({
                        message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                        icon: "fa fa-times"
                    })
                }))
            }, window.initExecAuto = function (e) {
                if (null != e.error) return "$" === e.error && load("/"), -1 === e.error && $("#b_si").click(), 1 === e.error && iziToast.error({
                    message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                    icon: "fa fa-times"
                }), clicked = !1, 2 === e.error && $("#_payin").click(), void(clicked = !1);
                betAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/bet.mp3" : "", k && betAudio.play(), $(".roulette-result").fadeOut(250, function () {
                    $(this).delay(250).toggleClass("roulette-result-lose", !1).toggleClass("roulette-result-win", !1), $("#toppart").fadeIn(250, function () {
                        l = e, spinTo(parseInt(l.response.number)), spinAudio.src = isQuick ? isAudioGame ? "https://cdn.29bet.com/assets/media/spinfast.mp3" : "" : isAudioGame ? "https://cdn.29bet.com/assets/media/spin.mp3" : "", k && spinAudio.play(), d = 1, gamemode = 1, winstatus = 0, retrygame(), setTimeout(function () {
                            clicked = !1
                        }, 350)
                    })
                })
            }, window.finishSpin = function () {
                processWin(l.response.number),
                $("#toppart").fadeOut("fast", function () {
                    $(".roulette-result").html(l.response.number).fadeIn("fast").toggleClass(!1 === l.response.win ? "roulette-result-lose" : "roulette-result-win", !0), !1 === l.response.win ? (loseAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/lose.mp3" : "", k && loseAudio.play()) : (winAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/win.mp3" : "", k && winAudio.play()), l.response.win && isDemo && isGuest() && showDemoTooltip(), -1 === l.response.id || isDemo || sendDrop(l.response.id), l = null, updateBalanceN()
                })
            }, window.finishSpinAuto = function () {
                processWin(l.response.number), $("#toppart").fadeOut("fast", function () {
                    $(".roulette-result").html(l.response.number).fadeIn("fast").toggleClass(!1 === l.response.win ? "roulette-result-lose" : "roulette-result-win", !0), !1 === l.response.win ? (loseAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/lose.mp3" : "", k && loseAudio.play(), winstatus = 0) : (winAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/win.mp3" : "", k && winAudio.play(), winstatus = 1), l.response.win && isDemo && isGuest() && showDemoTooltip(), -1 === l.response.id || isDemo || sendDrop(l.response.id), l = null, updateBalanceN(), c -= 1, d = 1, 1 == stopped && stopauto(), 0 == stopped && (0 == victory && (0 == winstatus ? c > 0 && retrygame() : (stopauto(), c = parseInt($("*[data-games]").attr("data-games")))), 1 == victory && (0 == stopped && (c > 0 ? retrygame() : (stopauto(), c = parseInt($("*[data-games]").attr("data-games")))), 1 == stopped && stopauto()), 2 == victory && (0 == winstatus ? c > 0 ? retrygame() : (stopauto(), m = 0, c = parseInt($("*[data-games]").attr("data-games"))) : (c > 0 && (m < 4 ? (m += 1, retrygame()) : (stopauto(), m = 0, c = parseInt($("*[data-games]").attr("data-games"))), c = parseInt($("*[data-games]").attr("data-games"))), 0 == c && (stopauto(), m = 0, c = parseInt($("*[data-games]").attr("data-games"))))))
                })
            }, window.retrygame = function () {
                0 == stopped && ($("#auto").fadeIn(0).attr("onclick", "stopauto()"), setAutoText("Остановить"), setTimeout(function () {
                    rouletteauto()
                }, 350)), 1 == stopped && stopauto()
            }, window.rouletteautotry = function () {
                stopped = 0, d = 1, rouletteauto()
            }, window.stopauto = function () {
                stopped = 1, d = 0, $("#auto").fadeIn(0).attr("onclick", "rouletteautotry()"), setAutoText("Запустить"), c = parseInt($("*[data-games]").attr("data-games"))
            }, processBet = function (e) {
                const t = Object.values(e);
                let a = 0;
                return t.forEach(function (e, t) {
                    a += e
                }), a
            }, processWin = function (e) {
                const t = Object.values(i),
                    a = Object.keys(i),
                    s = Object.keys(p),
                    n = Object.values(p);
                let o = 0;
                a.forEach(function (a, i) {
                    if (inArray(a, g)) {
                        const r = getKeyByValue(s, a);
                        inArray(e, n[r]) && (o += 2 * t[i])
                    } else if (inArray(a, f)) {
                        const r = getKeyByValue(s, a);
                        inArray(e, n[r]) && (o += 3 * t[i])
                    } else e == a && (o += 37 * t[i])
                }), r_history_clear(), o > 0 ? execTake(o, e) : ($("#play").removeClass("disabled").text(gBtT("jogar")), $(".outcome-window-lose").fadeIn(200),$('.btn_outcome_lose').click(), uapts(0), setInterval(() => {
                    $(".outcome-window-lose").fadeOut(200), clearInterval(null)
                }, 3e3))
            }, window.execTake = function (e, t) {
                const a = new XMLHttpRequest,
                    s = $("meta[name=csrf-token]").attr("content"),
                    n = {
                        winnings: e,
                        game_id: 6,
                        ghid: A
                    };
                a.open("PUT", "/api/balance/add"), a.setRequestHeader("Content-Type", "appication/json"), a.setRequestHeader("X-CSRF-TOKEN", s), a.setRequestHeader("Authorization", "Bearer " + s), a.onload = (() => {
                    if (a.status >= 200 && a.status < 300) {
                        const s = JSON.parse(a.responseText);
                        200 === s.status && (uapts(1), $(".outcome-window__coeff").html(t),$('.btn_outcome').click(), $(".outcome-window_won__sum").html(e.toFixed(2)), $(".outcome-window").fadeIn(200), setInterval(() => {
                            $("#play").removeClass("disabled").text(gBtT("jogar")), $(".outcome-window").fadeOut(200), clearInterval(null)
                        }, 3e3), $("#money").attr("data-current-balance", s.new_balance), $("#money_update").html("+$" + parseFloat(e).toFixed(2)), $("#div_money_update").css("display", "block"), $("#money_update").css("color", "yellow"), setTimeout(function () {
                            $("#div_money_update").css("display", "none"), $(".moremoney__gif").fadeIn(200), $("#money_gif__gain").attr("src", "https://cdn.29bet.com/assets/img/all/icons/coin-gif.gif"), setTimeout(() => {
                                $("#money").html(s.new_balance), $(".moremoney__gif").fadeOut(0), $("#money_gif__gain").attr("src", "")
                            }, 1300)
                        }, 3e3))
                    } else 419 == a.status ? $("#modal_please_login").addClass("md-show") : console.log(new Error(a.statusText))
                }), a.send(JSON.stringify(n))
            }, window.uapts = function (e) {
                w.push(v);
                var t = w;
                y.length > 21 && (y.shift(), $(".bet_jogadores").children().last().remove()), y.push(t), localStorage.setItem("rlt_res", JSON.stringify(y));
                var a = document.createElement("div");
                a.classList.add("d-flex"), a.classList.add("justify-content-around"), a.classList.add("align-items-center");
                var s = document.createElement("div");
                s.className = "crash__player--username", s.textContent = t[0], a.appendChild(s);
                var n = document.createElement("div");
                n.classList.add("crash__player--bet");
                var o = document.createElement("span");
                o.textContent = "R$", o.classList.add("crash__player__bet--rs");
                var i = document.createElement("span");
                i.textContent = t[1], i.classList.add("crash__player__bet--value"), 1 == e ? i.classList.add("game__color--win") : i.classList.add("game__color--lose"), n.appendChild(o), n.appendChild(i), a.appendChild(n), $(".bet_jogadores").prepend(a), w = []
            }, window.ggapts = function () {
                if (null == localStorage.getItem("rlt_res"))
                    for (let i = 1; i <= 22; i++) {
                        var e = gApsts();
                        y.push(e), localStorage.setItem("rlt_res", JSON.stringify(y));
                        var t = document.createElement("div");
                        const i = "d-flex",
                            r = "justify-content-around",
                            d = "align-items-center";
                        t.classList.add(i), t.classList.add(r), t.classList.add(d);
                        var a = document.createElement("div");
                        a.className = "crash__player--username", a.textContent = e[0], t.appendChild(a);
                        var s = document.createElement("div");
                        s.classList.add("crash__player--bet");
                        var n = document.createElement("span");
                        n.textContent = "R$", n.classList.add("crash__player__bet--rs");
                        var o = document.createElement("span");
                        o.textContent = e[2], o.classList.add("crash__player__bet--value"), 1 == mkRdI(0, 1) ? o.classList.add("game__color--win") : o.classList.add("game__color--lose"), s.appendChild(n), s.appendChild(o), t.appendChild(s), $(".bet_jogadores").prepend(t)
                    } else {
                        JSON.parse(localStorage.getItem("rlt_res")).forEach(e => {
                            y.push(e), localStorage.setItem("rlt_res", JSON.stringify(y));
                            var t = document.createElement("div");
                            t.classList.add("d-flex"), t.classList.add("justify-content-around"), t.classList.add("align-items-center");
                            var a = document.createElement("div");
                            a.className = "crash__player--username", a.textContent = e[0], t.appendChild(a);
                            var s = document.createElement("div");
                            s.classList.add("crash__player--bet");
                            var n = document.createElement("span");
                            n.textContent = "R$", n.classList.add("crash__player__bet--rs");
                            var o = document.createElement("span");
                            o.textContent = e[2], o.classList.add("crash__player__bet--value"), 1 == mkRdI(0, 1) ? o.classList.add("game__color--win") : o.classList.add("game__color--lose"), s.appendChild(n), s.appendChild(o), t.appendChild(s), $(".bet_jogadores").prepend(t)
                        })
                    }
            }, window.gapts = function () {
                var e = Math.floor(2e3 * Math.random()) + 1e3;
                setTimeout(function () {
                    var e = gApsts();
                    y.length > 21 && (y.shift(), $(".bet_jogadores").children().last().remove()), y.push(e), localStorage.setItem("rlt_res", JSON.stringify(y));
                    var t = document.createElement("div");
                    t.classList.add("d-flex"), t.classList.add("justify-content-around"), t.classList.add("align-items-center");
                    var a = document.createElement("div");
                    a.className = "crash__player--username", a.textContent = e[0], t.appendChild(a);
                    var s = document.createElement("div");
                    s.classList.add("crash__player--bet");
                    var n = document.createElement("span");
                    n.textContent = "R$", n.classList.add("crash__player__bet--rs");
                    var o = document.createElement("span");
                    o.textContent = e[2], o.classList.add("crash__player__bet--value"), 1 == mkRdI(0, 1) ? o.classList.add("game__color--win") : o.classList.add("game__color--lose"), s.appendChild(n), s.appendChild(o), t.appendChild(s), $(".bet_jogadores").prepend(t), gapts()
                }, e)
            }, window.gApsts = function () {
                var e = "";
                e += "User", e += mkId(4), e += "...";
                var t = "";
                return 0 == (t += mkRdI(0, 9)) ? t = mkRdI(1, 9) : t += mkRdI(0, 9), t += ".", t += mkRdI(0, 9), [e, 0, parseFloat(t).toFixed(2)]
            }, window.mkRdI = function (e, t) {
                return e = Math.ceil(e), t = Math.floor(t), Math.floor(Math.random() * (t - e + 1)) + e
            }, window.mkId = function (e) {
                for (var t = "", a = "0123456789a0123456789b0123456789c0123456789d0123456789e0123456789f0123456789g0123456789h0123456789i0123456789j0123456789kl0123456789m0123456789n0123456789o0123456789p0123456789q0123456789r0123456789s0123456789t0123456789u0123456789v0123456789w0123456789x0123456789y0123456789z0123456789", s = 0; s < e;) t += s > 1 ? a.charAt(Math.floor(Math.random() * a.length)) : "0123456789".charAt(Math.floor(Math.random() * "0123456789".length)), s += 1;
                return t
            }, window.checkSound = function () {
                k = "on" == $("#roulette_music").attr("data-music")
            }, ggapts(), gapts(), checkSound(), $("#roulette_music").on("click", function () {
                "on" == $("#roulette_music").attr("data-music") ? (spinAudio.muted = !0, k = !1, $("#roulette_music").attr("data-music", "off")) : (spinAudio.muted = !1, k = !0, $("#roulette_music").attr("data-music", "on"))
            }), inArray = function (e, t) {
                for (var a = t.length, s = 0; s < a; s++)
                    if (t[s] == e) return !0;
                return !1
            }, getKeyByValue = function (e, t) {
                for (let a in e)
                    if (e[a] === t) return a;
                return null
            }, $(".token").on("click", function () {
                e = parseFloat($(this).attr("data-value")), $(".token-active").removeClass("token-active"), $(this).addClass("token-active")
            }), $(".tokens").slick({
                dots: !1,
                infinite: !1,
                slidesToShow: 14,
                arrows: !1,
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
                        arrows: !1
                    }
                }],
                slidesToScroll: 4
            });
            var C = function (e, t) {
                    $(e).on("mouseover", function () {
                        $.each($(".chip"), function (e, a) {
                            t.includes($(this).attr("data-chip")) && $(this).addClass("chip-disabled")
                        })
                    }), $(e).on("mouseleave", function () {
                        $(".chip").removeClass("chip-disabled")
                    })
                },
                T = {
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
            C("#row1", T.second.concat(T.third)), C("#row2", T.first.concat(T.third)), C("#row3", T.first.concat(T.second)), C("#red", T.black), C("#black", T.ndred), C("#1-12", T.numeric.second.concat(T.numeric.third)), C("#13-24", T.numeric.first.concat(T.numeric.third)), C("#25-36", T.numeric.first.concat(T.numeric.second)), C("#1-18", T.half.seco), C("#19-36", T.half.first), C("#e", T.e.opposite), C("#eo", T.e.even), $(".chip").on("click", function () {
                var t = $(this).attr("data-chip");
                const a = getBetFor(t) + e,
                    s = processBet(i) + a;
                if (Number(s) > Number(1e3)) return iziToast.info({
                    message: iziGTr(5),
                    icon: "fa fa-info"
                }), setTimeout(function () {
                    clicked = !1
                }, 100);
                clickAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/click.mp3" : "", k && clickAudio.play();
                var n = $(this).find(".bet-stack");
                0 === n.length && (n = $('<div class="bet-stack"></div>')).hide().fadeIn("fast");
                var o = $('<div class="token bet-token" data-token-value="' + e + '" style="margin-top: -' + 2 * n.children().length + 'px">' + abbreviateNumber(e) + "</div>");
                n.append(o), r.push(o), $(this).append(n), setBetFor(t, getBetFor(t) + e)
            }), createWheel(), setTimeout(function () {
                $.getScript("/js/vendor/jquery.keyframes.min.js")
            }, 1e3), window.getBetFor = function (e) {
                return null == i[e] ? 0 : i[e]
            }, window.setBetFor = function (e, t) {
                i[e] = t;
                for (var a = 0, s = 0; s < Object.keys(i).length; s++) a += i[Object.keys(i)[s]];
                $("#token_bet").html(a.toFixed(2) + '&nbsp;<i class="fad fa-coins"></i>')
            }, window.r_history_back = function () {
                if (0 !== r.length) {
                    var e = r[r.length - 1];
                    setBetFor(e.parent().parent().attr("data-chip"), getBetFor(e.parent().parent().attr("data-chip")) - parseFloat(e.attr("data-token-value"))), 1 === e.parent().children().length ? e.parent().fadeOut("fast", function () {
                        $(this).remove()
                    }) : e.remove(), r.splice(r.length - 1, 1), clickAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/click.mp3" : "", k && clickAudio.play()
                }
            }, window.r_history_clear = function () {
                r = [], i = {}, $(".bet-stack").fadeOut("fast", function () {
                    $(this).remove()
                }), $("#token_bet").html('0.00&nbsp;<i class="fad fa-coins"></i>'), clickAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/click.mp3" : "", k && clickAudio.play()
            }
        })
    }
});
