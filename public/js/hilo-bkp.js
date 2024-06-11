! function(e) {
    var a = {};

    function i(t) {
        if (a[t]) return a[t].exports;
        var r = a[t] = {
            i: t,
            l: !1,
            exports: {}
        };
        return e[t].call(r.exports, r, r.exports, i), r.l = !0, r.exports
    }
    i.m = e, i.c = a, i.d = function(e, a, t) {
        i.o(e, a) || Object.defineProperty(e, a, {
            enumerable: !0,
            get: t
        })
    }, i.r = function(e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }, i.t = function(e, a) {
        if (1 & a && (e = i(e)), 8 & a) return e;
        if (4 & a && "object" == typeof e && e && e.__esModule) return e;
        var t = Object.create(null);
        if (i.r(t), Object.defineProperty(t, "default", {
                enumerable: !0,
                value: e
            }), 2 & a && "string" != typeof e)
            for (var r in e) i.d(t, r, function(a) {
                return e[a]
            }.bind(null, r));
        return t
    }, i.n = function(e) {
        var a = e && e.__esModule ? function() {
            return e.default
        } : function() {
            return e
        };
        return i.d(a, "a", a), a
    }, i.o = function(e, a) {
        return Object.prototype.hasOwnProperty.call(e, a)
    }, i.p = "/", i(i.s = 9)
}({
    9: function(e, a, i) {
        e.exports = i("TpFI")
    },
    TpFI: function(e, a) {
        $.on("/hilo", function() {
            var e = null,
                a = !1,
                i = !1,
                t = 1,
                b = 0,
                cli = null,
                apArr = [],
                urs = [],
                mml = 0.00, isSoundOn = true, ghid = 0;
            betAudio = new Audio, winAudio = new Audio, clickAudio = new Audio, flipAudio = new Audio, gameAudio = new Audio, loseAudio = new Audio, window.hilo = function() {
                if ($('#bet').val() >= 1) {
                    b = $('#bet').val();


                        const xhr = new XMLHttpRequest();
                        const csrfToken = $('meta[name=csrf-token]').attr('content');

                        const data = {
                            bet: b,
                            game_id: 9
                        };

                        xhr.open("POST", "/api/balance/deduct");

                        xhr.setRequestHeader('Content-Type', 'application/json');
                        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                        xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

                        xhr.onload = () => {
                            if (xhr.status >= 200 && xhr.status < 300) {
                                const response = JSON.parse(xhr.responseText);

                                if (response.status === 200) {
                                    b2 = response.new_balance;
                                    urs.push("User" + response.uid + "...");
                                    ghid = response.ghid;

                                    $('#money').html(response.new_balance);
                                    $('#money').attr('data-current-balance', response.new_balance);
                                    $('#money_update').html("-$" + parseFloat(b).toFixed(2));
                                    $('#div_money_update').css('display', "block");
                                    $('#money_update').css('color', "red");

                                    let interval = setInterval(function() {
                                        this.div_money_update.style.display = "none";
                                        clearInterval(interval);
                                    }, 3000);

                                    null == e && !0 !== a && $.get("/game/hilo/" + $("#bet").val() + "/" + t, function(a) {
                                        var i = JSON.parse(a);
                                        if (null != i.error) return "$" === i.error && load("/"), -1 === i.error && $("#b_si").click(), 1 === i.error && iziToast.error({
                                            message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                                            icon: "fa fa-times"
                                        }), 2 === i.error && $("#_payin").click(), void(3 === i.error && (replace(), hilo()));
                                        betAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/bet.mp3" : "", isSoundOn ? betAudio.play() : null, calculateProbability(t), $(".hilo-replace").fadeOut("fast"), $(".cf_status").fadeOut("fast"), clearInterval(cli), $(".hilo-select").fadeIn("fast"), $("#play").attr("disabled", true).attr("onclick", "take()"), updateBalanceN(), e = i, _disableDemo = !0, dbBtn(!1)
                                    })
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
                    return iziToast.info({
                        message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                        icon: "fa fa-info"
                    }), setTimeout(function() {
                        clicked = !1
                    }, 100);
                }

            }, window.flip = function(r) {
                null != e && !0 !== a && $.get("/game/hilo/flip/" + e.id + "/" + r, function(r) {
                    var o = JSON.parse(r);

                    if (null != o.error) return -1 === o.error && iziToast.error({
                        message: "Игра не найдена.",
                        icon: "fa fa-times"
                    }), void(0 === o.error && console.log("Server cancelled input"));
                    a = !0;
                    var n = parseFloat(o.multiplier).toFixed(2),
                        l = splitDecimal(n),
                        s = parseFloat(o.deck_index);
                    t = s, clickAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/click.mp3" : "", isSoundOn ? clickAudio.play() : null, flipAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/flip.mp3" : "", isSoundOn ? flipAudio.play() : null, setCard(deck[s]), setTimeout(function() {
                        if (a = !1, !1 === o.win) setTimeout(function() {
                            uapts(0), $("#cf_status_text").html("Você perdeu!!"), $('.cf_status').toggleClass('hilo__win', !1).toggleClass('hilo__lose', !0), $(".ribbon-wide").toggleClass("win-ribbon", !1).toggleClass("lose-ribbon", !0), $(".cf_status").fadeIn("fast"), cli = setInterval(() => {$(".cf_status").fadeOut(200);clearInterval(cli)}, 3000), loseAudio.src = isAudioGame ? "/assets/media/lose.mp3" : "", isSoundOn ? loseAudio.play() : null, isDemo || sendDrop(e.id), validateTask(e.id), clear(), updateBalanceN(), clearHistory(), $('#play').attr('disabled', false), dbBtn(!0)
                        }, 400);
                        else {
                            calculateProbability(s), $("#games").prop("number", p_n("#games")).animateNumber({
                                number: o.games
                            }), $("#mul").prop("number", p_n("#mul")).animateNumber({
                                number: l[0]
                            }), $("#mul_m").prop("number", p_n("#mul_m")).animateNumber({
                                number: l[1]
                            }), $('#play').attr('disabled', false), gameAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/game.mp3" : "", isSoundOn ? gameAudio.play() : null;
                            mml = parseFloat(o.multiplier).toFixed(2);
                            var t = (parseFloat(e.bet) * mml).toFixed(2);
                            t < 0 && (t = "0.00"), i ? $("#cf_profit").html(t) : (setBetText(gBtT("pegar") + '<br><span id="cf_profit">' + t + '</span>&nbsp;<i class="fad fa-coins"></i>'), $("#cf_profit").toggleClass("bet_profit-error", parseFloat(t) <= 0), i = !0)
                        }
                    }, 600)
                });
            }, window.take = function() {
                null != e && !0 !== a && $.get("/game/hilo/take/" + e.id, function(a) {
                    var o = JSON.parse(a);

                    const xhr = new XMLHttpRequest();
                    const csrfToken = $('meta[name=csrf-token]').attr('content');

                    const data = {
                        winnings: o.profit,
                        game_id: 9,
                        ghid: ghid
                    };

                    xhr.open("PUT", "/api/balance/add");

                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

                    xhr.onload = () => {
                        if (xhr.status >= 200 && xhr.status < 300) {
                            const response = JSON.parse(xhr.responseText);

                            if (response.status === 200) {
                                execTake(o);
                                uapts(1);

                                $('#money').html(response.new_balance);
                                $('#money').attr('data-current-balance', response.new_balance);
                                $('#money_update').html("+$" + parseFloat(o.profit).toFixed(2));
                                $('#div_money_update').css('display', "block");
                                $('#money_update').css('color', "yellow");

                                let interval = setInterval(function() {
                                    this.div_money_update.style.display = "none";
                                    clearInterval(interval);
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
            }, window.calculateProbability = function(e) {
                var a = deck[e].slot / 14 * 100,
                    i = splitDecimal(a),
                    t = splitDecimal(100 - a),
                    r = function(a) {
                        return a ? 12.35 / deck[e].slot : 12.35 / (13 - (deck[e].slot - 1))
                    },
                    o = r(!0),
                    n = r(!1),
                    l = splitDecimal(o),
                    s = splitDecimal(n);
                $("#chance-h_ma").animateNumber({
                    number: t[0]
                }), $("#chance-h_mi").animateNumber({
                    number: t[1]
                }), $("#chance-l_ma").animateNumber({
                    number: i[0]
                }), $("#chance-l_mi").animateNumber({
                    number: i[1]
                }), $("#mul-h_ma").animateNumber({
                    number: s[0]
                }), $("#mul-h_mi").animateNumber({
                    number: s[1]
                }), $("#mul-l_ma").animateNumber({
                    number: l[0]
                }), $("#mul-l_mi").animateNumber({
                    number: l[1]
                })
            }, window.clear = function() {
                e = null, a = !1, i = !1, _disableDemo = !1, $(".hilo-replace").fadeIn("fast"), setBetText(gBtT("jogar")), $("#play").attr("onclick", "hilo()"), $(".hilo-select").fadeOut("fast"), $("#games").animateNumber({
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
            }, window.addToHistory = function(e) {
                var a = "hearts" === e.type || "diamonds" === e.type,
                    i = $('<div class="card_history ' + (a ? "card_history_red" : "card_history_black") + '"><div>' + e.value + '</div><i class="' + deck.toIcon(e) + '"></i></div>').hide();
                $(".cf_history").prepend(i), i.fadeIn("fast")
            }, window.setCard = function(e) {
                void 0 === e && (e = deck[1]), $(".hilo-card-value").fadeOut("fast", function() {
                    $(this).html(e.value), $(this).fadeIn("fast")
                }), $("#card_icon").fadeOut("fast", function() {
                    $("#card_icon").attr("class", deck.toIcon(e)), $("#card_icon").fadeIn("fast");
                    var a = "hearts" === e.type || "diamonds" === e.type;
                    $(".hilo_card").toggleClass("card_history_red", a), $(".hilo_card").toggleClass("card_history_black", !a)
                }), addToHistory(e), $("#higher").fadeOut("fast", function() {
                    var e = t % 13 + 1 == 1;
                    $("#higher").html(e ? HLgBtT(2) : HLgBtT(0)), $("#higher").fadeIn("fast")
                }), $("#lower").fadeOut("fast", function() {
                    var e = t % 13 + 1 == 2;
                    $("#lower").html(e ? HLgBtT(2) : HLgBtT(1)), $("#lower").fadeIn("fast")
                })
            }, window.clearHistory = function() {
                $.each($(".cf_history .card_history"), function(e, a) {
                    $(a).fadeOut("fast", function() {
                        $(a).remove()
                    })
                })
            }, window.replace = function() {
                null == e && ($(".cf_status").fadeOut("fast"), clearInterval(cli), clearHistory(), function e() {
                    var a = Math.floor(Math.random() * (Object.keys(deck).length - 1)) + 1,
                        i = deck[a];
                    void 0 !== i && 1 !== i.slot && 13 !== i.slot ? (t = a, setCard(i)) : e()
                }())
            }, window.execTake = function(i) {
                if (null != i.error) return -1 === i.error && iziToast.error({
                    message: "Требуется авторизация.",
                    icon: "fa fa-times"
                }), 0 === i.error && console.log("Server cancelled input"), void(1 === i.error && iziToast.error({
                    message: "Игра не найдена.",
                    icon: "fa fa-times"
                }));
                isDemo || sendDrop(e.id), validateTask(e.id), isDemo && isGuest() && showDemoTooltip(), clear(), updateBalanceN(), clearHistory(), parseFloat(i.profit) > 0 && ($("#cf_status_text").html("Você ganhou!! <br> <span class='hilo__value--rs'>R$ <span class='color-yellow' style='color: #ffd534;'>" + parseFloat(i.profit).toFixed(2) + '&nbsp;<i class="fad fa-coins" style="color: #ffd534;"></i></span>   </span>'), $('.cf_status').toggleClass('hilo__win', !0).toggleClass('hilo__lose', !1), $(".ribbon-wide").toggleClass("win-ribbon", !0).toggleClass("lose-ribbon", !1), $(".cf_status").fadeIn("fast"), cli = setInterval(() => {$(".cf_status").fadeOut(200);clearInterval(cli)}, 3000)), winAudio.src = isAudioGame ? "/assets/media/win.mp3" : "", isSoundOn ? winAudio.play() : null, dbBtn(!0)
            }, window.uapts = function (status) {
                urs.push('x' + parseFloat(mml).toFixed(2));
                urs.push(b);

                var result = urs;
                if (apArr.length > 21) {
                    apArr.shift();
                    $('.bet_jogadores').children().last().remove();
                }
                apArr.push(result);
                localStorage.setItem('hlo_res', JSON.stringify(apArr));
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
                mml = 0.00;
            }, window.ggapts = function() {
                const hlo_res = localStorage.getItem('hlo_res');
                if (hlo_res == null) {
                    for (let i = 1;i <= 22;i++) {
                        var result = gApsts();
                        apArr.push(result);
                        localStorage.setItem('hlo_res', JSON.stringify(apArr));
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

                        d2.textContent = 'x' + parseFloat(result[1]).toFixed(2);
                        d.appendChild(d2);

                        var d3 = document.createElement('div');
                        d3.classList.add('crash__player--bet');

                        var s1 = document.createElement('span');
                        s1.textContent = "R$";
                        s1.classList.add('crash__player__bet--rs');

                        var s2 = document.createElement('span');
                        s2.textContent = result[2];
                        s2.classList.add('crash__player__bet--value');

                        if (result[1] == 0) {
                            s2.classList.add('game__color--lose');
                        } else {
                            if (mkRdI(0, 1) == 1) {
                                s2.classList.add('game__color--win');
                            } else {
                                s2.classList.add('game__color--lose');
                            }
                        }

                        d3.appendChild(s1);
                        d3.appendChild(s2);

                        d.appendChild(d3);
                        $('.bet_jogadores').prepend(d);
                    }
                } else {
                    const aapr = JSON.parse(localStorage.getItem('hlo_res'));

                    aapr.forEach((result) => {
                        apArr.push(result);
                        localStorage.setItem('hlo_res', JSON.stringify(apArr));
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

                        d2.textContent = 'x' + parseFloat(result[1]).toFixed(2);
                        d.appendChild(d2);

                        var d3 = document.createElement('div');
                        d3.classList.add('crash__player--bet');

                        var s1 = document.createElement('span');
                        s1.textContent = "R$";
                        s1.classList.add('crash__player__bet--rs');

                        var s2 = document.createElement('span');
                        s2.textContent = result[2];
                        s2.classList.add('crash__player__bet--value');

                        if (result[1] == 0) {
                            s2.classList.add('game__color--lose');
                        } else {
                            if (mkRdI(0, 1) == 1) {
                                s2.classList.add('game__color--win');
                            } else {
                                s2.classList.add('game__color--lose');
                            }
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
                    localStorage.setItem('hlo_res', JSON.stringify(apArr));
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

                    d2.textContent = 'x' + parseFloat(result[1]).toFixed(2);
                    d.appendChild(d2);

                    var d3 = document.createElement('div');
                    d3.classList.add('crash__player--bet');

                    var s1 = document.createElement('span');
                    s1.textContent = "R$";
                    s1.classList.add('crash__player__bet--rs');

                    var s2 = document.createElement('span');
                    s2.textContent = result[2];
                    s2.classList.add('crash__player__bet--value');

                    if (result[1] == 0) {
                        s2.classList.add('game__color--lose');
                    } else {
                        if (mkRdI(0, 1) == 1) {
                            s2.classList.add('game__color--win');
                        } else {
                            s2.classList.add('game__color--lose');
                        }
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
                var mul = '';

                const rnd = mkRdI(0, 9);
                if (rnd == 0) {
                    mul += 0;
                } else {
                    const lmt = mkRdI(1, 2);
                    for (let i = 1;i<=lmt;i++) {
                        if (i == 1) {
                            mul += mkRdI(1, 9);
                        } else {
                            mul += mkRdI(0, 9);
                        }
                    }

                    mul += '.' + mkRdI(0, 9) + 0;
                }

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
            }, ggapts(), gapts(), clear(), replace(), window.checkSound = function() {
                if ($('#hilo_music').attr('data-music') == 'on') {
                    isSoundOn = true;
                } else {
                    isSoundOn = false;
                }
            }, $('#hilo_music').on("click", function() {
                if ($('#hilo_music').attr('data-music') == 'on') {
                    isSoundOn = false;
                    $('#hilo_music').attr('data-music', 'off');
                } else {
                    isSoundOn = true;
                    $('#hilo_music').attr('data-music', 'on');
                }
            }), window.dbBtn = function(s) {
                $('.hilo__low').toggleClass('hilo_disabled', s), $('.hilo__high').toggleClass('hilo_disabled', s)
            }
        })
    }
});
var __profit = function() { };
