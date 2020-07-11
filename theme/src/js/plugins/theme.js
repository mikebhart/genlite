export default {

    setup() {

        backToTopButton(); 
        globalEvents();
        bootstrapStyles();
        lightBoxSetup();

        function backToTopButton() {


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
        }


        function globalEvents() {


            $('.genlite-header-navbar__buttton').on('click', function () {
                $('.genlite-header-navbar__buttton').toggleClass('open');
            });


            $('header .genlite-header-nabvar__links a').on('click', function () {
                document.getElementById("genlite-header-navbar-search").style.display = "block";
            });

            $('header .closebtn').on('click', function () {
                document.getElementById("genlite-header-navbar-search").style.display = "none";
            });
            

        }

        function bootstrapStyles() {

                    // // Wrap a bootstrap fixed-width container around certain blocks - the rest will be fluid as per template
                $( "article" ).find("h1,h2,h3,h4,h5,h6,p,ul,.wp-block-verse, .wp-block-quote, .wp-block-code, .wp-block-table, .wp-block-preformatted, .wp-caption, .comments-area, .wpcf7-response-output")
                    .not( ".blocks-gallery-grid, .wp-block-column p, .wp-block-quote p, .post-template-default h1.entry-title,.comment-reply-title,.logged-in-as,.comment-notes, .genlite-page-scroll-down__overlay-text h1, .genlite-title-row h1" )
                    .wrap( "<section><div class='container'><div class='row'><div class='col-12'></div></div></section>" );
            
                $( "article" ).find(".wp-block-columns")
                    .wrap("<div class='container'><div class='row'><div class='col-12'></div></div></div>");

                $( "article" ).find(".wp-block-gb-image-service-button").closest(".container").addClass("container-fluid").removeClass("container");
                
                // // wrap sections around the rest, keep it all the same
                $( "article" ).find(".wp-block-gallery, .wp-block-cover, .wp-block-separator, .wp-block-button").wrap( "<section></section>" );


                
                // // contact form 7 rows
                $(".wpcf7 .row").addClass("text-center");

                $(".wpcf7-form-control.wpcf7-text, .wpcf7-form-control.wpcf7-textarea, footer .search-field").addClass("form-control");

                


        }

        function lightBoxSetup() {

             /*  -------------------------------------------------------------------
                    Add Lightbox to user added Link To Media File images
                 ------------------------------------------------------------------------  */

                 if (document.querySelector('body.genlite__lightbox')) {

                    $("a[href$='.gif'], a[href$='.jpeg'], a[href$='.png'], a[href$='.jpg']").attr('data-fancybox','genlite-media-gallery').fancybox();
                
                }


        }

        
    }

};