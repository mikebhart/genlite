// Import our custom CSS
import '../scss/styles.scss';

import $ from "jquery";
window.$ = window.jQuery = $;

import "bootstrap/js/dist/modal";

import { handleContactUsForm } from './plugins/contact-us';
import { handleArchiveCategories } from './plugins/archive-categories';
import { handleScrollIndicator } from './plugins/scroll-indicator';
import { handleMobileMenu } from './plugins/mobile-menu';
import { handleBackToTop } from './plugins/back-to-top';


var app = function() {

    return {               

        init: function() {

            handleContactUsForm();
            handleMobileMenu();
            handleArchiveCategories();
            handleScrollIndicator();
            handleBackToTop();
          
        }
    }

}();

$( window ).on("load", function() {

    app.init();

});
