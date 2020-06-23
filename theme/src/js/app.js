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

    initialiseAll: function () {

   
        GENLITE.handleThemeSetup();
        GENLITE.handleAnimationsSetup();
        GENLITE.handleShopSetup();
       
    }

};


$(document).ready(function() {

  GENLITE.initialiseAll();

 
});






