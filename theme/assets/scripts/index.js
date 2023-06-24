import $ from "jquery";
window.$ = window.jQuery = $;

import "../../assets/styles/index.scss";
import "bootstrap/js/dist/modal";

import { handleBackToTopButton } from './plugins/back-to-top';
import { handleHeaderMenu } from './plugins/header-menu';
import { handleNavSections } from './plugins/nav-sections';
import { handleContactUsForm } from './plugins/contact-us';

var app = function() {

    return {               

        init: function() {

            handleBackToTopButton();
            handleHeaderMenu();
            handleNavSections();
            handleContactUsForm();
          
        }
    }

}();

$( window ).on("load", function() {

    app.init();

});
