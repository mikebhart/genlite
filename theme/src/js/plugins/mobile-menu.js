export const handleMobileMenu = function () {

    if ( document.querySelector('#website-mobile-menu') ) {

        let mobile_menu_open =  document.getElementById("website-mobile-menu-show");
        let mobile_menu_close =  document.getElementById("website-mobile-menu-close");

        let mobile_website_logo = document.getElementById("mobile-website-logo"); 
        let mobile_header_link =  document.getElementById("website-mobile-menu-link");

        mobile_menu_open.addEventListener("click", showwebsiteMenuLinks);
        mobile_menu_close.addEventListener("click", showwebsiteMenuLinks);

        function showwebsiteMenuLinks() {

            let mobile_page_links = document.getElementById("website_mobile_page_links");
            
            if ( mobile_page_links.style.display === "inline-block" ) {

                mobile_page_links.style.display = "none";
                mobile_menu_open.style.display = "inline-block";
                mobile_menu_close.style.display = "none";
                mobile_header_link.style.display = "none";
            
            } else {
            
                mobile_page_links.style.display = "inline-block";
                mobile_menu_open.style.display = "none";
                mobile_menu_close.style.display = "inline-block";
                mobile_header_link.style.display = "inline-block";
            }
        }

        // Back Button
        let subMenuBackButtons = document.getElementsByClassName("mobile-submenu-back");

        for (let i = 0; i < subMenuBackButtons.length; i++) {
            
            (function () {

                subMenuBackButtons[i].addEventListener("click", function() { 

                    let mobileSubParentMenus = document.getElementsByClassName("website-header__mobile-subnav-container");

                    for ( let i = 0; i < mobileSubParentMenus.length; i++ ) {
        
                        mobileSubParentMenus[i].style.display = "none";
        
                    }


                    let mobileParentMenus = document.getElementsByClassName("mobile-parent-menu");

                    for ( let i = 0; i < mobileParentMenus.length; i++ ) {

                        mobileParentMenus[i].style.display = "block";
        
                    }

                }, false);

            }()); 


        }

        // Parent Sub Menus
        let parentSubMenus = document.getElementsByClassName("mobile-parent-submenu");

        for (let i = 0; i < parentSubMenus.length; i++) {
            
            (function () {

                let subMenuId = 'mobile-submenu-' + parentSubMenus[i].id;

                parentSubMenus[i].addEventListener("click", function() { 

                    showMobileSubMenu( subMenuId );

                }, false);

            }()); 


        }

        function showMobileSubMenu( subMenuId ) {

            let mobileParentMenus = document.getElementsByClassName("mobile-parent-menu");

            for ( let i = 0; i < mobileParentMenus.length; i++ ) {

                mobileParentMenus[i].style.display = "none";

            }

            let mobile_submenu_open =  document.getElementById( subMenuId );
            mobile_submenu_open.style.display = "block";

        }

    }


}
