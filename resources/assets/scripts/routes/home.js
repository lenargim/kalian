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
  infinite: false,
});

let actionsSlider = $('.actions-slider__slider');

actionsSlider.slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  arrows: true,
  variableWidth: true,
  infinite: false,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
      },
    },
  ],
});

$('.faq-block__questions-item').not('.active').on('click', function() {
  $(this).addClass('active').siblings().removeClass('active');
  if (window.innerWidth < 1024) {
    $(this).siblings().remove('.faq-block__answers-item');
    let clone = $('.faq-block__answers-item').eq($(this).index()).clone();
    $(this).after( clone );
    clone.fadeIn()

  } else {
    $('.faq-block__answers-item')
      .hide()
      .eq($(this).index()).fadeIn();
  }

});


$('.price-block__wrap_slider').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  arrows: true,
  draggable: false,
  infinite: false,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
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
  responsive: [
    {
      breakpoint: 1024,
      settings: 'unslick',
    },
  ],
});
