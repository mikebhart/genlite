import $ from "jquery";
window.$ = window.jQuery = $;

import "../../src/sass/main.sass";

import "bootstrap/js/dist/util";
import "bootstrap/js/dist/dropdown";
import "bootstrap/js/dist/collapse";
//import "bootstrap/js/dist/button";
//import "bootstrap/js/dist/toast";
//import "bootstrap/js/dist/modal";
//import "bootstrap/js/dist/carousel";
//import "bootstrap/js/dist/tab";

//import "echo-js/dist/echo";
// import 'lazysizes/plugins/parent-fit/ls.parent-fit';
// import "lazysizes/plugins/bgset/ls.bgset"
// import "lazysizes/plugins/unveilhooks/ls.unveilhooks";

// export default () => {

//   //add simple support for background images:
//   document.addEventListener('lazybeforeunveil', function(e){

//     var bg = e.target.getAttribute('data-bg');
//     if(bg){
//       e.target.style.backgroundImage = 'url(' + bg + ')';
//     }
//   });

  

//}



$(document).ready(function() {

  if (document.querySelector('.type-page') && document.querySelector('.has-post-thumbnail') ) {
    $('#genlite-header__navbar').css("height", "50px");
    $('.genlite-page-hero__image').css("margin-top", "-50px");
  }





   
   /*  -------------------------------------------------------------------

                    Add Lightbox to user added Link To Media File images

        ------------------------------------------------------------------------  */

    //    $("a[href$='.gif'], a[href$='.jpeg'], a[href$='.png'], a[href$='.jpg']").attr('data-fancybox','genlite-media-gallery').fancybox();

    /*  -----------------------------------------

        			 Back to Top button 

        ---------------------------------------------  */

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

        /*  -----------------------------------------

        			 Shop Filter

        ---------------------------------------------  */

        var trigger = $('.genlite-shop-hamburger'),
        overlay = $('.genlite-shop-overlay'),
        isClosed = false;

        trigger.click(function () {
          hamburger_cross();      
        });

        function hamburger_cross() {

          if (isClosed == true) {          
            overlay.hide();
            trigger.removeClass('is-open');
            trigger.addClass('is-closed');
            isClosed = false;
          } else {   
            overlay.show();
            trigger.removeClass('is-closed');
            trigger.addClass('is-open');
            isClosed = true;
          }
      }
      
      $('[data-toggle="offcanvas"]').click(function () {
            $('#genlite-shop-wrapper').toggleClass('toggled');
      });  
     


//  // On Page template When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
// window.onscroll = function() {scrollFunction()};

// function scrollFunction() {
//   if (document.querySelector('.page-template-default') !== null) {

  

//       if (document.body.scrollTop > 880 || document.documentElement.scrollTop > 880) {

//         setHeaderProperties();

//       } else {

//         document.getElementById("genlite-header__navbar").style.padding = "50px 10px";
//         document.getElementById("genlite-header__navbar").style.backgroundColor = "";
//         document.getElementById("genlite-header__navbar").style.color = "white";
//         document.getElementById("genlite-header__image").style.height = "100px";
//         document.getElementById("genlite-header__navbar").style.boxShadow = "";
        

//       }
//   } else {
//     setHeaderProperties();
//   }

// }


// // on non page templates
// if (document.querySelector('.page-template-default') === null) {

//   setHeaderProperties();
 
// }

// function setHeaderProperties() {

//   document.getElementById("genlite-header__navbar").style.backgroundColor = "black";
//   document.getElementById("genlite-header__navbar").style.boxShadow = "0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)";
//   document.getElementById("genlite-header__navbar").style.padding = "0px";
//   document.getElementById("genlite-header__image").style.height = "50px";

// }




 
  $('.search-button').on('click', '.search-toggle', function(e) {

    var selector = $(this).data('selector');

    $(selector).toggleClass('show').find('.search-input').focus();
    $(this).toggleClass('active');

    e.preventDefault();
  });

    // Wrap a bootstrap fixed-width container around certain blocks - the rest will be fluid as per template
    $( "article" )
      .find("h1,h2,h3,h4,h5,h6,p,ul,.wp-block-verse,.wp-block-columns, .wp-block-quote, .wp-block-code, .wp-block-table, .wp-block-preformatted, .wp-caption, .comments-area, .wpcf7-response-output")
      .not( ".blocks-gallery-grid, .wp-block-column p, .wp-block-quote p, .post-template-default h1.entry-title" )
      .wrap( "<section><div class='container'><div class='row'><div class='col-12'></div></div></section>" )
    ;

    // wrap sections around the rest, keep it all the same
    $( "article" )
      .find(".wp-block-gallery, .wp-block-cover, .wp-block-separator, .wp-block-button")
      .wrap( "<section></section>" )
    ;





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


  var jump=function(e)
{

   if (e){
       e.preventDefault();
       var target = $(this).attr("href");
   }else{
       var target = location.hash;

       // different page
   }


   $('html,body').animate(
   {
       scrollTop: $(target).offset().top
   },400,function()
   {
      
   });


}

$('html, body').hide();




$('a[href^=#]').bind("click", jump);

  

if (location.hash){

  setTimeout(function(){
        $('html, body').scrollTop(0).show();
       
        jump(); 
       
 
    }, 400);

    
}else{


    $('html, body').show();
  
}

//$("article img").attr("data-echo","on");

$(".wp-block-cover").attr("data-echo","on");




// contact form 7 rows
$(".wpcf7 .row").addClass("text-center");



barba.init({
  transitions: [{
    name: 'default-transition',
    leave() {
      // create your stunning leave animation here
    },
    enter() {
      // create your amazing enter animation here
    }
  }]
});






}); // End of ready function











