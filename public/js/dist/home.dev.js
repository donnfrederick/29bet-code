"use strict";

$(document).ready(function () {
  var filtersSliderInitialized = false;
  var bannersSliderInitialized = false;

  function initializeFiltersSlider() {
    if ($(window).width() < 992 && !filtersSliderInitialized) {
      $('.slider-filters-home').slick({
        dots: false,
        arrows: false,
        infinite: false,
        slidesToShow: 5,
        slidesToScroll: 2,
        responsive: [{
          breakpoint: 769,
          settings: {
            slidesToShow: 4,
            dots: false,
            arrows: false
          }
        }, {
          breakpoint: 480,
          settings: {
            slidesToShow: 3,
            dots: false,
            arrows: false
          }
        }]
      });
      filtersSliderInitialized = true;
    } else if ($(window).width() >= 992 && filtersSliderInitialized) {
      $('.slider-filters-home').slick('unslick');
      filtersSliderInitialized = false;
    }
  }

  function initializeBannersSlider() {
    if ($(window).width() < 768 && !bannersSliderInitialized) {
      $('.slider-home-banners').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 400,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 1900
      });
      bannersSliderInitialized = true;
    } else if ($(window).width() >= 768 && bannersSliderInitialized) {
      $('.slider-home-banners').slick('unslick');
      bannersSliderInitialized = false;
    }
  }

  initializeFiltersSlider();
  initializeBannersSlider();
  $(window).resize(function () {
    initializeFiltersSlider();
    initializeBannersSlider();
  });
});
$(".slider-service").slick({
  dots: true,
  arrows: true,
  infinite: true,
  speed: 2000,
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: false,
  autoplaySpeed: 1900,
  responsive: [{
    breakpoint: 993,
    settings: {
      slidesToShow: 1,
      dots: true,
      arrows: true
    }
  }, {
    breakpoint: 769,
    settings: {
      slidesToShow: 1,
      dots: true,
      arrows: true
    }
  }]
});
$(document).ready(function () {
  var screenWidth = $(window).width();
  var sliceSize = 6;

  if (screenWidth >= 768) {
    // Tamanho de tela para desktop
    sliceSize = 7;
  }

  $(".item--slots").slice(0, sliceSize).show();

  if ($(".item--slots:hidden").length != 0) {
    $("#loadMore__slots").show();
  }

  $("#loadMore__slots").on("click", function (e) {
    e.preventDefault();
    $(".item--slots:hidden").slice(0, sliceSize).slideDown();

    if ($(".item--slots:hidden").length == 0) {
      $("#loadMore__slots").text("NO MORE"); //.fadOut("slow");

      $("#loadMore__slots").fadeOut("fast");
    }
  });
});
$('.slder-banners-new').slick({
  dots: true,
  arrows: false,
  infinite: true,
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplaySpeed: 1600,
  autoplay: true,
  responsive: [{
    breakpoint: 993,
    settings: {
      slidesToShow: 3,
      dots: true,
      arrows: false
    }
  }, {
    breakpoint: 769,
    settings: {
      slidesToShow: 2,
      dots: true,
      arrows: false
    }
  }, {
    breakpoint: 480,
    settings: {
      slidesToShow: 1,
      slidesToScroll: 1,
      dots: true,
      arrows: true
    }
  }]
});
$(document).ready(function () {
  $('.js-slider-home').slick({
    dots: false,
    arrows: false,
    infinite: false,
    speed: 400,
    slidesToShow: 7,
    slidesToScroll: 3,
    autoplay: false,
    autoplaySpeed: 1900,
    responsive: [{
      breakpoint: 1380,
      settings: {
        slidesToShow: 7,
        dots: false,
        arrows: false
      }
    }, {
      breakpoint: 1210,
      settings: {
        slidesToShow: 5,
        dots: false,
        arrows: false
      }
    }, {
      breakpoint: 900,
      settings: {
        slidesToShow: 4,
        dots: false,
        arrows: false
      }
    }, {
      breakpoint: 480,
      settings: {
        slidesToShow: 3,
        dots: false,
        arrows: false
      }
    }, {
      breakpoint: 428,
      settings: {
        slidesToShow: 3,
        dots: false,
        arrows: false
      }
    }]
  });
  $('.prev-home').click(function () {
    $('.js-slider-home').slick('slickPrev');
  });
  $('.next-home').click(function () {
    $('.js-slider-home').slick('slickNext');
  });
});

function slickify(code_name) {
  $('.js-slider-' + code_name).slick({
    dots: false,
    arrows: false,
    infinite: false,
    speed: 400,
    slidesToShow: 6,
    rows: 2,
    slidesToScroll: 4,
    autoplay: false,
    autoplaySpeed: 1900,
    responsive: [{
      breakpoint: 1380,
      settings: {
        slidesToShow: 6,
        rows: 2,
        dots: false,
        arrows: false
      }
    }, {
      breakpoint: 1210,
      settings: {
        slidesToShow: 5,
        rows: 2,
        dots: false,
        arrows: false
      }
    }, {
      breakpoint: 900,
      settings: {
        slidesToShow: 4,
        rows: 2,
        dots: false,
        arrows: false
      }
    }, {
      breakpoint: 480,
      settings: {
        slidesToShow: 3,
        rows: 2,
        dots: false,
        arrows: false
      }
    }, {
      breakpoint: 428,
      settings: {
        slidesToShow: 3,
        rows: 2,
        dots: false,
        arrows: false
      }
    }]
  });
}

function gameSlickPrev(code_name) {
  $('.js-slider-' + code_name).slick('slickPrev');
}

function gameSlickNext(code_name) {
  $('.js-slider-' + code_name).slick('slickNext');
}

$(document).ready(function () {
  $('.js-slider-rent').slick({
    dots: false,
    arrows: false,
    infinite: false,
    speed: 400,
    slidesToShow: 7,
    slidesToScroll: 4,
    autoplay: false,
    autoplaySpeed: 1900,
    responsive: [{
      breakpoint: 993,
      settings: {
        slidesToShow: 5,
        dots: false,
        arrows: false
      }
    }, {
      breakpoint: 769,
      settings: {
        slidesToShow: 4,
        dots: false,
        arrows: false
      }
    }, {
      breakpoint: 480,
      settings: {
        slidesToShow: 3,
        dots: false,
        arrows: false
      }
    }]
  });
  $('.prev-rent').click(function () {
    $('.js-slider-rent').slick('slickPrev');
  });
  $('.next-rent').click(function () {
    $('.js-slider-rent').slick('slickNext');
  });
});
$(document).ready(function () {
  $('.js-slider-new').slick({
    dots: false,
    arrows: false,
    infinite: false,
    speed: 400,
    slidesToShow: 7,
    slidesToScroll: 4,
    autoplay: false,
    autoplaySpeed: 1900,
    responsive: [{
      breakpoint: 993,
      settings: {
        slidesToShow: 5,
        dots: false,
        arrows: false
      }
    }, {
      breakpoint: 769,
      settings: {
        slidesToShow: 4,
        dots: false,
        arrows: false
      }
    }, {
      breakpoint: 480,
      settings: {
        slidesToShow: 3,
        dots: false,
        arrows: false
      }
    }]
  });
  $('.prev-new').click(function () {
    $('.js-slider-new').slick('slickPrev');
  });
  $('.next-new').click(function () {
    $('.js-slider-new').slick('slickNext');
  });
});
$(document).ready(function () {
  $('.js-slider-casino').slick({
    dots: false,
    arrows: false,
    infinite: false,
    speed: 400,
    slidesToShow: 7,
    slidesToScroll: 4,
    autoplay: false,
    autoplaySpeed: 1900,
    responsive: [{
      breakpoint: 993,
      settings: {
        slidesToShow: 5,
        dots: false,
        arrows: false
      }
    }, {
      breakpoint: 769,
      settings: {
        slidesToShow: 4,
        dots: false,
        arrows: false
      }
    }, {
      breakpoint: 480,
      settings: {
        slidesToShow: 3,
        dots: false,
        arrows: false
      }
    }]
  });
  $('.prev-casino').click(function () {
    $('.js-slider-casino').slick('slickPrev');
  });
  $('.next-casino').click(function () {
    $('.js-slider-casino').slick('slickNext');
  });
});
$(document).ready(function () {
  $('.js-slider-providers').slick({
    dots: false,
    arrows: false,
    infinite: false,
    speed: 400,
    slidesToShow: 7,
    slidesToScroll: 4,
    autoplay: false,
    autoplaySpeed: 1900,
    responsive: [{
      breakpoint: 993,
      settings: {
        slidesToShow: 5,
        dots: false,
        arrows: false
      }
    }, {
      breakpoint: 769,
      settings: {
        slidesToShow: 4,
        dots: false,
        arrows: false
      }
    }, {
      breakpoint: 480,
      settings: {
        slidesToShow: 3,
        dots: false,
        arrows: false
      }
    }, {
      breakpoint: 380,
      settings: {
        slidesToShow: 2,
        dots: false,
        arrows: false
      }
    }]
  });
  $('.prev-providers').click(function () {
    $('.js-slider-providers').slick('slickPrev');
  });
  $('.next-providers').click(function () {
    $('.js-slider-providers ').slick('slickNext');
  });
});
$('.mobile-slider-home').slick({
  dots: false,
  arrows: false,
  infinite: true,
  speed: 400,
  slidesToShow: 3,
  slidesToScroll: 2,
  autoplay: false,
  autoplaySpeed: 1900
});