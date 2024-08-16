import { Fancybox } from "@fancyapps/ui";

export const handleLighbox = function () {

    if ( !document.querySelector('.wp-block-gallery') && 
         !document.querySelector('.product') ) { 
        
        return;
    }

    $(".wp-block-gallery .wp-block-image a, .woocommerce-product-details__short-description a[href$='.jpeg'], .woocommerce-product-details__short-description a[href$='.jpg']").attr('data-fancybox', 'gallery' );

    Fancybox.bind( '[data-fancybox]' );    

    a[href$='.jpeg'], a[href$='.jpg']

    
}
