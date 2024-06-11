$.on("/ranks",function(){

    $('.slider-trunk').slick({


        // centerMode: true,
        // focusOnSelect: true,
        // centerPadding: '100px',
        dots: false,
        arrows: false,
        infinite: false,
        slidesToShow: 7,
        // slidesToScroll: 4,
        
        autoplay: false,

        responsive: [
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

    // const swiper = new Swiper('.swiper-ranks', {
    //     slidesPerView: 3,
    //     spaceBetween: 4,
    //     resistanceRatio : 0,
    //     breakpoints: {
    //         280: {
    //             slidesPerView: 1,
    //             spaceBetween: 20,
    //             resistanceRatio: 0.85
    //         },
    //         768: {
    //             slidesPerView: 2,
    //             spaceBetween: 20,
    //             resistanceRatio: 0.85
    //         },
    //         980: {
    //             slidesPerView: 3,
    //             spaceBetween: 20,
    //             resistanceRatio: 0.85
    //         },
    //         1280: {
    //             slidesPerView: 3,
    //             spaceBetween: 20,
    //             resistanceRatio : 0
    //         }
    //     },
    //     keyboard: {
    //         enabled: true,
    //     },
    //      navigation: {
    //         nextEl: '.swiper-button-next',
    //         prevEl: '.swiper-button-prev',
    //     },
    // });

    $(document).ready(function(){

        $('.js-slider-ranks-user').slick({
          dots: false,
          arrows: false,
          infinite: false,
          slidesToShow: 3,
          slidesToScroll: 3,
          autoplay: false,
          autoplaySpeed: 1900,
          responsive: [
            {
              breakpoint: 993,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                dots: false,
                arrows: false,
              },
            },
            {
                breakpoint: 769,
                settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: false,
                  arrows: false,
                }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: false,
                arrows: false,
              },
            },
          ],
        });

        $('.prev-ranks-user').click(function(){
          $('.js-slider-ranks-user').slick('slickPrev');
        });

        $('.next-ranks-user').click(function(){
          $('.js-slider-ranks-user').slick('slickNext');
        });

    });



});
