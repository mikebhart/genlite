import $ from "jquery";
window.$ = window.jQuery = $;

import "../../src/sass/app.sass";

import "bootstrap/js/dist/util";
import "bootstrap/js/dist/dropdown";
import "bootstrap/js/dist/collapse";

import barba from '@barba/core';
import gsap from 'gsap';


$(document).ready(function() {


  




  
    // $("article img").removeAttr("src").addClass("genlite-lazy-load-image");


    //   const io = new IntersectionObserver((entries) =>
    //   entries.forEach((entry) => {
    //       // set image source only when it is in the viewport
    //       if (entry.isIntersecting) {
    //           const image = entry.target;
    //           // setting image source from the dataset
    //           image.src = image.dataset.src;

    //           // when image is loaded, we do not need to observe it any more
    //           io.unobserve(image);
    //       }
    //   })
    // );

    // document.querySelectorAll(".genlite-lazy-load-image").forEach((element) => io.observe(element));




  // if using Page Template and has a featured image
    function setup_default_page() { 
        if ( document.querySelector('.type-page, .has-post-thumbnail') ) {

            let intViewportHeight = window.innerHeight + 'px';
      
            $('.genlite-page__image').css("height", intViewportHeight);
            $('.genlite-page__image').css("margin-top", "-112px");
    

            var timelinePage = gsap.timeline();
            timelinePage.fromTo('article h1', { y: 900, opacity: 0 }, { y: 0, duration: 2, opacity: 1});

        }
    }

    setup_default_page();

    // Back to Top button 

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
    
    
   
   
      // $('.scroll-down').click (function() {
      //   $('html, body').animate({scrollTop: $('section.ok').offset().top }, 'slow');
      //   return false;
      // });
    


      //alert('a');

    // Wrap a bootstrap fixed-width container around certain blocks - the rest will be fluid as per template
    $( "article" ).find("h1,h2,h3,h4,h5,h6,p,ul,.wp-block-verse,.wp-block-columns, .wp-block-quote, .wp-block-code, .wp-block-table, .wp-block-preformatted, .wp-caption, .comments-area, .wpcf7-response-output")
      .not( ".blocks-gallery-grid, .wp-block-column p, .wp-block-quote p, .post-template-default h1.entry-title" )
      .wrap( "<section><div class='container'><div class='row'><div class='col-12'></div></div></section>" );

  

    // wrap sections around the rest, keep it all the same
    $( "article" ).find(".wp-block-gallery, .wp-block-cover, .wp-block-separator, .wp-block-button").wrap( "<section></section>" );


    // navbar menu fix
    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');
  
  
        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
          $('.dropdown-submenu .show').removeClass("show");
        });
  
  
        return false;
    });


    // Scroll to href anchors
    var jump=function(e) {

        if (e) {

            e.preventDefault();
            var target = $(this).attr("href");

        } else {

          var target = location.hash;

        }


        $('html,body').animate({scrollTop: $(target).offset().top},400,function() {});

    }
    
    $('a[href^=#]').bind("click", jump);

  


    //$("article img").attr("data-echo","on");
    //$(".wp-block-cover").attr("data-echo","on");


    // contact form 7 rows
    $(".wpcf7 .row").addClass("text-center");


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

  

    try {


    barba.init({
      sync: true,

      transitions: [
          {
              name: 'page-wipe',
              async leave(data) {

                  const done = this.async();

                  pageTransition();
                  await delay(1000);
                
                  done();

                 // console.log('in leave11');

                  
              },

              async enter(data) {
                setup_default_page();
                // console.log('in enter');
              }

            
          },
      ],
    });


  }
  catch(err) {
    alert(err.message);
  }








}); // End of ready function











