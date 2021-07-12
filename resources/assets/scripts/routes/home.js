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
  //let slidesCount = slick.slideCount;
  sliderCounter.html(currentSlide);
};

slider.on('init afterChange', function (event, slick) {
  updateSliderCounter(slick);
});

let prevArrow = '<div class="banner__arrow"><i class="arrow left"></i></div>'
let nextArrow = '<div class="banner__arrow"><i class="arrow right"></i></div>'

slider.slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  appendArrows: $('.banner__arrow-box'),
  prevArrow: prevArrow,
  nextArrow: nextArrow,
});

let actionsSlider = $('.actions-slider__slider');

actionsSlider.slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  arrows: true,
  variableWidth: true,
  infinite: false,
});

$('.faq__questions-item:not(.active)').on('click', function() {
  $(this).addClass('active').siblings().removeClass('active');
  $('.faq__answers-item')
    .hide()
    .eq($(this).index()).fadeIn()
});
