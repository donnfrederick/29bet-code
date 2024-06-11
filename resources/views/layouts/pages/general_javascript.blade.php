<script type="text/javascript">
    // conffeti
$(document).ready(function() {
            const defaults = {
                spread: 90,
                ticks: 10,
                gravity: 0,
                decay: 0.94,
                startVelocity: 20,
                decay: 0.94,
                shapes: ["star", "circle"],
                colors: ["FFE400", "FFBD00", "E89400", "FFCA6C", "FDFFB8"],
            };

            function shoot() {
                confetti({
                ...defaults,
                particleCount: 100,
                scalar: 1.2,
                shapes: ["star"],
                decay: 0.94,
                });

                confetti({
                ...defaults,
                particleCount: 50,
                scalar: 0.75,
                shapes: ["circle"],
                decay: 0.94,
                });
                confetti({
                    spread: 70,
                    ticks: 10,
                    gravity: 0,
                    decay: 0.94,
                    startVelocity: 10,
                    particleCount: 10,
                    scalar: 2.7,
                    shapes: ["image"],
                    shapeOptions: {
                        image: [{
                            src: "https://cdn.29bet.com/assets/img/all/pages/games/coin-red.webp",
                            width: 32,
                            height: 32,
                        },

                        ],
                    },
                    });
                    confetti({
                    spread: 70,
                    ticks: 10,
                    gravity: 0,
                    decay: 0.94,
                    startVelocity: 10,
                    particleCount: 10,
                    scalar: 2.7,
                    shapes: ["image"],
                    shapeOptions: {
                        image: [{
                            src: "https://cdn.29bet.com/assets/img/all/pages/games/coin-black.webp",
                            width: 32,
                            height: 32,
                        },

                        ],
                    },
                    });
            }
            $("#confetti_proc").click(function() {
                shoot();
            });
            });



    // Mobile Menu
    $(document).ready(function() {
        $(".menuicon").click(function() {
            $(".menuicon").removeClass("active");
            $(this).addClass("active");

        });
    });
    // toggeon mobile layout
    // $(document).ready(function() {
    //     $('.mobile-menu__submenu_games .mobile-menu').click(function(e) {
    //         e.preventDefault();
    //         $('.mobile-menu__submenu_games .mobile-menu').removeClass('active');
    //         $(this).addClass('active');
    //     });
    // });
    // $(document).ready(function() {
    //     var activeIndex = localStorage.getItem('activeIndex');
    //     if (activeIndex !== null) {
    //         $('.mobile-menu__submenu_games .menu-item').removeClass('active');
    //         $('.mobile-menu__submenu_games .menu-item[data-index="' + activeIndex + '"]').addClass('active');
    //     }
    //     $('.mobile-menu__contents .menu-item').click(function(e) {
    //         e.preventDefault();
    //         $('.mobile-menu__contents .menu-item').removeClass('active');
    //         $(this).addClass('active');
    //         var index = $(this).data('index');
    //         localStorage.setItem('activeIndex', index);
    //     });
    // });

    document.addEventListener("DOMContentLoaded", function() {
        var wrapper = document.getElementById('pageContent');
        var loadingScreen = document.getElementById('loadingContent');
        document.getElementById('loadingContentPG').style.display = 'none';
        document.getElementById('_ajax_content_').style.display = 'block';
        setTimeout(function() {
            loadingScreen.style.display = 'none';
            wrapper.style.display = 'block';
        });
    });

    $(".dropdown__select__default").click(function() {
        $(this).parent().toggleClass("active");
    });

    $(".dropdown__select__list li").click(function() {
        var currentele = $(this).find("p").text();
        $(this).closest(".dropdown").find(".dropdown__select__default li").html(currentele);
        $(this).closest(".dropdown__select").removeClass("active");
    });

    $(document).ready(function() {
        var screenWidth = $(window).width();
        if (screenWidth <= 1490) {
            $('body').addClass('active');
        } else {
            $('body').removeClass('active');
        }
    });

    @auth

    function copyReferalLink() {
        var $HTMLinput = $('<input>');
        $('body').append($HTMLinput);
        var input = $('#copyReferalLink').val();
        $HTMLinput.val(input).select();
        document.execCommand('copy');
        $HTMLinput.remove();
        alert("Text copied to clipboard!");
    }

    function copyReferalcode() {
        var $HTMLinput = $('<input>');
        $('body').append($HTMLinput);
        var input = $('#copyReferalcode').val();
        $HTMLinput.val(input).select();
        document.execCommand('copy');
        $HTMLinput.remove();
        alert("Text copied to clipboard!");
    }

    function copyPix() {
        var $HTMLinput = $('<input>');
        $('body').append($HTMLinput);
        var input = $('#pixqrcode').val();
        $HTMLinput.val(input).select();
        document.execCommand('copy');
        $HTMLinput.remove();
        alert("Text copied to clipboard!");
    }

    function copyUsername() {

        var text = $('#copyUsername').text();
        $('<input>').val(text).appendTo('body').select();
        document.execCommand('copy');
        $('input').remove();
        alert("Text copied to clipboard!");

    }

    function ShowDropdownMenuUser() {
        const dropdownMenuProfileArea = document.getElementById('dropdownMenuProfileArea');

        const screenWidth = window.innerWidth;
        if (screenWidth <= 991) {
            dropdownMenuProfileArea.classList.toggle('show-dropdown-user-area');

            if (dropdownMenuProfileArea.classList.contains('show-dropdown-user-area')) {
                dropdownMenuProfileArea.classList.remove('none-dropdown-user-area');
            } else {
                dropdownMenuProfileArea.classList.add('none-dropdown-user-area');
            }
        }
    }

    function resetDropdownMenuProfileArea() {
        const dropdownMenuProfileArea = document.getElementById('dropdownMenuProfileArea');
        dropdownMenuProfileArea.classList.remove('show-dropdown-user-area');
        dropdownMenuProfileArea.classList.remove('none-dropdown-user-area');
    }
    const myButton = document.getElementById('dropdownMenuProfile');
    myButton.addEventListener('click', ShowDropdownMenuUser);
    window.addEventListener('resize', () => {
        const screenWidth = window.innerWidth;
        if (screenWidth > 991) {
            resetDropdownMenuProfileArea();
        }
    });


    var hamburger = document.querySelector("#notifications");
    hamburger.addEventListener("click", function() {
        document.querySelector("body").classList.toggle("active-notifications");
        document.getElementById("sidemenu").classList.toggle("close-notifications");
    })
    @endauth

    // filterSelection("all")
    // function filterSelection(c) {
    //     var x, i;
    //     x = document.getElementsByClassName("filterDiv");
    //     if (c == "all") c = "";
    //     for (i = 0; i < x.length; i++) {
    //         w3RemoveClass(x[i], "show");
    //         w3AddClass(x[i], "hide");
    //         if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
    //     }
    // }

    $('#providers').click(function() {
        $('.pang_load2').show();
        $('.cat--pgsoft').addClass('show');
    });

    // $('#providers').click(function() {
    //     $('.pang_load2').show();
    //     $('.cat--pgsoft').addClass('show');
    // const refreshEvent = new Event('refreshBreakpoints');
    // window.dispatchEvent(refreshEvent);
    // });
    // window.addEventListener('refreshBreakpoints', function() {
    //     refreshBreakpoints();
    // });
    // function refreshBreakpoints() {
    // $(filterSelection).width('99%');
    // }

    filterSelection('all')

    function filterSelection(c) {
        const a = c;
        var x, i;
        x = document.getElementsByClassName("filterDiv");
        if (c == "all") c = "";
        for (i = 0; i < x.length; i++) {
            w3RemoveClass(x[i], "show");
            w3AddClass(x[i], "hide");
            if (x[i].className.indexOf(c) > -1) {
                w3AddClass(x[i], "show");
                // if (a == "all") {
                //     if (i == 0) {
                //         w3RemoveClass(x[i], "show");
                //     }
                // } else if (a.indexOf('cat--') === -1 & a != "all") {
                //     w3AddClass(x[0], "show");
                // }
                // else if (a == "cat--providers") {

                //     $('.pang_load2 .slick-track').css({
                //         'max-width': '100%',
                //         'width': '100%'
                //     });
                //     $('.pang_load2 .slick-track .initGames__item--prov').css({
                //         'max-width': '141px',
                //         'width': '100%'
                //     });

                // }

            }

        }

        return (c);
    }


    //     filterSelection('all')
    // function filterSelection(c) {
    //     const a = c;
    //     var x, i;
    //     x = document.getElementsByClassName("filterDiv");
    //     if (c == "all") c = "";
    //     for (i = 0; i < x.length; i++) {
    //         w3RemoveClass(x[i], "show");
    //         w3AddClass(x[i], "hide");
    //         if (x[i].className.indexOf(c) > -1) {
    //             w3AddClass(x[i], "show");
    //             if (a == "all") {
    //                 if (a.indexOf('cat--providers') === -1) {
    //                     w3RemoveClass(x[i], "show");
    //                 }
    //             } else if (a.indexOf('cat--') === -1 && a != "all") {
    //                 w3AddClass(x[0], "show");
    //             }
    //         }
    //         console.log(a);
    //     }
    // }

    function w3AddClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            if (arr1.indexOf(arr2[i]) == -1) {
                element.className += " " + arr2[i];
            }
        }
    }

    function w3RemoveClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            while (arr1.indexOf(arr2[i]) > -1) {
                arr1.splice(arr1.indexOf(arr2[i]), 1);
            }
        }
        element.className = arr1.join(" ");
    }

    $(".filter__item").on('click', function() {
        $(".filter__item").removeClass("active");
        $(this).addClass("active");
    });
    $(".filter__itempromo").on('click', function() {
        $(".filter__itempromo").removeClass("active");
        $(this).addClass("active");
    });
    $(".center__faq__card--link").on('click', function() {
        $(".center__faq__card--link").removeClass("active");
        $(this).addClass("active");
    });

    function toogleFunction() {
        var x = document.getElementById("btn__multiples");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
    // double check on the masksidebar error in hamburger
    $(".mobile-menu__link").on('click', function() {
        $(".mobile-menu__link").removeClass("active");
        $(this).addClass("active");
    });

    var hamburger = document.querySelector(".hamburguer");
    hamburger.addEventListener("click", function() {
        document.querySelector("body").classList.toggle("active");
        document.getElementById("sidemenu").classList.toggle("close");
        document.getElementById("loadingContent29").classList.toggle("loading-content-close");
        document.getElementById("masksidebar").classList.toggle("overlay-sidebar-active"); // Toggle masksidebar
    });

    var burguermobile = document.querySelector(".burguermobile");
    burguermobile.addEventListener("click", function() {
        document.querySelector("body").classList.toggle("active");
        document.getElementById("sidemenumobile").classList.toggle("close");
        document.getElementById("masksidebar").classList.toggle("overlay-sidebar-active");
    });

    var masksidebar = document.querySelector(".md-overlay-sidebar");
    masksidebar.addEventListener("click", function() {
        $('body').toggleClass('active');
        document.getElementById("masksidebar").classList.toggle("overlay-sidebar-active");
    });

    var maskModal = document.querySelector(".md-overlay");
    masksidebar.addEventListener("click", function() {
        document.getElementsByClassName("md-modal").removeClass('md-show');
    });

    var screenWidth = $(window).width();
    if (screenWidth <= 768) {
        $(document).ready(function() {
            if ($('body.active').length) {
                $('body').removeClass('active');
            }
        });
        $('.linksidebar').click(function() {
            $('body').removeClass('active');
            $('#sidemenumobile').toggleClass('close');
            $('.md-overlay-sidebar').removeClass('overlay-sidebar-active');
        });
    }
    // end of sidebar

    const input = document.querySelector('.search-field input');
    const games = document.querySelectorAll('.game-slide-search');
    const errorMessage = document.querySelector('.error-search');

    input.addEventListener('input', (event) => {
        const searchTerm = event.target.value.toLowerCase();
        let results = 0;

        games.forEach((game) => {
            const gameTitle = game.querySelector('.h-game-slide').textContent.toLowerCase();
            if (gameTitle.includes(searchTerm)) {
                game.style.display = 'block';
                results++;
            } else {
                game.style.display = 'none';
            }
        });

        if (results === 0) {
            errorMessage.style.display = 'block';
        } else {
            errorMessage.style.display = 'none';
        }
    });

    $(document).ready(function() {
        if (window.location.pathname === '/') {
            // Verificar se o cookie 'popupShown' não está definido
            if (!$.cookie('popupShown')) {
                // Exibir a popup
                $('.md-popup-hover').toggleClass('md-show', true);

                // Definir o cookie para que a popup não seja exibida novamente
                $.cookie('popupShown', 'true', {
                    expires: 365,
                    path: '/'
                });
            }
        }
    });

    $('#mask').click(function() {
        $('.md-modal').toggleClass('md-show', false);
    })
    $('.linkmodal').click(function() {
        $('.md-modal').toggleClass('md-show', false);
    })
    $('.md-overlay').click(function() {
        $('.md-modal').toggleClass('md-show', false);
    })
    $('.lvl__box-vip-bonus').on('click', function() {
        var id = this.id;

        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        console.log(token);
        $.ajax({
            "method": "POST",
            "url": "{{ route('claim_reward-vip') }}",
            data: {
                "_token": token,
                "id": id.substring(id.lastIndexOf("-") + 1),
            },
            success: function(response) {

                if (response.success) {

                    iziToast.success({
                        message: response.message,
                        position: 'center',
                        icon: "fa fa-check"
                    });
                    location.reload();
                } else {
                    iziToast.error({
                        message: response.message,
                        position: 'center',
                        icon: "fa fa-times-circle "
                    });
                }
            },
            error: function(xhr, status, error) {
                iziToast.error({
                    message: error,
                    position: 'center',
                    icon: "fa fa-times-circle "
                });
            }
        });
    });
</script>

<script>
    function formatStateOption(state) {
        if (!state.id) {
            return state.text;
        }
        var iconUrl = "https://cdn.29bet.com/assets/img/all/icons/global.svg";
        var isSelected = state.element.value === $('#frm_brand').val();
        var $state = $(
            '<span><img src="' +
            (isSelected ? iconUrl : '') +
            '" class="img-flag" style="display: inline-block; margin-right: 5px; position: relative; top: 5px;" /> ' +
            state.text +
            '</span>'
        );
        return $state;
    }

    $("#frm_brand").select2({
        minimumResultsForSearch: -1,
        templateSelection: formatStateOption,
    });
    $("#frm_brands").select2({
        minimumResultsForSearch: -1,
        templateSelection: formatStateOption,
    });

    $("#frm_promotions").select2({
        minimumResultsForSearch: -1,
        templateSelection: formatStateOption,
    });
</script>


<script>
    $('.slider-logos-footer').slick({
        dots: false,
        arrows: false,
        infinite: true,
        slidesToShow: 11,
        autoplaySpeed: 1100,
        autoplay: true,
        responsive: [{
                breakpoint: 1300,
                settings: {
                    slidesToShow: 8,
                    dots: false,
                    arrows: false,
                },
            },

            {
                breakpoint: 993,
                settings: {
                    slidesToShow: 5,
                    dots: false,
                    arrows: false,
                },
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 4,
                    dots: false,
                    arrows: false,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 3,
                    dots: false,
                    arrows: false,
                },
            },
        ],
    });
    // WON OUTCOME SECTION
    $(function() {
        var overlay = $('.congrats');
        var btn = $('.btn_outcome'),
            bg_1 = $('.bg-1'),
            bg_2 = $('.bg-2'),
            ang_a = $('.ang-a'),
            ang_b = $('.ang-b'),
            ang_c = $('.ang-c'),
            text = $('.text'),
            glow = $('.glow'),
            dots = $('.dots'),
            shine = $('.shine');



        var start = function() {
            overlay.css('visibility', 'visible');
            ang_a.removeClass('d-none').removeClass(ang_a.data('in')).addClass(ang_a.data('in'));
            ang_b.removeClass('d-none').removeClass(ang_b.data('in')).addClass(ang_b.data('in'));
            ang_c.removeClass('d-none').removeClass(ang_c.data('in')).addClass(ang_c.data('in'));
            bg_2.removeClass('d-none').removeClass(bg_2.data('out')).addClass(bg_2.data('in'));
            setTimeout(function() {
                bg_1.removeClass('d-none').removeClass(bg_1.data('out')).addClass(bg_1.data('in'));
            }, 500);
            btn.fadeOut(200);
        };

        btn.on('click', start);

        bg_2.off().on('animationend webkitAnimationEnd oAnimationEnd mozAnimationEnd', function() {
            setTimeout(function() {
                bg_2.fadeOut('fast').addClass('d-none').removeClass(bg_2.data('in'));
                text.removeClass('d-none').addClass(text.data('in'));
            }, 600);
        });

        text.off().on('animationend webkitAnimationEnd oAnimationEnd mozAnimationEnd', function() {
            setTimeout(function() {
                text.addClass('txt-ind');
                glow.removeClass('d-none').addClass(glow.data('in'));
                dots.removeClass('d-none');
                shine.removeClass('d-none').addClass(shine.data('in'));
            }, 50);
        });

        glow.off().on('animationend webkitAnimationEnd oAnimationEnd mozAnimationEnd', function() {
            bg_2.removeAttr('style').removeClass('d-none').addClass(bg_2.data('out'));
        });

        shine.off().on('animationend webkitAnimationEnd oAnimationEnd mozAnimationEnd', function() {
            setTimeout(function() {
                dots.fadeOut(300);
                glow.fadeOut(500);
            }, 1000);
            setTimeout(function() {
                shine.fadeOut(400);
                bg_1.removeClass(bg_1.data('in')).addClass(bg_1.data('out'));
            }, 2000);
            setTimeout(function() {
                text.removeClass(text.data('in')).addClass(text.data('out'));
                setTimeout(function() {
                    $(document).trigger('animate:reset');
                }, 500);
            }, 2500);
        });

        $(document).on('animate:reset', function() {
            overlay.css('visibility', 'hidden');
            $('.el').each(function() {
                $(this).addClass('d-none').removeClass($(this).data('in')).removeClass($(this)
                    .data('out')).removeAttr('style');
            });
            text.removeClass('txt-ind');
            btn.fadeIn(200);
        });
    });


    //LOSE OUTCOME SECTION
    $(function() {
        var overlay = $('.YOU_LOSE');
        var btn = $('.btn_outcome_lose'),
            bg_1 = $('.bg-1_lose'),
            bg_2 = $('.bg-2_lose'),
            ang_a_LOSE = $('.ang-a_LOSE'),
            ang_b_LOSE = $('.ang-b_LOSE'),
            ang_c_LOSE = $('.ang-c_LOSE'),
            text_LOSE = $('.text_LOSE'),
            glow_LOSE = $('.glow_lose'),
            dots_LOSE = $('.dots_LOSE'),
            shine_LOSE = $('.shine_LOSE');

        var start = function() {
            overlay.css('visibility', 'visible');

            ang_a_LOSE.removeClass('d-none').removeClass(ang_a_LOSE.data('in')).addClass(ang_a_LOSE.data(
                'in'));
            ang_b_LOSE.removeClass('d-none').removeClass(ang_b_LOSE.data('in')).addClass(ang_b_LOSE.data(
                'in'));
            ang_c_LOSE.removeClass('d-none').removeClass(ang_c_LOSE.data('in')).addClass(ang_c_LOSE.data(
                'in'));
            bg_2.removeClass('d-none').removeClass(bg_2.data('out')).addClass(bg_2.data('in'));
            setTimeout(function() {
                bg_1.removeClass('d-none').removeClass(bg_1.data('out')).addClass(bg_1.data('in'));
            }, 500);
            btn.fadeOut(200);
        };

        btn.on('click', start);

        bg_2.off().on('animationend webkitAnimationEnd oAnimationEnd mozAnimationEnd', function() {
            setTimeout(function() {
                bg_2.fadeOut('fast').addClass('d-none').removeClass(bg_2.data('in'));
                text_LOSE.removeClass('d-none').addClass(text_LOSE.data('in'));
            }, 600);
        });

        text_LOSE.off().on('animationend webkitAnimationEnd oAnimationEnd mozAnimationEnd', function() {
            setTimeout(function() {
                text_LOSE.addClass('txt-ind');
                glow_LOSE.removeClass('d-none').addClass(glow_LOSE.data('in'));
                dots_LOSE.removeClass('d-none');
                shine_LOSE.removeClass('d-none').addClass(shine_LOSE.data('in'));
            }, 50);
        });

        glow_LOSE.off().on('animationend webkitAnimationEnd oAnimationEnd mozAnimationEnd', function() {
            bg_2.removeAttr('style').removeClass('d-none').addClass(bg_2.data('out'));
        });

        shine_LOSE.off().on('animationend webkitAnimationEnd oAnimationEnd mozAnimationEnd', function() {
            setTimeout(function() {
                dots_LOSE.fadeOut(300);
                glow_LOSE.fadeOut(500);
            }, 1000);
            setTimeout(function() {
                shine_LOSE.fadeOut(400);
                bg_1.removeClass(bg_1.data('in')).addClass(bg_1.data('out'));
            }, 2000);
            setTimeout(function() {
                text_LOSE.removeClass(text_LOSE.data('in')).addClass(text_LOSE.data('out'));
                setTimeout(function() {
                    $(document).trigger('animate:reset');
                }, 500);
            }, 2500);
        });

        $(document).on('animate:reset', function() {
            // remove attributes for visibility
            overlay.css('visibility', 'hidden');
            $('.el').each(function() {
                $(this).addClass('d-none').removeClass($(this).data('in')).removeClass($(this)
                    .data('out')).removeAttr('style');
            });
            text_LOSE.removeClass('txt-ind');
            btn.fadeIn(200);
        });
    });
</script>
