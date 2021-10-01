export default {
  init() {
    // JavaScript to be fired on the home page
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};

let slider = $('.banner__slider');
let sliderCounter = $('.banner__slider-counter');

let updateSliderCounter = function (slick) {
  let currentSlide = slick.slickCurrentSlide() + 1;
  sliderCounter.html(currentSlide);
};

slider.on('init afterChange', function (event, slick) {
  updateSliderCounter(slick);
});

slider.slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  appendArrows: $('.banner__arrow-box'),
  draggable: false,
  infinite: true,
  autoplay: true,
  autoplaySpeed: 5000,
  pauseOnHover: false,
});

let actionsSlider = $('.actions-slider__slider');

actionsSlider.slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  arrows: true,
  variableWidth: true,
  infinite: false,
  swipeToSlide: true,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
      },
    },
  ],
});

$('.faq-block__questions-item').on('click', function() {
  if (window.innerWidth > 1023) {
   if ( !$(this).hasClass('active') ) {
     $(this).addClass('active').siblings().removeClass('active');
     $('.faq-block__answers-item')
       .hide()
       .eq($(this).index()).fadeIn();
   }
  } else {
    $(this).toggleClass('active').siblings().removeClass('active');
    $(this).siblings().remove('.faq-block__answers-item');
    if ( $(this).hasClass('active') ) {
      let clone = $('.faq-block__answers-item').eq($(this).index()).clone();
      $(this).after( clone );
      clone.fadeIn()
    } else {
      return
    }
  }

});


$('.price-block__wrap_slider').slick({
  slidesToShow: 4,
  arrows: true,
  infinite: false,
  swipeToSlide: true,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
      },
    },
  ],
});

$('.reviews-block__item-box_slider').slick({
  slidesToShow: 2,
  slidesToScroll: 1,
  arrows: true,
  infinite: false,
  mobileFirst: true,
  swipeToSlide: true,
  responsive: [
    {
      breakpoint: 1024,
      settings: 'unslick',
    },
  ],
});

$('.covid-block__link').on( 'click', function () {
  $(this).siblings('.covid-block__iframe').slideToggle();
  $(this).text() == 'Подробнее' ? $(this).text('Скрыть') : $(this).text('Подробнее')
});
