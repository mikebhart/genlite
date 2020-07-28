import gsap from 'gsap'

export default {

    setup() {

        filterButton();
        enableScrollActions2();
        

        function filterButton() {

            $('[data-toggle="offcanvas"]').click(function () {
                $('#genlite-shop-wrapper').toggleClass('toggled');
            });  


        }

        function enableScrollActions2() {

            //        const options = {
            //     rootMargin: "0px",
            //     threshold: 0
            //   };


            // const options = {
            //     root: null, // defaults to document
            //     rootMargin: '0px',
            //     threshold: .4 // 40% of the element needs to be in the viewport before running 
            //   };
              
            //   gsap.set('.genlite-archive-shop__card', {opacity: 0, y: 10});
              
            //   // grid to observe if in viewport
            //   const grid = document.querySelector('.genlite-archive-shop__container');
              
            //   const observer = new IntersectionObserver(handleAnimation, options);
              
              
              
            //   observer.observe(grid);
              
            //   function handleAnimation(entries, observer) {
            //     entries.forEach(entry => {
            //       if (entry.isIntersecting) {
                      

            //         gsap.to(entry.target, {opacity: 1, y: 0, duration: .3, ease: 'sine.in', stagger: 0.3});

            //       //   gsap.fromTo(entry.target, { x: '100%' } , { x: 0, stagger: .2, duration: 2, ease: "power2.out"  });
            //         // stop observing after element is in viewport so animation runs once
            //         console.log(entry.target);
            //         observer.unobserve(entry.target);
            //       }
            //     })
            //   }


                //   const targetElements = document.querySelectorAll("article h2, article h3, article h4, article h5, article h6, article section p, article section ul, .genlite-shop__product");


            //   for (let element of targetElements) {
            //       moveup.observe(element);
            //   }



              
            // gsap.fromTo(".genlite-archive-shop__card", { x: '100%' } , { stagger: 1, x: 0,  duration: 2, ease: "power2.out" });
              

        

       



              

           
            // let tlSwipeFromRight = gsap.timeline();

            // tlSwipeFromRight.to(".genlite-archive-shop__card", {x:'100vw'});               
            // tlSwipeFromRight.fromTo(".genlite-archive-shop__card", { x: '100%' } , { x: 0, stagger: .2, duration: 2, ease: "power2.out"  });

             

        }






    }

}

