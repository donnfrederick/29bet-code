! function(e) {
    var t = {};

    function a(o) {
        if (t[o]) return t[o].exports;
        var s = t[o] = {
            i: o,
            l: !1,
            exports: {}
        };
        return e[o].call(s.exports, s, s.exports, a), s.l = !0, s.exports
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
            for (var s in e) a.d(o, s, function(t) {
                return e[t]
            }.bind(null, s));
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
    }, a.p = "/", a(a.s = 11)
}({
    11: function(e, t, a) {
        e.exports = a("YHe5")
    },
    YHe5: function(e, a) {
        $.on("/dice", function() {
            var e, a, o = 15,
                s = !1,
                i = 0,
                b = 0,
                b2 = 0,
                cl = 0,
                pcs = false,
                cli = null,
                clI = null,
                ml = [0, 98.00, 49.00, 32.00, 24.00, 19.00, 16.00, 14.00, 12.00, 10.90, 9.80, 8.90, 8.10, 7.50, 7.00, 6.50, 6.10, 5.70, 5.40, 5.10, 4.90, 4.60, 4.40, 4.20, 4.10, 3.90, 3.70, 3.60, 3.50, 3.30, 3.20, 3.10, 3.00, 2.90, 2.85, 2.80, 2.70, 2.60, 2.55, 2.50, 2.45, 2.40, 2.30, 2.27, 2.22, 2.17, 2.13, 2.08, 2.04, 2.00, 1.96, 1.92, 1.88, 1.84, 1.81, 1.78, 1.75, 1.71, 1.68, 1.66, 1.63, 1.60, 1.58, 1.55, 1.53, 1.50, 1.48, 1.46, 1.44, 1.42, 1.40, 1.38, 1.36, 1.34, 1.32, 1.30, 1.28, 1.27, 1.26, 1.25, 1.24, 1.20, 1.19, 1.18, 1.17, 1.16, 1.15, 1.14, 1.13, 1.12, 1.11, 1.10, 1.09, 1.08, 1.06, 0, 0, 0, 0, 0, 0],
                mulArr = [98.00, 49.00, 32.00, 24.00, 19.00, 16.00, 14.00, 12.00, 10.90, 9.80, 8.90, 8.10, 7.50, 7.00, 6.50, 6.10, 5.70, 5.40, 5.10, 4.90, 4.60, 4.40, 4.20, 4.10, 3.90, 3.70, 3.60, 3.50, 3.30, 3.20, 3.10, 3.00, 2.90, 2.85, 2.80, 2.70, 2.60, 2.55, 2.50, 2.45, 2.40, 2.30, 2.27, 2.22, 2.17, 2.13, 2.08, 2.04, 2.00, 1.96, 1.92, 1.88, 1.84, 1.81, 1.78, 1.75, 1.71, 1.68, 1.66, 1.63, 1.60, 1.58, 1.55, 1.53, 1.50, 1.48, 1.46, 1.44, 1.42, 1.40, 1.38, 1.36, 1.34, 1.32, 1.30, 1.28, 1.27, 1.26, 1.25, 1.24, 1.20, 1.19, 1.18, 1.17, 1.16, 1.15, 1.14, 1.13, 1.12, 1.11, 1.10, 1.09, 1.08, 1.06],
                apArr = [], isDiceAuto = false, winMulti = 1, ghid = 0, pftp = 50,
                urs = [], isSoundOn = true;
            victory = 0, pft = 0, stopped = 0, clicked = !1, t = "lower", betAudio = new Audio, winAudio = new Audio, loseAudio = new Audio, rollAudio = new Audio, window.setMode = function(e) {
                if (cl == 0 && !isDiceAuto) {
                    setTimeout(() => {
                        $('.game-sidebar-tab').removeClass('active'), $('[data-tab=' + e + ']').addClass('active');
                    }, 152);

                    if ("auto" == e) {
                        $('#play').hide(), $('#auto').show(), $('#gamesvalue').fadeIn(200), $('#gamesvictory').fadeIn(200);
                    } else {
                        $('#auto').hide(), $('#play').show(), $('#gamesvalue').fadeOut(200), $('#gamesvictory').fadeOut(200);
                    }
                } else {
                    return iziToast.info({
                        message: iziGTr(7),
                        icon: "fa fa-info"
                    }), setTimeout(function() {
                        clicked = !1
                    }, 100);
                }
            }, window.cur = t;
            var r = $('<div class="d_slider-tooltip_container dice__tooltip"><div class="d_slider-tooltip"><span id="tooltip-value" class="slide_val">50</span></div></div>').hide(),
                n = function(e, t) {
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
                slide: function(e, a) {
                    if (cl == 0) {
                        return !(a.value < 1 || a.value > 99) && !("lower" === t && a.value > 94) && !("higher" === t && a.value < 6) && (__profit(a.value), $(".slide_val").text(a.value), void updateHeader(a.value));
                    }
                }
            })).append($('<div id="circle" class="d_slider-circle" style="display: none" />')).append($('<div id="result" class="d_slider-result" style="opacity: 0">0</div>')).append(n(100, "100%")).append(n(75, "75%")).append(n(50, "50%")).append(n(25, "25%")).append(n(0, "0")), e.find(".ui-slider-handle").append(r).hover(function() {
                r.stop(!0).fadeIn("fast")
            }, function() {
                r.stop(!0).fadeOut("fast")
            }), $('.dice__options__content__low').click(function() {
                if (t != "lower") {
                    $('.d_slider-top').removeClass('dice__red').addClass('dice__blue');
                    t = "lower";
                    sw();
                }
            }), $('.dice__options__content__high').click(function() {
                if (t != "higher") {
                    $('.d_slider-top').removeClass('dice__blue').addClass('dice__red');
                    t = "higher";
                    sw();
                }
            }), $("#i_value").on("input", function() {
                if ("lower" === t) {
                    if ($(this).val() > 94) {
                        __profit(94);
                        $("#i_value").val(94);
                        $('.dice__options__content__chance--porcent').html(94 + "%");
                        $('#i_chance').val(94 + '%');
                        $("#slider-range").slider("value", 94)
                        $('#tooltip-value').html(94);
                    } else if ($(this).val() < 1) {
                        __profit(1);
                        $("#i_value").val(1);
                        $('.dice__options__content__chance--porcent').html(1 + "%");
                        $('#i_chance').val(1 + '%');
                        $("#slider-range").slider("value", 1)
                        $('#tooltip-value').html(1);
                    } else {
                        __profit($(this).val());
                        $('.dice__options__content__chance--porcent').html($(this).val() + "%");
                        $('#i_chance').val($(this).val() + '%');
                        $("#slider-range").slider("value", $(this).val())
                        $('#tooltip-value').html($(this).val());
                    }
                } else {
                    if ($(this).val() < 6) {
                        __profit(100 - 6);
                        $(this).val(100 - 6);
                        $('.dice__options__content__chance--porcent').html(100 - 6 + "%");
                        $('#i_chance').val(100 - 6 + '%');
                        $("#slider-range").slider("value", 100 - 6)
                        $('#tooltip-value').html(100 - 6);
                    } else if ($(this).val() > 99) {
                        __profit(100 - 99);
                        $("#i_value").val(100 - 99);
                        $('.dice__options__content__chance--porcent').html(100 - 99 + "%");
                        $('#i_chance').val(100 - 99 + '%');
                        $("#slider-range").slider("value", 100 - 99)
                        $('#tooltip-value').html(100 - 99);
                    } else {
                        __profit(100 - $(this).val());
                        $('.dice__options__content__chance--porcent').html(100 - $(this).val() + "%");
                        $('#i_chance').val(100 - $(this).val() + '%');
                        $("#slider-range").slider("value", 100 - $(this).val())
                        $('#tooltip-value').html(100 - $(this).val());
                    }
                }
            }), $("*[data-games]").on("click", function() {
                !isDiceAuto && ($("*[data-games]").toggleClass("bc_active", !1), $(this).toggleClass("bc_active", !0), o = parseInt($(this).attr("data-games")), $(".bomb_input").val(o), $('.bomb_input').toggleClass('dn', !0), $("#change_games span").toggleClass("dn", !1))
            }), $("#change_games").on("click", function() {
                !isDiceAuto && (o = 0, $("*[data-games]").toggleClass("bc_active", !1), $("#change_games input").val(''), $("#change_games span").toggleClass("dn", !0), $("#change_games input").toggleClass("dn", !1), $(".bomb_input").on("input", function() {
                    var e = parseInt($(this).val());
                    if (isNaN(e) || e < 1) return $(this).toggleClass("bad", !0), void(r = !0);
                    $(this).toggleClass("bad", !1), r = !1, o = e, $("*[data-games]").toggleClass("bc_active", !1), $('*[data-games="' + o + '"]').toggleClass("bc_active", !0)
                }).focus())
            }), $("*[data-victory]").on("click", function() {
                !isDiceAuto && ($(this).attr("*[data-victory]"), $(".buttons-3-selected").removeClass("buttons-3-selected"), $(this).addClass("buttons-3-selected"), $('.victory_input').val(parseInt($(this).attr("data-victory"))), winMulti = parseInt($('.victory_input').val()))
            }), window.aPb = function(status) {
                const pB = $('#play');
                if (status == 0) {
                    pB.text(gBtT("jogar"));
                    pB.attr('disabled', false);
                } else if (status == 1) {
                    pB.text(gBtT("aguarde"));
                    pB.attr('disabled', true);
                } else {
                    pB.text(gBtT("parar"));
                }
            }, window.sw = function() {
                $("#slider-range").slider("option", {
                    range: "lower" === t ? "min" : "max"
                }), $("#sw_text").html("lower" === t ? "Menos" : "Mais");
                var e = 100 - $("#slider-range").slider("value");
                "higher" === t && e < 6 && (e = 6), "lower" === t && e > 94 && (e = 94), e < 1 && (e = 1), e > 99 && (e = 99), $("#tooltip-value").html(e), $("#slider-range").slider("value", e), updateHeader(e), __profit(e)
            }, window.updateHeader = function(e) {
                var a = null == e ? $("#slider-range").slider("value") : e;
                $("#i_value").val(a), $("#i_chance").val(("lower" === t ? a : 100 - a) + "%"), $('.dice__options__content__chance--porcent').html(("lower" === t ? a : 100 - a) + "%")
            }, window.getDiceProfit = function(e, tt, a) {
                if (isNaN(a)) {
                    a = $('#i_value').val();
                }
                let mlt = t === 'lower' ? ml[a] : ml[100-a];
                pft = mlt;
                pftp = a;
                $('.dice__options__content__multiplier--number').html("x" + mlt);
                return t === 'lower' ? (e * mlt).toFixed(2) : (e * mlt).toFixed(2);
            }, window.diceauto = function() {
                $('.outcome-window').fadeOut(200);
                clearInterval(cli);
                $('.outcome-window-lose').fadeOut(200);
                clearInterval(clI);

                b = $('#bet').val();

                cl = 1;

                const xhr = new XMLHttpRequest();
                const csrfToken = $('meta[name=csrf-token]').attr('content');

                __profit(pftp);

                const data = {
                    bet: b,
                    game_id: 4,
                    type: t,
                    chance: $("#slider-range").slider("value")
                };

                xhr.open("POST", "/api/dice/init");

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

                            executeManual(response);
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

                if (isDiceAuto) {
                    xhr.send(JSON.stringify(data));
                } else {
                    cl = 0;
                }
            }, window.retrygame = function() {
            }, window.diceautotry = function() {
            }, window.stopauto = function() {
            }, window.dice = function() {
                if (pcs == false) {
                    cl = 1;
                    aPb(cl);
                    pcs = true;
                    $('.outcome-window').fadeOut(200);
                    clearInterval(cli);
                    $('.outcome-window-lose').fadeOut(200);
                    clearInterval(clI);
                    __profit
                    if ($('#bet').val() >= 1) {
                        b = $('#bet').val();

                        const xhr = new XMLHttpRequest();
                        const csrfToken = $('meta[name=csrf-token]').attr('content');

                        __profit(pftp);

                        const data = {
                            bet: b,
                            game_id: 4,
                            type: t,
                            chance: $("#slider-range").slider("value")
                        };

                        xhr.open("POST", "/api/dice/init");

                        xhr.setRequestHeader('Content-Type', 'appication/json');
                        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                        xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

                        xhr.onload = () => {
                            if (xhr.status >= 200 && xhr.status < 300) {
                                const response = JSON.parse(xhr.responseText);

                                if (response.status === 200) {
                                    urs.push("User" + response.uid + "...");
                                    b2 = response.new_balance;
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

                                    executeManual(response);
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
            }, window.executeManual = function(t) {
                if (o >= 0) {
                    o = o - 1;
                }

                if (!1 !== clicked) {
                    return iziToast.info({
                        message: iziGTr(1),
                        icon: "fa fa-info"
                    }), setTimeout(function() {
                        clicked = !1
                    }, 100);
                }

                if (parseFloat($('#bet_profit').html()) <= 0) {
                    return iziToast.error({
                        message: "The winning amount must be higher than 0.<br>Adjust the bet and chance.",
                        icon: "fa fa-times",
                        position: "bottomCenter"
                    });
                } else {
                    if (null != t.error) return "$" === t.error && load("/"), -1 === t.error && $("#b_si").click(), 0 === t.error && iziToast.error({
                        message: "Permissible value: 1% - 94%",
                        icon: "fa fa-times"
                    }), clicked = !1, 1 === t.error && iziToast.error({
                        message: 'Minimum bet: 1&nbsp;<i class="fad fa-coins"></i>',
                        icon: "fa fa-times"
                    }), clicked = !1, 2 === t.error && $("#_payin").click(), void(clicked = !1);
                    rollAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/roll.mp3" : "", isSoundOn ? rollAudio.play() : null;
                    var r = !1 !== t.response.result;
                    $("#circle").fadeIn("fast"), $("#circle").css({
                        left: "calc(" + t.response.number + "% - 3px)",
                        color: r ? "green" : "red",
                        "transition-duration": "1.5s"
                    }), $("#result").toggleClass("lose", !r), showResult(r), setTimeout(function() {
                        0 == r && (loseAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/lose.mp3" : "", isSoundOn ? loseAudio.play() : null);
                        if (!0 == r && winMulti > !1) {
                            winMulti = winMulti - 1
                        }

                        isDiceAuto ? setTimeout(() => {
                            if (winMulti == - 1) {
                                if (o == -1) {
                                    diceauto();
                                } else {
                                    if (o > 0) {
                                        diceauto();
                                    } else {
                                        isDiceAuto = false, $('#bet_btn_auto').text(gBtT('jogar')), cl = 0;
                                    }
                                }
                            } else {
                                if (winMulti > 0) {
                                    if (o == -1) {
                                        diceauto();
                                    } else {
                                        if (o > 0) {
                                            diceauto();
                                        } else {
                                            isDiceAuto = false, $('#bet_btn_auto').text(gBtT('jogar')), cl = 0;
                                        }
                                    }
                                } else {
                                    isDiceAuto = false, $('#bet_btn_auto').text(gBtT('jogar')), cl = 0;
                                }
                            }
                        }, 3000) : null
                    }, 1300), $("#result").text(t.response.number), $("#result").css({
                        opacity: 1
                    }), $("#result").css({
                        left: "calc(" + t.response.number + "% - 16px)",
                        "transition-duration": "1.5s"
                    }), clearTimeout(a), a = setTimeout(function() {
                        $("#result").css({
                            opacity: 0
                        }), $("#circle").fadeOut("fast")
                    }, 7e3), setTimeout(function() {
                        clicked = !1
                    }, 100), o && isDemo && isGuest() && showDemoTooltip(), -1 === t.response.id || isDemo || sendDrop(t.response.id), validateTask(t.response.id), updateBalanceN(), take(t)
                }
            }, window.executeAuto = function() {
            }, window.take = function(t) {
                if (t.response.result) {
                    const xhr = new XMLHttpRequest();
                    const csrfToken = $('meta[name=csrf-token]').attr('content');

                    const data = {
                        winnings: parseFloat(pft).toFixed(2) * parseFloat(b).toFixed(2),
                        game_id: 4,
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
                                b2 = response.new_balance;

                                let delay = setInterval(function() {
                                    uapts(1);
                                    $('#mul').html($("#slider-range").slider("value") + '%');
                                    $('#val').html(parseFloat(data.winnings).toFixed(2));

                                    winAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/win.mp3" : "";
                                    if (isSoundOn) {
                                        winAudio.play()
                                    }

                                    $('.outcome-window').fadeIn(200);
                                    cli = setInterval(() => {
                                        $('.outcome-window').fadeOut(200);
                                        clearInterval(cli);
                                    }, 3000);

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

                                    pcs = false;
                                    !isDiceAuto ? (cl = 0, aPb(cl)) : null;
                                    clearInterval(delay);
                                }, 1500);
                            }
                        } else if (xhr.status == 419) {
                            $('#modal_please_login').addClass('md-show');
                        } else {
                            console.log(new Error(xhr.statusText));
                        }
                    };

                    xhr.send(JSON.stringify(data));
                } else {
                    let delay = setInterval(function() {
                        !isDiceAuto ? (cl = 0, aPb(cl)) : null;
                        uapts(0);
                        $('.outcome-window-lose').fadeIn(200);
                        clI = setInterval(() => {
                            $('.outcome-window-lose').fadeOut(200);
                            clearInterval(clI);
                        }, 3000);
                        pcs = false;
                        clearInterval(delay);
                    }, 1500);
                }
            }, window.showResult = function(o) {
                let delay = setInterval(function() {
                    $("#result").toggleClass("win", o);
                    clearInterval(delay);
                    rollDice();
                });
            }, window.rollDice = function() {
                const dice = [...document.querySelectorAll(".die-list")];
                dice.forEach(die => {
                    toggleClasses(die);
                    die.dataset.roll = getRandomNumber(1, 9);
                });
            }, window.toggleClasses = function(die) {
                die.classList.toggle("odd-roll");
                die.classList.toggle("even-roll");
                die.classList.toggle("third-sibling")
            }, window.getRandomNumber = function(min, max) {
                min = Math.ceil(min);
                max = Math.floor(max);
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }, window.uapts = function (status) {
                urs.push($('.dice__options__content__multiplier--number').text());
                urs.push(b);

                var result = urs;
                if (apArr.length > 21) {
                    apArr.shift();
                    $('.bet_jogadores').children().last().remove();
                }
                apArr.push(result);
                localStorage.setItem('dce_res', JSON.stringify(apArr));
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
            }, window.ggapts = function() {
                const dce_res = localStorage.getItem('dce_res');
                if (dce_res == null) {
                    for (let i = 1;i <= 22;i++) {
                        var result = gApsts();
                        apArr.push(result);
                        localStorage.setItem('dce_res', JSON.stringify(apArr));
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
                    const aapr = JSON.parse(localStorage.getItem('dce_res'));

                    aapr.forEach((result) => {
                        apArr.push(result);
                        localStorage.setItem('dce_res', JSON.stringify(apArr));
                        var d = document.createElement('div');
                        const flex = "d-flex";
                        const between = "justify-content-between";
                        const centered = "align-items-center";

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
                    localStorage.setItem('dce_res', JSON.stringify(apArr));
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

                    if (!isNaN(result[1])) {
                        d2.textContent = 'x' + result[1];
                    } else {
                        d2.textContent = 'x' + 1.81;
                    }
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
                if ($('#dice_music').attr('data-music') == 'on') {
                    isSoundOn = true;
                } else {
                    isSoundOn = false;
                }
            }, ggapts(), gapts(), checkSound(), $('#dice_music').on("click", function() {
                if ($('#dice_music').attr('data-music') == 'on') {
                    isSoundOn = false;
                    $('#dice_music').attr('data-music', 'off');
                } else {
                    isSoundOn = true;
                    $('#dice_music').attr('data-music', 'on');
                }
            }), $('#auto').click(function() {
                if (!isDiceAuto) {
                    if (cl == 0) {
                        if ($('#bet').val() >= 1 && cl == 0) {
                            winMulti = parseInt($('.victory_input').val());
                            o = parseInt($('.bomb_input').val());
                            if (o != 0) {
                                isDiceAuto = true;
                                $('#bet_btn_auto').text(gBtT('parar'));

                                diceauto();
                            } else {
                                return iziToast.info({
                                    message: iziGTr(6),
                                    icon: "fa fa-info"
                                }), setTimeout(function() {
                                    clicked = !1
                                }, 100);
                            }
                        } else {
                            return iziToast.info({
                                message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                                icon: "fa fa-info"
                            }), setTimeout(function() {
                                clicked = !1
                            }, 100);
                        }
                    } else {
                        return iziToast.info({
                            message: iziGTr(1),
                            icon: "fa fa-info"
                        }), setTimeout(function() {
                            clicked = !1
                        }, 100);
                    }
                } else {
                    cl = 0;
                    isDiceAuto = false;
                    $('#bet_btn_auto').text(gBtT("jogar"));
                }
            })
        })
    }
});

var __profit = function(val) {
    if(typeof window.cur !== 'string') {
        setTimeout(function() {
            __profit(val);
        }, 100);
        return;
    }
    var v = val == null ? $('#slider-range').slider('value') : val;
    var r = getDiceProfit($('#bet').val(), cur === 'lower' ? 0 : v, cur === 'higher' ? 100 : v);

    $('.bet_profit').toggleClass('bet_profit-error', parseFloat(r) <= 0);
};
