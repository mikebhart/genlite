import gsap from 'gsap';
import ScrollTrigger from "gsap/ScrollTrigger";
import SplitText from "gsap/SplitText";

gsap.registerPlugin(SplitText);
gsap.registerPlugin(ScrollTrigger);



export default {

    setup() {

        enableScrollActions();
        buildHeroPages();
      
        
        //
        function enableScrollActions() {

            // slide in from right
            // Use gsap scrolltrigger batch to detect user y scroll position on the page, then fire gsap animation
            var genliteDocElements = ".genlite-archive-shop__card, .genlite-archive__card, .wp-block-embed-youtube, figcaption, .wp-block-column, .wp-block-button";

            gsap.set(genliteDocElements, {opacity: 0});

            ScrollTrigger.batch(genliteDocElements, {
                interval: 0.2, // time window (in seconds) for batching to occur. The first callback that occurs (of its type) will start the timer, and when it elapses, any other similar callbacks for other targets will be batched into an array and fed to the callback. Default is 0.1
                batchMax: 10,   // maximum batch size (targets
                once: true,
                onEnter: batch =>  gsap.fromTo(batch, { x: '100%'}, { x: 0, opacity: 1, duration: 1, ease: "sine.out", stagger: 0.2, overwrite: true}) 
            });

            // Use standard js IntersectionObserver to detect user y scroll position on the page, then fire gsap animation
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
         
                const targetElements = document.querySelectorAll("article h2, article h3, article h4, article h5, article h6, article section p, article section ul");


                for (let element of targetElements) {
                    moveup.observe(element);
                }

         
            }

            window.addEventListener('load',fadeUpTargets);


            // With images scale up

            var genliteDocImageElements = ".wp-block-image img, .wp-block-cover, .wp-block-gallery img";

            gsap.set(genliteDocImageElements, {opacity: 0});

            ScrollTrigger.batch(genliteDocImageElements, {
                interval: 0.2, // time window (in seconds) for batching to occur. The first callback that occurs (of its type) will start the timer, and when it elapses, any other similar callbacks for other targets will be batched into an array and fed to the callback. Default is 0.1
                batchMax: 10,   // maximum batch size (targets
                once: true,
                onEnter: batch => gsap.fromTo(batch, 1, {scale:0}, {scale:1, opacity: 1, repeat:0})
            });





        }

        function buildHeroPages() {

            if (document.querySelector('body.page-template-template-scroll-down') || 
                document.querySelector('body.post-template-default') || 
                document.querySelector('body.work-template-default')) {

                    // Show fancy heading animation
                    var tl = gsap.timeline(), 
                    mySplitText = new SplitText("article h1", {type:"words,chars"}), 
                    chars = mySplitText.chars;

                    gsap.set("article h1", {perspective: 400});

                    tl.from(chars, {delay: 1, duration: 1, opacity:0, scale:0, y:80, rotationX:180, transformOrigin:"0% 50% -50",  ease:"back", stagger: 0.01}, "+=0");

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





