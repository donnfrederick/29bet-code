! function (e) {
    var a = {};

    function t(s) {
        if (a[s]) return a[s].exports;
        var n = a[s] = {
            i: s,
            l: !1,
            exports: {}
        };
        return e[s].call(n.exports, n, n.exports, t), n.l = !0, n.exports
    }
    t.m = e, t.c = a, t.d = function (e, a, s) {
        t.o(e, a) || Object.defineProperty(e, a, {
            enumerable: !0,
            get: s
        })
    }, t.r = function (e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }, t.t = function (e, a) {
        if (1 & a && (e = t(e)), 8 & a) return e;
        if (4 & a && "object" == typeof e && e && e.__esModule) return e;
        var s = Object.create(null);
        if (t.r(s), Object.defineProperty(s, "default", {
                enumerable: !0,
                value: e
            }), 2 & a && "string" != typeof e)
            for (var n in e) t.d(s, n, function (a) {
                return e[a]
            }.bind(null, n));
        return s
    }, t.n = function (e) {
        var a = e && e.__esModule ? function () {
            return e.default
        } : function () {
            return e
        };
        return t.d(a, "a", a), a
    }, t.o = function (e, a) {
        return Object.prototype.hasOwnProperty.call(e, a)
    }, t.p = "/", t(t.s = 10)
}({
    10: function (e, a, t) {
        e.exports = t("tnDT")
    },
    tnDT: function (e, a) {
        $.on("/blackjack", function () {
            var e, a, t = 0,
                s = [],
                n = [],
                i = [],
                d = 0,
                l = !0,
                o = !1,
                r = !1,
                c = 0,
                u = new function () {
                    this.newGame = function () {
                        if (!($("#bet").val() >= 1)) return iziToast.info({
                            message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                            icon: "fa fa-info"
                        }), setTimeout(function () {
                            clicked = !1
                        }, 100); {
                            t = $("#bet").val();
                            const n = new XMLHttpRequest,
                                d = $("meta[name=csrf-token]").attr("content"),
                                o = {
                                    bet: t,
                                    game_id: 10
                                };
                            n.open("POST", "/api/blackjack/init"), n.setRequestHeader("Content-Type", "application/json"), n.setRequestHeader("X-CSRF-TOKEN", d), n.setRequestHeader("Authorization", "Bearer " + d), n.onload = (() => {
                                if (n.status >= 200 && n.status < 300) {
                                    const d = JSON.parse(n.responseText);
                                    if (200 === d.status) {
                                        r = !0, d.new_balance;
                                        const n = JSON.parse(d.game);
                                        if (s = n, d.decks, i.push("User" + d.uid + "..."), c = d.ghid, $("#money").attr("data-current-balance", d.new_balance), $("#money_update").html("-$" + parseFloat(t).toFixed(2)), $("#div_money_update").css("display", "block"), $("#money_update").css("color", "red"), setTimeout(function () {
                                                $("#money").html(d.new_balance), $("#div_money_update").css("display", "none"), $(".lessmoney__gif").fadeIn(200), $("#money_gif__lose").attr("src", "https://cdn.29bet.com/assets/img/all/icons/coin-gif.gif"),  setTimeout(() => {
                                                    $(".lessmoney__gif").fadeOut(0), $("#money_gif__lose").attr("src", "")
                                                }, 1300)
                                            }, 3e3), a = n.id, null != n.error) return "$" === n.error && load("/"), -1 === n.error && $("#b_si").click(), 1 === n.error && iziToast.error({
                                            message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                                            icon: "fa fa-times"
                                        }), void(2 === n.error && $("#_payin").click());
                                        betAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/bet.mp3" : "", l && betAudio.play(), _disableDemo = !0, updateBalanceN(), resetBoard(), e = new function () {
                                            this.setCard = function (e, a) {
                                                e.setHand(a)
                                            }, this.dealCard = function (a, t, s) {
                                                var n = a,
                                                    i = a.getElements(),
                                                    d = i.score,
                                                    l = i.ele,
                                                    o = m.getHand();
                                                e.setCard(n, t), renderCard(l, n, !1, s), n.getScore(".dealer" === d ? "dealer" : "player", function (e) {
                                                    $(d).html(e)
                                                }), p.getHand().length < 3 && (o.length > 0 && "A" === o[0].rank && setActions("insurance"), p.getScore("player", function (e) {
                                                    if (21 === e) {
                                                        if (dCtrl(!0), _) return;
                                                        _ = !0;
                                                        let e = setInterval(function () {
                                                            p.stand(), clearInterval(e)
                                                        }, 2500)
                                                    } else o.length > 1 && setActions("run")
                                                }))
                                            }
                                        }, f = !0, _ = !1, p.resetHand(), m.resetHand(), setTimeout(function () {
                                            e.dealCard(p, {
                                                index: n.player[0].index,
                                                rank: n.player[0].value,
                                                suit: n.player[0].type,
                                                value: n.player[0].blackjack_value,
                                                type: "up"
                                            }), setTimeout(function () {
                                                e.dealCard(m, {
                                                    index: n.dealer.index,
                                                    rank: n.dealer.value,
                                                    suit: n.dealer.type,
                                                    value: n.dealer.blackjack_value,
                                                    type: "up"
                                                }), setTimeout(function () {
                                                    e.dealCard(p, {
                                                        index: n.player[1].index,
                                                        rank: n.player[1].value,
                                                        suit: n.player[1].type,
                                                        value: n.dealer.blackjack_value,
                                                        type: "up"
                                                    }), setTimeout(function () {
                                                        e.dealCard(m, {
                                                            index: 1,
                                                            rank: "",
                                                            suit: "",
                                                            value: 0,
                                                            type: "down"
                                                        }, !0), f && $("#blackjack_controls").fadeIn("fast"), slideAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/slide.mp3" : "", l && slideAudio.play()
                                                    }, 500), slideAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/slide.mp3" : "", l && slideAudio.play()
                                                }, 500), slideAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/slide.mp3" : "", l && slideAudio.play()
                                            }, 500), slideAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/slide.mp3" : "", l && slideAudio.play()
                                        }, 500)
                                    } else t = 0, 0, $("#_payin").click()
                                } else 419 == n.status ? $("#modal_please_login").addClass("md-show") : console.log(new Error(n.statusText))
                            }), n.send(JSON.stringify(o))
                        }
                    }
                },
                p = new y,
                m = new y,
                f = !1,
                _ = !1,
                h = 1,
                g = 0,
                b = null;

            function y() {
                var e = [],
                    a = "",
                    t = "";
                this.getElements = function () {
                    return this === p ? (a = "#phand", t = ".player") : (a = "#dhand", t = ".dealer"), {
                        ele: a,
                        score: t
                    }
                }, this.getHand = function () {
                    return e
                }, this.setHand = function (a) {
                    e.push(a)
                }, this.resetHand = function () {
                    e = []
                }, this.flipCards = function (e) {
                    $(".down").each(function () {
                        $(this).removeClass("down").addClass("up"), renderCard(!1, !1, $(this), !1, e)
                    }), m.getScore("dealer", function (e) {
                        $(".dealer").html(e)
                    })
                }
            }
            betAudio = new Audio, winAudio = new Audio, clickAudio = new Audio, slideAudio = new Audio, gameAudio = new Audio, loseAudio = new Audio, y.prototype.hit = function (t) {
                $.get("/game/blackjack/hit/" + a, function (a) {
                    var n = JSON.parse(a);
                    h = 0, $("#double").toggleClass("bb_disabled", !0), s.player.push(n.player), e.dealCard(p, {
                        index: n.player.index,
                        rank: n.player.value,
                        suit: n.player.type,
                        value: n.player.blackjack_value,
                        type: "up"
                    }), p.getScore("player", function (e) {
                        t || e > 21 ? (f = !1, clickAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/click.mp3" : "", l && clickAudio.play(), setTimeout(function () {
                            p.stand()
                        }, 500)) : p.getHand(), setActions(), slideAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/slide.mp3" : "", l && slideAudio.play(), p.updateBoard()
                    })
                })
            }, y.prototype.stand = function () {
                g = 0, dCtrl(!0), f = !1, setActions(), $.get("/game/blackjack/stand/" + a, function (t) {
                    var s = JSON.parse(t),
                        n = JSON.parse(s.status);
                    showAlert("error" === n.type, n.header, n.message, n), isDemo || sendDrop(a), _disableDemo = !1, clickAudio.src = isAudioGame ? "/assets/media/click.mp3" : "", l && clickAudio.play(), m.flipCards({
                        rank: s.dealerReveal.value,
                        suit: '<i class="' + deck.toIcon(deck[s.dealerReveal.index]) + '"></i>',
                        value: s.dealerReveal.blackjack_value,
                        dealerScore: s.dealerScore
                    });
                    for (var i = 0; i < s.dealerDraw.length; i++) e.dealCard(m, {
                        index: s.dealerDraw[i].index,
                        rank: s.dealerDraw[i].value,
                        suit: s.dealerDraw[i].type,
                        value: s.dealerDraw[i].blackjack_value,
                        type: "up"
                    });
                    m.updateBoard(), updateBalanceN()
                })
            }, y.prototype.dbl = function () {
                1 == h && 1 == g && (p.hit(!0), updateBalanceN(), _disableDemo = !1)
            }, y.prototype.insure = function () {
                o = !1;
                const e = ["You bought insurance", "Você comprou seguro", "你买了保险"];
                let a;
                a = "en" == $("#frm_brand").val() ? e[0] : "pt" == $("#frm_brand").val() ? e[1] : e[2], $(".insurance").fadeOut("fast"), clickAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/click.mp3" : "", l && clickAudio.play(), iziToast.success({
                    message: a,
                    icon: "fas fa-info-circle",
                    position: "bottomCenter"
                }), updateBalanceN()
            }, y.prototype.getScore = function (e, a) {
                let t = 0,
                    n = 0;
                "player" == e ? s.player.forEach(e => {
                    t += e.blackjack_value, 11 == e.blackjack_value && (n += 1), t > 21 && n > 0 && (t -= 10, n--)
                }) : dealer.length > 1 ? s.dealer.forEach(e => {
                    t += e.blackjack_value, 11 == e.blackjack_value && (n += 1), t > 21 && n > 0 && (t -= 10, n--)
                }) : t += s.dealer.blackjack_value, a(t)
            }, y.prototype.updateBoard = function () {
                var e = ".dealer";
                this === p && (e = ".player"), this.getScore(".dealer" === e ? "dealer" : "player", function (a) {
                    $(e).html(a)
                })
            }, window.showAlert = function (e, a, s, n) {
                if (!e && (winAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/win.mp3" : "", l && winAudio.play()), e && (loseAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/lose.mp3" : "", l && loseAudio.play()),  $(".wheel_game_result").toggleClass("wg_lose", e), $(".wheel_game_result").toggleClass("3000", !e), $(".mul").html(a), $(".te").html(s), $(".wheel_game_result").fadeIn("fast"), b = setInterval(() => {
                        $(".wheel_game_result").fadeOut("fast"), clearInterval(b)
                    },
                    // lose outcome section
                    3e3), dCtrl(!0), e) $(".wheel_game_result").addClass("blackjack__lose"), $('.btn_outcome_lose').click(), uapts(0);
                else {
                    const e = new XMLHttpRequest,
                        a = $("meta[name=csrf-token]").attr("content");
                        // win outcome section
                    1 == n.diff ? ($(".wheel_game_result").addClass("blackjack__tie"), winnings = t) : ($(".wheel_game_result").addClass("blackjack__win"),$('.btn_outcome').click(), 2 == n.diff ? winnings = 3 * t : winnings = 2 * t);
                    const s = {
                        winnings: winnings,
                        game_id: 10,
                        ghid: c
                    };
                    e.open("PUT", "/api/balance/add"), e.setRequestHeader("Content-Type", "application/json"), e.setRequestHeader("X-CSRF-TOKEN", a), e.setRequestHeader("Authorization", "Bearer " + a), e.onload = (() => {
                        if (e.status >= 200 && e.status < 300) {
                            const a = JSON.parse(e.responseText);
                            200 === a.status && (uapts(1), $("#money").attr("data-current-balance", a.new_balance), $("#money_update").html("+$" + parseFloat(s.winnings).toFixed(2)), $("#div_money_update").css("display", "block"), $("#money_update").css("color", "yellow"), setTimeout(function () {
                                $("#div_money_update").css("display", "none"), $(".moremoney__gif").fadeIn(200), $("#money_gif__gain").attr("src", "https://cdn.29bet.com/assets/img/all/icons/coin-gif.gif"), setTimeout(() => {
                                    $("#money").html(a.new_balance), $(".moremoney__gif").fadeOut(0), $("#money_gif__gain").attr("src", "")
                                }, 1300)
                            }, 3e3))
                        } else 419 == e.status ? $("#modal_please_login").addClass("md-show") : console.log(new Error(e.statusText))
                    }), e.send(JSON.stringify(s))
                }
            },
            // wind section for stop btn
            window.hideAlert = function () {
                $(".wheel_game_result").removeClass("blackjack__win"),  $(".wheel_game_result").removeClass("blackjack__lose"), $(".wheel_game_result").removeClass("blackjack__tie"), $(".wheel_game_result").fadeOut("fast"), clearInterval(b)
            }, window.setActions = function (e) {
                var a = p.getHand();
                let t = 0;
                f || ($("#play").attr("disabled", !1), $("#blackjack_controls").fadeOut("fast"), $("#split").toggleClass("bb_disabled", !0), $(".insurance").fadeOut("fast")), "run" !== e && ("split" === e ? $("#split").toggleClass("bb_disabled", !1) : a.length > 2 && ($("#split").toggleClass("bb_disabled", !0), $(".insurance").fadeOut("fast"))), a.length > 1 && "insurance" == e ? p.getScore("player", function (e) {
                    21 != e && (o = !0, $(".insurance").fadeIn("fast"))
                }) : p.getScore("player", function (e) {
                    t = e
                }), 1 == r && (21 != t && (dCtrl(!1), h = 1, g = 1), r = !1)
            }, window.renderCard = function (e, a, t, s, n) {
                var i, d, l;
                const o = window.innerWidth;
                console.log(o), l = new function (e) {
                    this.getIndex = function () {
                        return e.index
                    }, this.getType = function () {
                        return e.type
                    }, this.getRank = function () {
                        return e.rank
                    }, this.getSuit = function () {
                        return e.suit
                    }, this.getValue = function () {
                        var e = this.getRank();
                        return "A" === e ? 11 : "K" === e || "Q" === e || "J" === e ? 10 : parseInt(e, 0)
                    }
                }(t ? (i = m.getHand())[1] : (i = a.getHand())[d = i.length - 1]), void 0 !== n && (l.rank = n.rank, l.suit = n.suit, l.value = n.value);
                var r = l.getRank(),
                    c = l.getSuit(),
                    u = "red",
                    f = 350,
                    _ = o <= 590 ? 85 : 20,
                    h = 200,
                    g = e + " .card-" + d,
                    b = l.getType();
                d > 0 && (f -= 50 * d), t ? g = t : ($(e).append('<div class="' + (void 0 !== s && !0 === s ? "dealerSecret " : "") + "blackjack_card card-" + d + " " + b + '"><span class="pos-0"><span class="rank">&nbsp;</span><span class="suit">&nbsp;</span></span></div>'), "#phand" === e ? (_ = o <= 590 ? 235 : 340, h = 500, $(e + " div.card-" + d).attr("id", "pcard-" + d), i.length < 2 && setTimeout(function () {
                    p.getScore("player", function (e) {
                        $(".player").html(e).fadeIn("fast")
                    })
                }, 500)) : ($(e + " div.card-" + d).attr("id", "dcard-" + d), i.length < 2 && setTimeout(function () {
                    m.getScore("dealer", function (e) {
                        $(".dealer").html(e).fadeIn("fast")
                    })
                }, 100)), $(e + " .card-" + d).css("z-index", d), $(e + " .card-" + d).animate({
                    top: _,
                    right: f
                }, h), $(e).queue(function () {
                    $(this).animate({
                        left: "-=25.5px"
                    }, 100), $(this).dequeue()
                })), ("up" === b || t) && ("hearts" !== c && "diamonds" !== c && (u = "black"), $(g).find('span[class*="pos"]').addClass("card_history_" + u), void 0 === n ? $(g).find("span.rank").html(r) : ($(".dealerSecret span.rank").html(n.rank), setTimeout(function () {
                    $(".dealer").html(n.dealerScore)
                }, 50)), $(g).find("span.suit").html('<i class="' + deck.toIcon(deck[l.getIndex()]) + '"></i>'))
            }, window.resetBoard = function () {
                $("#dhand").html(""), $("#phand").html(""), $("#phand, #dhand").css("left", 0), $(".dealer").fadeOut("fast"), $(".player").fadeOut("fast"), $(".insurance").fadeOut("fast")
            }, window.uapts = function (e) {
                i.push(parseFloat(t).toFixed(2));
                var a = i;
                n.length > 8 && (n.shift(), $(".bet_jogadores").children().last().remove()), n.push(a), localStorage.setItem("bjk_res", JSON.stringify(n));
                var s = document.createElement("div");
                s.classList.add("my-2"), s.classList.add("d-flex"), s.classList.add("justify-content-around"), s.classList.add("align-items-center");
                var d = document.createElement("div");
                d.className = "crash__player--username", d.textContent = a[0], s.appendChild(d);
                var l = document.createElement("div");
                l.classList.add("crash__player--bet");
                var o = document.createElement("span");
                o.textContent = "R$", o.classList.add("crash__player__bet--rs");
                var r = document.createElement("span");
                r.textContent = a[1], r.classList.add("crash__player__bet--value"), 1 == e ? r.classList.add("game__color--win") : r.classList.add("game__color--lose"), l.appendChild(o), l.appendChild(r), s.appendChild(l), $(".bet_jogadores").prepend(s), i = []
            }, window.ggapts = function () {
                if (null == localStorage.getItem("bjk_res"))
                    for (let l = 1; l <= 8; l++) {
                        var e = gApsts();
                        n.push(e), localStorage.setItem("bjk_res", JSON.stringify(n));
                        var a = document.createElement("div");
                        const l = "d-flex",
                            o = "justify-content-around",
                            r = "align-items-center",
                            c = "my-2";
                        a.classList.add(c), a.classList.add(l), a.classList.add(o), a.classList.add(r);
                        var t = document.createElement("div");
                        t.className = "crash__player--username", t.textContent = e[0], a.appendChild(t);
                        var s = document.createElement("div");
                        s.classList.add("crash__player--bet");
                        var i = document.createElement("span");
                        i.textContent = "R$", i.classList.add("crash__player__bet--rs");
                        var d = document.createElement("span");
                        d.textContent = e[2], d.classList.add("crash__player__bet--value"), 1 == mkRdI(0, 1) ? d.classList.add("game__color--win") : d.classList.add("game__color--lose"), s.appendChild(i), s.appendChild(d), a.appendChild(s), $(".bet_jogadores").prepend(a)
                    } else {
                        JSON.parse(localStorage.getItem("bjk_res")).forEach(e => {
                            n.push(e), localStorage.setItem("bjk_res", JSON.stringify(n));
                            var a = document.createElement("div");
                            a.classList.add("my-2"), a.classList.add("d-flex"), a.classList.add("justify-content-around"), a.classList.add("align-items-center");
                            var t = document.createElement("div");
                            t.className = "crash__player--username", t.textContent = e[0], a.appendChild(t);
                            var s = document.createElement("div");
                            s.classList.add("crash__player--bet");
                            var i = document.createElement("span");
                            i.textContent = "R$", i.classList.add("crash__player__bet--rs");
                            var d = document.createElement("span");
                            d.textContent = e[2], d.classList.add("crash__player__bet--value"), 1 == mkRdI(0, 1) ? d.classList.add("game__color--win") : d.classList.add("game__color--lose"), s.appendChild(i), s.appendChild(d), a.appendChild(s), $(".bet_jogadores").prepend(a)
                        })
                    }
            }, window.gapts = function () {
                var e = Math.floor(2e3 * Math.random()) + 1e3;
                setTimeout(function () {
                    var e = gApsts();
                    n.length > 8 && (n.shift(), $(".bet_jogadores").children().last().remove()), n.push(e), localStorage.setItem("bjk_res", JSON.stringify(n));
                    var a = document.createElement("div");
                    a.classList.add("my-2"), a.classList.add("d-flex"), a.classList.add("justify-content-around"), a.classList.add("align-items-center");
                    var t = document.createElement("div");
                    t.className = "crash__player--username", t.textContent = e[0], a.appendChild(t);
                    var s = document.createElement("div");
                    s.classList.add("crash__player--bet");
                    var i = document.createElement("span");
                    i.textContent = "R$", i.classList.add("crash__player__bet--rs");
                    var d = document.createElement("span");
                    d.textContent = e[2], d.classList.add("crash__player__bet--value"), 1 == mkRdI(0, 1) ? d.classList.add("game__color--win") : d.classList.add("game__color--lose"), s.appendChild(i), s.appendChild(d), a.appendChild(s), $(".bet_jogadores").prepend(a), gapts()
                }, e)
            }, window.gApsts = function () {
                var e = "";
                e += "User", e += mkId(4), e += "...";
                var a = "";
                return 0 == (a += mkRdI(0, 9)) ? a = mkRdI(1, 9) : a += mkRdI(0, 9), [e, 0, parseFloat(a).toFixed(2)]
            }, window.mkRdI = function (e, a) {
                return e = Math.ceil(e), a = Math.floor(a), Math.floor(Math.random() * (a - e + 1)) + e
            }, window.mkId = function (e) {
                for (var a = "", t = "0123456789a0123456789b0123456789c0123456789d0123456789e0123456789f0123456789g0123456789h0123456789i0123456789j0123456789kl0123456789m0123456789n0123456789o0123456789p0123456789q0123456789r0123456789s0123456789t0123456789u0123456789v0123456789w0123456789x0123456789y0123456789z0123456789", s = 0; s < e;) a += s > 1 ? t.charAt(Math.floor(Math.random() * t.length)) : "0123456789".charAt(Math.floor(Math.random() * "0123456789".length)), s += 1;
                return a
            }, window.dCtrl = function (e) {
                $("#hit").toggleClass("bb_disabled", e), $("#stand").toggleClass("bb_disabled", e), $("#double").toggleClass("bb_disabled", e)
            }, ggapts(), gapts(), $("#play").on("click", function () {
                $("#play").attr("disabled", !0), f || (hideAlert(), u.newGame())
            }), $("#hit").on("click", function () {
                $("#hit").hasClass("bb_disabled") || 1 !== g || 1 != !d || (p.hit(), d = !0, setTimeout(() => {
                    d = !1
                }, 1e3))
            }), $("#stand").on("click", function () {
                $("#stand").hasClass("bb_disabled") || 1 !== g || ($(".insurance").fadeOut("fast"), p.stand())
            }), $("#double").on("click", function () {
                if (!$("#double").hasClass("bb_disabled") && 1 === h && 1 == g) {
                    $("#double").toggleClass("bb_disabled", !0);
                    const e = new XMLHttpRequest,
                        s = $("meta[name=csrf-token]").attr("content"),
                        n = {
                            bet: t,
                            game_id: 10,
                            session_id: a,
                            ghid: c
                        };
                    t *= 2, e.open("POST", "/api/blackjack/double"), e.setRequestHeader("Content-Type", "application/json"), e.setRequestHeader("X-CSRF-TOKEN", s), e.setRequestHeader("Authorization", "Bearer " + s), e.onload = (() => {
                        if (e.status >= 200 && e.status < 300) {
                            const a = JSON.parse(e.responseText);
                            if (200 !== a.status) return iziToast.info({
                                message: "Saldo insuficiente",
                                icon: "fa fa-info"
                            }), setTimeout(function () {
                                clicked = !1
                            }, 100); {
                                $("#money").html(a.new_balance), $("#money").attr("data-current-balance", a.new_balance), $("#money_update").html("-$" + parseFloat(t / 2).toFixed(2)), $("#div_money_update").css("display", "block"), $("#money_update").css("color", "red");
                                let e = setInterval(function () {
                                    this.div_money_update.style.display = "none", clearInterval(e)
                                }, 3e3);
                                p.dbl()
                            }
                        } else 419 == e.status ? $("#modal_please_login").addClass("md-show") : window.location.reload()
                    }), e.send(JSON.stringify(n))
                }
            }), $("#insurance_accept").on("click", function () {
                if (o) {
                    const e = new XMLHttpRequest,
                        s = $("meta[name=csrf-token]").attr("content"),
                        n = {
                            bet: t / 2,
                            game_id: 10,
                            session_id: a,
                            ghid: c
                        };
                    e.open("POST", "/api/blackjack/insure"), e.setRequestHeader("Content-Type", "application/json"), e.setRequestHeader("X-CSRF-TOKEN", s), e.setRequestHeader("Authorization", "Bearer " + s), e.onload = (() => {
                        if (e.status >= 200 && e.status < 300) {
                            const a = JSON.parse(e.responseText);
                            if (200 === a.status) {
                                $("#money").html(a.new_balance), $("#money").attr("data-current-balance", a.new_balance), $("#money_update").html("-$" + parseFloat(t / 2).toFixed(2)), $("#div_money_update").css("display", "block"), $("#money_update").css("color", "red");
                                let e = setInterval(function () {
                                    this.div_money_update.style.display = "none", clearInterval(e)
                                }, 3e3);
                                p.insure()
                            }
                        } else 419 == e.status ? $("#modal_please_login").addClass("md-show") : window.location.reload()
                    }), e.send(JSON.stringify(n))
                } else console.log("Subject for account disable")
            }), $("#insurance_cancel").on("click", function () {
                $(".insurance").fadeOut("fast"), clickAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/click.mp3" : "", l && clickAudio.play()
            }), window.checkSound = function () {
                l = "on" == $("#blackjack_music").attr("data-music")
            }, $("#blackjack_music").on("click", function () {
                "on" == $("#blackjack_music").attr("data-music") ? (l = !1, $("#blackjack_music").attr("data-music", "off")) : (l = !0, $("#blackjack_music").attr("data-music", "on"))
            })
        })
    }
});
var __profit = function () {};
