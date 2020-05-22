//import gsaptTypes from '@types/gsap'

import barba from '@barba/core'
import gsap from 'gsap'



//animation.gsap.js


//import ScrollMagic from 'scrollmagic'

import ScrollMagicPluginGsap from 'scrollmagic-plugin-gsap'

// import * as ScrollMagic from "scrollmagic"; // Or use scrollmagic-with-ssr to avoid server rendering problems
// import { TweenMax, TimelineMax } from "gsap"; // Also works with TweenLite and TimelineLite
// import { ScrollMagicPluginGsap } from "scrollmagic-plugin-gsap";

// ScrollMagicPluginGsap(ScrollMagic, TweenMax, TimelineMax);





export default {

    setup() {

        if (document.body.classList.contains('admin-bar') == false) { 

            setupPageSwipes();
        
        }

        initDefaultPage();
        makeBootstrapBlocks();
        setupMagic();



        function setupMagic() {

            // var controller = new ScrollMagicPluginGsap.Controller();

            // var scene = new ScrollMagicPluginGsap.Scene({
            //     triggerElement: ".mike12345"
            // })
            // .setTween(".mike12345", 0.5, {backgroundColor: "green", scale: 2.5}) // trigger a TweenMax.to tween
            // .addIndicators({name: "1 (duration: 0)"}) // add indicators (requires plugin)
            // .addTo(controller);




            // const tlServicesScroll = new gsap.timeline();

            // tlServicesScroll.fromTo('.anchor', {x: '100%'} , {x:0});


            // const serviceElement = document.querySelector('.anchor');



            // let homeController = new scrollmagic.Controller();

            // let serviceScene = new scrollmagic.Scene({

            //     triggerElement: '.anchor',
            //     triggerHook: 1,
            //     duration: serviceElement.offsetHeight
            // })
            // .setTween(tlServicesScroll)
            // .addTo(homeController);



            //ScrollMagicPluginGsap

        }

        function setupPageSwipes() {

            // Easit in Out on Page load
            const delay = (n) => {
                return new Promise((done) => {
                setTimeout(() => {
                    done();
                }, n)
                })
            }

            const pageTransition = () => {

                var tl = gsap.timeline();

                tl.to(".loading-screen", {
                    duration: 1.2,
                    width: "100%",
                    left: "0%",
                    ease: "Expo.easeInOut",
                });

                tl.to(".loading-screen", {
                    duration: 1,
                    width: "100%",
                    left: "100%",
                    ease: "Expo.easeInOut",
                    delay: 0.3,
                });

                tl.set(".loading-screen", { left: "-100%" });

            }

            
            barba.init({
                sync: true,
                transitions: [
                {
                    name: 'page-wipe',
                    async leave(data) {
                        const done = this.async();
                        pageTransition();
                        await delay(1600);
                        done();
                    },
                    after(data) {
                        
                        initDefaultPage();
                        makeBootstrapBlocks();
    
                        },

                    },
                ],
            });


        }



        function initDefaultPage() {

            if ( (document.querySelector('article.page-template-default') ||  document.querySelector('article.type-page')) &&
                  (document.querySelector('article.has-post-thumbnail')) ) {
    
                      var timelinePage = gsap.timeline();
                      timelinePage.fromTo('article h1', { y: 900, opacity: 0 }, { y: 0, duration: 2, opacity: 1});
                
            } else {
            
                 $('.navbar').css("background-color", "black"); 
            }
    
        }


        function makeBootstrapBlocks() {

                    // // Wrap a bootstrap fixed-width container around certain blocks - the rest will be fluid as per template
                $( "article" ).find("h1,h2,h3,h4,h5,h6,p,ul,.wp-block-verse,.wp-block-columns, .wp-block-quote, .wp-block-code, .wp-block-table, .wp-block-preformatted, .wp-caption, .comments-area, .wpcf7-response-output")
                    .not( ".blocks-gallery-grid, .wp-block-column p, .wp-block-quote p, .post-template-default h1.entry-title" )
                    .wrap( "<section><div class='container'><div class='row'><div class='col-12'></div></div></section>" );

            

                // // wrap sections around the rest, keep it all the same
                $( "article" ).find(".wp-block-gallery, .wp-block-cover, .wp-block-separator, .wp-block-button").wrap( "<section></section>" );


        }



    }
};




