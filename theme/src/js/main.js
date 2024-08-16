// Import our custom CSS
import '../scss/styles.scss';

import $ from "jquery";
window.$ = window.jQuery = $;

import "bootstrap/js/dist/modal";

import { handleBackToTopButton } from './plugins/back-to-top';
import { handleHeaderMenu } from './plugins/header-menu';
import { handleNavSections } from './plugins/nav-sections';
import { handleContactUsForm } from './plugins/contact-us';
//import { handleWooAjaxHandler } from './plugins/woo-ajax-handler';
import { handleMobileMenu } from './plugins/mobile-menu';

import { handleLighbox } from './plugins/lightbox';

var app = function() {

    return {               

        init: function() {

            handleBackToTopButton();
            handleHeaderMenu();
            handleNavSections();
            handleContactUsForm();
            handleMobileMenu();
            handleLighbox();
       //     handleWooAjaxHandler();
          
        }
    }

}();

$( window ).on("load", function() {

    app.init();

});
