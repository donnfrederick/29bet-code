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
    }, a.p = "/", a(a.s = 6)
}({
    "08te": function (e, t) {
        $.on("/tower", function () {
            var e = 1,
                t = 0,
                a = !0,
                s = !1,
                n = !1,
                o = 0,
                r = [],
                i = [],
                d = 0,
                l = 0,
                c = 0;
            clI = null, cli = null, apArr = [], mulArr = [1.19, 1.48, 1.86, 2.32, 2.9, 3.62, 4.53, 5.66, 7.08, 8.85, 1.58, 2.64, 4.4, 7.33, 12.22, 20.36, 33.94, 56.56, 94.27, 157.11, 2.38, 5.94, 14.84, 37.11, 92.77, 231.93, 579.83, 1449.58, 4.75, 23, 118, 593], cg = 0, nb = e, ghid = 0, urs = [], isSoundOn = !0, betAudio = new Audio, minesAudio = new Audio, winAudio = new Audio, bombAudio = new Audio, window.row = function (e, t) {
                $("*[data-r]").toggleClass("mine_disabled", !0), $('*[data-r="' + e + '"]').toggleClass("mine_disabled", !1 === t).toggleClass("tower_active", !0 === t)
            }, window.tower = function () {
                if (!($("#bet").val() >= 1)) return iziToast.info({
                    message: iziGTr(3) + '&nbsp;<i class="fad fa-coins"></i>',
                    icon: "fa fa-info"
                }), setTimeout(function () {
                    clicked = !1
                }, 100); {
                    o = $("#bet").val();
                    const t = new XMLHttpRequest,
                        a = $("meta[name=csrf-token]").attr("content"),
                        s = {
                            bet: o,
                            game_id: 5,
                            mines: e
                        };
                    t.open("POST", "/api/tower/init"), t.setRequestHeader("Content-Type", "application/json"), t.setRequestHeader("X-CSRF-TOKEN", a), t.setRequestHeader("Authorization", "Bearer " + a), t.onload = (() => {
                        if (t.status >= 200 && t.status < 300) {
                            const e = JSON.parse(t.responseText);
                            200 === e.status ? (i = e.multiplier, e.new_balance, d = Number(e.c), cfI = Number(e.i), urs.push("User" + e.uid + "..."), ghid = e.ghid, $("#money").attr("data-current-balance", e.new_balance), $("#money_update").html("-$" + parseFloat(o).toFixed(2)), $("#div_money_update").css("display", "block"), $("#money_update").css("color", "red"), setTimeout(function () {
                                $("#money").html(e.new_balance), $("#div_money_update").css("display", "none"), $(".lessmoney__gif").fadeIn(200), $("#money_gif__lose").attr("src", "https://cdn.29bet.com/assets/img/all/icons/coin-gif.gif"), setTimeout(() => {
                                    $(".lessmoney__gif").fadeOut(0), $("#money_gif__lose").attr("src", "")
                                }, 1300)
                            }, 3e3), initExec()) : (o = 0, 0, $("#_payin").click())
                        } else 419 == t.status ? $("#modal_please_login").addClass("md-show") : window.location.reload()
                    }), t.send(JSON.stringify(s))
                }
            }, window.take = function () {
                if (1 == c) {
                    c = 0, $("#play").attr("disabled", !1);
                    const e = new XMLHttpRequest,
                        t = $("meta[name=csrf-token]").attr("content"),
                        a = {
                            winnings: l,
                            game_id: 5,
                            ghid: ghid
                        };
                    gBmR(nb - 1), e.open("PUT", "/api/balance/add"), e.setRequestHeader("Content-Type", "application/json"), e.setRequestHeader("X-CSRF-TOKEN", t), e.setRequestHeader("Authorization", "Bearer " + t), e.onload = (() => {
                        if (e.status >= 200 && e.status < 300) {
                            const t = JSON.parse(e.responseText);
                            200 === t.status && (execTake(), uapts(1), $("#money").attr("data-current-balance", t.new_balance), $("#money_update").html("+$" + parseFloat(l).toFixed(2)), $("#div_money_update").css("display", "block"), $("#money_update").css("color", "yellow"), setTimeout(function () {
                                $("#div_money_update").css("display", "none"), $(".moremoney__gif").fadeIn(200), $("#money_gif__gain").attr("src", "https://cdn.29bet.com/assets/img/all/icons/coin-gif.gif"), setTimeout(() => {
                                    $("#money").html(t.new_balance), $(".moremoney__gif").fadeOut(0), $("#money_gif__gain").attr("src", "")
                                }, 1300)
                            }, 3e3))
                        } else 419 == e.status ? $("#modal_please_login").addClass("md-show") : console.log(new Error(e.statusText))
                    }), e.send(JSON.stringify(a))
                }
            }, window.clear = function () {
                $("*[data-grid-id]").toggleClass("tower_active", !1).toggleClass("mine_disabled", !0), $("*[data-row-id]").toggleClass("tower_mul_active", !1), setBetText(gBtT("jogar")), $("#play").attr("onclick", "tower()"), null, s = !1, t = 0, _disableDemo = !1
            }, window.swap = function (e) {
                a = e, $("*[data-grid-id]").toggleClass("mine_disabled", e)
            }, window.clear_c = function () {
                $.get("/game/tower/mul/" + e, function (e) {
                    for (var t = JSON.parse(e), a = 0; a < Object.keys(t).length; a++) $('*[data-row-id="' + a + '"]').html("x" + t[a + 1])
                })
            }, window.displayGrid = function (e) {
                for (var t = Array.from(e), a = 0; a < 10; a++)
                    for (var s = 0; s < 5; s++) $('*[data-r="' + a + '"][data-grid-in-row-id="' + s + '"]').toggleClass("mine_disabled", !0).toggleClass(1 === t[a][s] ? "tower_bomb" : "tower_safe", !0)
            }, window.displayRow = function (e, t) {
                var a = Array.from(t);
                $.each($('*[data-r="' + e + '"]'), function (e, t) {
                    $(t).toggleClass(1 === a[e] ? "tower_bomb" : "tower_safe", !0).toggleClass("mine_disabled", !0)
                })
            }, clear_c(), $("*[data-bomb]").on("click", function (t) {
                a ? ($("*[data-bomb]").toggleClass("bc_active", !1), $(this).toggleClass("bc_active", !0), e = parseInt($(this).attr("data-bomb")), nb = e, clear_c()) : t.preventDefault()
            }), $("*[data-r]").on("click", function () {
                if (!($(this).hasClass("mine_disabled") || a || $(this).hasClass("tower_safe") || $(this).hasClass("tower_bomb"))) {
                    var e = parseInt($(this).attr("data-grid-in-row-id")),
                        n = $(this);
                    const a = Object.values(i);
                    if (row(t, !1), getFG(t, e), 0 == r[t][e]) {
                        r[t][e] = 2, gBm(nb - 1), c = 1, $("#play").attr("disabled", !1), displayRow(t, r[t]), n.toggleClass("tower_safe_picked", !0), minesAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/game.mp3" : "", isSoundOn && minesAudio.play();
                        var u = parseFloat(a[t] * o).toFixed(2);
                        l = u, s ? $("#cf_profit").html(u) : (setBetText(gBtT("pegar") + '<br><span id="cf_profit">' + u + '</span>&nbsp;<i class="fad fa-coins"></i>'), s = !0), setTimeout(function () {
                            $("#cf_profit").toggleClass("cf_profit-error", parseFloat(u) <= 0)
                        }, 200), 9 === t ? (t += 1, take()) : (t += 1, cg += 1, d += cfI, row(t, !0), $("*[data-row-id]").toggleClass("tower_mul_active", !1), $('*[data-row-id="' + t + '"]').toggleClass("tower_mul_active", !0))
                    } else c = 0, t += 1, gBmR(nb - 1), $(".outcome-window-lose").fadeIn(200), cli = setInterval(() => {
                        $(".outcome-window-lose").fadeOut(200), clearInterval(clI)
                    }, 3e3), n.toggleClass("mine_disabled", !0).toggleClass("tower_bomb", !0),
                    $('.btn_outcome_lose').click(),
                    bombAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/bomb.mp3" : "", isSoundOn && bombAudio.play(), setTimeout(function () {
                        swap(!0), uapts(0), clear(), displayGrid(r), $("#play").attr("disabled", !1)
                    }, 1e3)
                }
            }), window.gBmR = function (e) {
                for (let a = t; a <= 9; a++) gBm(e), t += 1
            }, window.initExec = function () {
                if (!1 !== n) return iziToast.info({
                    message: iziGTr(1),
                    icon: "fa fa-info"
                }), setTimeout(function () {
                    n = !1
                }, 100);
                if (o < 1) return iziToast.error({
                    message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                    icon: "fa fa-times"
                });
                if (e < 1 || e > 4) return iziToast.error({
                    message: iziGTr(3),
                    icon: "fa fa-times"
                });
                r = [];
                for (let e = 0; e <= 9; e++) {
                    let e = [];
                    for (let t = 0; t <= 4; t++) e.push(0);
                    r.push(shuffleArray(e))
                }
                n = !0, $("*[data-grid-id]").toggleClass("tower_active", !1).toggleClass("mine_disabled", !0).toggleClass("tower_bomb", !1).toggleClass("tower_safe", !1).toggleClass("tower_safe_picked", !1), clear(), $(".outcome-window").fadeOut(200), clearInterval(clI), $(".outcome-window-lose").fadeOut(200), clearInterval(cli), betAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/bet.mp3" : "", isSoundOn && betAudio.play(), $("#play").attr("disabled", !0).attr("onclick", "take()"), setTimeout(function () {
                    n = !1
                }, 350), swap(!1), 0, t = 0, _disableDemo = !0, row(0, !0), $('*[data-row-id="0"]').toggleClass("tower_mul_active", !0)
            }, window.gBm = function (e) {
                let a = 0,
                    s = [];
                r[t].forEach((e, t) => {
                    1 == e && (a += 1), 0 == e && s.push(t)
                }), r[t][s[mkRdI(0, s.length - 1)]] = 1, a < e && gBm(e)
            }, window.getFG = function (e, t) {
                return 1 == getDist() ? swFG(e, t) : r
            }, window.swFG = function (e, t) {
                return 0 == r[e][t] ? (r[e][t] = 1, 1 != nb && gBm(nb - 1), r) : r
            }, window.getDist = function () {
                const e = 100 - d;
                let t = [];
                for (let a = 1; a <= e; a++) t.push(0);
                for (let e = 1; e <= d; e++) t.push(1);
                return shuffleArray(t), t[Math.floor(99 * Math.random())]
            }, window.shuffleArray = function (e) {
                for (let t = e.length - 1; t > 0; t--) {
                    const a = Math.floor(Math.random() * (t + 1));
                    [e[t], e[a]] = [e[a], e[t]]
                }
                return e
            }, window.execTake = function () {
                const e = Object.values(i);
                winAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/win.mp3" : "", isSoundOn && winAudio.play(), setTimeout(function () {
                    n = !1
                }, 100), $(".outcome-window__coeff").text("x" + e[t]),
                $('.btn_outcome').click(),
                $(".outcome-window_won__sum").text(parseFloat(l).toFixed(2)), $(".outcome-window").fadeIn(200), clI = setInterval(() => {
                    $(".outcome-window").fadeOut(200), clearInterval(clI)
                }, 3e3), isDemo && isGuest() && showDemoTooltip(), swap(!0), clear(), updateBalanceN(), displayGrid(r)
            }, window.uapts = function (e) {
                const t = Object.values(i);
                0 == cg ? urs.push(parseFloat(t[cg]).toFixed(2)) : urs.push(parseFloat(t[cg - 1]).toFixed(2)), urs.push(o);
                var a = urs;
                apArr.length > 21 && (apArr.shift(), $(".bet_jogadores").children().last().remove()), apArr.push(a), localStorage.setItem("twr_res", JSON.stringify(apArr));
                var s = document.createElement("div");
                s.classList.add("my-2"), s.classList.add("d-flex"), s.classList.add("justify-content-between"), s.classList.add("align-items-center");
                var n = document.createElement("div");
                n.className = "crash__player--username", n.textContent = a[0], s.appendChild(n);
                var r = document.createElement("div");
                r.classList.add("crash__player--multiplier"), r.textContent = "x" + a[1], s.appendChild(r);
                var d = document.createElement("div");
                d.classList.add("crash__player--bet");
                var l = document.createElement("span");
                l.textContent = "R$", l.classList.add("crash__player__bet--rs");
                var c = document.createElement("span");
                c.textContent = a[2], c.classList.add("crash__player__bet--value"), 1 == e ? c.classList.add("game__color--win") : c.classList.add("game__color--lose"), d.appendChild(l), d.appendChild(c), s.appendChild(d), $(".bet_jogadores").prepend(s), cg = 0, urs = []
            }, window.ggapts = function () {
                if (null == localStorage.getItem("twr_res"))
                    for (let i = 1; i <= 22; i++) {
                        var e = gApsts();
                        apArr.push(e), localStorage.setItem("twr_res", JSON.stringify(apArr));
                        var t = document.createElement("div");
                        const i = "d-flex",
                            d = "justify-content-around",
                            l = "align-items-center";
                        t.classList.add(i), t.classList.add(d), t.classList.add(l);
                        var a = document.createElement("div");
                        a.className = "crash__player--username", a.textContent = e[0], t.appendChild(a);
                        var s = document.createElement("div");
                        s.classList.add("crash__player--multiplier"), s.textContent = "x" + e[1], t.appendChild(s);
                        var n = document.createElement("div");
                        n.classList.add("crash__player--bet");
                        var o = document.createElement("span");
                        o.textContent = "R$", o.classList.add("crash__player__bet--rs");
                        var r = document.createElement("span");
                        r.textContent = e[2], r.classList.add("crash__player__bet--value"), 1 == mkRdI(0, 1) ? r.classList.add("game__color--win") : r.classList.add("game__color--lose"), n.appendChild(o), n.appendChild(r), t.appendChild(n), $(".bet_jogadores").prepend(t)
                    } else {
                        JSON.parse(localStorage.getItem("twr_res")).forEach(e => {
                            apArr.push(e), localStorage.setItem("twr_res", JSON.stringify(apArr));
                            var t = document.createElement("div");
                            t.classList.add("my-2"), t.classList.add("d-flex"), t.classList.add("justify-content-between"), t.classList.add("align-items-center");
                            var a = document.createElement("div");
                            a.className = "crash__player--username", a.textContent = e[0], t.appendChild(a);
                            var s = document.createElement("div");
                            s.classList.add("crash__player--multiplier"), s.textContent = "x" + e[1], t.appendChild(s);
                            var n = document.createElement("div");
                            n.classList.add("crash__player--bet");
                            var o = document.createElement("span");
                            o.textContent = "R$", o.classList.add("crash__player__bet--rs");
                            var r = document.createElement("span");
                            r.textContent = e[2], r.classList.add("crash__player__bet--value"), 1 == mkRdI(0, 1) ? r.classList.add("game__color--win") : r.classList.add("game__color--lose"), n.appendChild(o), n.appendChild(r), t.appendChild(n), $(".bet_jogadores").prepend(t)
                        })
                    }
            }, window.gapts = function () {
                var e = Math.floor(2e3 * Math.random()) + 1e3;
                setTimeout(function () {
                    var e = gApsts();
                    apArr.length > 21 && (apArr.shift(), $(".bet_jogadores").children().last().remove()), apArr.push(e), localStorage.setItem("twr_res", JSON.stringify(apArr));
                    var t = document.createElement("div");
                    t.classList.add("my-2"), t.classList.add("d-flex"), t.classList.add("justify-content-between"), t.classList.add("align-items-center");
                    var a = document.createElement("div");
                    a.className = "crash__player--username", a.textContent = e[0], t.appendChild(a);
                    var s = document.createElement("div");
                    s.classList.add("crash__player--multiplier"), s.textContent = "x" + e[1], t.appendChild(s);
                    var n = document.createElement("div");
                    n.classList.add("crash__player--bet");
                    var o = document.createElement("span");
                    o.textContent = "R$", o.classList.add("crash__player__bet--rs");
                    var r = document.createElement("span");
                    r.textContent = e[2], r.classList.add("crash__player__bet--value"), 1 == mkRdI(0, 1) ? r.classList.add("game__color--win") : r.classList.add("game__color--lose"), n.appendChild(o), n.appendChild(r), t.appendChild(n), $(".bet_jogadores").prepend(t), gapts()
                }, e)
            }, window.gApsts = function () {
                var e = "";
                e += "User", e += mkId(4), e += "...";
                var t = parseFloat(mulArr[mkRdI(0, mulArr.length)]).toFixed(2),
                    a = "";
                return 0 == (a += mkRdI(0, 9)) ? a = mkRdI(1, 9) : a += mkRdI(0, 9), [e, t, parseFloat(a).toFixed(2)]
            }, window.mkRdI = function (e, t) {
                return e = Math.ceil(e), t = Math.floor(t), Math.floor(Math.random() * (t - e + 1)) + e
            }, window.mkId = function (e) {
                for (var t = "", a = "0123456789a0123456789b0123456789c0123456789d0123456789e0123456789f0123456789g0123456789h0123456789i0123456789j0123456789kl0123456789m0123456789n0123456789o0123456789p0123456789q0123456789r0123456789s0123456789t0123456789u0123456789v0123456789w0123456789x0123456789y0123456789z0123456789", s = 0; s < e;) t += s > 1 ? a.charAt(Math.floor(Math.random() * a.length)) : "0123456789".charAt(Math.floor(Math.random() * "0123456789".length)), s += 1;
                return t
            }, window.checkSound = function () {
                "on" == $("#tower_music").attr("data-music") ? isSoundOn = !0 : isSoundOn = !1
            }, ggapts(), gapts(), checkSound(), $("#tower_music").on("click", function () {
                "on" == $("#tower_music").attr("data-music") ? (isSoundOn = !1, $("#tower_music").attr("data-music", "off")) : (isSoundOn = !0, $("#tower_music").attr("data-music", "on"))
            })
        })
    },
    6: function (e, t, a) {
        e.exports = a("08te")
    }
});
var __profit = function () {};
