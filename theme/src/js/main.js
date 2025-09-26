// Import our custom CSS
import '../scss/styles.scss';

import $ from "jquery";
window.$ = window.jQuery = $;

import "bootstrap/js/dist/modal";

import { handleNavSections } from './plugins/nav-sections';
import { handleContactUsForm } from './plugins/contact-us';
import { handleMobileMenu } from './plugins/mobile-menu';
import { handleArchiveCategories } from './plugins/archive-categories';
import { handleScrollEvents } from './plugins/scroll-events';
import { handleTest } from './plugins/test';

var app = function() {

    return {               

        init: function() {

            handleNavSections();
            handleContactUsForm();
            handleMobileMenu();
            handleArchiveCategories();
            handleScrollEvents();
            handleTest();
          
        }
    }

}();

$( window ).on("load", function() {

    app.init();

});
