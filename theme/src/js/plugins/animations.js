import 'regenerator-runtime/runtime' // used by barba
import barba from '@barba/core'
import gsap from 'gsap'
import genliteTheme from "./theme";

export default {

    setup() {

        if (document.body.classList.contains('admin-bar') == false) { 

            setupPageSwipes();
        
        }

        initDefaultPage();
        enableScrolls();
        var mikeload;


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
                    duration: 2,
                    width: "100%",
                    left: "0%",
                    ease: "Expo.easeInOut",
                });

                tl.to(".loading-screen", {
                    duration: 1,
                    width: "100%",
                    left: "100%",
                    ease: "Expo.easeInOut",
                    delay: 0.3
                });

                tl.set(".loading-screen", { left: "-100%" });

            }

            
            barba.init({
                sync: true,
                transitions: [
                {
                    name: 'genlite-page-wipe',
                    async leave(data) {
                        const done = this.async();
                        pageTransition();
                        await delay(2000);
                        done();
                    },
                    after(data) {


                        initDefaultPage();
                        enableScrolls();
                        genliteTheme.setup();

                        },

                    beforeLeave(data) {
//                           alert('about to leave');
                       //    window.addEventListener('unload',fadeUpTargets);
                  //     enableScrolls();
                    }

                },
                ],
            });


        }

        function enableScrolls() {

            function fadeUpTargets(){

                //event.preventDefault();
       
                const options = {
                  rootMargin: "0px",
                  threshold: 0
                };

                const moveup = new IntersectionObserver(entries => {

                  entries.forEach(entry => {
                    
                    if (entry.intersectionRatio > 0)  {
                    console.log('inxdasd');
                      let tlFadeInBottom = gsap.timeline();
                      tlFadeInBottom.from(entry.target, { y: 100, opacity: 0, duration: 1 });
                      moveup.unobserve(entry.target);
                    }

                  });
                }, options);
         
                const targetElements = document.querySelectorAll(".wp-block-button, .wp-block-columns, article h2, article section p, article section ul");


                for (let element of targetElements) {
                    moveup.observe(element);
                }

         
              }

          

              
           
            // FadeInBottom
         //   window.removeEventListener('load', fadeUpTargets);

//          var nextButton = document.querySelector(".swipe-button-next"); 

// if(nextButton != null)
//     nextButton.addEventListener(...);



              
                   window.addEventListener('DOMContentLoaded',fadeUpTargets,  {
                        once: true
    //                    passive: true,
    //                    capture: fatrue
                    });
              

                // window.addEventListener('load',function() {

                //  alert(mikeload);
                 
                // }
                // );

//                 $('body').click(function(){ alert('test' )})

// var foo = $.data( $('body').get(0), 'events' ).click
// // you can query $.data( object, 'events' ) and get an object back, then see what events are attached to it.

// $.each( foo, function(i,o) {
//     alert(i) // guid of the event
//     alert(o) // the function definition of the event handler
// });




                //   window.addEventListener('unload',fadeUpTargets) {
                //     console.log('I am the 3rd one.')

                //   };


            //   element.addEventListener('click', myClickHandler, {
            //     once: true,
            //     passive: true,
            //     capture: true
            //   });




            // Swipe from Right
            window.addEventListener('load',function(){

              
                const options = {
                  rootMargin: "0px",
                  threshold: 0
                };

                const swipeleft = new IntersectionObserver(entries => {

                  entries.forEach(entry => {
                    
                    if (entry.intersectionRatio > 0) {

                      let tlSwipeFromRight = gsap.timeline();
                      tlSwipeFromRight.fromTo(entry.target, { x: '100%' } , { x: 0 });

                      swipeleft.unobserve(entry.target);

                    }

                  });
                }, options);
         
                const targetElements = document.querySelectorAll(".wp-block-cover, article img");
                for (let element of targetElements) {
                    swipeleft.observe(element);
                }

         
              });



        }



        function initDefaultPage() {

            if  (document.querySelector('article.has-post-thumbnail') ) {
    
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


       


    }
};




