import $ from "jquery";
window.$ = window.jQuery = $;

import "../../src/sass/app.sass";

import "bootstrap/js/dist/util";
import "bootstrap/js/dist/dropdown";
import "bootstrap/js/dist/collapse";




import genliteTheme from "./plugins/theme";
import genliteAnimations from "./plugins/animations";


const GENLITE = {

    
    handleThemeSetup() {
        genliteTheme.setup();
    },

    handleAnimationsSetup() {
        genliteAnimations.setup();
    },


    initialiseAll: function () {

        GENLITE.handleThemeSetup();
        GENLITE.handleAnimationsSetup();
       
    }

};


$(document).ready(function() {

  GENLITE.initialiseAll();

 
});






