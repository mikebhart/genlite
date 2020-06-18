import $ from "jquery";
window.$ = window.jQuery = $;

import "../../src/sass/app.sass";

import "bootstrap/js/dist/util";
import "bootstrap/js/dist/dropdown";
import "bootstrap/js/dist/collapse";
import "bootstrap/js/dist/modal";


import genliteTheme from "./plugins/theme";
import genliteAnimations from "./plugins/animations";
import genliteShop from "./plugins/shop";
import genliteTemplate from "./plugins/template";


const GENLITE = {

     
    handleThemeSetup() {
        genliteTheme.setup();
    },

    handleAnimationsSetup() {
        genliteAnimations.setup();
    },

    handleShopSetup() {
        genliteShop.setup();
    },

    handleTemplateSetup() {
        genliteTemplate.setup();
    },

    initialiseAll: function () {

   
        GENLITE.handleThemeSetup();
        GENLITE.handleAnimationsSetup();
        GENLITE.handleShopSetup();
        GENLITE.handleTemplateSetup();
       
    }

};


$(document).ready(function() {

  GENLITE.initialiseAll();

 


 
});






