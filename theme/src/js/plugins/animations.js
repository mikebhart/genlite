import gsap from 'gsap'


export default {

    setup() {

        enableScrollActions();
        buildHeroPages();
      
        //
        // Use standard js IntersectionObserver to detect user y scroll position on the page, then fire gsap animation
        //
        function enableScrollActions() {
               
            function fadeUpTargets() {


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
         
                const targetElements = document.querySelectorAll("article h2, article h3, article h4, article h5, article h6, article section p, article section ul, .genlite-shop__product");


                for (let element of targetElements) {
                    moveup.observe(element);
                }

         
            }

            window.addEventListener('load',fadeUpTargets);

            function swipeLeft() {

               
                const options = {
                    rootMargin: "0px",
                    threshold: 0
                };

                const swipeleft = new IntersectionObserver(entries => {

                    entries.forEach(entry => {

                    if (entry.intersectionRatio > 0) {
                        
                        let tlSwipeFromRight = gsap.timeline();
                
                        tlSwipeFromRight.fromTo(entry.target, { x: '100%' } , { x: 0, duration: 2, ease: "sine.out" });

                        swipeleft.unobserve(entry.target);

                    }

                    });
                }, options);
        
                const targetElements = document.querySelectorAll(".wp-block-cover, .wp-block-image img, .wp-block-embed-youtube, figcaption, .wp-block-columns, .wp-block-button, .wp-block-gallery img, footer");
                for (let element of targetElements) {
                    swipeleft.observe(element);
                }


            }
                   
            window.addEventListener('load', swipeLeft);

        }

        function buildHeroPages() {

            if (document.querySelector('body.page-template-template-scroll-down') || 
                document.querySelector('body.post-template-default') || 
                document.querySelector('body.work-template-default')) {
    
                    let tlHeading = gsap.timeline();
                        tlHeading.fromTo(
                            "article h1",
                            {
                                y: 900,
                                opacity: 0
                            }, 
                            { 
                                y: 0, 
                                duration: 3,
                                opacity: 1,
                                ease: "sine.out"
                          
                            }
                        );

                    if (document.querySelector('body.page-template-template-scroll-down')) {

                        let tlDownButton = gsap.timeline();
                            tlDownButton.fromTo(
                                ".genlite-page-scroll-down__scroll-down",
                                {
                                    opacity: 0
                                }, 
                                { 
                                    delay: 1,
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
                                duration: 2,
                                ease: "bounce.out"
                              
                            }
                        );



                    let tlMenu = gsap.timeline();
                        tlMenu.fromTo(
                            ".navbar-nav .menu-item.depth-0, .genlite-social li a",
                            {
                                x: 1200,
                                opacity: 0
                            },
                            {
                                x: 0,
                                opacity: 1,
                                duration: 1,
                                stagger: 0.2,
                                ease: "sine.out"
                            }
                    );
                
            } else {
            
                 $('.navbar').css("background-color", "black"); 
            }

               
    
        }





       
      


    }
};





