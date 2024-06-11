! function (e) {
    var t = {};

    function o(a) {
        if (t[a]) return t[a].exports;
        var s = t[a] = {
            i: a,
            l: !1,
            exports: {}
        };
        return e[a].call(s.exports, s, s.exports, o), s.l = !0, s.exports
    }
    o.m = e, o.c = t, o.d = function (e, t, a) {
        o.o(e, t) || Object.defineProperty(e, t, {
            enumerable: !0,
            get: a
        })
    }, o.r = function (e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }, o.t = function (e, t) {
        if (1 & t && (e = o(e)), 8 & t) return e;
        if (4 & t && "object" == typeof e && e && e.__esModule) return e;
        var a = Object.create(null);
        if (o.r(a), Object.defineProperty(a, "default", {
                enumerable: !0,
                value: e
            }), 2 & t && "string" != typeof e)
            for (var s in e) o.d(a, s, function (t) {
                return e[t]
            }.bind(null, s));
        return a
    }, o.n = function (e) {
        var t = e && e.__esModule ? function () {
            return e.default
        } : function () {
            return e
        };
        return o.d(t, "a", t), t
    }, o.o = function (e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }, o.p = "/", o(o.s = 5)
}({
    5: function (e, t, o) {
        e.exports = o("aiCU")
    },
    aiCU: function (e, t) {
        $.on("/stairs", function () {
            var e = 4,
                t = 0,
                o = !0,
                a = !1,
                s = !1,
                i = null,
                b = 0,
                b2 = 0,
                fg = [],
                fm = [],
                fp = 0,
                cf = 0
            fl = 0,
                clI = null,
                cli = null,
                cl = 1,
                cr = [],
                rws = [
                    15, 14, 14, 13, 14, 12, 13, 9, 9, 14, 8, 7
                ],
                mulArr = [2.71, 2.38, 2.11, 1.90, 1.73, 1.58, 1.46, 1.36, 1.27, 1.19, 1.12, 1.06, 1.00, 8.60, 6.45, 5.01, 4.01, 3.28, 2.73, 2.31, 1.98, 1.72, 1.50, 1.33, 1.18, 1.06, 30.94, 19.34, 12.89, 9.03, 6.56, 4.92, 3.79, 2.98, 2.38, 1.93, 1.59, 1.33, 1.12, 131.51, 65.75, 36.53, 21.92, 13.95, 9.30, 6.44, 4.60, 3.37, 2.53, 1.93, 1.61, 1.19, 701.37, 263.01, 116.90, 58.45, 31.88, 18.60, 11.44, 7.36, 4.90, 3.37, 2.38, 1.72, 1.27, 438.36, 175.34, 79.70, 39.85, 21.46, 12.26, 7.36, 4.60, 2.98, 1.98, 1.36, 613.70, 223.16, 92.98, 42.92, 21.46, 11.44, 6.44, 3.79, 2.31, 1.46],
                apArr = [], urs = [], cg = 0, nb = e, isSoundOn = true, ghid = 0;
            betAudio = new Audio, winAudio = new Audio, gameAudio = new Audio, loseAudio = new Audio, window.row = function (e, t) {
                $("*[data-row]").toggleClass("stairs-block-id", !0), $('*[data-row="' + e + '"]').toggleClass("stairs-block-disabled", !1 === t)
            }, window.stairs = function () {
                if ($('#bet').val() >= 1) {
                    b = $('#bet').val();

                    const xhr = new XMLHttpRequest();
                    const csrfToken = $('meta[name=csrf-token]').attr('content');

                    const data = {
                        bet: b,
                        game_id: 7,
                        mines: e
                    };

                    xhr.open("POST", "/api/stairs/init");

                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

                    xhr.onload = () => {
                        if (xhr.status >= 200 && xhr.status < 300) {
                            const response = JSON.parse(xhr.responseText);

                            if (response.status === 200) {
                                b2 = response.n;
                                fm = response.m;
                                cf = parseInt(response.c);
                                cfI = parseInt(response.i);
                                urs.push("User" + response.uid + "...");
                                ghid = response.ghid;

                                $('#money').attr('data-current-balance', response.n);
                                $('#money_update').html("-$" + parseFloat(b).toFixed(2));
                                $('#div_money_update').css('display', "block");
                                $('#money_update').css('color', "red");

                                setTimeout(function () {
                                    $('#money').html(response.n);
                                    $('#div_money_update').css('display', "none");
                                    $('.lessmoney__gif').fadeIn(200);
                                    $('#money_gif__lose').attr('src', 'https://cdn.29bet.com/asset-uat/img/all/icons/coin-gif.gif');

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
                    }), setTimeout(function () {
                        clicked = !1
                    }, 100);
                }
            }, window.take = function () {
                if (!1 != cl) {
                    return null
                } else {
                    if (!1 !== s) return iziToast.info({
                        message: iziGTr(1),
                        icon: "fa fa-info"
                    }), setTimeout(function () {
                        s = !1
                    }, 100);

                    var t = JSON.parse(e);

                    const xhr = new XMLHttpRequest();
                    const csrfToken = $('meta[name=csrf-token]').attr('content');

                    const data = {
                        winnings: fp,
                        game_id: 7,
                        ghid: ghid
                    };

                    gBmR(nb - 1);

                    xhr.open("PUT", "/api/balance/add");

                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

                    xhr.onload = () => {
                        if (xhr.status >= 200 && xhr.status < 300) {
                            const response = JSON.parse(xhr.responseText);

                            if (response.status === 200) {
                                execTake();
                                uapts(1);

                                $('#money').attr('data-current-balance', response.new_balance);
                                $('#money_update').html("+$" + parseFloat(fp).toFixed(2));
                                $('#div_money_update').css('display', "block");
                                $('#money_update').css('color', "yellow");

                                setTimeout(function () {
                                    $('#div_money_update').css('display', "none");
                                    $('.moremoney__gif').fadeIn(200);
                                    $('#money_gif__gain').attr('src', 'https://cdn.29bet.com/asset-uat/img/all/icons/coin-gif.gif');

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
                }
            }, window.clear = function () {
                // TODO Remove class for climb animation

                alienBuddy.classList.remove('alien_walking_left', 'alien_walking_right', 'alien_climbing', 'alien_hurt', 'explosion_death');
                if (window.innerWidth <= 375) {
                    // Mobile view
                    alienBuddy.style.left = '-7.2%';
                    alienBuddy.style.top = '91%';
                }
                if (window.innerWidth <= 430) {
                    alienBuddy.style.left = '-25px';
                    alienBuddy.style.top = '314px';
                }

                else {
                    // Larger view
                    alienBuddy.style.left = '15px';
                    alienBuddy.style.top = '420px';
                }



                $("*[data-row]").toggleClass("stairs-block-disabled", !0), $(".stairs-mul-current").removeClass("stairs-mul-current"), setBetText(gBtT("jogar")), $("#play").attr("onclick", "stairs()"), i = null, a = !1, t = 0, _disableDemo = !1
            }, window.swap = function (e) {
                o = e, $("*[data-row]").toggleClass("stairs-bad", !1).toggleClass("stairs-block-disabled", e)
            }, window.clear_c = function () {
                $.get("/game/stairs/mul/" + e, function (e) {
                    for (var t = JSON.parse(e), o = 1; o <= Object.keys(t).length; o++) $('*[data-m-row="' + o + '"]').html("x" + abbreviateNumber(t[o]))
                })
            }, window.displayGrid = function (e) {
                for (var t = 1; t <= 12; t++)
                    for (var o = Array.from(e[t]), a = 0; a < o.length; a++) $('*[data-row="' + t + '"][data-cell-id="' + a + '"]').toggleClass("stairs-block-disabled", !0).toggleClass("stairs-bad", 1 === o[a])
            }, window.displayRow = function (e, t) {
                var o = Array.from(t);
                $.each($('*[data-row="' + e + '"]'), function (e, t) {
                    $(t).toggleClass("stairs-bad", 1 === o[e]).toggleClass("stairs-block-disabled", !0)
                })
            }, window.initExec = function () {
                if (!1 !== s) return iziToast.info({
                    message: iziGTr(1),
                    icon: "fa fa-info"
                }), setTimeout(function () {
                    s = !1
                }, 100);

                if (b < 1) {
                    return iziToast.error({
                        message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                        icon: "fa fa-times"
                    });
                } else {
                    if (e < 1 || e > 7) {
                        return iziToast.error({
                            message: iziGTr(4),
                            icon: "fa fa-times"
                        });
                    } else {
                        cl = 0;
                        fg = [];

                        for (let a = 0; a <= 12; a++) {
                            let rw = [];
                            if (a != 0) {
                                for (let b = 1; b <= rws[a - 1]; b++) {
                                    rw.push(0);
                                }

                                fg.push(shuffleArray(rw));
                            } else {
                                fg.push([]);
                            }
                        }

                        s = !0, $("*[data-row]").toggleClass("stairs-block-disabled", !0), $('.stairs-ladder:not([data-stairs-mouseover="true"])').fadeOut("fast", function () {
                            $(this).remove()
                        }), $(".stairs-block").toggleClass("stairs-bad", !1).toggleClass("stairs-good", !1), clear(), $(".outcome-window").fadeOut(200), clearInterval(clI), $(".outcome-window-lose").fadeOut(200), clearInterval(cli), betAudio.src = isAudioGame ? "/assets/media/bet.mp3" : "", isSoundOn ? betAudio.play() : null, $("#play").attr("disabled", 'true').attr("onclick", "take()"), setTimeout(function () {
                            s = !1
                        }, 350), updateBalanceN(), swap(!0), i = o.id, t = 1, _disableDemo = !0, row(1, !0)
                    }
                }
            }, window.execTake = function () {
                const demo = 0;
                winAudio.src = isAudioGame ? "/assets/media/win.mp3" : "", isSoundOn ? winAudio.play() : null, setTimeout(function () {
                    s = !1
                }, 350), 1 == demo || (sendDrop(t), validateTask(t)), $('.btn_outcome').click(), $(".outcome-window__coeff").text("x" + fm[t - 1]), $(".outcome-window_won__sum").text(parseFloat(fp).toFixed(2)), $(".outcome-window").fadeIn(200), clI = setInterval(() => {
                    $(".outcome-window").fadeOut(200);
                    clearInterval(clI)
                }, 3000), isDemo && isGuest() && showDemoTooltip(), swap(!0), clear(), updateBalanceN(), displayGrid(fg)
            }, window.gBmR = function (nbm) {
                const stp = 0;
                const fnp = 12 - t;

                for (let i = stp; i <= fnp; i++) {
                    gBm(nbm);
                    t += 1;
                }
            }, window.gBm = function (bc) {
                let bmc = 0,
                    zs = [];

                fg[t].forEach((v, k) => {
                    if (v == 1) {
                        bmc += 1;
                    }

                    if (v == 0) {
                        zs.push(k);
                    }
                });

                fg[t][zs[mkRdI(0, zs.length - 1)]] = 1;

                if (bmc < bc) {
                    gBm(bc);
                }
            }, window.getFG = function (rg, dg) {
                const dst = getDist();
                return dst == 1 ? swFG(rg, dg) : fg;
            }, window.swFG = function (rg, dg) {
                if (fg[rg][dg] == 0) {

                    fg[rg][dg] = 1;

                    if (nb != 1) {
                        gBm(nb - 1);
                    }

                    return fg;
                } else return fg;
            }, window.getDist = function () {
                const wc = 100 - cf;

                let cd = [];

                for (let j = 1; j <= wc; j++) {
                    cd.push(0);
                }

                for (let i = 1; i <= cf; i++) {
                    cd.push(1);
                }

                shuffleArray(cd);

                return cd[Math.floor(Math.random() * 99)];
            }, window.shuffleArray = function (r) {
                for (let i = r.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [r[i], r[j]] = [r[j], r[i]];
                }
                return r;
            }, window.uapts = function (status) {
                const ml = Object.values(fm);
                if (cg == 0) {
                    urs.push(ml[cg]);
                } else {
                    urs.push(ml[cg - 1]);
                }

                urs.push(b);

                var result = urs;
                if (apArr.length > 21) {
                    apArr.shift();
                    $('.bet_jogadores').children().last().remove();
                }
                apArr.push(result);
                localStorage.setItem('str_res', JSON.stringify(apArr));
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
                cg = 0;
                urs = [];
            }, window.ggapts = function () {
                const str_res = localStorage.getItem('str_res');
                if (str_res == null) {
                    for (let i = 1; i <= 22; i++) {
                        var result = gApsts();
                        apArr.push(result);
                        localStorage.setItem('str_res', JSON.stringify(apArr));
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
                    const aapr = JSON.parse(localStorage.getItem('str_res'));

                    aapr.forEach((result) => {
                        apArr.push(result);
                        localStorage.setItem('str_res', JSON.stringify(apArr));
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
                    localStorage.setItem('str_res', JSON.stringify(apArr));
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
                        d2.textContent = 'x1.72';
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
            }, window.mkRdI = function (mn, mx) {
                mn = Math.ceil(mn);
                mx = Math.floor(mx);
                return Math.floor(Math.random() * (mx - mn + 1)) + mn;
            }, window.mkId = function (length) {
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
            }, ggapts(), gapts(), clear_c(), $("*[data-bomb]").on("click", function (t) {
                o ? ($("*[data-bomb]").toggleClass("bc_active", !1), $(this).toggleClass("bc_active", !0), e = parseInt($(this).attr("data-bomb")), nb = e, clear_c()) : t.preventDefault()
            }), $("*[data-row]").mouseover(function () {
                $(this).hasClass("stairs-block-disabled") ? $('.stairs-ladder[data-stairs-mouseover="true"]').fadeOut("fast") : $('.stairs-ladder[data-stairs-mouseover="true"]').stop().fadeIn("fast")

            }), $("*[data-row]").on("click", function () {
                if (!$(this).hasClass("stairs-block-disabled")) {
                    var e = parseInt($(this).attr("data-cell-id")),
                        o = $(this);
                    row(t, !1), getFG(t, e), cl = 1;

                    var s = $('<div class="stairs-ladder"></div>');
                    $("#stairs_container").append(s), s.fadeIn("fast").css({
                        width: $(".stairs-block").width(),
                        height: $(".stairs-block").width() + 1,
                        top: $(this).position().top,
                        left: $(this).offset().left - $(this).parent().offset().left
                    });

                    if (fg[t][e] == 0) {
                        fg[t][e] = 2;
                        gBm(nb - 1);
                        cr.push(t);
                        displayRow(t, fg[t]), $("*[data-m-row]").removeClass("stairs-mul-current"), $('*[data-m-row="' + t + '"]').toggleClass("stairs-mul-current", !0), o.toggleClass("stairs-good", !0);
                        var r = parseFloat(fm[t] * b).toFixed(2);
                        fp = r;
                        a ? $("#cf_profit").html(r) : ($('#play').attr('disabled', false), setBetText(gBtT("pegar") + '<br><span id="cf_profit">' + r + '</span>&nbsp;<i class="fad fa-coins"></i>'), a = !0), setTimeout(function () {
                                $("#cf_profit").toggleClass("cf_profit-error", parseFloat(r) <= 0)
                            }, 200),

                            12 === t ? (cl = 0, take()) : (t += 1, cg += 1, cf += cfI, row(t - 1, !1), row(t, !0), cl = 0), gameAudio.src = isAudioGame ? "/assets/media/game.mp3" : "", isSoundOn ? gameAudio.play() : null
                    } else uapts(0), cl = 1, t += 1, gBmR(nb - 1), loseAudio.src = isAudioGame ? "/assets/media/redzone.mp3" : "",
                        isSoundOn ? loseAudio.play() : null, isDemo || sendDrop(i),
                        $('.btn_outcome_lose').click(),
                        $('.outcome-window-lose').delay(7500).fadeIn(1000), cli = setInterval(() => {
                            $('.outcome-window-lose').fadeOut(200);
                            clearInterval(cli)
                        }, 3000), // dito ung sa pag ease out ng pop up window

                        // TODO
                        // clear function kasabay ng outcome window
                        o.toggleClass("stairs-bad", true).toggleClass("stairs-block-disabled", true),
                        setTimeout(function () {
                            // Check if alienBuddy has specific classes
                            var explosionDelay = 1300;
                            var hurtInterval = setInterval(function() {
                                if (!alienBuddy.classList.contains('alien_walk_left') &&
                                    !alienBuddy.classList.contains('alien_walk_right') &&
                                    !alienBuddy.classList.contains('alien_climb')) {
                                    isClimbingEnabled = false;
                                    alienBuddy.classList.add('alien_hurt');
                                    alienBuddy.classList.remove('alien_climb');
                                    setTimeout(function() {
                                        alienBuddy.classList.add('explosion_death');
                                    }, explosionDelay);

                                    updateBalanceN();
                                    swap(true);
                                    setTimeout(function() {
                                        clear();

                                        alienBuddy.classList.remove('alien_hurt');

                                        isClimbingEnabled = true;
                                    }, 6000);
                                    displayGrid(fg);
                                    $('#play').attr('disabled', false);
                                    isClimbingEnabled = false;
                                    clearInterval(hurtInterval);
                                }
                            }, 3000);
                        },
                        1e3)
                }
            }), window.checkSound = function () {
                if ($('#stairs_music').attr('data-music') == 'on') {
                    isSoundOn = true;
                } else {
                    isSoundOn = false;
                }
            }, $('#stairs_music').on("click", function () {
                if ($('#stairs_music').attr('data-music') == 'on') {
                    isSoundOn = false;
                    $('#stairs_music').attr('data-music', 'off');
                } else {
                    isSoundOn = true;
                    $('#stairs_music').attr('data-music', 'on');
                }
            })
        })
    }
});

// character aniamtion section area alien buddy(sprites)
var alienBuddy = document.getElementById('alienBuddy');
var stairsBlocks = document.querySelectorAll('.stairs-block');
// pang globalization ng climb animation
var isClimbingEnabled = true;


stairsBlocks.forEach(function (block) {
    block.addEventListener('click', function (event) {
        if (!block.classList.contains('stairs-block-disabled')){

            var blockRect = block.getBoundingClientRect();
            var containerRect = document.querySelector('.stairs-container').getBoundingClientRect();

            // defautl attribuets for larger screen
            var offsetX = (event.clientX - containerRect.left) - 23 + (window.scrollX);
            var offsetY = (event.clientY - containerRect.top) - -25 + (window.scrollY);

            // For mobile viwe
            if (window.innerWidth <= 390) {
                offsetX = (event.clientX - containerRect.left) - 10 + (window.scrollX);
                offsetY = (event.clientY - containerRect.top) - -30 + (window.scrollY);
            }
            // for largre mobile view
            if (window.innerWidth <= 430){
                offsetX = (event.clientX - containerRect.left) - 10 + (window.scrollX);
                offsetY = (event.clientY - containerRect.top) - -5 + (window.scrollY);
            }

            alienBuddy.classList.remove('alien_idle', 'alien_walking_left', 'alien_walking_right', 'alien_climbing', 'alien_hurt','explosion_death');
            var characterX = alienBuddy.offsetLeft;
            var characterY = alienBuddy.offsetTop;


            // pang global sa travel time
            var fastAnimationThreshold = 50;

            // Check if the distance is very small, skip animation
            if (Math.abs(offsetX - characterX) < 5 && Math.abs(offsetY - characterY) < 5) {
                alienBuddy.style.left = offsetX + 'px';
                alienBuddy.classList.add('alien_idle');
                alienBuddy.style.transition = 'none';
                return;
            }
            // pang check ng distance ng travel and time ng travel ng character(Threshhold)
            var isFastAnimation = Math.abs(offsetX - characterX) < fastAnimationThreshold && Math.abs(offsetY - characterY) < fastAnimationThreshold;
            // duration ng travel ni buddy
            var walkDuration = isFastAnimation ? 2500 : 5000;
            if (offsetX > characterX) {
                alienBuddy.classList.add('alien_walking_right');
            } else {
                alienBuddy.classList.add('alien_walking_left');
            }

            var walkDuration = 2000;
            alienBuddy.style.transition = `left ${walkDuration}ms linear, top ${walkDuration}ms linear`;
            alienBuddy.style.left = offsetX + 'px';

            // Akyat animation ni buddy with a slight delay
            var climbDelay = walkDuration;
            setTimeout(function() {
                if (isClimbingEnabled) {
                    alienBuddy.classList.remove('alien_walking_left', 'alien_walking_right');
                    alienBuddy.style.transition = 'none';
                    alienBuddy.classList.add('alien_climbing');

                    var climbDuration = 1500;
                    alienBuddy.style.transition = `top ${climbDuration}ms linear`;

                    if (window.innerWidth <= 390) {
                        alienBuddy.style.top = offsetY - 6 * blockRect.height + 'px';
                    }
                    if (window.innerWidth <= 430){
                        alienBuddy.style.top = offsetY - 3 * blockRect.height + 'px';
                    }
                    else {
                        alienBuddy.style.top = offsetY - 3 * blockRect.height + 'px';
                    }

                    // pang remove ng climbng class
                    setTimeout(function() {
                        alienBuddy.classList.remove('alien_climbing');
                        alienBuddy.classList.add('alien_idle');
                        alienBuddy.style.transition = 'none';
                    }, climbDuration);
                }
            }, climbDelay);
        }
        return;

    });
});


var __profit = function () {};
