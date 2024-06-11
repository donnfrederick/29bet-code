$.on("/keno", function() {
    let e = {
            1: [0, 3.8],
            2: [0, 1.7, 5.2],
            3: [0, 0, 2.7, 48],
            4: [0, 0, 1.7, 10, 84],
            5: [0, 0, 1.4, 4, 14, 290],
            6: [0, 0, 0, 3, 9, 160, 720],
            7: [0, 0, 0, 2, 7, 30, 280, 800],
            8: [0, 0, 0, 2, 4, 10, 50, 300, 850],
            9: [0, 0, 0, 2, 2.5, 4.5, 12, 60, 320, 900],
            10: [0, 0, 0, 1.5, 2, 4, 6, 22, 80, 400, 1e3]
        },
        o = [],
        t = !1,
        i = 15,
        a = !1,
        s = 0,
        n = 0,
        d = 0,
        c = 0,
        u = !1,
        r = !1,
        b = 0,
        b2 = 0
        clI = null,
        cli = null,
        cl = 0,
        identifier = 0,
        mulArr = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.4, 1.4, 1.4, 1.4, 1.5, 1.5, 1.5, 1.5, 1.7, 1.7, 1.7, 1.7, 2, 2, 2, 2, 2.7, 2.7, 2.7, 3, 3, 3, 3.8, 3.8, 3.8, 4, 4, 4, 4.5, 4.5, 4.5, 5, 5, 5.2, 5.2, 6, 6, 10, 10, 12, 12, 14, 14, 50, 60, 80, 84, 290, 400, 720, 800, 850, 900, 1000, 14, 14, 12, 12, 10, 10, 6, 6, 5.2, 5.2, 5, 5, 4.5, 4.5, 4.5,  4, 4, 4, 3.8, 3.8, 3.8, 3, 3, 3, 2.7, 2.7, 2.7, 2, 2, 2, 2, 1.7, 1.7, 1.7, 1.7, 1.5, 1.5, 1.5, 1.5, 1.4, 1.4, 1.4, 1.4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        apArr = [],
        urs = [], isKenoAuto = false, winMulti = 1,
        mml = 0, dlyNtrvl = null, isSoundOn = true, ghid = 0;
    win5 = 0, betAudio = new Audio, winAudio = new Audio, openAudio = new Audio, clickAudio = new Audio, emptyAudio = new Audio, loseAudio = new Audio, window.setMode = function(e, o) {
        if (cl == 0 && !isKenoAuto) {
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
    }, window.keno = function() {
        if (cl == 0) {
            const btMTr = [
                "Choose from 1 to 10 space",
                "Escolha de 1 a 10 espaço",
                "选择 1 到 10 个空格"
            ];

            let msg;

            if ($('#frm_brand').val() == 'en') {
                msg = btMTr[0];
            } else if ($('#frm_brand').val() == 'pt') {
                msg = btMTr[1];
            } else {
                msg = btMTr[2];
            }

            if (o.length > 0) {
                $(".keno-picked").removeClass("keno-picked"), $(".keno-correct").removeClass("keno-correct"), r = !0;

                if ($('#bet').val() >= 1) {
                    cl = 1;
                    $("#play").text(gBtT("aguarde")).attr('disabled', true);
                    b = $('#bet').val();
                    const xhr = new XMLHttpRequest();
                    const csrfToken = $('meta[name=csrf-token]').attr('content');

                    const data = {
                        bet: b,
                        game_id: 12,
                        slots: o
                    };

                    xhr.open("POST", "/api/keno/result");

                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

                    xhr.onload = () => {
                        if (xhr.status >= 200 && xhr.status < 300) {
                            const response = JSON.parse(xhr.responseText);

                            if (response.status === 200) {
                                b2 = response.n;
                                urs.push("User" + response.uid + "...");
                                ghid = response.ghid;

                                $('#money').attr('data-current-balance', response.n);
                                $('#money_update').html("-$" + parseFloat(b).toFixed(2));
                                $('#div_money_update').css('display', "block");
                                $('#money_update').css('color', "red");

                                setTimeout(function() {
                                    $('#money').html(response.n);
                                    $('#div_money_update').css('display', "none");
                                    $('.lessmoney__gif').fadeIn(200);
                                    $('#money_gif__lose').attr('src', 'https://cdn.29bet.com/assets/img/all/icons/coin-gif.gif');

                                    setTimeout(() => {
                                        $('.lessmoney__gif').fadeOut(0);
                                        $('#money_gif__lose').attr('src', '');
                                    }, 1300);
                                }, 3000);

                                initExec(response.game);
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
            } else {
                return iziToast.error({
                    message: msg,
                    icon: "fa fa-times",
                    position: "bottomCenter"
                });
            }
        }
    }, window.kenoauto = function() {
        b = $('#bet').val(), cl = 1;

        const btMTr = [
            "Choose from 1 to 10 space",
            "Escolha de 1 a 10 espaço",
            "选择 1 到 10 个空格"
        ];

        let msg;

        if ($('#frm_brand').val() == 'en') {
            msg = btMTr[0];
        } else if ($('#frm_brand').val() == 'pt') {
            msg = btMTr[1];
        } else {
            msg = btMTr[2];
        }

        if (o.length > 0) {
            $(".keno-picked").removeClass("keno-picked"), $(".keno-correct").removeClass("keno-correct"), r = !0

            if ($('#bet').val() >= 1) {
                b = $('#bet').val();
                const xhr = new XMLHttpRequest();
                const csrfToken = $('meta[name=csrf-token]').attr('content');

                const data = {
                    bet: b,
                    game_id: 12,
                    slots: o
                };

                xhr.open("POST", "/api/keno/result");

                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

                xhr.onload = () => {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        const response = JSON.parse(xhr.responseText);

                        if (response.status === 200) {
                            b2 = response.n;
                            urs.push("User" + response.uid + "...");
                            ghid = response.ghid;

                            $('#money').attr('data-current-balance', response.n);
                            $('#money_update').html("-$" + parseFloat(b).toFixed(2));
                            $('#div_money_update').css('display', "block");
                            $('#money_update').css('color', "red");

                            setTimeout(function() {
                                $('#money').html(response.n);
                                $('#div_money_update').css('display', "none");
                                $('.lessmoney__gif').fadeIn(200);
                                $('#money_gif__lose').attr('src', 'https://cdn.29bet.com/assets/img/all/icons/coin-gif.gif');

                                setTimeout(() => {
                                    $('.lessmoney__gif').fadeOut(0);
                                    $('#money_gif__lose').attr('src', '');
                                }, 1300);
                            }, 3000);

                            initExec(response.game);
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

                if (isKenoAuto) {
                    xhr.send(JSON.stringify(data));
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
            return iziToast.error({
                message: msg,
                icon: "fa fa-times",
                position: "bottomCenter"
            });
        }
    }, window.initExec = function(o) {
        if (i >= 0) {
            i = i - 1;
        }
        betAudio.src = isAudioGame ? "/assets/media/bet.mp3" : "", isSoundOn ? betAudio.play() : null, $(".outcome-window").fadeOut(200), clearInterval(clI), $(".outcome-window-lose").fadeOut(200), clearInterval(cli), 0 == o.demo && updateBalanceN(void 0, -parseFloat($("#bet").val()));
        let t = function(e, o) {
            setTimeout(function() {
                o(1), setTimeout(function() {
                    o(2), setTimeout(function() {
                        o(3), setTimeout(function() {
                            o(4), setTimeout(function() {
                                o(5), setTimeout(function() {
                                    o(6), setTimeout(function() {
                                        o(7), setTimeout(function() {
                                            o(8), setTimeout(function() {
                                                o(9), setTimeout(function() {
                                                    o(10)
                                                }, 300)
                                            }, 300)
                                        }, 300)
                                    }, 300)
                                }, 300)
                            }, 300)
                        }, 300)
                    }, 300)
                }, 300)
            }, 300)
        };
        t(isQuick ? 20 : 100, function(e) {
            identifier += 1;
            if (identifier >= 10) {
                identifier = 0;
                initTake(o);

                if (o.win > 0 && winMulti > !1) {
                    winMulti = winMulti - 1
                }

                isKenoAuto ? setTimeout(() => {
                    if (winMulti == - 1) {
                        if (i == -1) {
                            kenoauto();
                        } else {
                            if (i > 0) {
                                kenoauto();
                            } else {
                                isKenoAuto = false, $('#bet_btn_auto').text(gBtT('jogar')), cl = 0;
                            }
                        }
                    } else {
                        if (winMulti > 0) {
                            if (i == -1) {
                                kenoauto();
                            } else {
                                if (i > 0) {
                                    kenoauto();
                                } else {
                                    isKenoAuto = false, $('#bet_btn_auto').text(gBtT('jogar')), cl = 0;
                                }
                            }
                        } else {
                            isKenoAuto = false, $('#bet_btn_auto').text(gBtT('jogar')), cl = 0;
                        }
                    }
                }, 3000) : null
            }
            if (o.correct.includes(o.grid[e - 1])) {
                $('[data-keno-id="' + o.grid[e - 1] + '"]').addClass("keno-correct"), openAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/open.mp3" : "", isSoundOn ? openAudio.play() : null
            } else {
                $('[data-keno-id="' + o.grid[e - 1] + '"]').addClass("keno-picked"), emptyAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/empty.mp3" : "", isSoundOn ? emptyAudio.play() : null
            }

            10 === e && (updateBalanceN(), r = !1, isDemo && isGuest() && showDemoTooltip(), parseFloat(o.win).toFixed(2) > 0 && (winAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/win.mp3" : "", isSoundOn ? winAudio.play() : null, $(".outcome-window__coeff").text("x" + o.multiplier), $(".outcome-window_won__sum").text(parseFloat(o.win).toFixed(2)), $(".outcome-window").fadeIn(200), clI = setInterval(() => {$(".outcome-window").fadeOut(200);clearInterval(clI)}, 3000)))
        });
    }, window.initTake = function(o) {
        if (o.win > 0) {
            const xhr = new XMLHttpRequest();
            const csrfToken = $('meta[name=csrf-token]').attr('content');

            const data = {
                winnings: o.win,
                game_id: 12,
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
                        mml = o.multiplier;
                        uapts(1);
                        setTimeout(() => {
                            cl = 0;
                            $('#play').text(gBtT("jogar")).attr('disabled', false);
                        }, 700);
                        $('#money').attr('data-current-balance', response.new_balance);
                        $('#money_update').html("+$" + parseFloat(o.profit).toFixed(2));
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
            uapts(0);
            $(".outcome-window-lose").fadeIn(200);
            setTimeout(() => {
                cl = 0;
                $('#play').text(gBtT("jogar")).attr('disabled', false);
            }, 700);
            cli = setInterval(() => {$(".outcome-window-lose").fadeOut(200);clearInterval(cli)}, 3000);
        }
    }, window.retrygame = function() {
        0 == n && ($("#auto").fadeIn("fast").attr("onclick", "stopauto()"), setAutoText(gBtT("parar")), setTimeout(function() {
            r = !1, dlyNtrvl = setInterval(() => {kenoauto();clearInterval(dlyNtrvl)}, 3000)
        }, isQuick ? 500 : 1300)), 1 == n && stopauto()
    }, window.kenoautotry = function() {
        n = 0, c = 1, kenoauto()
    }, window.stopauto = function() {
        n = 1, c = 0, $("#auto").fadeIn(0).attr("onclick", "kenoautotry()"), setAutoText(gBtT("jogar")), i = parseInt($("*[data-games]").attr("data-games"))
    }, window.autopick = function() {
        if (!isKenoAuto) {
            if (!1 !== t) return iziToast.info({
                message: "Подождите...",
                icon: "fa fa-info"
            }), setTimeout(function() {
                t = !1
            }, 100);
            t = !0;
            for (var e = []; e.length <= 10;) {
                var o = Math.floor(40 * Math.random()) + 1;
                $('[data-keno-id="' + o + '"]').click(), e.includes(o) || e.push(o), d = 1
            }
            displayMultiplier(), d = 0, setTimeout(function() {
                t = !1
            }, 250)
        }
    }, window.clearkeno = function() {
        if (!isKenoAuto && o.length > 0) {
            for (let e = 1; e < 41; e++) {
                $('.keno_mul').fadeOut(1);
                $('.welcome-text').fadeIn(350);
                let t = $('[data-keno-id="' + e + '"]').attr("data-keno-id");
                o.includes(t) && ($('[data-keno-id="' + e + '"]').toggleClass("keno_active", !1), $(".keno-picked").removeClass("keno-picked"), $(".keno-correct").removeClass("keno-correct"), $(".outcome-window").fadeOut(300), clearInterval(clI), clickAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/click.mp3" : "", isSoundOn ? clickAudio.play() : null, o = o.filter(e => e !== t))
            }
            displayMultiplier()
        }
    }, window.displayMultiplier = function() {
        u && $("#cf_slick").slick("unslick"), u = !0, $("#cf_slick").html("");
        for (let t = 0; t < e[o.length].length; t++) $("#cf_slick").append('<div class="mines__box__history" data-keno-multiplier="' + t + '"><p class="number__wins__history"> ' + t + "</p><p class='number__box__history'>x" + e[o.length][t] + "</p></div>");
        $("#cf_slick").slick({
            infinite: !1,
            slidesToShow: 6,
            slidesToScroll: 6,
            arrows: false,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 6,
                    slidesToScroll: 6
                }
            }, {
                breakpoint: 600,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4
                }
            }, {
                breakpoint: 480,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            }]
        })
    }, $("*[data-games]").on("click", function() {
        !isKenoAuto && ($("*[data-games]").toggleClass("bc_active", !1), $(this).toggleClass("bc_active", !0), i = parseInt($(this).attr("data-games")), $(".bomb_input").val(i), $('.bomb_input').toggleClass('dn', !0), $("#change_games span").toggleClass("dn", !1))
    }), $("#change_games").on("click", function() {
        !isKenoAuto && (i = 0, $("*[data-games]").toggleClass("bc_active", !1), $("#change_games input").val(''), $("#change_games span").toggleClass("dn", !0), $("#change_games input").toggleClass("dn", !1), $(".bomb_input").on("input", function() {
            var e = parseInt($(this).val());
            if (isNaN(e) || e < 1) return $(this).toggleClass("bad", !0), void(r = !0);
            $(this).toggleClass("bad", !1), r = !1, i = e, $("*[data-games]").toggleClass("bc_active", !1), $('*[data-games="' + o + '"]').toggleClass("bc_active", !0)
        }).focus())
    }), $("*[data-victory]").on("click", function() {
        !isKenoAuto && ($(this).attr("*[data-victory]"), $(".buttons-3-selected").removeClass("buttons-3-selected"), $(this).addClass("buttons-3-selected"), $('.victory_input').val(parseInt($(this).attr("data-victory"))), winMulti = parseInt($('.victory_input').val()))
    }), $("[data-keno-id]").on("click", function() {
        $('.welcome-text').fadeOut(1);
        $('.keno_mul').fadeIn(350);
        if (r) return;
        $(".keno-picked").removeClass("keno-picked"), $(".keno-correct").removeClass("keno-correct");
        let e = $(this).attr("data-keno-id");
        if (o.includes(e)) $(this).toggleClass("keno_active", !1), $(".outcome-window").fadeOut(300), clearInterval(clI), $(".outcome-window-lose").fadeOut(300), clearInterval(cli), console.log("re-setting keno now"), clickAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/click.mp3" : "", isSoundOn ? clickAudio.play() : null, o = o.filter(o => o !== e);
        else {
            if (o.length >= 10) return;
            $(this).toggleClass("keno_active", !0), $(".outcome-window").fadeOut(300), clearInterval(clI), $(".outcome-window-lose").fadeOut(300), clearInterval(cli), o.push(e), clickAudio.src = isAudioGame ? "/assets/media/click.mp3" : "", isSoundOn ? clickAudio.play() : null
        }
        0 == d && displayMultiplier()
    }), window.uapts = function (status) {
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
        mml = 0;
    }, window.ggapts = function() {
        const kno_res = localStorage.getItem('kno_res');
        if (kno_res == null) {
            for (let i = 1;i <= 22;i++) {
                var result = gApsts();
                apArr.push(result);
                localStorage.setItem('kno_res', JSON.stringify(apArr));
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

                if (result[1] != 0) {
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
            const aapr = JSON.parse(localStorage.getItem('kno_res'));

            aapr.forEach((result) => {
                apArr.push(result);
                localStorage.setItem('kno_res', JSON.stringify(apArr));
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

                if (result[1] != 0) {
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
            localStorage.setItem('kno_res', JSON.stringify(apArr));
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

            if (result[1] != 0) {
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
    }, ggapts(), gapts(), window.checkSound = function() {
        if ($('#keno_music').attr('data-music') == 'on') {
            isSoundOn = true;
        } else {
            isSoundOn = false;
        }
    }, $('#keno_music').on("click", function() {
        if ($('#keno_music').attr('data-music') == 'on') {
            isSoundOn = false;
            $('#keno_music').attr('data-music', 'off');
        } else {
            isSoundOn = true;
            $('#keno_music').attr('data-music', 'on');
        }
    }), $('#auto').click(function() {
        if (!isKenoAuto) {
            if (cl == 0) {
                const btMTr = [
                    "Choose from 1 to 10 space",
                    "Escolha de 1 a 10 espaço",
                    "选择 1 到 10 个空格"
                ];

                let msg;

                if ($('#frm_brand').val() == 'en') {
                    msg = btMTr[0];
                } else if ($('#frm_brand').val() == 'pt') {
                    msg = btMTr[1];
                } else {
                    msg = btMTr[2];
                }

                if (o.length > 0) {
                    if ($('#bet').val() >= 1 && cl == 0) {
                        winMulti = parseInt($('.victory_input').val());
                        i = parseInt($('.bomb_input').val());
                        if (i != 0) {
                            isKenoAuto = true;
                            $('#bet_btn_auto').text(gBtT('parar'));

                            kenoauto();
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
                    return iziToast.error({
                        message: msg,
                        icon: "fa fa-times",
                        position: "bottomCenter"
                    });
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
            isKenoAuto = false;
            $('#bet_btn_auto').text(gBtT("jogar"));
        }
    })
});
var __profit = function() { };
