import gsap from 'gsap';
import ScrollTrigger from "gsap/ScrollTrigger";

export const handleAnimations = function () {

    let anim_duration = 0.3;
    let anim_stagger = 0.2;

    gsap.registerPlugin( ScrollTrigger );

    // if ( document.querySelector('.block-hero-image .slidetext') ) { 

    //     var sliderTween = function() {

    //         var heroTextSlidesTimeline = gsap.timeline( { repeat: -1 } );

    //         var slide_elements = document.querySelectorAll( ".slidetext" );

    //         for ( let i = 0; i < slide_elements.length; i++ ) {

    //             let current_slide = '.' + slide_elements[i].classList[2];

    //             heroTextSlidesTimeline.to(current_slide, { opacity: 1, duration: 2, ease: "power2.inOut" } )
    //                                 .to(current_slide, { opacity: 0, duration: 2, ease: "power2.inOut", delay: 5 } );

    //         }

    //     };

    //     sliderTween();

    // }


    // Move up

    // if ( document.querySelector('article p') ) { 
      
        var animationUpElements = '.page-template-default h1,' +
                                '.page-template-default h2,' +
                                '.page-template-default h3,' +
                                '.page-template-default h4,' +
                                '.page-template-default h5,' +
                                '.page-template-default h6,' +
                                '.page-template-default p,' +
                                '.page-template-default article ul li,' +
                                '.page-template-default .wp-block-button,' +
                                '.fade-in-up,' +
                                '.work-template-default h1,' +
                                '.work-template-default h2,' +
                                '.work-template-default h3,' +
                                '.work-template-default h4,' +
                                '.work-template-default h5,' +
                                '.work-template-default h6,' +
                                '.work-template-default p,' +
                                '.work-template-default article ul li,' +
                                '.work-template-default .wp-block-button';

                               

    

        gsap.set( animationUpElements, { opacity: 0 } );

        ScrollTrigger.batch( animationUpElements, {
            once: true,
            onEnter: batch =>  gsap.fromTo( batch, { y: '50%'}, { y: 0, opacity: 1, duration: anim_duration, ease: "sine.out", stagger: anim_stagger, overwrite: true }) 
        });

    // }

    // // Move Down

    if ( document.querySelector('.fade-in-down') ) { 

        var animationDownElements = ".fade-in-down";

        gsap.set( animationDownElements, { opacity: 0 } );

        ScrollTrigger.batch( animationDownElements, {
            once: true,
            onEnter: batch =>  gsap.fromTo( batch, { y: '-50%'}, { y: 0, opacity: 1, duration: anim_duration, ease: "sine.out", stagger: anim_stagger, overwrite: true, clearProps: "transform" }) 
        });

    }


    // // Move From Left

    // if ( document.querySelector('.fade-in-left') ) { 

    //     var animationLeftElements = ".fade-in-left";

    //     gsap.set( animationLeftElements, { opacity: 0 } );

    //     ScrollTrigger.batch( animationLeftElements, {
    //         once: true,
    //         onEnter: batch =>  gsap.fromTo( batch, { x: '-50%'}, { x: 0, opacity: 1, duration: anim_duration, ease: "sine.out", stagger: anim_stagger, overwrite: true }) 
    //     });

    // }

        
    // // // Move From Right

    if ( document.querySelector('.fade-in-right') ) { 

        var animationRightElements = ".fade-in-right";
    
        gsap.set( animationRightElements, { opacity: 0 } );

        ScrollTrigger.batch( animationRightElements, {
            once: true,
            onEnter: batch =>  gsap.fromTo( batch, { x: '50%'}, { x: 0, opacity: 1, duration: anim_duration, ease: "sine.out", stagger: anim_stagger, overwrite: true }) 
        });

    }

    // // Zoom

    // if ( document.querySelector('.fade-in-zoom') ) { 

        var animationZoomElements = '.page-template-default .wp-block-image,' +
                                    '.page-template-default .wp-block-cover,' +
                                    '.fade-in-zoom';

        gsap.set( animationZoomElements, { opacity: 0 } );

        ScrollTrigger.batch( animationZoomElements, {
            once: true,
            onEnter: batch => gsap.fromTo(batch, 1, {scale:0}, {scale:1, opacity: 1, repeat:0, stagger: anim_stagger })
        });


    // }


};
