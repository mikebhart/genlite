import $ from "jquery";
window.$ = window.jQuery = $;

import "../../src/sass/app.sass";

import "bootstrap/js/dist/util";
import "bootstrap/js/dist/dropdown";
import "bootstrap/js/dist/collapse";

import barba from '@barba/core';
import gsap from 'gsap';


const GENLITE = {

    initDefaultPage: function() {

        if ( document.querySelector('.type-page, .has-post-thumbnail') ) {

            $('.genlite-page__image').css("margin-top", "-112px");

            var timelinePage = gsap.timeline();
            timelinePage.fromTo('article h1', { y: 900, opacity: 0 }, { y: 0, duration: 2, opacity: 1});

        }
    },

    initBackToTopButton: function() {

        if ($('.genlite-back-to-top').length) {
            var scrollTrigger = 1000, // px
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                      $('.genlite-back-to-top').addClass('show');
                } else {
                      $('.genlite-back-to-top').removeClass('show');
                }
            };
            
            backToTop();
        
            $(window).on('scroll', function () {
                backToTop();
            });
            $('.genlite-back-to-top').on('click', function (e) {
                e.preventDefault();
                $('html,body').animate({ scrollTop: 0 }, 500);
            });
        } 
    },

    makeBootstrapBlocks: function() {

          // // Wrap a bootstrap fixed-width container around certain blocks - the rest will be fluid as per template
        $( "article" ).find("h1,h2,h3,h4,h5,h6,p,ul,.wp-block-verse,.wp-block-columns, .wp-block-quote, .wp-block-code, .wp-block-table, .wp-block-preformatted, .wp-caption, .comments-area, .wpcf7-response-output")
            .not( ".blocks-gallery-grid, .wp-block-column p, .wp-block-quote p, .post-template-default h1.entry-title" )
            .wrap( "<section><div class='container'><div class='row'><div class='col-12'></div></div></section>" );

  

        // // wrap sections around the rest, keep it all the same
        $( "article" ).find(".wp-block-gallery, .wp-block-cover, .wp-block-separator, .wp-block-button").wrap( "<section></section>" );


    },

    setupPageSwipes: function() {

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
                        pageTransition()
                        await delay(1000);
                        done();
                    },

                    async enter(data) {
                      GENLITE.initDefaultPage();
                      GENLITE.makeBootstrapBlocks();
                    }
                  
                },
            ],
          });


    },

    initialiseAll: function () {

        //GENLITE.setupPageSwipes();
        GENLITE.initDefaultPage();
        GENLITE.initBackToTopButton();
        GENLITE.makeBootstrapBlocks();
      
   
        $(window).resize(function () { });
    }

};


//const { barba } = window;

/*
 * App Class
 */
// class App {
//   static start() {
//     return new App();
//   }

//   constructor() {
//     Promise
//       .all([
//         App.domReady(),
//       ])
//       .then(this.init.bind(this));
//   }

//   static domReady() {
//     return new Promise(resolve => {
//       document.addEventListener('DOMContentLoaded', resolve);
//     });
//   }

//   static showPage() {
//     document.documentElement.classList.add('ready');
//   }

//   init() {
//     console.info('🚀App:init');

//     // Avoid "blank page" on JS error
//     try {
  
//       barba.init({
//         debug: true,
//         transitions: [
//           {
//             name: 'page-wipe',
//                     async leave(data) {
                       
//                         console.log('in leave');
                    
//                     },

//                     async enter(data) {
                      

//                         console.log('in enter');
                 
//                     }
                  
//                 },
//         ],
//       });
//     } catch (err) {
//       console.error(err);
//     }

//     App.showPage();
//   }
// }

// App.start();






$(document).ready(function() {

  GENLITE.initialiseAll();


    // // navbar menu fix
    // $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
    //     if (!$(this).next().hasClass('show')) {
    //         $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
    //     }
        
    //     var $subMenu = $(this).next(".dropdown-menu");
    //     $subMenu.toggleClass('show');
  
  
    //     $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
    //       $('.dropdown-submenu .show').removeClass("show");
    //     });
  
  
    //     return false;
    // });



  


    // //$("article img").attr("data-echo","on");
    // //$(".wp-block-cover").attr("data-echo","on");


    // // contact form 7 rows
     $(".wpcf7 .row").addClass("text-center");


    


}); // End of ready function











