// Import our custom CSS
import '../scss/styles.scss';

import $ from "jquery";
window.$ = window.jQuery = $;

import "bootstrap/js/dist/modal";

import { handleBackToTopButton } from './plugins/back-to-top';
import { handleNavSections } from './plugins/nav-sections';
import { handleContactUsForm } from './plugins/contact-us';
import { handleMobileMenu } from './plugins/mobile-menu';
import { handleArchiveCategories } from './plugins/archive-categories';

var app = function() {

    return {               

        init: function() {

            handleBackToTopButton();
            handleNavSections();
            handleContactUsForm();
            handleMobileMenu();
            handleArchiveCategories();
          
        }
    }

}();

$( window ).on("load", function() {

    app.init();

});
