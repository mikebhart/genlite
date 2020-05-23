export default {

    setup() {

        backToTopButton(); 
        fixNavbarSubMenus();
     

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

            //$('.navbar .depth-0').css("background-color", "black"); 

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

        }

      

    
    }

};