! function(e) {
    var a = {};

    function t(i) {
        if (a[i]) return a[i].exports;
        var n = a[i] = {
            i: i,
            l: !1,
            exports: {}
        };
        return e[i].call(n.exports, n, n.exports, t), n.l = !0, n.exports
    }
    t.m = e, t.c = a, t.d = function(e, a, i) {
        t.o(e, a) || Object.defineProperty(e, a, {
            enumerable: !0,
            get: i
        })
    }, t.r = function(e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }, t.t = function(e, a) {
        if (1 & a && (e = t(e)), 8 & a) return e;
        if (4 & a && "object" == typeof e && e && e.__esModule) return e;
        var i = Object.create(null);
        if (t.r(i), Object.defineProperty(i, "default", {
                enumerable: !0,
                value: e
            }), 2 & a && "string" != typeof e)
            for (var n in e) t.d(i, n, function(a) {
                return e[a]
            }.bind(null, n));
        return i
    }, t.n = function(e) {
        var a = e && e.__esModule ? function() {
            return e.default
        } : function() {
            return e
        };
        return t.d(a, "a", a), a
    }, t.o = function(e, a) {
        return Object.prototype.hasOwnProperty.call(e, a)
    }, t.p = "/", t(t.s = 10)
}({
    10: function(e, a, t) {
        e.exports = t("tnDT")
    },
    tnDT: function(e, a) {
        $.on("/blackjack", function() {
            var e, a, b = 0, b2 = 0, pd = [], dc = [], apArr = [], urs = [], hl = 0, isSoundOn = true, insuranceActive = false, init = false, ghid = 0, t = new function() {

                    this.newGame = function() {
                        if ($('#bet').val() >= 1) {
                            b = $('#bet').val();

                            const xhr = new XMLHttpRequest();
                            const csrfToken = $('meta[name=csrf-token]').attr('content');

                            const data = {
                                bet: b,
                                game_id: 10
                            };

                            xhr.open("POST", "/api/blackjack/init");

                            xhr.setRequestHeader('Content-Type', 'application/json');
                            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                            xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

                            xhr.onload = () => {
                                if (xhr.status >= 200 && xhr.status < 300) {
                                    const response = JSON.parse(xhr.responseText);
                                    if (response.status === 200) {
                                        init = true;
                                        b2 = response.new_balance;
                                        const o = JSON.parse(response.game);
                                        pd = o;
                                        dc = response.decks;
                                        urs.push("User" + response.uid + "...");
                                        ghid = response.ghid;

                                        $('#money').attr('data-current-balance', response.new_balance);
                                        $('#money_update').html("-$" + parseFloat(b).toFixed(2));
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

                                        if (a = o.id, null != o.error) return "$" === o.error && load("/"), -1 === o.error && $("#b_si").click(), 1 === o.error && iziToast.error({
                                            message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                                            icon: "fa fa-times"
                                        }), void(2 === o.error && $("#_payin").click());
                                        betAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/bet.mp3" : "", isSoundOn ? betAudio.play() : null, _disableDemo = !0, updateBalanceN(), resetBoard(), e = new l, r = !0, s = !1, i.resetHand(), n.resetHand(),
                                        setTimeout(function() {
                                            e.dealCard(i, {
                                                index: o.player[0].index,
                                                rank: o.player[0].value,
                                                suit: o.player[0].type,
                                                value: o.player[0].blackjack_value,
                                                type: "up"
                                            }), setTimeout(function() {
                                                e.dealCard(n, {
                                                    index: o.dealer.index,
                                                    rank: o.dealer.value,
                                                    suit: o.dealer.type,
                                                    value: o.dealer.blackjack_value,
                                                    type: "up"
                                                }), setTimeout(function() {
                                                    e.dealCard(i, {
                                                        index: o.player[1].index,
                                                        rank: o.player[1].value,
                                                        suit: o.player[1].type,
                                                        value: o.dealer.blackjack_value,
                                                        type: "up"
                                                    }), setTimeout(function() {
                                                        e.dealCard(n, {
                                                            index: 1,
                                                            rank: "",
                                                            suit: "",
                                                            value: 0,
                                                            type: "down"
                                                        }, !0), r && $("#blackjack_controls").fadeIn("fast"), slideAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/slide.mp3" : "", isSoundOn ? slideAudio.play() : null
                                                    }, 500), slideAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/slide.mp3" : "", isSoundOn ? slideAudio.play() : null
                                                }, 500), slideAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/slide.mp3" : "", isSoundOn ? slideAudio.play() : null
                                            }, 500), slideAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/slide.mp3" : "", isSoundOn ? slideAudio.play() : null
                                        }, 500)
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
                    }
                },
                i = new o,
                n = new o,
                r = !1,
                s = !1,
                dbl = 1,
                og = 0,
                cli = null;

            function o() {
                var e = [],
                    a = "",
                    t = "";
                this.getElements = function() {
                    return this === i ? (a = "#phand", t = ".player") : (a = "#dhand", t = ".dealer"), {
                        ele: a,
                        score: t
                    }
                }, this.getHand = function() {
                    return e
                }, this.setHand = function(a) {
                    e.push(a)
                }, this.resetHand = function() {
                    e = []
                }, this.flipCards = function(e) {
                    $(".down").each(function() {
                        $(this).removeClass("down").addClass("up"), renderCard(!1, !1, $(this), !1, e)
                    }), n.getScore("dealer", function(e) {
                        $(".dealer").html(e)
                    })
                }
            }

            function d(e) {
                this.getIndex = function() {
                    return e.index
                }, this.getType = function() {
                    return e.type
                }, this.getRank = function() {
                    return e.rank
                }, this.getSuit = function() {
                    return e.suit
                }, this.getValue = function() {
                    var e = this.getRank();
                    return "A" === e ? 11 : "K" === e || "Q" === e || "J" === e ? 10 : parseInt(e, 0)
                }
            }

            function l() {
                this.setCard = function(e, a) {
                    e.setHand(a)
                }, this.dealCard = function(a, t, r) {
                    var o = a,
                        d = a.getElements(),
                        l = d.score,
                        u = d.ele,
                        c = n.getHand();
                    e.setCard(o, t), renderCard(u, o, !1, r), o.getScore(".dealer" === l ? "dealer" : "player", function(e) {
                        $(l).html(e)
                    }), i.getHand().length < 3 && (c.length > 0 && "A" === c[0].rank && setActions("insurance"), i.getScore("player", function(e) {
                        if (21 === e) {
                            dCtrl(!0);
                            if (s) return;
                            s = !0
                            let standInterval = setInterval(function() {
                                i.stand();
                                clearInterval(standInterval);
                            }, 2500);
                        } else c.length > 1 && setActions("run")
                    }))
                }
            }

            betAudio = new Audio, winAudio = new Audio, clickAudio = new Audio, slideAudio = new Audio, gameAudio = new Audio, loseAudio = new Audio, o.prototype.hit = function(t) {
                $.get("/game/blackjack/hit/" + a, function(a) {
                    var n = JSON.parse(a);
                    dbl = 0;
                    $('#double').toggleClass('bb_disabled', !0);
                    pd.player.push(n.player);
                    e.dealCard(i, {
                        index: n.player.index,
                        rank: n.player.value,
                        suit: n.player.type,
                        value: n.player.blackjack_value,
                        type: "up"
                    }), i.getScore("player", function(e) {
                        t || e > 21 ? (r = !1, clickAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/click.mp3" : "", isSoundOn ? clickAudio.play() : null, setTimeout(function() {
                            i.stand()
                        }, 500)) : i.getHand(), setActions(), slideAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/slide.mp3" : "", isSoundOn ? slideAudio.play() : null, i.updateBoard()
                    })
                })
            }, o.prototype.stand = function() {
                og = 0;
                dCtrl(!0);
                r = !1, setActions(), $.get("/game/blackjack/stand/" + a, function(t) {
                    var i = JSON.parse(t),
                        r = JSON.parse(i.status);
                    showAlert("error" === r.type, r.header, r.message, r), isDemo || sendDrop(a), _disableDemo = !1, clickAudio.src = isAudioGame ? "/assets/media/click.mp3" : "", isSoundOn ? clickAudio.play() : null

                    n.flipCards({
                        rank: i.dealerReveal.value,
                        suit: '<i class="' + deck.toIcon(deck[i.dealerReveal.index]) + '"></i>',
                        value: i.dealerReveal.blackjack_value,
                        dealerScore: i.dealerScore
                    });

                    for (var s = 0; s < i.dealerDraw.length; s++) e.dealCard(n, {
                        index: i.dealerDraw[s].index,
                        rank: i.dealerDraw[s].value,
                        suit: i.dealerDraw[s].type,
                        value: i.dealerDraw[s].blackjack_value,
                        type: "up"
                    });

                    n.updateBoard(), updateBalanceN()
                })
            }, o.prototype.dbl = function() {
                if (dbl == 1 && og == 1) {
                    i.hit(!0), updateBalanceN(), _disableDemo = !1
                }
            }, o.prototype.insure = function() {
                insuranceActive = false;
                const nsrTr = [
                    "You bought insurance",
                    "Você comprou seguro",
                    "你买了保险"
                ];

                let msg;

                if ($('#frm_brand').val() == 'en') {
                    msg = nsrTr[0];
                } else if ($('#frm_brand').val() == 'pt') {
                    msg = nsrTr[1];
                } else {
                    msg = nsrTr[2];
                }

                $(".insurance").fadeOut("fast");
                clickAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/click.mp3" : "", isSoundOn ? clickAudio.play() : null, iziToast.success({
                    message: msg,
                    icon: "fas fa-info-circle",
                    position: "bottomCenter"
                }), updateBalanceN()
            }, o.prototype.getScore = function(e, t) {
                let score = 0;
                let aces = 0;

                if (e == 'player') {
                    pd.player.forEach(card => {
                        score += card.blackjack_value;

                        if (card.blackjack_value == 11) aces += 1;

                        if (score > 21 && aces > 0) {
                            score -= 10;
                            aces--;
                        }
                    });
                } else {
                    if (dealer.length > 1) {
                        pd.dealer.forEach(card => {
                            score += card.blackjack_value;

                            if (card.blackjack_value == 11) aces += 1;

                            if (score > 21 && aces > 0) {
                                score -= 10;
                                aces--;
                            }
                        });
                    } else {
                        score += pd.dealer.blackjack_value;
                    }
                }

                t(score);
            }, o.prototype.updateBoard = function() {
                var e = ".dealer";
                this === i && (e = ".player"), this.getScore(".dealer" === e ? "dealer" : "player", function(a) {
                    $(e).html(a)
                })
            }, window.showAlert = function(e, a, t, r) {
                !e && (winAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/win.mp3" : "", isSoundOn ? winAudio.play() : null), e && (loseAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/lose.mp3" : "", isSoundOn ? loseAudio.play() : null), $(".wheel_game_result").toggleClass("wg_lose", e), $(".wheel_game_result").toggleClass("3000", !e), $(".mul").html(a), $(".te").html(t), $(".wheel_game_result").fadeIn("fast"), cli = setInterval(() => {$(".wheel_game_result").fadeOut("fast");clearInterval(cli)}, 3000)

                dCtrl(!0);

                if (!e) {
                    const xhr = new XMLHttpRequest();
                    const csrfToken = $('meta[name=csrf-token]').attr('content');

                    if (r.diff == 1) {
                        $('.wheel_game_result').addClass('blackjack__tie');
                        winnings = b;
                    } else {
                        $('.wheel_game_result').addClass('blackjack__win');
                        if (r.diff == 2) {
                            winnings = b * 3;
                        } else {
                            winnings = b * 2;
                        }
                    }

                    const data = {
                        winnings: winnings,
                        game_id: 10,
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
                                uapts(1);
                                $('#money').attr('data-current-balance', response.new_balance);
                                $('#money_update').html("+$" + parseFloat(data.winnings).toFixed(2));
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
                } else {
                    $('.wheel_game_result').addClass('blackjack__lose');
                    uapts(0);
                }
            }, window.hideAlert = function() {
                $('.wheel_game_result').removeClass('blackjack__win');
                $('.wheel_game_result').removeClass('blackjack__lose');
                $('.wheel_game_result').removeClass('blackjack__tie');
                $(".wheel_game_result").fadeOut("fast");
                clearInterval(cli);
            }, window.setActions = function(e) {
                var a = i.getHand();
                let scr = 0;

                r || ($("#play").attr("disabled", false), $("#blackjack_controls").fadeOut("fast"), $("#split").toggleClass("bb_disabled", !0), $(".insurance").fadeOut("fast")), "run" === e ? null : "split" === e ? $("#split").toggleClass("bb_disabled", !1) : a.length > 2 && ($("#split").toggleClass("bb_disabled", !0), $(".insurance").fadeOut("fast"))

                if (a.length > 1 && "insurance" == e) {
                    i.getScore("player", function(score) {
                        if (score != 21) {
                            insuranceActive = true;
                            $(".insurance").fadeIn("fast");
                        }
                    });
                } else {
                    i.getScore("player", function(score) {
                        scr = score;
                    });
                }

                if (init == true) {

                    if (scr != 21) {
                        dCtrl(!1);
                        dbl = 1;
                        og = 1;
                    }

                    init = false;
                }
            }, window.renderCard = function(e, a, t, r, s) {
                var o, l, u;
                const screnWidth = window.innerWidth;
                console.log(screnWidth);
                u = new d(t ? (o = n.getHand())[1] : (o = a.getHand())[l = o.length - 1]), void 0 !== s && (u.rank = s.rank, u.suit = s.suit, u.value = s.value);
                var c = u.getRank(),
                    p = u.getSuit(),
                    f = "red",
                    m = 350,
                    g = screnWidth <= 590 ? 85 : 20,
                    b = 200,
                    k = e + " .card-" + l,
                    h = u.getType();
                l > 0 && (m -= 50 * l), t ? k = t : ($(e).append('<div class="' + (void 0 !== r && !0 === r ? "dealerSecret " : "") + "blackjack_card card-" + l + " " + h + '"><span class="pos-0"><span class="rank">&nbsp;</span><span class="suit">&nbsp;</span></span></div>'), "#phand" === e ? (g = screnWidth <= 590 ? 235 : 340, b = 500, $(e + " div.card-" + l).attr("id", "pcard-" + l), o.length < 2 && setTimeout(function() {
                    i.getScore("player", function(e) {
                        $(".player").html(e).fadeIn("fast")
                    })
                }, 500)) : ($(e + " div.card-" + l).attr("id", "dcard-" + l), o.length < 2 && setTimeout(function() {
                    n.getScore("dealer", function(e) {
                        $(".dealer").html(e).fadeIn("fast")
                    })
                }, 100)), $(e + " .card-" + l).css("z-index", l), $(e + " .card-" + l).animate({
                    top: g,
                    right: m
                }, b), $(e).queue(function() {
                    $(this).animate({
                        left: "-=25.5px"
                    }, 100), $(this).dequeue()
                })), ("up" === h || t) && ("hearts" !== p && "diamonds" !== p && (f = "black"), $(k).find('span[class*="pos"]').addClass("card_history_" + f), void 0 === s ? $(k).find("span.rank").html(c) : ($(".dealerSecret span.rank").html(s.rank), setTimeout(function() {
                    $(".dealer").html(s.dealerScore)
                }, 50)), $(k).find("span.suit").html('<i class="' + deck.toIcon(deck[u.getIndex()]) + '"></i>'))
            }, window.resetBoard = function() {
                $("#dhand").html(""), $("#phand").html(""), $("#phand, #dhand").css("left", 0), $(".dealer").fadeOut("fast"), $(".player").fadeOut("fast"), $(".insurance").fadeOut("fast")
            }, window.uapts = function (status) {
                urs.push(parseFloat(b).toFixed(2));

                var result = urs;
                if (apArr.length > 8) {
                    apArr.shift();
                    $('.bet_jogadores').children().last().remove();
                }
                apArr.push(result);
                localStorage.setItem('bjk_res', JSON.stringify(apArr));
                var d = document.createElement('div');
                const flex = "d-flex";
                const between = "justify-content-around";
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
                const bjk_res = localStorage.getItem('bjk_res');
                if (bjk_res == null) {
                    for (let i = 1;i <= 8;i++) {
                        var result = gApsts();
                        apArr.push(result);
                        localStorage.setItem('bjk_res', JSON.stringify(apArr));
                        var d = document.createElement('div');
                        const flex = "d-flex";
                        const between = "justify-content-around";
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
                    const aapr = JSON.parse(localStorage.getItem('bjk_res'));

                    aapr.forEach((result) => {
                        apArr.push(result);
                        localStorage.setItem('bjk_res', JSON.stringify(apArr));
                        var d = document.createElement('div');
                        const flex = "d-flex";
                        const between = "justify-content-around";
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
                    if (apArr.length > 8) {
                        apArr.shift();
                        $('.bet_jogadores').children().last().remove();
                    }
                    apArr.push(result);
                    localStorage.setItem('bjk_res', JSON.stringify(apArr));
                    var d = document.createElement('div');
                    const flex = "d-flex";
                    const between = "justify-content-around";
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
            }, window.dCtrl = function(md) {
                $('#hit').toggleClass('bb_disabled', md);
                $('#stand').toggleClass('bb_disabled', md);
                $('#double').toggleClass('bb_disabled', md);
            }, ggapts(), gapts(), $("#play").on("click", function() {
                $('#play').attr("disabled", true);

                r || (hideAlert(), t.newGame())
            }), $("#hit").on("click", function() {
                if (!$('#hit').hasClass('bb_disabled') && og === 1 && !hl == !0) {
                    i.hit();
                    hl = !0;
                    setTimeout(() => {
                        hl = !1;
                    }, 1000)
                }
            }), $("#stand").on("click", function() {
                if (!$('#stand').hasClass('bb_disabled') && og === 1) {
                    $(".insurance").fadeOut("fast"), i.stand()
                }
            }), $("#double").on("click", function() {
                if (!$('#double').hasClass('bb_disabled') && dbl === 1 && og == 1) {
                    $('#double').toggleClass('bb_disabled', !0);
                    const xhr = new XMLHttpRequest();
                    const csrfToken = $('meta[name=csrf-token]').attr('content');

                    const data = {
                        bet: b,
                        game_id: 10,
                        session_id: a,
                        ghid: ghid
                    };

                    b = b * 2;

                    xhr.open("POST", "/api/blackjack/double");

                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

                    xhr.onload = () => {
                        if (xhr.status >= 200 && xhr.status < 300) {
                            const response = JSON.parse(xhr.responseText);
                            if (response.status === 200) {
                                $('#money').html(response.new_balance);
                                $('#money').attr('data-current-balance', response.new_balance);
                                $('#money_update').html("-$" + parseFloat(b/2).toFixed(2));
                                $('#div_money_update').css('display', "block");
                                $('#money_update').css('color', "red");

                                let interval = setInterval(function() {
                                    this.div_money_update.style.display = "none";
                                    clearInterval(interval);
                                }, 3000);

                                i.dbl();
                            } else {
                                return iziToast.info({
                                    message: "Saldo insuficiente",
                                    icon: "fa fa-info"
                                }), setTimeout(function() {
                                    clicked = !1
                                }, 100);
                            }
                        } else if (xhr.status == 419) {
                            $('#modal_please_login').addClass('md-show');
                        } else {
                            window.location.reload();
                        }
                    }

                    xhr.send(JSON.stringify(data));
                }
            }), $("#insurance_accept").on("click", function() {
                if (insuranceActive) {
                    const xhr = new XMLHttpRequest();
                    const csrfToken = $('meta[name=csrf-token]').attr('content');

                    const data = {
                        bet: b/2,
                        game_id: 10,
                        session_id: a,
                        ghid: ghid
                    };

                    xhr.open("POST", "/api/blackjack/insure");

                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

                    xhr.onload = () => {
                        if (xhr.status >= 200 && xhr.status < 300) {
                            const response = JSON.parse(xhr.responseText);
                            if (response.status === 200) {
                                $('#money').html(response.new_balance);
                                $('#money').attr('data-current-balance', response.new_balance);
                                $('#money_update').html("-$" + parseFloat(b/2).toFixed(2));
                                $('#div_money_update').css('display', "block");
                                $('#money_update').css('color', "red");

                                let interval = setInterval(function() {
                                    this.div_money_update.style.display = "none";
                                    clearInterval(interval);
                                }, 3000);

                                i.insure();
                            }
                        } else if (xhr.status == 419) {
                            $('#modal_please_login').addClass('md-show');
                        } else {
                            window.location.reload();
                        }
                    }

                    xhr.send(JSON.stringify(data));
                } else {
                    console.log("Subject for account disable");
                }
            }), $("#insurance_cancel").on("click", function() {
                $(".insurance").fadeOut("fast"), clickAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/assets/media/click.mp3" : "", isSoundOn ? clickAudio.play() : null
            }), window.checkSound = function() {
                if ($('#blackjack_music').attr('data-music') == 'on') {
                    isSoundOn = true;
                } else {
                    isSoundOn = false;
                }
            }, $('#blackjack_music').on("click", function() {
                if ($('#blackjack_music').attr('data-music') == 'on') {
                    isSoundOn = false;
                    $('#blackjack_music').attr('data-music', 'off');
                } else {
                    isSoundOn = true;
                    $('#blackjack_music').attr('data-music', 'on');
                }
            })
        })
    }
});
var __profit = function() { };
