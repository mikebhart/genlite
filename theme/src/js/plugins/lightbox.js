import { Fancybox } from "@fancyapps/ui";

export const handleLighbox = function () {

    if ( !document.querySelector('.wp-block-gallery') ) { 
        return;
    }
   
    $(".wp-block-gallery .wp-block-image a").attr('data-fancybox', 'gallery' );

    Fancybox.bind( '[data-fancybox]' );    
    
}
