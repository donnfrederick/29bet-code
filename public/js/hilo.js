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
    }, a.p = "/", a(a.s = 9)
}({
    9: function (e, t, a) {
        e.exports = a("TpFI")
    },
    TpFI: function (e, t) {
        $.on("/hilo", function () {
            var e = null,
                t = !1,
                a = !1,
                s = 1,
                n = 0,
                r = null,
                i = [],
                o = [],
                l = 0,
                d = !0,
                c = 0;
            betAudio = new Audio, winAudio = new Audio, clickAudio = new Audio, flipAudio = new Audio, gameAudio = new Audio, loseAudio = new Audio, window.hilo = function () {
                if (!($("#bet").val() >= 1)) return iziToast.info({
                    message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                    icon: "fa fa-info"
                }), setTimeout(function () {
                    clicked = !1
                }, 100); {
                    n = $("#bet").val();
                    const a = new XMLHttpRequest,
                        i = $("meta[name=csrf-token]").attr("content"),
                        l = {
                            bet: n,
                            game_id: 9
                        };
                    a.open("POST", "/api/balance/deduct"), a.setRequestHeader("Content-Type", "application/json"), a.setRequestHeader("X-CSRF-TOKEN", i), a.setRequestHeader("Authorization", "Bearer " + i), a.onload = (() => {
                        if (a.status >= 200 && a.status < 300) {
                            const i = JSON.parse(a.responseText);
                            if (200 === i.status) {
                                b2 = i.new_balance, o.push("User" + i.uid + "..."), c = i.ghid, $("#money").html(i.new_balance), $("#money").attr("data-current-balance", i.new_balance), $("#money_update").html("-$" + parseFloat(n).toFixed(2)), $("#div_money_update").css("display", "block"), $("#money_update").css("color", "red");
                                let a = setInterval(function () {
                                    this.div_money_update.style.display = "none", clearInterval(a)
                                }, 3e3);
                                null == e && !0 !== t && $.get("/game/hilo/" + $("#bet").val() + "/" + s, function (t) {
                                    var a = JSON.parse(t);
                                    if (null != a.error) return "$" === a.error && load("/"), -1 === a.error && $("#b_si").click(), 1 === a.error && iziToast.error({
                                        message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                                        icon: "fa fa-times"
                                    }), 2 === a.error && $("#_payin").click(), void(3 === a.error && (replace(), hilo()));
                                    betAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/bet.mp3" : "", d && betAudio.play(), calculateProbability(s), $(".hilo-replace").fadeOut("fast"), $(".cf_status").fadeOut("fast"), clearInterval(r), $(".hilo-select").fadeIn("fast"), $("#play").attr("disabled", !0).attr("onclick", "take()"), updateBalanceN(), e = a, _disableDemo = !0, dbBtn(!1)
                                })
                            } else n = 0, b2 = 0, $("#_payin").click()
                        } else 419 == a.status ? $("#modal_please_login").addClass("md-show") : console.log(new Error(a.statusText))
                    }), a.send(JSON.stringify(l))
                }
            }, window.flip = function (n) {
                null != e && !0 !== t && $.get("/game/hilo/flip/" + e.id + "/" + n, function (n) {
                    var i = JSON.parse(n);
                    if (null != i.error) return -1 === i.error && iziToast.error({
                        message: "Игра не найдена.",
                        icon: "fa fa-times"
                    }), void(0 === i.error && console.log("Server cancelled input"));
                    t = !0;
                    var o = parseFloat(i.multiplier).toFixed(2),
                        c = splitDecimal(o),
                        u = parseFloat(i.deck_index);
                    s = u, clickAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/click.mp3" : "", d && clickAudio.play(), flipAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/flip.mp3" : "", d && flipAudio.play(), setCard(deck[u]), setTimeout(function () {
                        if (t = !1, !1 === i.win) setTimeout(function () {
                            uapts(0), $("#cf_status_text").html("Você perdeu!!"), $(".cf_status").toggleClass("hilo__win", !1).toggleClass("hilo__lose", !0), $('.btn_outcome_lose').click(), $(".ribbon-wide").toggleClass("win-ribbon", !1).toggleClass("lose-ribbon", !0), $(".cf_status").fadeIn("fast"), r = setInterval(() => {
                                $(".cf_status").fadeOut(200), clearInterval(r)
                            }, 3e3), loseAudio.src = isAudioGame ? "/assets/media/lose.mp3" : "", d && loseAudio.play(), isDemo || sendDrop(e.id), validateTask(e.id), clear(), updateBalanceN(), clearHistory(), $("#play").attr("disabled", !1), dbBtn(!0)
                        }, 400);
                        else {
                            calculateProbability(u), $("#games").prop("number", p_n("#games")).animateNumber({
                                number: i.games
                            }), $("#mul").prop("number", p_n("#mul")).animateNumber({
                                number: c[0]
                            }), $("#mul_m").prop("number", p_n("#mul_m")).animateNumber({
                                number: c[1]
                            }), $("#play").attr("disabled", !1), gameAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/game.mp3" : "", d && gameAudio.play(), l = parseFloat(i.multiplier).toFixed(2);
                            var s = (parseFloat(e.bet) * l).toFixed(2);
                            s < 0 && (s = "0.00"), a ? $("#cf_profit").html(s) : (setBetText(gBtT("pegar") + '<br><span id="cf_profit">' + s + '</span>&nbsp;<i class="fad fa-coins"></i>'), $("#cf_profit").toggleClass("bet_profit-error", parseFloat(s) <= 0), a = !0)
                        }
                    }, 600)
                })
            }, window.take = function () {
                null != e && !0 !== t && $.get("/game/hilo/take/" + e.id, function (e) {
                    var t = JSON.parse(e);
                    const a = new XMLHttpRequest,
                        s = $("meta[name=csrf-token]").attr("content"),
                        n = {
                            winnings: t.profit,
                            game_id: 9,
                            ghid: c
                        };
                    a.open("PUT", "/api/balance/add"), a.setRequestHeader("Content-Type", "application/json"), a.setRequestHeader("X-CSRF-TOKEN", s), a.setRequestHeader("Authorization", "Bearer " + s), a.onload = (() => {
                        if (a.status >= 200 && a.status < 300) {
                            const e = JSON.parse(a.responseText);
                            if (200 === e.status) {
                                execTake(t), uapts(1), $("#money").html(e.new_balance), $("#money").attr("data-current-balance", e.new_balance), $("#money_update").html("+$" + parseFloat(t.profit).toFixed(2)), $("#div_money_update").css("display", "block"), $("#money_update").css("color", "yellow");
                                let a = setInterval(function () {
                                    this.div_money_update.style.display = "none", clearInterval(a)
                                }, 3e3)
                            }
                        } else 419 == a.status ? $("#modal_please_login").addClass("md-show") : console.log(new Error(a.statusText))
                    }), a.send(JSON.stringify(n))
                })
            }, window.calculateProbability = function (e) {
                var t = deck[e].slot / 14 * 100,
                    a = splitDecimal(t),
                    s = splitDecimal(100 - t),
                    n = function (t) {
                        return t ? 12.35 / deck[e].slot : 12.35 / (13 - (deck[e].slot - 1))
                    },
                    r = n(!0),
                    i = n(!1),
                    o = splitDecimal(r),
                    l = splitDecimal(i);
                $("#chance-h_ma").animateNumber({
                    number: s[0]
                }), $("#chance-h_mi").animateNumber({
                    number: s[1]
                }), $("#chance-l_ma").animateNumber({
                    number: a[0]
                }), $("#chance-l_mi").animateNumber({
                    number: a[1]
                }), $("#mul-h_ma").animateNumber({
                    number: l[0]
                }), $("#mul-h_mi").animateNumber({
                    number: l[1]
                }), $("#mul-l_ma").animateNumber({
                    number: o[0]
                }), $("#mul-l_mi").animateNumber({
                    number: o[1]
                })
            }, window.clear = function () {
                e = null, t = !1, a = !1, _disableDemo = !1, $(".hilo-replace").fadeIn("fast"), setBetText(gBtT("jogar")), $("#play").attr("onclick", "hilo()"), $(".hilo-select").fadeOut("fast"), $("#games").animateNumber({
                    number: 0
                }), $("#mul").animateNumber({
                    number: 0
                }), $("#mul_m").animateNumber({
                    number: 0
                }), $("#chance-h_ma").animateNumber({
                    number: 0
                }), $("#chance-h_mi").animateNumber({
                    number: 0
                }), $("#chance-l_ma").animateNumber({
                    number: 0
                }), $("#chance-l_mi").animateNumber({
                    number: 0
                }), $("#mul-h_ma").animateNumber({
                    number: 0
                }), $("#mul-h_mi").animateNumber({
                    number: 0
                }), $("#mul-l_ma").animateNumber({
                    number: 0
                }), $("#mul_l-mi").animateNumber({
                    number: 0
                })
            }, window.addToHistory = function (e) {
                var t = "hearts" === e.type || "diamonds" === e.type,
                    a = $('<div class="card_history ' + (t ? "card_history_red" : "card_history_black") + '"><div>' + e.value + '</div><i class="' + deck.toIcon(e) + '"></i></div>').hide();
                $(".cf_history").prepend(a), a.fadeIn("fast")
            }, window.setCard = function (e) {
                void 0 === e && (e = deck[1]), $(".hilo-card-value").fadeOut("fast", function () {
                    $(this).html(e.value), $(this).fadeIn("fast")
                }), $("#card_icon").fadeOut("fast", function () {
                    $("#card_icon").attr("class", deck.toIcon(e)), $("#card_icon").fadeIn("fast");
                    var t = "hearts" === e.type || "diamonds" === e.type;
                    $(".hilo_card").toggleClass("card_history_red", t), $(".hilo_card").toggleClass("card_history_black", !t)
                }), addToHistory(e), $("#higher").fadeOut("fast", function () {
                    var e = s % 13 + 1 == 1;
                    $("#higher").html(e ? HLgBtT(2) : HLgBtT(0)), $("#higher").fadeIn("fast")
                }), $("#lower").fadeOut("fast", function () {
                    var e = s % 13 + 1 == 2;
                    $("#lower").html(e ? HLgBtT(2) : HLgBtT(1)), $("#lower").fadeIn("fast")
                })
            }, window.clearHistory = function () {
                $.each($(".cf_history .card_history"), function (e, t) {
                    $(t).fadeOut("fast", function () {
                        $(t).remove()
                    })
                })
            }, window.replace = function () {
                null == e && ($(".cf_status").fadeOut("fast"), clearInterval(r), clearHistory(), function e() {
                    var t = Math.floor(Math.random() * (Object.keys(deck).length - 1)) + 1,
                        a = deck[t];
                    void 0 !== a && 1 !== a.slot && 13 !== a.slot ? (s = t, setCard(a)) : e()
                }())
            }, window.execTake = function (t) {
                if (null != t.error) return -1 === t.error && iziToast.error({
                    message: "Требуется авторизация.",
                    icon: "fa fa-times"
                }), 0 === t.error && console.log("Server cancelled input"), void(1 === t.error && iziToast.error({
                    message: "Игра не найдена.",
                    icon: "fa fa-times"
                }));
                isDemo || sendDrop(e.id), validateTask(e.id), isDemo && isGuest() && showDemoTooltip(), clear(), updateBalanceN(), clearHistory(), parseFloat(t.profit) > 0 && ($("#cf_status_text").html("Você ganhou!! <br> <span class='hilo__value--rs'>R$ <span class='color-yellow' style='color: #ffd534;'>" + parseFloat(t.profit).toFixed(2) + '&nbsp;<i class="fad fa-coins" style="color: #ffd534;"></i></span>   </span>'), $(".cf_status").toggleClass("hilo__win", !0).toggleClass("hilo__lose", !1), $(".ribbon-wide").toggleClass("win-ribbon", !0).toggleClass("lose-ribbon", !1), $(".cf_status").fadeIn("fast"), r = setInterval(() => {
                    $(".cf_status").fadeOut(200), clearInterval(r)
                }, 3e3)), winAudio.src = isAudioGame ? "/assets/media/win.mp3" : "", d && winAudio.play(), $('.btn_outcome').click(),  dbBtn(!0)
            }, window.uapts = function (e) {
                o.push("x" + parseFloat(l).toFixed(2)), o.push(n);
                var t = o;
                i.length > 21 && (i.shift(), $(".bet_jogadores").children().last().remove()), i.push(t), localStorage.setItem("hlo_res", JSON.stringify(i));
                var a = document.createElement("div");
                a.classList.add("my-2"), a.classList.add("d-flex"), a.classList.add("justify-content-between"), a.classList.add("align-items-center");
                var s = document.createElement("div");
                s.className = "crash__player--username", s.textContent = t[0], a.appendChild(s);
                var r = document.createElement("div");
                r.classList.add("crash__player--multiplier"), r.textContent = t[1], a.appendChild(r);
                var d = document.createElement("div");
                d.classList.add("crash__player--bet");
                var c = document.createElement("span");
                c.textContent = "R$", c.classList.add("crash__player__bet--rs");
                var u = document.createElement("span");
                u.textContent = t[2], u.classList.add("crash__player__bet--value"), 1 == e ? u.classList.add("game__color--win") : u.classList.add("game__color--lose"), d.appendChild(c), d.appendChild(u), a.appendChild(d), $(".bet_jogadores").prepend(a), o = [], l = 0
            }, window.ggapts = function () {
                if (null == localStorage.getItem("hlo_res"))
                    for (let l = 1; l <= 22; l++) {
                        var e = gApsts();
                        i.push(e), localStorage.setItem("hlo_res", JSON.stringify(i));
                        var t = document.createElement("div");
                        const l = "d-flex",
                            d = "justify-content-between",
                            c = "align-items-center",
                            u = "my-2";
                        t.classList.add(u), t.classList.add(l), t.classList.add(d), t.classList.add(c);
                        var a = document.createElement("div");
                        a.className = "crash__player--username", a.textContent = e[0], t.appendChild(a);
                        var s = document.createElement("div");
                        s.classList.add("crash__player--multiplier"), s.textContent = "x" + parseFloat(e[1]).toFixed(2), t.appendChild(s);
                        var n = document.createElement("div");
                        n.classList.add("crash__player--bet");
                        var r = document.createElement("span");
                        r.textContent = "R$", r.classList.add("crash__player__bet--rs");
                        var o = document.createElement("span");
                        o.textContent = e[2], o.classList.add("crash__player__bet--value"), 0 == e[1] ? o.classList.add("game__color--lose") : 1 == mkRdI(0, 1) ? o.classList.add("game__color--win") : o.classList.add("game__color--lose"), n.appendChild(r), n.appendChild(o), t.appendChild(n), $(".bet_jogadores").prepend(t)
                    } else {
                        JSON.parse(localStorage.getItem("hlo_res")).forEach(e => {
                            i.push(e), localStorage.setItem("hlo_res", JSON.stringify(i));
                            var t = document.createElement("div");
                            t.classList.add("my-2"), t.classList.add("d-flex"), t.classList.add("justify-content-between"), t.classList.add("align-items-center");
                            var a = document.createElement("div");
                            a.className = "crash__player--username", a.textContent = e[0], t.appendChild(a);
                            var s = document.createElement("div");
                            s.classList.add("crash__player--multiplier"), s.textContent = "x" + parseFloat(e[1]).toFixed(2), t.appendChild(s);
                            var n = document.createElement("div");
                            n.classList.add("crash__player--bet");
                            var r = document.createElement("span");
                            r.textContent = "R$", r.classList.add("crash__player__bet--rs");
                            var o = document.createElement("span");
                            o.textContent = e[2], o.classList.add("crash__player__bet--value"), 0 == e[1] ? o.classList.add("game__color--lose") : 1 == mkRdI(0, 1) ? o.classList.add("game__color--win") : o.classList.add("game__color--lose"), n.appendChild(r), n.appendChild(o), t.appendChild(n), $(".bet_jogadores").prepend(t)
                        })
                    }
            }, window.gapts = function () {
                var e = Math.floor(2e3 * Math.random()) + 1e3;
                setTimeout(function () {
                    var e = gApsts();
                    i.length > 21 && (i.shift(), $(".bet_jogadores").children().last().remove()), i.push(e), localStorage.setItem("hlo_res", JSON.stringify(i));
                    var t = document.createElement("div");
                    t.classList.add("my-2"), t.classList.add("d-flex"), t.classList.add("justify-content-between"), t.classList.add("align-items-center");
                    var a = document.createElement("div");
                    a.className = "crash__player--username", a.textContent = e[0], t.appendChild(a);
                    var s = document.createElement("div");
                    s.classList.add("crash__player--multiplier"), s.textContent = "x" + parseFloat(e[1]).toFixed(2), t.appendChild(s);
                    var n = document.createElement("div");
                    n.classList.add("crash__player--bet");
                    var r = document.createElement("span");
                    r.textContent = "R$", r.classList.add("crash__player__bet--rs");
                    var o = document.createElement("span");
                    o.textContent = e[2], o.classList.add("crash__player__bet--value"), 0 == e[1] ? o.classList.add("game__color--lose") : 1 == mkRdI(0, 1) ? o.classList.add("game__color--win") : o.classList.add("game__color--lose"), n.appendChild(r), n.appendChild(o), t.appendChild(n), $(".bet_jogadores").prepend(t), gapts()
                }, e)
            }, window.gApsts = function () {
                var e = "";
                e += "User", e += mkId(4), e += "...";
                var t = "";
                if (0 == mkRdI(0, 9)) t += 0;
                else {
                    const e = mkRdI(1, 2);
                    for (let a = 1; a <= e; a++) t += 1 == a ? mkRdI(1, 9) : mkRdI(0, 9);
                    t += "." + mkRdI(0, 9) + 0
                }
                var a = "";
                return 0 == (a += mkRdI(0, 9)) ? a = mkRdI(1, 9) : a += mkRdI(0, 9), [e, t, parseFloat(a).toFixed(2)]
            }, window.mkRdI = function (e, t) {
                return e = Math.ceil(e), t = Math.floor(t), Math.floor(Math.random() * (t - e + 1)) + e
            }, window.mkId = function (e) {
                for (var t = "", a = "0123456789a0123456789b0123456789c0123456789d0123456789e0123456789f0123456789g0123456789h0123456789i0123456789j0123456789kl0123456789m0123456789n0123456789o0123456789p0123456789q0123456789r0123456789s0123456789t0123456789u0123456789v0123456789w0123456789x0123456789y0123456789z0123456789", s = 0; s < e;) t += s > 1 ? a.charAt(Math.floor(Math.random() * a.length)) : "0123456789".charAt(Math.floor(Math.random() * "0123456789".length)), s += 1;
                return t
            }, ggapts(), gapts(), clear(), replace(), window.checkSound = function () {
                d = "on" == $("#hilo_music").attr("data-music")
            }, $("#hilo_music").on("click", function () {
                "on" == $("#hilo_music").attr("data-music") ? (d = !1, $("#hilo_music").attr("data-music", "off")) : (d = !0, $("#hilo_music").attr("data-music", "on"))
            }), window.dbBtn = function (e) {
                $(".hilo__low").toggleClass("hilo_disabled", e), $(".hilo__high").toggleClass("hilo_disabled", e)
            }
        })
    }
});
var __profit = function () {};
