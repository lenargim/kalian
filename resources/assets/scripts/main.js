// import external dependencies
//import 'jquery';
import 'slick-carousel/slick/slick.min';
import 'jquery-mask-plugin/dist/jquery.mask.min'
import '@fancyapps/ui/dist/fancybox.umd';

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Home page
  home,
  // About Us page, note the change from about-us to aboutUs.
  aboutUs,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
