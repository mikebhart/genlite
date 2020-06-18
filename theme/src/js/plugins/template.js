import gsap from 'gsap'

export default {

    setup() {

        buildHeroPages();

         //
        // On posts and pages, fire gsap animations
        //
        function buildHeroPages() {

            if (document.querySelector('header.page-template-template-scroll-down') || 
                document.querySelector('header.post-template-default') || 
                document.querySelector('header.work-template-default')) {
    
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

                    if (document.querySelector('header.page-template-template-scroll-down')) {

                        let tlDownButton = gsap.timeline();
                            tlDownButton.fromTo(
                                ".genlite-page-scroll-down__scroll-down",
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

}