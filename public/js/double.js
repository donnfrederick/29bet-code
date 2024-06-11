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
    }, a.p = "/", a(a.s = 11)
}({
    11: function (e, t, a) {
        e.exports = a("YHe5")
    },
    YHe5: function (e, a) {
        $.on("/dice", function () {
            var e, a, s = 15,
                n = 0,
                o = 0,
                i = !1,
                l = null,
                r = null,
                d = [0, 98, 49, 32, 24, 19, 16, 14, 12, 10.9, 9.8, 8.9, 8.1, 7.5, 7, 6.5, 6.1, 5.7, 5.4, 5.1, 4.9, 4.6, 4.4, 4.2, 4.1, 3.9, 3.7, 3.6, 3.5, 3.3, 3.2, 3.1, 3, 2.9, 2.85, 2.8, 2.7, 2.6, 2.55, 2.5, 2.45, 2.4, 2.3, 2.27, 2.22, 2.17, 2.13, 2.08, 2.04, 2, 1.96, 1.92, 1.88, 1.84, 1.81, 1.78, 1.75, 1.71, 1.68, 1.66, 1.63, 1.6, 1.58, 1.55, 1.53, 1.5, 1.48, 1.46, 1.44, 1.42, 1.4, 1.38, 1.36, 1.34, 1.32, 1.3, 1.28, 1.27, 1.26, 1.25, 1.24, 1.2, 1.19, 1.18, 1.17, 1.16, 1.15, 1.14, 1.13, 1.12, 1.11, 1.1, 1.09, 1.08, 1.06, 0, 0, 0, 0, 0, 0],
                c = [98, 49, 32, 24, 19, 16, 14, 12, 10.9, 9.8, 8.9, 8.1, 7.5, 7, 6.5, 6.1, 5.7, 5.4, 5.1, 4.9, 4.6, 4.4, 4.2, 4.1, 3.9, 3.7, 3.6, 3.5, 3.3, 3.2, 3.1, 3, 2.9, 2.85, 2.8, 2.7, 2.6, 2.55, 2.5, 2.45, 2.4, 2.3, 2.27, 2.22, 2.17, 2.13, 2.08, 2.04, 2, 1.96, 1.92, 1.88, 1.84, 1.81, 1.78, 1.75, 1.71, 1.68, 1.66, 1.63, 1.6, 1.58, 1.55, 1.53, 1.5, 1.48, 1.46, 1.44, 1.42, 1.4, 1.38, 1.36, 1.34, 1.32, 1.3, 1.28, 1.27, 1.26, 1.25, 1.24, 1.2, 1.19, 1.18, 1.17, 1.16, 1.15, 1.14, 1.13, 1.12, 1.11, 1.1, 1.09, 1.08, 1.06],
                u = [],
                p = !1,
                m = 1,
                _ = [],
                f = !0;
            victory = 0, pft = 0, stopped = 0, clicked = !1, t = "lower", betAudio = new Audio, winAudio = new Audio, loseAudio = new Audio, rollAudio = new Audio, window.setMode = function (e) {
                if (0 != o || p) return iziToast.info({
                    message: iziGTr(7),
                    icon: "fa fa-info"
                }), setTimeout(function () {
                    clicked = !1
                }, 100);
                setTimeout(() => {
                    $(".game-sidebar-tab").removeClass("active"), $("[data-tab=" + e + "]").addClass("active")
                }, 152), "auto" == e ? ($("#play").hide(), $("#auto").show(), $("#gamesvalue").fadeIn(200), $("#gamesvictory").fadeIn(200)) : ($("#auto").hide(), $("#play").show(), $("#gamesvalue").fadeOut(200), $("#gamesvictory").fadeOut(200))
            }, window.cur = t;
            var g = $('<div class="d_slider-tooltip_container dice__tooltip"><div class="d_slider-tooltip"><span id="tooltip-value">50</span></div></div>').hide(),
                v = function (e, t) {
                    var a = 2 === e.toString().length ? 7 : 11;
                    return $("<div style='display: none;'>" + e + "</div>").css({
                        position: "absolute",
                        top: -30,
                        color: "#565656",
                        "text-align": "center",
                        "font-size": "13px",
                        left: 0 === e ? "-3px" : "calc(" + t + " - " + a + "px)"
                    })
                };
            (e = $("#slider-range").slider({
                range: "min",
                min: 0,
                max: 100,
                value: 50,
                slide: function (e, a) {
                    if (0 == o) return !(a.value < 1 || a.value > 99) && !("lower" === t && a.value > 94) && !("higher" === t && a.value < 6) && (__profit(a.value), $("#tooltip-value").text(a.value), void updateHeader(a.value))
                }
            })).append($('<div id="circle" class="d_slider-circle" style="display: none" />')).append($('<div id="result" class="d_slider-result" style="opacity: 0">0</div>')).append(v(100, "100%")).append(v(75, "75%")).append(v(50, "50%")).append(v(25, "25%")).append(v(0, "0")), e.find(".ui-slider-handle").append(g).hover(function () {
                g.stop(!0).fadeIn("fast")
            }, function () {
                g.stop(!0).fadeOut("fast")
            }), $(".dice__options__content__low").click(function () {
                "lower" != t && ($(".d_slider-top").removeClass("dice__red").addClass("dice__blue"), t = "lower", sw())
            }), $(".dice__options__content__high").click(function () {
                "higher" != t && ($(".d_slider-top").removeClass("dice__blue").addClass("dice__red"), t = "higher", sw())
            }), $("#i_value").on("input", function () {
                $(this).val() < 6 && "higher" === t && $(this).val(94), $(this).val() < 94 && "lower" === t && $(this).val(6), $("#slider-range").slider("value", $("#i_value").val()), $("#i_chance").val(("higher" === t ? 100 - $("#i_value").val() : $("#i_value").val()) + "%"), $(".dice__options__content__chance--porcent").html(("higher" === t ? 100 - $("#i_value").val() : $("#i_value").val()) + "%")
            }), $("*[data-games]").on("click", function () {
                !p && ($("*[data-games]").toggleClass("bc_active", !1), $(this).toggleClass("bc_active", !0), s = parseInt($(this).attr("data-games")), $(".bomb_input").val(s), $(".bomb_input").toggleClass("dn", !0), $("#change_games span").toggleClass("dn", !1))
            }), $("#change_games").on("click", function () {
                !p && (s = 0, $("*[data-games]").toggleClass("bc_active", !1), $("#change_games input").val(""), $("#change_games span").toggleClass("dn", !0), $("#change_games input").toggleClass("dn", !1), $(".bomb_input").on("input", function () {
                    var e = parseInt($(this).val());
                    if (isNaN(e) || e < 1) return $(this).toggleClass("bad", !0), void(g = !0);
                    $(this).toggleClass("bad", !1), g = !1, s = e, $("*[data-games]").toggleClass("bc_active", !1), $('*[data-games="' + s + '"]').toggleClass("bc_active", !0)
                }).focus())
            }), $("*[data-victory]").on("click", function () {
                !p && ($(this).attr("*[data-victory]"), $(".buttons-3-selected").removeClass("buttons-3-selected"), $(this).addClass("buttons-3-selected"), $(".victory_input").val(parseInt($(this).attr("data-victory"))), m = parseInt($(".victory_input").val()))
            }), window.aPb = function (e) {
                const t = $("#play");
                0 == e ? (t.text(gBtT("jogar")), t.attr("disabled", !1)) : 1 == e ? (t.text(gBtT("aguarde")), t.attr("disabled", !0)) : t.text(gBtT("parar"))
            }, window.sw = function () {
                $("#slider-range").slider("option", {
                    range: "lower" === t ? "min" : "max"
                }), $("#sw_text").html("lower" === t ? "Menos" : "Mais");
                var e = 100 - $("#slider-range").slider("value");
                "higher" === t && e < 6 && (e = 6), "lower" === t && e > 94 && (e = 94), e < 1 && (e = 1), e > 99 && (e = 99), $("#tooltip-value").html(e), $("#slider-range").slider("value", e), updateHeader(e), __profit(e)
            }, window.updateHeader = function (e) {
                var a = null == e ? $("#slider-range").slider("value") : e;
                $("#i_value").val(a), $("#i_chance").val(("lower" === t ? a : 100 - a) + "%"), $(".dice__options__content__chance--porcent").html(("lower" === t ? a : 100 - a) + "%")
            }, window.getDiceProfit = function (e, a, s) {
                isNaN(s) && (s = $("#i_value").val());
                let n = "lower" === t ? d[s] : d[100 - s];
                return pft = n, $(".dice__options__content__multiplier--number").html("x" + n), t, (e * n).toFixed(2)
            }, window.diceauto = function () {
                $(".outcome-window").fadeOut(200), clearInterval(l), $(".outcome-window-lose").fadeOut(200), clearInterval(r), n = $("#bet").val(), o = 1;
                const e = new XMLHttpRequest,
                    t = $("meta[name=csrf-token]").attr("content"),
                    a = {
                        bet: n,
                        game_id: 4
                    };
                e.open("PUT", "/api/balance/deduct"), e.setRequestHeader("Content-Type", "application/json"), e.setRequestHeader("X-CSRF-TOKEN", t), e.setRequestHeader("Authorization", "Bearer " + t), e.onload = (() => {
                    if (e.status >= 200 && e.status < 300) {
                        const t = JSON.parse(e.responseText);
                        200 === t.status ? (t.new_balance, _.push("User" + t.uid + "..."), $("#money").attr("data-current-balance", t.new_balance), $("#money_update").html("-$" + parseFloat(n).toFixed(2)), $("#div_money_update").css("display", "block"), $("#money_update").css("color", "red"), setTimeout(function () {
                            $("#money").html(t.new_balance), $("#div_money_update").css("display", "none"), $(".lessmoney__gif").fadeIn(200), $("#money_gif__lose").attr("src", "https://cdn.29bet.com/assets/img/all/icons/coin-gif.gif"), setTimeout(() => {
                                $(".lessmoney__gif").fadeOut(0), $("#money_gif__lose").attr("src", "")
                            }, 1300)
                        }, 3e3), executeManual()) : (n = 0, 0, $("#_payin").click())
                    } else 419 == e.status ? $("#modal_please_login").addClass("md-show") : console.log(new Error(e.statusText))
                }), p && e.send(JSON.stringify(a))
            }, window.retrygame = function () {}, window.diceautotry = function () {}, window.stopauto = function () {}, window.dice = function () {
                if (0 == i) {
                    if (o = 1, aPb(o), i = !0, $(".outcome-window").fadeOut(200), clearInterval(l), $(".outcome-window-lose").fadeOut(200), clearInterval(r), !($("#bet").val() >= 1)) return iziToast.info({
                        message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                        icon: "fa fa-info"
                    }), setTimeout(function () {
                        clicked = !1
                    }, 100); {
                        n = $("#bet").val();
                        const e = new XMLHttpRequest,
                            t = $("meta[name=csrf-token]").attr("content"),
                            a = {
                                bet: n,
                                game_id: 4
                            };
                        e.open("PUT", "/api/balance/deduct"), e.setRequestHeader("Content-Type", "appication/json"), e.setRequestHeader("X-CSRF-TOKEN", t), e.setRequestHeader("Authorization", "Bearer " + t), e.onload = (() => {
                            if (e.status >= 200 && e.status < 300) {
                                const t = JSON.parse(e.responseText);
                                200 === t.status ? (_.push("User" + t.uid + "..."), t.new_balance, $("#money").attr("data-current-balance", t.new_balance), $("#money_update").html("-$" + parseFloat(n).toFixed(2)), $("#div_money_update").css("display", "block"), $("#money_update").css("color", "red"), setTimeout(function () {
                                    $("#money").html(t.new_balance), $("#div_money_update").css("display", "none"), $(".lessmoney__gif").fadeIn(200), $("#money_gif__lose").attr("src", "https://cdn.29bet.com/assets/img/all/icons/coin-gif.gif"), setTimeout(() => {
                                        $(".lessmoney__gif").fadeOut(0), $("#money_gif__lose").attr("src", "")
                                    }, 1300)
                                }, 3e3), executeManual()) : (n = 0, 0, $("#_payin").click())
                            } else 419 == e.status ? $("#modal_please_login").addClass("md-show") : console.log(new Error(e.statusText))
                        }), e.send(JSON.stringify(a))
                    }
                }
            }, window.executeManual = function () {
                if (s >= 0 && (s -= 1), !1 !== clicked) return iziToast.info({
                    message: iziGTr(1),
                    icon: "fa fa-info"
                }), setTimeout(function () {
                    clicked = !1
                }, 100);
                clicked = !0, parseFloat($("#bet_profit").html()) <= 0 ? iziToast.error({
                    message: "Сумма выигрыша должна быть выше 0.<br>Подкорректируйте ставку и шанс.",
                    icon: "fa fa-times",
                    position: "bottomCenter"
                }) : $.get("/game/dice/" + $("#bet").val() + "/" + t + "/" + $("#slider-range").slider("value") + "?demo", function (e) {
                    var t = JSON.parse(e);
                    if (null != t.error) return "$" === t.error && load("/"), -1 === t.error && $("#b_si").click(), 0 === t.error && iziToast.error({
                        message: "Допустимое значение: 1% - 94%",
                        icon: "fa fa-times"
                    }), clicked = !1, 1 === t.error && iziToast.error({
                        message: 'Минимальная ставка: 0.01&nbsp;<i class="fad fa-coins"></i>',
                        icon: "fa fa-times"
                    }), clicked = !1, 2 === t.error && $("#_payin").click(), void(clicked = !1);
                    rollAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/roll.mp3" : "", f && rollAudio.play();
                    var n = !1 !== t.response.result;
                    $("#circle").fadeIn("fast"), $("#circle").css({
                        left: "calc(" + t.response.number + "% - 3px)",
                        color: n ? "green" : "red",
                        "transition-duration": "1.5s"
                    }), $("#result").toggleClass("lose", !n), showResult(n), setTimeout(function () {
                        0 == n && (loseAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/lose.mp3" : "", f && loseAudio.play()), 1 == n && m > !1 && (m -= 1), p && setTimeout(() => {
                            -1 == m ? -1 == s ? diceauto() : s > 0 ? diceauto() : (p = !1, $("#bet_btn_auto").text(gBtT("jogar")), o = 0) : m > 0 ? -1 == s ? diceauto() : s > 0 ? diceauto() : (p = !1, $("#bet_btn_auto").text(gBtT("jogar")), o = 0) : (p = !1, $("#bet_btn_auto").text(gBtT("jogar")), o = 0)
                        }, 3e3)
                    }, 1300), $("#result").text(t.response.number), $("#result").css({
                        opacity: 1
                    }), $("#result").css({
                        left: "calc(" + t.response.number + "% - 16px)",
                        "transition-duration": "1.5s"
                    }), clearTimeout(a), a = setTimeout(function () {
                        $("#result").css({
                            opacity: 0
                        }), $("#circle").fadeOut("fast")
                    }, 7e3), setTimeout(function () {
                        clicked = !1
                    }, 100), s && isDemo && isGuest() && showDemoTooltip(), -1 === t.response.id || isDemo || sendDrop(t.response.id), validateTask(t.response.id), updateBalanceN(), take(t)
                })
            }, window.executeAuto = function () {}, window.take = function (e) {
                if (e.response.result) {
                    const e = new XMLHttpRequest,
                        t = $("meta[name=csrf-token]").attr("content"),
                        a = {
                            winnings: parseFloat(pft).toFixed(2) * parseFloat(n).toFixed(2),
                            game_id: 4
                        };
                    e.open("POST", "/api/balance/add"), e.setRequestHeader("Content-Type", "application/json"), e.setRequestHeader("X-CSRF-TOKEN", t), e.setRequestHeader("Authorization", "Bearer " + t), e.onload = (() => {
                        if (e.status >= 200 && e.status < 300) {
                            const t = JSON.parse(e.responseText);
                            if (200 === t.status) {
                                t.new_balance;
                                let e = setInterval(function () {
                                    uapts(1), $("#mul").html($("#slider-range").slider("value") + "%"), $("#val").html(a.winnings), winAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/win.mp3" : "", f && winAudio.play(), $(".outcome-window").fadeIn(200), l = setInterval(() => {
                                        $(".outcome-window").fadeOut(200), clearInterval(l)
                                    }, 3e3), $("#money").attr("data-current-balance", t.new_balance), $("#money_update").html("+$" + parseFloat(a.winnings).toFixed(2)), $("#div_money_update").css("display", "block"), $("#money_update").css("color", "yellow"), setTimeout(function () {
                                        $("#div_money_update").css("display", "none"), $(".moremoney__gif").fadeIn(200), $("#money_gif__gain").attr("src", "https://cdn.29bet.com/assets/img/all/icons/coin-gif.gif"), setTimeout(() => {
                                            $("#money").html(t.new_balance), $(".moremoney__gif").fadeOut(0), $("#money_gif__gain").attr("src", "")
                                        }, 1300)
                                    }, 3e3), i = !1, !p && (o = 0, aPb(o)), clearInterval(e)
                                }, 1500)
                            }
                        } else 419 == e.status ? $("#modal_please_login").addClass("md-show") : console.log(new Error(e.statusText))
                    }), e.send(JSON.stringify(a))
                } else  t = setInterval(function () {
                    !p && (o = 0, aPb(o)), uapts(0), $(".outcome-window-lose").fadeIn(200), r = setInterval(() => {
                        $(".outcome-window-lose").fadeOut(200), clearInterval(r)
                    }, 3e3), i = !1, clearInterval(t)
                }, 1500)
            }, window.showResult = function (e) {
                let t = setInterval(function () {
                    $("#result").toggleClass("win", e), clearInterval(t), rollDice()
                })
            }, window.rollDice = function () {
                [...document.querySelectorAll(".die-list")].forEach(e => {
                    toggleClasses(e), e.dataset.roll = getRandomNumber(1, 9)
                })
            }, window.toggleClasses = function (e) {
                e.classList.toggle("odd-roll"), e.classList.toggle("even-roll"), e.classList.toggle("third-sibling")
            }, window.getRandomNumber = function (e, t) {
                return e = Math.ceil(e), t = Math.floor(t), Math.floor(Math.random() * (t - e + 1)) + e
            }, window.uapts = function (e) {
                _.push($(".dice__options__content__multiplier--number").text()), _.push(n);
                var t = _;
                u.length > 21 && (u.shift(), $(".bet_jogadores").children().last().remove()), u.push(t), localStorage.setItem("dce_res", JSON.stringify(u));
                var a = document.createElement("div");
                a.classList.add("my-2"), a.classList.add("d-flex"), a.classList.add("justify-content-between"), a.classList.add("align-items-center");
                var s = document.createElement("div");
                s.className = "crash__player--username", s.textContent = t[0], a.appendChild(s);
                var o = document.createElement("div");
                o.classList.add("crash__player--multiplier"), o.textContent = t[1], a.appendChild(o);
                var i = document.createElement("div");
                i.classList.add("crash__player--bet");
                var l = document.createElement("span");
                l.textContent = "R$", l.classList.add("crash__player__bet--rs");
                var r = document.createElement("span");
                r.textContent = t[2], r.classList.add("crash__player__bet--value"), 1 == e ? r.classList.add("game__color--win") : r.classList.add("game__color--lose"), i.appendChild(l), i.appendChild(r), a.appendChild(i), $(".bet_jogadores").prepend(a), _ = []
            }, window.ggapts = function () {
                if (null == localStorage.getItem("dce_res"))
                    for (let l = 1; l <= 22; l++) {
                        var e = gApsts();
                        u.push(e), localStorage.setItem("dce_res", JSON.stringify(u));
                        var t = document.createElement("div");
                        const l = "d-flex",
                            r = "justify-content-between",
                            d = "align-items-center",
                            c = "my-2";
                        t.classList.add(c), t.classList.add(l), t.classList.add(r), t.classList.add(d);
                        var a = document.createElement("div");
                        a.className = "crash__player--username", a.textContent = e[0], t.appendChild(a);
                        var s = document.createElement("div");
                        s.classList.add("crash__player--multiplier"), s.textContent = "x" + e[1], t.appendChild(s);
                        var n = document.createElement("div");
                        n.classList.add("crash__player--bet");
                        var o = document.createElement("span");
                        o.textContent = "R$", o.classList.add("crash__player__bet--rs");
                        var i = document.createElement("span");
                        i.textContent = e[2], i.classList.add("crash__player__bet--value"), 1 == mkRdI(0, 1) ? i.classList.add("game__color--win") : i.classList.add("game__color--lose"), n.appendChild(o), n.appendChild(i), t.appendChild(n), $(".bet_jogadores").prepend(t)
                    } else {
                        JSON.parse(localStorage.getItem("dce_res")).forEach(e => {
                            u.push(e), localStorage.setItem("dce_res", JSON.stringify(u));
                            var t = document.createElement("div");
                            t.classList.add("d-flex"), t.classList.add("justify-content-between"), t.classList.add("align-items-center");
                            var a = document.createElement("div");
                            a.className = "crash__player--username", a.textContent = e[0], t.appendChild(a);
                            var s = document.createElement("div");
                            s.classList.add("crash__player--multiplier"), s.textContent = "x" + e[1], t.appendChild(s);
                            var n = document.createElement("div");
                            n.classList.add("crash__player--bet");
                            var o = document.createElement("span");
                            o.textContent = "R$", o.classList.add("crash__player__bet--rs");
                            var i = document.createElement("span");
                            i.textContent = e[2], i.classList.add("crash__player__bet--value"), 1 == mkRdI(0, 1) ? i.classList.add("game__color--win") : i.classList.add("game__color--lose"), n.appendChild(o), n.appendChild(i), t.appendChild(n), $(".bet_jogadores").prepend(t)
                        })
                    }
            }, window.gapts = function () {
                var e = Math.floor(2e3 * Math.random()) + 1e3;
                setTimeout(function () {
                    var e = gApsts();
                    u.length > 21 && (u.shift(), $(".bet_jogadores").children().last().remove()), u.push(e), localStorage.setItem("dce_res", JSON.stringify(u));
                    var t = document.createElement("div");
                    t.classList.add("my-2"), t.classList.add("d-flex"), t.classList.add("justify-content-between"), t.classList.add("align-items-center");
                    var a = document.createElement("div");
                    a.className = "crash__player--username", a.textContent = e[0], t.appendChild(a);
                    var s = document.createElement("div");
                    s.classList.add("crash__player--multiplier"), isNaN(e[1]) ? s.textContent = "x1.81" : s.textContent = "x" + e[1], t.appendChild(s);
                    var n = document.createElement("div");
                    n.classList.add("crash__player--bet");
                    var o = document.createElement("span");
                    o.textContent = "R$", o.classList.add("crash__player__bet--rs");
                    var i = document.createElement("span");
                    i.textContent = e[2], i.classList.add("crash__player__bet--value"), 1 == mkRdI(0, 1) ? i.classList.add("game__color--win") : i.classList.add("game__color--lose"), n.appendChild(o), n.appendChild(i), t.appendChild(n), $(".bet_jogadores").prepend(t), gapts()
                }, e)
            }, window.gApsts = function () {
                var e = "";
                e += "User", e += mkId(4), e += "...";
                var t = parseFloat(c[mkRdI(0, c.length)]).toFixed(2),
                    a = "";
                return 0 == (a += mkRdI(0, 9)) ? a = mkRdI(1, 9) : a += mkRdI(0, 9), [e, t, parseFloat(a).toFixed(2)]
            }, window.mkRdI = function (e, t) {
                return e = Math.ceil(e), t = Math.floor(t), Math.floor(Math.random() * (t - e + 1)) + e
            }, window.mkId = function (e) {
                for (var t = "", a = "0123456789a0123456789b0123456789c0123456789d0123456789e0123456789f0123456789g0123456789h0123456789i0123456789j0123456789kl0123456789m0123456789n0123456789o0123456789p0123456789q0123456789r0123456789s0123456789t0123456789u0123456789v0123456789w0123456789x0123456789y0123456789z0123456789", s = 0; s < e;) t += s > 1 ? a.charAt(Math.floor(Math.random() * a.length)) : "0123456789".charAt(Math.floor(Math.random() * "0123456789".length)), s += 1;
                return t
            }, window.checkSound = function () {
                f = "on" == $("#dice_music").attr("data-music")
            }, ggapts(), gapts(), checkSound(), $("#dice_music").on("click", function () {
                "on" == $("#dice_music").attr("data-music") ? (f = !1, $("#dice_music").attr("data-music", "off")) : (f = !0, $("#dice_music").attr("data-music", "on"))
            }), $("#auto").click(function () {
                if (p) p = !1, $("#bet_btn_auto").text(gBtT("jogar"));
                else {
                    if (0 != o) return iziToast.info({
                        message: iziGTr(1),
                        icon: "fa fa-info"
                    }), setTimeout(function () {
                        clicked = !1
                    }, 100);
                    if (!($("#bet").val() >= 1 && 0 == o)) return iziToast.info({
                        message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                        icon: "fa fa-info"
                    }), setTimeout(function () {
                        clicked = !1
                    }, 100);
                    if (m = parseInt($(".victory_input").val()), 0 == (s = parseInt($(".bomb_input").val()))) return iziToast.info({
                        message: iziGTr(6),
                        icon: "fa fa-info"
                    }), setTimeout(function () {
                        clicked = !1
                    }, 100);
                    p = !0, $("#bet_btn_auto").text(gBtT("parar")), diceauto()
                }
            })
        })
    }
});
var __profit = function (e) {
    if ("string" == typeof window.cur) {
        var t = null == e ? $("#slider-range").slider("value") : e,
            a = getDiceProfit($("#bet").val(), "lower" === cur ? 0 : t, "higher" === cur ? 100 : t);
        $(".bet_profit").toggleClass("bet_profit-error", parseFloat(a) <= 0)
    } else setTimeout(function () {
        __profit(e)
    }, 100)
};
