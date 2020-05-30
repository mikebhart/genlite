import 'regenerator-runtime/runtime' // used by barba

import barba from '@barba/core'
import gsap from 'gsap'

import { CSSPlugin } from 'gsap/CSSPlugin'


// Force CSSPlugin to not get dropped during build
gsap.registerPlugin(CSSPlugin)


import ScrollMagic from 'scrollmagic'
import { TweenMax, TimelineMax, Linear } from 'gsap'

import 'imports-loader?define=>false!scrollmagic/scrollmagic/uncompressed/plugins/debug.addIndicators'
import { ScrollMagicPluginGsap } from "scrollmagic-plugin-gsap";

ScrollMagicPluginGsap(ScrollMagic, TweenMax, TimelineMax);


export default {

    setup() {

        if (document.body.classList.contains('admin-bar') == false) { 

            setupPageSwipes();
        
        }

        initDefaultPage();
        makeBootstrapBlocks();
        enableScrolls();



        function enableScrolls() {


            let controller = new ScrollMagic.Controller();

            // FadeInBottom
            let fadeElem = Array.prototype.slice.call(document.querySelectorAll(".wp-block-button, .wp-block-columns, article h2, article section p, article section ul"));
            let self = this;

            fadeElem.forEach(function(self) {
                // build a tween
                let tlFadeInBottom = TweenMax.from(self, 1.5, { y: 100, opacity: 0 });
                // build a scene
                let scene = new ScrollMagic.Scene({
                    triggerElement: self,
                    offset: -200,
                    reverse: false
                })
                .setTween(tlFadeInBottom)
                .addTo(controller)
            })

            // Swipe from Right
            let swipeElem = Array.prototype.slice.call(document.querySelectorAll(".wp-block-cover, article img"));
            let selfSwipe = this;

            swipeElem.forEach(function(selfSwipe) {

                let tlSwipeFromRight = TweenMax.fromTo(selfSwipe, { x: '100%' } , { x: 0 });

                let servicesScene = new ScrollMagic.Scene({
                    triggerElement: selfSwipe,
                    triggerHook: 1,
                    duration: "100%",
                    reverse: false
                })
                .setTween(tlSwipeFromRight) 
                .addTo(controller);


            });



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
                        enableScrolls();
    
                        },

                    },
                ],
            });


        }



        function initDefaultPage() {

            if ( (document.querySelector('article.page-template-default') ||  document.querySelector('article.type-page')) &&
                  (document.querySelector('article.has-post-thumbnail')) ) {
    
                    let tlHeading = gsap.timeline();
                        tlHeading.fromTo(
                            "article h1",
                            {
                                y: 900,
                                opacity: 0
                            }, 
                            { 
                                y: 0, 
                                duration: 2,
                                opacity: 1 
                          
                            }
                        );

                    let tlDownButton = gsap.timeline();
                        tlDownButton.fromTo(
                            ".genlite-page__scroll-down",
                            {
                                opacity: 0
                            }, 
                            { 
                                opacity: 1,
                                duration: 2
                              
                            }
                        );

                    let tlLogo = gsap.timeline();
                        tlLogo.fromTo(
                            "#genlite-header__image",
                            {
                                x: -200,
                                opacity: 0
                            },
                            {
                                x: 0,
                                opacity: 1,
                                duration: 2
                              
                            }
                        );



                    let tlMenu = gsap.timeline();
                        tlMenu.fromTo(
                            "#navbarTogglerHeaderMenu, .navbar-toggler",
                            {
                                x: 1200,
                                opacity: 0
                            },
                            {
                                x: 0,
                                opacity: 1,
                                duration: 2
                             
                            }
                    );
                
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

                $('.genlite-header-navbar__buttton').on('click', function () {
            
                    $('.genlite-header-navbar__buttton').toggleClass('open');
                  });

                  
                  


        }



    }
};




