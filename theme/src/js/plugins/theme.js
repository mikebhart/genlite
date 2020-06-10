export default {

    setup() {

        backToTopButton(); 
        fixNavbarSubMenus();
        makeBootstrapBlocks();

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


        function fixNavbarSubMenus() {

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

            $('.genlite-header-navbar__buttton').on('click', function () {
            
                $('.genlite-header-navbar__buttton').toggleClass('open');
            });


        }


        function makeBootstrapBlocks() {

                    // // Wrap a bootstrap fixed-width container around certain blocks - the rest will be fluid as per template
                $( "article" ).find("h1,h2,h3,h4,h5,h6,p,ul,.wp-block-verse,.wp-block-columns, .wp-block-quote, .wp-block-code, .wp-block-table, .wp-block-preformatted, .wp-caption, .comments-area, .wpcf7-response-output")
                    .not( ".blocks-gallery-grid, .wp-block-column p, .wp-block-quote p, .post-template-default h1.entry-title,.comment-reply-title,.logged-in-as,.comment-notes" )
                    .wrap( "<section><div class='container'><div class='row'><div class='col-12'></div></div></section>" );

            

                // // wrap sections around the rest, keep it all the same
                $( "article" ).find(".wp-block-gallery, .wp-block-cover, .wp-block-separator, .wp-block-button").wrap( "<section></section>" );

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
                    
                    $('article a[href^=#]').bind("click", jump);

                    $("#genlite-archive__more-posts-button").bind("click",function(event) { 
                        genlite_load_posts();
                    });
                
        
        


               


        }




      

    
    }

};