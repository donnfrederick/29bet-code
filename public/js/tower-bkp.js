! function(e) {
    var o = {};

    function t(i) {
        if (o[i]) return o[i].exports;
        var a = o[i] = {
            i: i,
            l: !1,
            exports: {}
        };
        return e[i].call(a.exports, a, a.exports, t), a.l = !0, a.exports
    }
    t.m = e, t.c = o, t.d = function(e, o, i) {
        t.o(e, o) || Object.defineProperty(e, o, {
            enumerable: !0,
            get: i
        })
    }, t.r = function(e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }, t.t = function(e, o) {
        if (1 & o && (e = t(e)), 8 & o) return e;
        if (4 & o && "object" == typeof e && e && e.__esModule) return e;
        var i = Object.create(null);
        if (t.r(i), Object.defineProperty(i, "default", {
                enumerable: !0,
                value: e
            }), 2 & o && "string" != typeof e)
            for (var a in e) t.d(i, a, function(o) {
                return e[o]
            }.bind(null, a));
        return i
    }, t.n = function(e) {
        var o = e && e.__esModule ? function() {
            return e.default
        } : function() {
            return e
        };
        return t.d(o, "a", o), o
    }, t.o = function(e, o) {
        return Object.prototype.hasOwnProperty.call(e, o)
    }, t.p = "/", t(t.s = 6)
}({
    "08te": function(e, o) {
        $.on("/tower", function() {
            var e = 1,
                o = 0,
                t = !0,
                i = !1,
                a = !1,
                r = null,
                b = 0,
                b2 = 0,
                fg = [],
                fm = [],
                cf = 0,
                fp = 0,
                cl = 0
                clI = null,
                cli = null,
                apArr = [],
                mulArr = [
                    1.19, 1.48, 1.86, 2.32, 2.90, 3.62, 4.53, 5.66, 7.08, 8.85, 1.58, 2.64, 4.40, 7.33, 12.22, 20.36, 33.94, 56.56, 94.27, 157.11, 2.38, 5.94, 14.84, 37.11, 92.77, 231.93, 579.83, 1449.58, 4.75, 23, 118, 593
                ],
                cg = 0,
                nb = e, ghid = 0,
                urs = [], isSoundOn = true;
            betAudio = new Audio, minesAudio = new Audio, winAudio = new Audio, bombAudio = new Audio, window.row = function(e, o) {
                $("*[data-r]").toggleClass("mine_disabled", !0), $('*[data-r="' + e + '"]').toggleClass("mine_disabled", !1 === o).toggleClass("tower_active", !0 === o)
            }, window.tower = function() {
                if ($('#bet').val() >= 1) {
                    b = $('#bet').val();

                    const xhr = new XMLHttpRequest();
                    const csrfToken = $('meta[name=csrf-token]').attr('content');

                    const data = {
                        bet: b,
                        game_id: 5,
                        mines: e
                    };

                    xhr.open("POST", "/api/tower/init");

                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

                    xhr.onload = () => {
                        if (xhr.status >= 200 && xhr.status < 300) {
                            const response = JSON.parse(xhr.responseText);

                            if (response.status === 200) {
                                fm = response.multiplier;
                                b2 = response.new_balance;
                                cf = Number(response.c);
                                cfI = Number(response.i);
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

                                initExec();
                            } else {
                                b = 0;
                                b2 = 0;
                                $('#_payin').click();
                            }
                        } else if (xhr.status == 419) {
                            $('#modal_please_login').addClass('md-show');
                        } else {
                            window.location.reload();
                        }
                    };

                    xhr.send(JSON.stringify(data));
                } else {
                    return iziToast.info({
                        message: iziGTr(3) + '&nbsp;<i class="fad fa-coins"></i>',
                        icon: "fa fa-info"
                    }), setTimeout(function() {
                        clicked = !1
                    }, 100);
                }
            }, window.take = function() {
                if (cl == 1) {
                    cl = 0;
                    $('#play').attr('disabled', false);
                    const xhr = new XMLHttpRequest();
                    const csrfToken = $('meta[name=csrf-token]').attr('content');

                    const data = {
                        winnings: fp,
                        game_id: 5,
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
                }
            }, window.clear = function() {
                $("*[data-grid-id]").toggleClass("tower_active", !1).toggleClass("mine_disabled", !0), $("*[data-row-id]").toggleClass("tower_mul_active", !1), setBetText(gBtT("jogar")), $("#play").attr("onclick", "tower()"), r = null, i = !1, o = 0, _disableDemo = !1
            }, window.swap = function(e) {
                t = e, $("*[data-grid-id]").toggleClass("mine_disabled", e)
            }, window.clear_c = function() {
                $.get("/game/tower/mul/" + e, function(e) {
                    for (var o = JSON.parse(e), t = 0; t < Object.keys(o).length; t++) $('*[data-row-id="' + t + '"]').html("x" + o[t + 1])
                })
            }, window.displayGrid = function(e) {
                for (var o = Array.from(e), t = 0; t < 10; t++)
                    for (var i = 0; i < 5; i++) $('*[data-r="' + t + '"][data-grid-in-row-id="' + i + '"]').toggleClass("mine_disabled", !0).toggleClass(1 === o[t][i] ? "tower_bomb" : "tower_safe", !0)
            }, window.displayRow = function(e, o) {
                var t = Array.from(o);
                $.each($('*[data-r="' + e + '"]'), function(e, o) {
                    $(o).toggleClass(1 === t[e] ? "tower_bomb" : "tower_safe", !0).toggleClass("mine_disabled", !0)
                })
            }, clear_c(), $("*[data-bomb]").on("click", function(o) {
                t ? ($("*[data-bomb]").toggleClass("bc_active", !1), $(this).toggleClass("bc_active", !0), e = parseInt($(this).attr("data-bomb")), nb = e, clear_c()) : o.preventDefault()
            }), $("*[data-r]").on("click", function() {
                if (!($(this).hasClass("mine_disabled") || t || $(this).hasClass("tower_safe") || $(this).hasClass("tower_bomb"))) {
                    var e = parseInt($(this).attr("data-grid-in-row-id")),
                        a = $(this);

                    const ml = Object.values(fm);

                    row(o, !1), getFG(o, e);

                    if (fg[o][e] == 0) {
                        fg[o][e] = 2;
                        gBm(nb - 1);
                        cl = 1, $('#play').attr('disabled', false), displayRow(o, fg[o]), a.toggleClass("tower_safe_picked", !0), minesAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/game.mp3" : "", isSoundOn ? minesAudio.play() : null;
                        var s = parseFloat(ml[o] * b).toFixed(2);
                        fp = s;
                        i ? $("#cf_profit").html(s) : (setBetText(gBtT("pegar") + '<br><span id="cf_profit">' + s + '</span>&nbsp;<i class="fad fa-coins"></i>'), i = !0), setTimeout(function() {
                            $("#cf_profit").toggleClass("cf_profit-error", parseFloat(s) <= 0)
                        }, 200), 9 === o ? (o += 1, take()) : (o += 1, cg += 1, cf += cfI, row(o, !0), $("*[data-row-id]").toggleClass("tower_mul_active", !1), $('*[data-row-id="' + o + '"]').toggleClass("tower_mul_active", !0))
                    } else cl = 0, o += 1, gBmR(nb - 1), $(".outcome-window-lose").fadeIn(200), cli = setInterval(() => {$(".outcome-window-lose").fadeOut(200);clearInterval(clI)}, 3000), a.toggleClass("mine_disabled", !0).toggleClass("tower_bomb", !0), bombAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/bomb.mp3" : "", isSoundOn ? bombAudio.play() : null, setTimeout(function() {
                        swap(!0), uapts(0), clear(), displayGrid(fg), $('#play').attr('disabled', false)
                    }, 1e3)
                }
            }), window.gBmR = function(nbm) {
                const stp = o;
                const fnp = 9;

                for (let i = stp;i <= fnp;i++) {
                    gBm(nbm);
                    o += 1;
                }
            }, window.initExec = function() {
                if (!1 !== a) return iziToast.info({
                    message: iziGTr(1),
                    icon: "fa fa-info"
                }), setTimeout(function() {
                    a = !1
                }, 100);

                if (b < 1) {
                    return iziToast.error({
                        message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                        icon: "fa fa-times"
                    });
                } else {
                    if (e < 1 || e > 4) {
                        return iziToast.error({
                            message: iziGTr(3),
                            icon: "fa fa-times"
                        });
                    } else {
                        fg = [];

                        for (let i = 0;i <= 9;i++) {
                            let rw = [];
                            for (let j = 0;j <= 4;j++) {
                                rw.push(0);
                            }

                            fg.push(shuffleArray(rw));
                        }

                        a = !0, $("*[data-grid-id]").toggleClass("tower_active", !1).toggleClass("mine_disabled", !0).toggleClass("tower_bomb", !1).toggleClass("tower_safe", !1).toggleClass("tower_safe_picked", !1), clear(), $(".outcome-window").fadeOut(200), clearInterval(clI), $(".outcome-window-lose").fadeOut(200), clearInterval(cli), betAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/bet.mp3" : "", isSoundOn ? betAudio.play() : null, $("#play").attr("disabled", true).attr("onclick", "take()"), setTimeout(function() {
                            a = !1
                        }, 350), swap(!1), r = 0, o = 0, _disableDemo = !0, row(0, !0), $('*[data-row-id="0"]').toggleClass("tower_mul_active", !0)
                    }
                }
            }, window.gBm = function(bc) {
                let bmc = 0,
                    zs = [];

                fg[o].forEach((v, k) => {
                    if (v == 1) {
                        bmc += 1;
                    }

                    if (v == 0) {
                        zs.push(k);
                    }
                });

                fg[o][zs[mkRdI(0, zs.length - 1)]] = 1;

                if (bmc < bc) {
                    gBm(bc);
                }
            }, window.getFG = function(rg, dg) {
                const dst = getDist();
                return dst == 1? swFG(rg, dg) : fg;
            }, window.swFG = function(rg, dg) {
                if (fg[rg][dg] == 0) {

                    fg[rg][dg] = 1;

                    if (nb != 1) {
                        gBm(nb - 1);
                    }

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
            }, window.shuffleArray = function(r) {
                for (let i = r.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [r[i], r[j]] = [r[j], r[i]];
                }
                return r;
            }, window.execTake = function() {
                const demo = 0;
                const ml = Object.values(fm);
                winAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/win.mp3" : "", isSoundOn ? winAudio.play() : null, setTimeout(function() {
                    a = !1
                }, 100), ($(".outcome-window__coeff").text("x" + ml[o]), $(".outcome-window_won__sum").text(parseFloat(fp).toFixed(2)), $(".outcome-window").fadeIn(200), clI = setInterval(() => {$(".outcome-window").fadeOut(200);clearInterval(clI)}, 3000)), isDemo && isGuest() && showDemoTooltip(), 1 == demo && ($(".outcome-window__coeff-demo").text("x" + ml[o]), $(".outcome-window_won__sum").text(parseFloat(fp).toFixed(2))), swap(!0), clear(), updateBalanceN(), displayGrid(fg)
            }, window.uapts = function (status) {
                const ml = Object.values(fm);
                if (cg == 0) {
                    urs.push(parseFloat(ml[cg]).toFixed(2));
                } else {
                    urs.push(parseFloat(ml[cg - 1]).toFixed(2));
                }
                urs.push(b);

                var result = urs;
                if (apArr.length > 21) {
                    apArr.shift();
                    $('.bet_jogadores').children().last().remove();
                }
                apArr.push(result);
                localStorage.setItem('twr_res', JSON.stringify(apArr));
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
            }, window.ggapts = function() {
                const twr_res = localStorage.getItem('twr_res');
                if (twr_res == null) {
                    for (let i = 1;i <= 22;i++) {
                        var result = gApsts();
                        apArr.push(result);
                        localStorage.setItem('twr_res', JSON.stringify(apArr));
                        var d = document.createElement('div');
                        const flex = "d-flex";
                        const between = "justify-content-around";
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
                    }
                } else {
                    const aapr = JSON.parse(localStorage.getItem('twr_res'));

                    aapr.forEach((result) => {
                        apArr.push(result);
                        localStorage.setItem('twr_res', JSON.stringify(apArr));
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
                    localStorage.setItem('twr_res', JSON.stringify(apArr));
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
                if ($('#tower_music').attr('data-music') == 'on') {
                    isSoundOn = true;
                } else {
                    isSoundOn = false;
                }
            }, ggapts(), gapts(), checkSound(), $('#tower_music').on("click", function() {
                if ($('#tower_music').attr('data-music') == 'on') {
                    isSoundOn = false;
                    $('#tower_music').attr('data-music', 'off');
                } else {
                    isSoundOn = true;
                    $('#tower_music').attr('data-music', 'on');
                }
            });
        })
    },
    6: function(e, o, t) {
        e.exports = t("08te")
    }
});
var __profit = function() { };
