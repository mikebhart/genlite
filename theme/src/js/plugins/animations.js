import gsap from 'gsap'
import genliteTheme from "./theme";


export default {

    setup() {

      
        setupPageSwipes();
        setupFrontPages();
        enableScrollActions();
        
        //
        // CSS swipe animation, that replaces the refresh of the page while the content is updated using Ajax.
        //
        function setupPageSwipes() {

            var isAnimating = false;
            var newLocation = '';
            var firstLoad = false;


            function firePageTransitionClick() {

                //trigger smooth transition from the actual page to the new one 
                event.preventDefault();

                //detect which page has been selected
                var newPage = $(this).attr('href');
                //if the page is not already being animated - trigger animation
                if( !isAnimating ) {
                   changePage(newPage, true);
                }
                firstLoad = true;
            
            }

            $("main").on("click", "[data-type='page-transition']", firePageTransitionClick);

            function changePage(url, bool) {

                isAnimating = true;

                // trigger page animation
                $('body').addClass('page-is-changing');
                loadNewContent(url);
                newLocation = url;
                
                //if browser doesn't support CSS transitions
                 if( !transitionsSupported() ) {
                   loadNewContent(url, bool);
                   newLocation = url;
                 }

            }


            function detectUserClick() {

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

            }

            //detect the 'popstate' event - e.g. user clicking the back button
            $(window).on('popstate', detectUserClick);

            
          
            function loadNewContent(url, bool) {

                var newSection = 'genlite-'+url.replace('.html', '');
                var section = $('<div class="genlite-main-content '+newSection+'"></div>');
                      
             

                section.load(url+' .genlite-main-content > *',function(event) {
                  

                    var delay = 500;
                                          
                    setTimeout(function() {

                        // load new content and replace <main> content with the new one

                        $('main').html(section);

                        window.scrollTo(0, 0);
                        genliteTheme.setup();
    
                        setupFrontPages();
                        enableScrollActions();

                        
                        $('body').removeClass('page-is-changing');
                      
                
                        if( !transitionsSupported() ) isAnimating = false;

                    }, delay);
                      
                    if(url!=window.location && bool){
                      //add the new page to the window.history
                      //if the new page was triggered by a 'popstate' event, don't add it
                      window.history.pushState({path: url},'',url);
                    }

                  
                

                });
             
            }
          
            function transitionsSupported() {
              return $('html').hasClass('csstransitions');
            }
          


        }

        //
        // Use standard js IntersectionObserver to detect user y scroll position on the page, then fire gsap animation
        //
        function enableScrollActions() {

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

            window.addEventListener('DOMContentLoaded',fadeUpTargets);

            function swipeLeft() {

               
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


            }
                   
            window.addEventListener('DOMContentLoaded', swipeLeft);
            
        }

        //
        // On posts and pages, fire gsap animations
        //
        function setupFrontPages() {

            if (document.querySelector('article.has-post-thumbnail') ) {
    
                    let tlHeading = gsap.timeline();
                        tlHeading.fromTo(
                            "article h1",
                            {
                                y: 900,
                                opacity: 1
                            }, 
                            { 
                                y: 0, 
                                duration: 2,
                                opacity: 1 
                          
                            }
                        );

                    if (document.querySelector('header.page-template-default')) {

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
                    }

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




