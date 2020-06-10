//import 'regenerator-runtime/runtime' // used by barba
//import barba from '@barba/core'
import gsap from 'gsap'
import genliteTheme from "./theme";


export default {

    setup() {

        if (document.body.classList.contains('admin-bar') == false) { 

         //   setupPageSwipes();
        
        }

        initDefaultPage();
        enableScrolls();
        newStuff();

        

        function newStuff() {



            var isAnimating = false;
            var  newLocation = '';
            var  firstLoad = false;

            //  console.clear;

            //   $('main a[data-type="page-transition"]').not(".genlite-page__scroll-down").each(function(){

            //     $(this).on('click', function(event){
            //         event.preventDefault();
            //         var newPage = $(this).attr('href');
            //         if( !isAnimating ) changePage(newPage);
            //         firstLoad = true;
    
    
            //      });



            // //    console.log($(this).attr('data-type'));
            //     console.log($(this));
            //  });



       
            
            //trigger smooth transition from the actual page to the new one 
            $("main").on("click", "[data-type='page-transition']", function(event){
              //alert('in');
             // console.log($(this));

              event.preventDefault();
              //detect which page has been selected
              var newPage = $(this).attr('href');
              //if the page is not already being animated - trigger animation
              if( !isAnimating ) changePage(newPage);
              firstLoad = true;




            });





          
            //detect the 'popstate' event - e.g. user clicking the back button
            $(window).on('popstate', function() {
                if( firstLoad ) {
                /*
                Safari emits a popstate event on page load - check if firstLoad is true before animating
                if it's false - the page has just been loaded 
                */
                var newPageArray = location.pathname.split('/'),
                  //this is the url of the page to be loaded 
                  newPage = newPageArray[newPageArray.length - 1];
          
                if( !isAnimating  &&  newLocation != newPage ) changePage(newPage, false);
              }
              firstLoad = true;
              });
          
              function changePage(url) {
              isAnimating = true;
              // trigger page animation
              $('body').addClass('page-is-changing');
            
                  loadNewContent(url);
                  
                newLocation = url;

                
              
              
              //if browser doesn't support CSS transitions
              if( !transitionsSupported() ) {
                loadNewContent(url);
                newLocation = url;
              }
              }
          
              function loadNewContent(url, bool) {

                var newSection = 'cd-'+url.replace('.html', '');
                var section = $('<div class="cd-main-content '+newSection+'"></div>');
                    
                section.load(url+' .cd-main-content > *', function(event){
                // load new content and replace <main> content with the new one
                $('main').html(section);
               


                //if browser doesn't support CSS transitions - dont wait for the end of transitions
                var delay = ( transitionsSupported() ) ? 2000 : 0;
                setTimeout(function(){

              
                  $('body').removeClass('page-is-changing');
                
          
                  if( !transitionsSupported() ) isAnimating = false;
                }, delay);
                
                if(url!=window.location){
                  //add the new page to the window.history
                  //if the new page was triggered by a 'popstate' event, don't add it
                  window.history.pushState({path: url},'',url);
                }

                window.scrollTo(0, 0);
                genliteTheme.setup();

                initDefaultPage();
                enableScrolls();
              
                


                  });
            }
          
            function transitionsSupported() {
              return $('html').hasClass('csstransitions');
            }
          





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

                        window.scrollTo(0, 0);
                        
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

                const options = {
                  rootMargin: "0px",
                  threshold: 0
                };

                const moveup = new IntersectionObserver(entries => {

                  entries.forEach(entry => {
                    
                    if (entry.intersectionRatio > 0)  {
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



              
              
                   window.addEventListener('DOMContentLoaded',fadeUpTargets,  {
                        once: true
    //                    passive: true,
    //                    capture: fatrue
                    });
               
              

            // Swipe from Right
            window.addEventListener('DOMContentLoaded',function(){

              
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




