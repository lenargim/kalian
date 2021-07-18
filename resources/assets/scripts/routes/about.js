export default {
  init() {
    // JavaScript to be fired on the about us page
  },
};

let equipmentSlider = $('.about-page__slider');

equipmentSlider.slick({
  slidesToShow: 2,
  slidesToScroll: 1,
  arrows: true,
  infinite: false,
  variableWidth: true,
});
