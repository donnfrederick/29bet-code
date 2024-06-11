! function(e) {
    var a = {};

    function t(i) {
        if (a[i]) return a[i].exports;
        var o = a[i] = {
            i: i,
            l: !1,
            exports: {}
        };
        return e[i].call(o.exports, o, o.exports, t), o.l = !0, o.exports
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
            for (var o in e) t.d(i, o, function(a) {
                return e[a]
            }.bind(null, o));
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
    }, t.p = "/", t(t.s = 3)
}({
    3: function(e, a, t) {
        e.exports = t("UPzd")
    },
    UPzd: function(e, a) {
        $.on("/mines", function() {
            var mulArr = [
                    1.03, 1.12, 1.23, 1.35, 1.5, 1.66, 1.86, 2.09, 2.37, 2.71, 3.13, 3.65, 4.31, 5.18, 6.33, 7.91, 10.17, 13.57, 19, 28.5, 47.5, 1.07, 1.23, 1.41, 1.64, 1.91, 2.25, 2.67, 3.21, 3.9, 4.8, 6, 7.63, 9.93, 13.24, 18.2, 26.01, 39.01, 62.42, 1.13, 1.35, 1.64, 2, 2.48, 3.1, 3.92, 5.04, 6.6, 8.8, 12, 16.8, 24.77, 36.41, 57.22, 95.37, 1.18, 1.5, 1.91, 2.48, 3.25, 4.34, 5.89, 8.15, 11.55, 16.8, 25.21, 39.21, 63.72, 109.25, 1.25, 1.66, 2.25, 3.1, 4.34, 6.2, 9.06, 13.59, 21, 33.61, 56.02, 98.04, 182.08, 1.31, 1.86, 2.67, 3.92, 5.89, 9.06, 14.34, 23.48, 39.91, 70.96, 133.06, 1.39, 2.09, 3.21, 5.04, 8,15, 13.59, 23.48, 42.26, 79.83, 159.67, 1.48, 2.37, 3.9, 6.6, 11.55, 21, 39.91, 79.83, 169.65, 1.58, 2.71, 4.8, 8.8, 16.8, 33.61, 70.96, 159.67, 1.69, 3.13, 6, 12, 25.21, 56.02, 133.06, 342.15, 1.82, 3.65, 7.63, 16.8, 39.21, 98.04, 266.12, 1.97, 4.31, 9.93, 24.27, 63.72, 182.08, 2.15, 5.18, 13.24, 36.41, 109.25, 364.16, 2.37, 6.33, 18.2, 57.22, 200.29, 2.63, 7.91, 26.01, 95.37, 400.58, 2.96, 10.17, 39.01, 171.67, 3.39, 13.57, 62.42, 343.35, 3.95, 19, 109.25, 4.75, 28.5, 218.5, 5.93, 47.5, 546.25, 7.91, 95, 11.87, 285, 23.75
                ],
                e = 3,
                a = 15,
                t = !0,
                i = !1,
                o = !1,
                s = 25 - e,
                n = 0,
                r = !1,
                l = !1,
                d = null,
                b = 0,
                b2 = 0,
                fg = [],
                fm = [],
                fl = 0,
                fp = 0,
                cl = 0,
                cf = 0,
                cfI = 0,
                cd = 0
                clI = null,
                cli = null,
                apArr = [],
                urs = [],
                ghid = 0,
                isSoundOn = true;
            betAudio = new Audio, minesAudio = new Audio, winAudio = new Audio, loseAudio = new Audio, window.setMode = function(e, a) {
                $("*[data-tab]").toggleClass("active", !1), $("*[data-tab=" + e + "]").toggleClass("active", !0), "default" === e && (auto = 0, $("#auto").fadeOut(0), $("#gamestext").fadeOut(0), $("#gamesvalue").fadeOut(0), $("#gamesvictory").fadeOut(0), $("#gamesvictoryvalue").fadeOut(0), $("#play").fadeIn(0)), "auto" === e && (auto = 1, $("#play").fadeOut(0), $("#gamestext").fadeIn(0), $("#gamesvalue").fadeIn(0), $("#gamesvictory").fadeIn(0), $("#gamesvictoryvalue").fadeIn(0), $("#auto").fadeIn(0))
            }, window.minesauto = function() {
                return iziToast.warning({
                    message: "O lance automático está temporariamente indisponível!",
                    icon: "fa fa-info"
                }), setTimeout(function() {
                    l = !1
                }, 100)
            }, window.mines = function() {
                if ($('#bet').val() >= 1) {
                    b = $('#bet').val();

                    const xhr = new XMLHttpRequest();
                    const csrfToken = $('meta[name=csrf-token]').attr('content');

                    const data = {
                        bet: b,
                        game_id: 3,
                        mines: e
                    };

                    xhr.open("POST", "/api/mines/init");

                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

                    xhr.onload = () => {
                        if (xhr.status >= 200 && xhr.status < 300) {
                            const response = JSON.parse(xhr.responseText);

                            if (response.status === 200) {
                                fm = response.multiplier;
                                b2 = response.new_balance;
                                ghid = response.ghid;
                                cf = Number(response.c);
                                cfI = Number(response.i);
                                urs.push("User" + response.uid + "...");

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

                                initExec();
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
            }, window.take = function() {
                if (cl == 1) {
                    gBm(e - 1);
                    cl = 0;
                    const xhr = new XMLHttpRequest();
                    const csrfToken = $('meta[name=csrf-token]').attr('content');

                    uapts(1);

                    const data = {
                        winnings: fp,
                        game_id: 3,
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
                                $('.slick-slider').slick('slickGoTo', 0);
                                execTake();

                                $('#money').attr('data-current-balance', response.new_balance);
                                $('#money_update').html("+$" + parseFloat(fp).toFixed(2));
                                $('#div_money_update').css('display', "block");
                                $('#money_update').css('color', "yellow");

                                setTimeout(function() {
                                    $('#div_money_update').css('display', "none");
                                    $('.moremoney__gif').fadeIn(200);
                                    $('#money_gif__gain').attr('src', 'https://cdn.29bet.com/assets/img/all/icons/coin-gif.gif');

                                    setTimeout(() => {
                                        $('#money').html(response.new_balance);
                                        $('.moremoney__gif').fadeOut(200);
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
                }
            }, window.setStatus = function(a) {
                void 0 === a && (a = 25), $("#bomb").prop("number", p_n("#bomb")).animateNumber({
                    number: e
                }), $("#safe").prop("number", p_n("#safe")).animateNumber({
                    number: a - e
                })
            }, window.clear = function() {
                setStatus(), s = 25 - e, n = 0, $("*[data-grid-id]").removeAttr("class"), $("*[data-grid-id]").toggleClass("mine_disabled", !0), setBetText(gBtT("jogar")), $("#play").attr("onclick", "mines()"), d = null, o = !1, cd = 0
            }, window.swap = function(e) {
                t = e, $("*[data-grid-id]").toggleClass("mine_disabled", e)
            }, window.clear_c = function() {
                const xhr = new XMLHttpRequest();
                const csrfToken = $('meta[name=csrf-token]').attr('content');

                xhr.open("GET", "/game/mines/mul/" + e);

                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

                xhr.onload = () => {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        const t = JSON.parse(xhr.responseText);
                        r && $("#cf_slick").slick("unslick"), r = !0, $("#cf_slick").html("");
                        for (var i = 0; i < 25 - e; i++) $("#cf_slick").append('<div class="mines__box__history" data-diamond="' + (i + 1) + '"><p class="number__wins__history"> ' + (i + 1) + "</p><p class='number__box__history'>x" + abbreviateNumber(t[(i + 1).toString()]) + "</p></div>");
                        $('#cf_slick').removeClass('slick-initialized');
                        $('#cf_slick').removeClass('slick-slider');

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
                    } else if (xhr.status == 419) {
                        $('#modal_please_login').addClass('md-show');
                    } else {
                        window.location.reload();
                    }
                };

                xhr.send();
            }, window.displayGrid = function(e) {
                for (var a = Array.from(e), t = 0; t < 25; t++) $('*[data-grid-id="' + t + '"]').toggleClass(1 === a[t] ? "mine_bomb" : "mine_safe", !0)
            }, window.shuffleArray = function(r) {
                for (let i = r.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [r[i], r[j]] = [r[j], r[i]];
                }
                return r;
            }, window.initExec = function() {
                if (!1 !== l) return iziToast.info({
                    message: iziGTr(1),
                    icon: "fa fa-info"
                }), setTimeout(function() {
                    l = !1
                }, 100);

                let g = [];
                for (let i = 0;i <= 24;i++) {
                    g.push(0);
                }

                if (b < 1) {
                    return iziToast.error({
                        message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                        icon: "fa fa-times"
                    });
                } else {
                    if (e < 3 || e > 24) {
                        return iziToast.error({
                            message: iziGTr(2),
                            icon: "fa fa-times"
                        });
                    } else {
                        fg = g;
                        clear(), $(".outcome-window").fadeOut(200), clearInterval(clI),
                        $(".outcome-window-lose").fadeOut(200), clearInterval(cli), betAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/bet.mp3" : "", isSoundOn ? betAudio.play(): null,
                        $("#play").attr("onclick", "take()").attr('disabled', true), setTimeout(function() {
                            l = !1
                        }, 200), $("*[data-diamond]").toggleClass("cf_active", !1), swap(!1), _disableDemo = !0
                    }
                }
            }, window.execTake = function() {
                const demo = 0;
                const ml = Object.values(fm);
                winAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/win.mp3" : "", isSoundOn ? winAudio.play(): null, 1 == demo || (validateTask(d), $(".outcome-window__coeff").text("x" + ml[fl - 1]), $('.btn_outcome').click(),
                $(".outcome-window_won__sum").text(parseFloat(fp).toFixed(2)),
                $(".outcome-window").fadeIn(200), clI = setInterval(() => {$(".outcome-window").fadeOut(200);clearInterval(clI)}, 3000)), isDemo && isGuest() && showDemoTooltip(), 1 == demo && ($(".outcome-window__coeff-demo").text("x" + ml[fl - 1]), $(".outcome-window_won__sum").text(parseFloat(fp).toFixed(2))), swap(!0), clear(), updateBalanceN(), displayGrid(fg), l = !1, _disableDemo = !1, fg = [], fm = [], fl = 0
            }, window.gBm = function(bc) {
                let bmc = 0,
                    zs = [];

                fg.forEach((v, k) => {
                    if (v == 1) {
                        bmc += 1;
                    }

                    if (v == 0) {
                        zs.push(k);
                    }
                });

                fg[zs[mkRdI(0, zs.length - 1)]] = 1;

                if (bmc < bc) {
                    gBm(bc);
                }
            }, window.getFG = function(dg) {
                const dst = getDist();
                return dst == 1? swFG(dg) : fg;
            }, window.swFG = function(dg) {
                if (fg[dg] == 0) {

                    fg[dg] = 1;
                    gBm(e - 1);

                    return fg;
                } else return fg;
            }, window.getDist = function() {
                const wc = 100 - cf;

                let cd = [];

                for (let j = 1;j <= wc; j++) {
                    cd.push(0);
                }

                for (let i = 1;i <= cf; i++) {
                    cd.push(1);
                }

                shuffleArray(cd);

                return cd[Math.floor(Math.random() * 99)];
            }, window.uapts = function (status) {
                const ml = Object.values(fm);

                if (fl == 0) {
                    urs.push(ml[fl]);
                } else {
                    urs.push(ml[fl - 1]);
                }

                urs.push(b);

                var result = urs;
                if (apArr.length > 21) {
                    apArr.shift();
                    $('.bet_jogadores').children().last().remove();
                }
                apArr.push(result);
                localStorage.setItem('mns_res', JSON.stringify(apArr));
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
                const mns_res = localStorage.getItem('mns_res');
                if (mns_res == null) {
                    for (let i = 1;i <= 22;i++) {
                        var result = gApsts();
                        apArr.push(result);
                        localStorage.setItem('mns_res', JSON.stringify(apArr));
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
                    const aapr = JSON.parse(localStorage.getItem('mns_res'));

                    aapr.forEach((result) => {
                        apArr.push(result);
                        localStorage.setItem('mns_res', JSON.stringify(apArr));
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
                    localStorage.setItem('mns_res', JSON.stringify(apArr));
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
                if ($('#mines_music').attr('data-music') == 'on') {
                    isSoundOn = true;
                } else {
                    isSoundOn = false;
                }
            }, ggapts(), gapts(), checkSound();
            var c = !1,
                u = !1;
            $("#change_bombs").on("click", function() {
                c || (c = !0, $("#change_bombs span").toggleClass("dn", !0), $("#change_bombs input").toggleClass("dn", !1), $(".bomb_input").on("input", function() {
                    var a = parseInt($(this).val());
                    if (isNaN(a) || a < 3 || a > 24) return $(this).toggleClass("bad", !0), void(i = !0);
                    $(this).toggleClass("bad", !1), i = !1, e = a, $("*[data-bomb]").toggleClass("bc_active", !1), $('*[data-bomb="' + e + '"]').toggleClass("bc_active", !0), clear_c(), setStatus()
                }).focus())
            }), $("#change_games").on("click", function() {
                u || (u = !0, $("#change_games span").toggleClass("dn", !0), $("#change_games input").toggleClass("dn", !1), $(".bomb_input").on("input", function() {
                    var e = parseInt($(this).val());
                    if (isNaN(e) || e < 1 || e > 240) return $(this).toggleClass("bad", !0), void(i = !0);
                    $(this).toggleClass("bad", !1), i = !1, a = e, $("*[data-games]").toggleClass("bc_active", !1), $('*[data-games="' + a + '"]').toggleClass("bc_active", !0)
                }).focus())
            }), $("*[data-bomb]").on("click", function(a) {
                t ? ($("*[data-bomb]").toggleClass("bc_active", !1), $(this).toggleClass("bc_active", !0), e = parseInt($(this).attr("data-bomb")), $(".bomb_input").val(e), setStatus(), clear_c()) : a.preventDefault()
            }), $("*[data-games]").on("click", function() {
                $("*[data-games]").toggleClass("bc_active", !1), $(this).toggleClass("bc_active", !0), a = parseInt($(this).attr("data-games")), $(".games_input").val(a)
            }), $("*[data-victory]").on("click", function() {
                $(this).attr("*[data-victory]"), $(".buttons-3-selected").removeClass("buttons-3-selected"), $(this).addClass("buttons-3-selected"), parseInt($(this).attr("data-victory"))
            }), $("*[data-grid-id]").on("click", function() {
                if (!cd === !0) {
                    if (!($(this).hasClass("mine_disabled") || t || $(this).hasClass("mine_safe"))) {
                        var a = parseInt($(this).attr("data-grid-id"));
                        const ml = Object.values(fm);

                        const nfg = getFG(a);
                        if (nfg[a] == 0) {
                            fg[a] = 2;
                            cl = 1, s -= 1, n += 1, setStatus(s + e), $('#play').attr("disabled", false), $(this).toggleClass("mine_disabled", !0), $(".slick-slide").toggleClass("cf_active", !1), $("*[data-diamond=" + n + "]").toggleClass("cf_active", !0), $("*[data-grid-id=" + a + "]").toggleClass("mine_safe", !0), minesAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/game.mp3" : "", isSoundOn ? minesAudio.play() : null;
                            fp = parseFloat(ml[fl] * b).toFixed(2);
                            o ? $("#cf_profit").html(fp) : (setBetText(gBtT("pegar") + '<br><span id="cf_profit">' + fp + '</span> &nbsp;<i class="fad fa-coins"></i>'), o = !0), setTimeout(function() {
                                $("#cf_profit").toggleClass("cf_profit-error", parseFloat(fp) <= 0)
                            }, 200), 0 === s && take(), fl += 1, cf += cfI, slckSld()
                        } else setBetText(gBtT("jogar")),
                        $('#play').attr("disabled", true), cl = 0, cd = 1, validateTask(d), loseAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/bomb.mp3" : "", isSoundOn ? loseAudio.play() : null,$('.btn_outcome_lose').click(), l = !1, uapts(0), fg = [], fm = [], fl = 0, fp = 0,
                        $("*[data-grid-id=" + a + "]").toggleClass("mine_bomb", !0),
                        $("*[data-diamond=" + n + "]").toggleClass("cf_active", !1),
                        setTimeout(function() {
                            updateBalanceN(), swap(!0), clear(), displayGrid(nfg),
                            $(".outcome-window-lose").fadeIn(200), cli = setInterval(() => {
                                $(".outcome-window-lose").fadeOut(200);clearInterval(cli)}, 3000)
                        }, 1e3), setTimeout(() => {
                            $('#play').attr('onclick', 'mines()').attr("disabled", false)}, 1000),
                            $('.slick-slider').slick('slickGoTo', 0)
                    }
                }
            }), $('#mines_music').on("click", function() {
                if ($('#mines_music').attr('data-music') == 'on') {
                    isSoundOn = false;
                    $('#mines_music').attr('data-music', 'off');
                } else {
                    isSoundOn = true;
                    $('#mines_music').attr('data-music', 'on');
                }
            }), slckSld = function() {
                const pgs = {
                    3: [7, 13, 19],
                    4: [7, 13, 19],
                    5: [7, 13, 19],
                    6: [7, 13, 19],
                    7: [7, 13],
                    8: [7, 13],
                    9: [7, 13],
                    10: [7, 13],
                    11: [7, 13],
                    12: [7, 13],
                    13: [7],
                    14: [7],
                    15: [7],
                    16: [7],
                    17: [7],
                    18: [7]
                };

                let pg_ks = 0;

                Object.keys(pgs).forEach((v) => {
                    if (e == v) {
                        pg_ks == v;
                    }
                });

                let pgs_vl = 0;

                Object.values(pgs)[pg_ks].forEach((v) => {
                    if (fl == v) {
                        pgs_vl = v;
                    }
                });

                if (pgs_vl != 0) {
                    $('.slick-slider').slick('slickGoTo', pgs_vl);
                }
            }
        })
    }
});
var __profit = function() { };
$(document).ready(function() {
    const xhr = new XMLHttpRequest();
    const csrfToken = $('meta[name=csrf-token]').attr('content');

    xhr.open("GET", "/game/mines/mul/3");

    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

    xhr.onload = () => {
        if (xhr.status >= 200 && xhr.status < 300) {
            const t = JSON.parse(xhr.responseText);

            $("#cf_slick").html("");
            for (var i = 0; i < 22; i++) $("#cf_slick").append('<div class="mines__box__history" data-diamond="' + (i + 1) + '"><p class="number__wins__history"> ' + (i + 1) + "</p><p class='number__box__history'>x" + abbreviateNumber(t[(i + 1).toString()]) + "</p></div>");
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
        } else if (xhr.status == 419) {
            $('#modal_please_login').addClass('md-show');
        } else {
            window.location.reload();
        }
    };

    xhr.send();
});
