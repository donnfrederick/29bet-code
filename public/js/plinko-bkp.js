$.on("/plinko", function() {
    var t = 8,
        e = !1,
        a = 15,
        o = !1,
        i = 0,
        n = 0,
        s = 0,
        r = 0,
        cl = 0,
        l = "medium";
    win5 = 0, win3 = 0, betAudio = new Audio, winAudio = new Audio, plinkoAudio = new Audio;
    let d, c, u = [],
        m = [],
        f = [],
        p = [],
        g = [],
        w = 0,
        b1 = 0,
        b2 = 0,
        b = {
            8: {
                1: [5, -66],
                2: [-44, -24],
                3: [-11],
                4: [-3, -100],
                5: [.1, -7.4],
                6: [10],
                7: [0, .11, -.11, 20, -77, -97],
                8: [-19, -33],
                9: [30]
            },
            9: {
                1: [-5],
                2: [1.3],
                3: [4.1, 28],
                4: [1.1],
                5: [1.8, 4],
                6: [-4],
                7: [-1.4],
                8: [2.2],
                9: [-2],
                10: [-25]
            },
            10: {
                1: [0, 1, -1.3],
                2: [-2.22],
                3: [3],
                4: [5, -70],
                5: [.4, -9.6],
                6: [2],
                7: [.2, 4],
                8: [-29],
                9: [6.5, -3.5],
                10: [.7, 2.5],
                11: [66, -1]
            },
            11: {
                1: [6.66],
                2: [1.4, 22, 112, -52],
                3: [-57],
                4: [-160],
                5: [7, -1.444, 7],
                6: [1.2, -4, -50],
                7: [5, -2],
                8: [-7, -60],
                9: [3.33, 25],
                10: [0, 1.8, -2.2, 3.52, -85],
                11: [-22],
                12: [.55, -29.3, -1.3]
            },
            12: {
                1: [0, -1.5, -1.66],
                2: [22],
                3: [-2, -2.22],
                4: [.6, .21, 5.42, 77],
                5: [5.5, 27],
                6: [7, 5, 5.2, .051, -4.1, 55.555],
                7: [25, 55],
                8: [-7, 29.3],
                9: [.1],
                10: [3],
                11: [128],
                12: [33],
                13: [-1, -4.42, 2.424]
            },
            13: {
                1: [.555],
                2: [.5, 5, -2.7],
                3: [.7],
                4: [.9],
                5: [.99, -99.3],
                6: [-55],
                7: [.12, -.6],
                8: [.6, -99.4],
                9: [0, -1.76, -.2, -.7312],
                10: [-99.2],
                11: [-3.131, -3, -99],
                12: [100],
                13: [-2.22, -121],
                14: [3.33, 77, -1]
            },
            14: {
                1: [3.7],
                2: [.9, -3],
                3: [.4, .8],
                4: [1.3],
                5: [-.213],
                6: [-.1],
                7: [.6],
                8: [2.9],
                9: [0, 3.5],
                10: [.1, .7],
                11: [-24, 28],
                12: [.5, 2.8, -5, -20],
                13: [-.8, 44],
                14: [3],
                15: [-66]
            },
            15: {
                1: [1.3, 3.1],
                2: [-68.9],
                3: [3, 5],
                4: [2.9, 5.5],
                5: [5.2],
                6: [.4, .7],
                7: [1.5, -2],
                8: [.5, 3.33],
                9: [-21.2],
                10: [.9],
                11: [.3, 3.2, 5.6],
                12: [.2, .6],
                13: [20],
                14: [20.1],
                15: [20.2],
                16: [0, -3.1]
            },
            16: {
                1: [-150],
                2: [1.4, -3, -66],
                3: [-3.1],
                4: [1.5],
                5: [1.9],
                6: [1.2, -88],
                7: [.8, 1.1, 1.6],
                8: [0],
                9: [1.3, 2.8],
                10: [.9, 2.1],
                11: [2.2],
                12: [2.3, -1.2],
                13: [1.8],
                14: [3.6],
                15: [3.1, -45],
                16: [3],
                17: [2.7]
            }
        },
        cli = null,
        mulArr = [0.5, 0.9, 0.5, 0.9, 2.2, 5.3, 0.4, 0.6, 1.3, 0.4, 0.6, 1.3, 3.1, 13, 0.2, 0.3, 1.5, 4, 24, 0.6, 1.1, 1.4, 0.6, 1.1, 1.4, 2.2, 5.5, 0.2, 0.6, 2, 0.2, 0.6, 2, 6.4, 38, 0.5, 0.9, 1.1, 0.5, 0.9, 1.1, 1.4, 3.1, 9, 0.4, 0.6, 0.4, 0.6, 1.3, 1.8, 5.2, 21, 0.2, 0.3, 0.7, 0.2, 0.3, 0.7, 3.2, 10, 70, 0.7, 0.9, 0.7, 0.9, 1.3, 1.8, 2.9, 8, 0.4, 0.7, 1.8, 0.4, 0.7, 1.8, 3.1, 6, 24, 0.2, 0.3, 1.4, 0.2, 0.3, 1.4, 5.2, 13, 120, 0.4, 0.9, 1.1, 0.4, 0.9, 1.1, 1.5, 1.9, 3.3, 10, 0.3, 0.5, 1.1, 0.3, 0.5, 1.1, 2, 4, 11, 32, 0.1, 0.2, 0.7, 2, 0.1, 0.2, 0.7, 2, 8, 21, 170, 0.6, 0.9, 1.2, 1.9, 0.6, 0.9, 1.2, 1.9, 3.1, 4.3, 8, 0.4, 0.6, 1.3, 0.4, 0.6, 1.3, 3, 5.3, 15, 40, 0.5, 0.2, 1.1, 0.5, 0.2, 1.1, 4, 11, 32, 260, 0.5, 0.8, 1.1, 0.5, 0.8, 1.1, 1.4, 1.8, 2.1, 5, 7.1, 0.2, 0.4, 1.1, 1.7, 0.2, 0.4, 1.1, 1.7, 4, 6.8, 15, 52, 0.1, 0.2, 2, 0.1, 0.2, 2, 5, 16, 51, 420, 0.5, 1.1, 1.2, 0.5, 1.1, 1.2, 1.4, 2, 3, 7, 15, 0.2, 0.5, 1.3, 0.2, 0.5, 1.3, 5, 11, 1.8, 80, 0.1, 0.2, 0.5, 0.1, 0.2, 0.5, 3, 8, 27, 63, 620, 0.4, 0.9, 1.1, 1.2, 0.4, 0.9, 1.1, 1.2, 1.4, 4, 8.4, 16, 0.2, 0.4, 1.1, 1.4, 0.4, 1.1, 1.4, 3.1, 5, 10, 38, 110, 0.1, 0.2, 2, 0.1, 0.2, 2, 4, 9, 22, 120, 1000],
        apArr = [], falling = 0,
        urs = [], mml = 0, isSoundOn = true, ghid = 0;
    window.setMode = function(t, e) {
        0 == r && ($("*[data-tab]").toggleClass("active", !1), $("*[data-tab=" + t + "]").toggleClass("active", !0)), "default" === t && 0 == r && (i = 0, $("#auto").fadeOut(0), $("#gamestext").fadeOut(0), $("#gamesvalue").fadeOut(0), $("#gamesvictory").fadeOut(0), $("#gamesvictoryvalue").fadeOut(0), $("#play").fadeIn(0)), "auto" === t && (i = 1, $("#play").fadeOut(0), $("#gamestext").fadeIn(0), $("#gamesvalue").fadeIn(0), $("#gamesvictory").fadeIn(0), $("#gamesvictoryvalue").fadeIn(0), $("#auto").fadeIn(0))
    }, window.initPlinko = function(e) {
        const {
            Engine: a,
            Render: o,
            World: n,
            Bodies: s,
            Events: r
        } = Matter, b = a.create(), v = o.create({
            element: document.getElementsByClassName("plinko")[0],
            engine: b,
            options: {
                wireframes: !1,
                background: " ",
                pixelRatio: 1
            }
        });
        c = function(e) {
            n.clear(b.world), g = [];
            const a = e + 2,
                o = 800 / a / 2,
                i = (e - 3) / ((e - 7) / 2) * (800 / 700),
                {
                    world: r
                } = b,
                c = u[l][t],
                w = {
                    0: ["#ffc000", "#997300"],
                    1: ["#ffa808", "#a16800"],
                    2: ["#ffa808", "#a95b00"],
                    3: ["#ff9010", "#a95b00"],
                    4: ["#ff7818", "#914209"],
                    5: ["#ff6020", "#b93500"],
                    6: ["#ff4827", "#c01d00"],
                    7: ["#ff302f", "#c80100"],
                    8: ["#ff1837", "#91071c"],
                    9: ["#ff003f", "#990026"]
                },
                $ = {
                    8: [w[9], w[7], w[4], w[2], w[0], w[2], w[4], w[7], w[9]],
                    9: [w[9], w[7], w[6], w[5], w[2], w[2], w[5], w[6], w[7], w[9]],
                    10: [w[9], w[8], w[7], w[5], w[4], w[1], w[4], w[5], w[7], w[8], w[9]],
                    11: [w[9], w[8], w[7], w[5], w[4], w[2], w[2], w[4], w[5], w[7], w[8], w[9]],
                    12: [w[9], w[8], w[7], w[6], w[5], w[4], w[1], w[4], w[5], w[6], w[7], w[8], w[9]],
                    13: [w[9], w[8], w[7], w[6], w[5], w[4], w[2], w[2], w[4], w[5], w[6], w[7], w[8], w[9]],
                    14: [w[9], w[8], w[7], w[6], w[5], w[4], w[3], w[2], w[3], w[4], w[5], w[6], w[7], w[8], w[9]],
                    15: [w[9], w[8], w[7], w[6], w[5], w[4], w[3], w[2], w[2], w[3], w[4], w[5], w[6], w[7], w[8], w[9]],
                    16: [w[9], w[8], w[7], w[6], w[5], w[4], w[3], w[2], w[1], w[2], w[3], w[4], w[5], w[6], w[7], w[8], w[9]]
                },
                v = (800 - 2 * o) / (a - 1),
                k = [s.rectangle(400, 625, 800, 50, {
                    isStatic: !0,
                    render: {
                        fillStyle: "transparent"
                    }
                }), s.rectangle(0, 0, o / 2, 1200, {
                    isStatic: !0,
                    render: {
                        fillStyle: "transparent"
                    }
                }), s.rectangle(800, 0, o / 2, 1200, {
                    isStatic: !0,
                    render: {
                        fillStyle: "transparent"
                    }
                })],
                y = (800 - 2 * o) / a,
                h = 560 / e,
                _ = Array(e).fill().map((t, a) => {
                    const n = y * (e - a - 1) / 2;
                    return Array(a + 3).fill().map((t, e) => ((t, e) => s.circle(t, e, i, {
                        isStatic: !0,
                        render: {
                            // CIRCULOS DO PLINKO
                            fillStyle: "#fff"
                        },
                        label: "peg"
                    }))(o + y * e + y / 2 + n, h * a + h / 2))
                }).reduce((t, e) => [...t, ...e], []),
                A = Array(a - 1).fill().map((e, a) => (e => {
                    const a = v / 1.08;
                    let o = g.length,
                        i = $[t][o];
                    n.add(r, s.rectangle(e, 588, a, 24, {
                        isStatic: !0,
                        render: {
                            fillStyle: i[0]
                        },
                        chamfer: {
                            radius: 3
                        },
                        label: "bucket-" + o
                    }));
                    let l = "x" + c[o];
                    return g.push({
                        text: l,
                        x: e,
                        y: 591.75
                    }), s.rectangle(e, 800, a, 7.5, {
                        isStatic: !0,
                        render: {
                            fillStyle: i[1]
                        }
                    })
                })(v * a + v));
            n.add(r, [...k, ..._, ...A]), d = function(t, e, a, o, l) {
                const d = ((t, e, a, o, n) => {
                    const r = 1.1 * i,
                        l = 400 + t,
                        d = `hsl(${((t,e)=>Math.floor(360*Math.random())+0)()}, 90%, 60%)`;
                    return p[e] = a, m[e] = o, f[e] = n, s.circle(l, 0, r, {
                        restitution: .8,
                        render: {
                            fillStyle: d
                        },
                        label: "plinko-" + e
                    })
                })(t, e, a, o, l);
                n.add(r, d)
            }
        }, $.get("/game/plinko/multipliers", function(t) {
            u = JSON.parse(t), c(e)
        }).fail(function() {
            window.location.reload();
        }), r.on(b, "collisionStart", function(t) {
            const {
                pairs: e
            } = t;
            e.forEach(t => {
                const {
                    bodyA: e,
                    bodyB: a
                } = t, {
                    label: o
                } = e, {
                    label: s
                } = a;
                if (o.includes("plinko") && s.includes("plinko") && (t.isActive = !1), s.includes("plinko") && o.includes("bucket")) {
                    let t = s.split("plinko-")[1];
                    if (void 0 === p[t]) return;
                    n.remove(b.world, a), --w <= 0 && 0 == i && (setBetText("Jogar"), w = 0), --w <= 0 && 1 == i && (w = 0), 1 == parseFloat(f[t]) || (parseFloat(p[t]) > 0 && show_win_window(parseFloat(m[t]), parseFloat(p[t]))), delete p[t]
                }
            })
        }), r.on(v, "afterRender", () => {
            if (0 === $(".plinko canvas").length) return;
            const t = $(".plinko canvas")[0].getContext("2d");
            t.font = "15px Open Sans", t.fillStyle = "white", t.textAlign = "center";
            for (let e = 0; e < g.length; e++) {
                let a = g[e];
                t.fillText(a.text, a.x, a.y)
            }
        }), a.run(b), o.run(v)
    }, window.show_win_window = function(t, e) {
        const xhr = new XMLHttpRequest();
        const csrfToken = $('meta[name=csrf-token]').attr('content');

        const data = {
            winnings: e,
            game_id: 11,
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
                    execTake(t, e);
                    uapts(1);

                    falling -= 1;

                    $('#money').attr('data-current-balance', response.new_balance);
                    $('#money_update').html("+$" + parseFloat(e).toFixed(2));
                    $('#div_money_update').css('display', "block");
                    $('#money_update').css('color', "yellow");

                    if (falling < 1) {
                        $('.dropdown__select__default').removeClass('bb_disabled');
                    }

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
    }, window.plinko = function() {
        if ($('#bet').val() >= 1) {
            if (cl == 0) {
                cl = 1;
                b1 = $('#bet').val();

                const xhr = new XMLHttpRequest();
                const csrfToken = $('meta[name=csrf-token]').attr('content');

                const data = {
                    bet: b1,
                    game_id: 11,
                    difficulty: l,
                    pins: t
                };

                xhr.open("POST", "/api/plinko/init");

                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

                xhr.onload = () => {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        const response = JSON.parse(xhr.responseText);

                        if (response.status === 200) {
                            falling += 1, $('.dropdown__select__default').addClass('bb_disabled');

                            b2 = response.n;
                            urs.push("User" + response.uid + "...");
                            ghid = response.ghid;

                            $('#money').attr('data-current-balance', response.n);
                            $('#money_update').html("-$" + parseFloat(b1).toFixed(2));
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

                            setTimeout(function() {
                                initExec(response.game);
                            }, 750);
                        } else {
                            cl = 0;
                            b1 = 0;
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
            }
        } else {
            return iziToast.info({
                message: iziGTr(0) + '&nbsp;<i class="fad fa-coins"></i>',
                icon: "fa fa-info"
            }), setTimeout(function() {
                clicked = !1
            }, 100);
        }
    }, window.initExec = function(a) {
        e = !0, w++, cl = 0
        if (null != a.error) return "$" === a.error && load("games"), -1 === a.error && $("#b_si").click(), 0 === a.error && iziToast.error({
            message: "NÃºmero de pinos - de 8 a 16",
            icon: "fa fa-times",
            position: "bottomCenter"
        }), 1 === a.error && iziToast.error({
            message: "Aposta mÃ­nima: 0,01 RUB.",
            icon: "fa fa-times",
            position: "bottomCenter"
        }), 2 === a.error && $("#_payin").click(), e = !1, 3 === a.error && iziToast.error({
            message: "Invalid risk level",
            icon: "fa fa-times",
            position: "bottomCenter"
        }), void w--;
        betAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/bet.mp3" : "", isSoundOn ? betAudio.play() : null, $(".outcome-window").fadeOut(200), clearInterval(cli), setTimeout(function() {
            e = !1
        }, 10), drop(a.bucket, a.id, a.profit.toFixed(2), a.multiplier, a.demo)
    }, window.execTake = function(t, e) {
        $(".outcome-window__coeff-demo").text("x" + t), $(".outcome-window_won__sum").text(e), $(".outcome-window").fadeIn(200), cli = setInterval(() => {$(".outcome-window").fadeOut(200);clearInterval(cli)}, 3000), winAudio.src = isAudioGame ? "https://cdn.29bet.com/assets/media/win.mp3" : "", isSoundOn ? winAudio.play() : null
    }, window.drop = function(e, a, o, i, n) {
        let s = b[t][e][Math.floor(Math.random() * b[t][e].length)];
        mml = i;
        d(s, a, o, i, n)
    }, window.debug = function(t) {
        d(t, Math.random(), 0)
    }, window.reloadCSS = function(t) {
        $("[data-async]").remove(), void 0 !== t && t()
    }, reloadCSS(function() {
        initPlinko(8)
    }), window.datapin = function(e) {
        $("*[data-pin]").on("click", function(e) {
            if (falling < 1) {
                $('.pins-dropdown-list').find('p').toggleClass("bc_active", !1);
                w > 0 || ($("*[data-pin]").toggleClass("bc_active", !1), $(this).find('div').find('p').toggleClass("bc_active", !0), t = parseInt($(this).attr("data-pin")), c(t))
            } else {
                return iziToast.info({
                    message: iziGTr(7),
                    icon: "fa fa-info"
                }), setTimeout(function() {
                    clicked = !1
                }, 100);
            }
        })
    }, window.datadiff = function(e) {
        $("*[data-plinko-difficulty]").on("click", function() {
            if (falling < 1) {
                $('.difficulty-dropdown-list').find('p').toggleClass("buttons-3-selected", !1);
                w > 0 || (l = $(this).attr("data-plinko-difficulty"), $(this).find('div').find('p').toggleClass("buttons-3-selected", !0), c(t))
            } else {
                return iziToast.info({
                    message: iziGTr(7),
                    icon: "fa fa-info"
                }), setTimeout(function() {
                    clicked = !1
                }, 100);
            }
        })
    }, datapin(), datadiff(), $("*[data-games]").on("click", function() {
        $("*[data-games]").toggleClass("bc_active", !1), $(this).toggleClass("bc_active", !0), a = parseInt($(this).attr("data-games")), $(".games_input").val(a)
    }), $("#change_games").on("click", function() {
        o || (o = !0, $("#change_games span").toggleClass("dn", !0), $("#change_games input").toggleClass("dn", !1), $(".bomb_input").on("input", function() {
            var t = parseInt($(this).val());
            if (isNaN(t) || t < 1 || t > 240) return $(this).toggleClass("bad", !0), void(u = !0);
            $(this).toggleClass("bad", !1), u = !1, a = t, $("*[data-games]").toggleClass("bc_active", !1), $('*[data-games="' + a + '"]').toggleClass("bc_active", !0)
        }).focus())
    }), $("*[data-victory]").on("click", function() {
        $(this).attr("*[data-victory]"), $(".buttons-4-selected").removeClass("buttons-4-selected"), $(this).addClass("buttons-4-selected"), n = parseInt($(this).attr("data-victory"))
    }), window.uapts = function (status) {
        urs.push('x' + parseFloat(mml).toFixed(2));
        urs.push(b1);

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
        const pko_res = localStorage.getItem('pko_res');
        if (pko_res == null) {
            for (let i = 1;i <= 22;i++) {
                var result = gApsts();
                apArr.push(result);
                localStorage.setItem('pko_res', JSON.stringify(apArr));
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

                s2.classList.add('game__color--win');

                d3.appendChild(s1);
                d3.appendChild(s2);

                d.appendChild(d3);
                $('.bet_jogadores').prepend(d);
            }
        } else {
            const aapr = JSON.parse(localStorage.getItem('pko_res'));

            aapr.forEach((result) => {
                apArr.push(result);
                localStorage.setItem('pko_res', JSON.stringify(apArr));
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

                s2.classList.add('game__color--win');

                d3.appendChild(s1);
                d3.appendChild(s2);

                d.appendChild(d3);
                $('.bet_jogadores').prepend(d);
            });
        }
    }, window.gapts = function () {
        var interval = Math.floor(Math.random() * 1000) + 600;

        setTimeout(function () {
            var result = gApsts();
            if (apArr.length > 21) {
                apArr.shift();
                $('.bet_jogadores').children().last().remove();
            }
            apArr.push(result);
            localStorage.setItem('pko_res', JSON.stringify(apArr));
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

            s2.classList.add('game__color--win');

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
        if ($('#plinko_music').attr('data-music') == 'on') {
            isSoundOn = true;
        } else {
            isSoundOn = false;
        }
    }, $('#plinko_music').on("click", function() {
        if ($('#plinko_music').attr('data-music') == 'on') {
            isSoundOn = false;
            $('#plinko_music').attr('data-music', 'off');
        } else {
            isSoundOn = true;
            $('#plinko_music').attr('data-music', 'on');
        }
    }), $('.dropdown__select').click(function() {
        console.log(falling);
        if (falling > 0) {
            $(this).removeClass('active');
        }
    })
});
var __profit = function() { };

// $('.linksidebar').click(function() {
//     $(".plinko canvas").css('visibility', 'hidden');
// });
