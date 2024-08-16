export const handleMobileMenu = function () {

    if ( document.querySelector('#kseries-header-mobile-menu') ) {

        let mobile_menu_open =  document.getElementById("fund-mobile-menu-show");
        let mobile_menu_close =  document.getElementById("fund-mobile-menu-close");
        let mobile_fund_logo = document.getElementById("mobile-fund-logo"); 
        let mobile_header_link =  document.getElementById("fund-mobile-menu-link");

        mobile_menu_open.addEventListener("click", showFundMenuLinks);
        mobile_menu_close.addEventListener("click", showFundMenuLinks);

        function showFundMenuLinks() {

            let mobile_page_links = document.getElementById("fund_mobile_page_links");
            
            if ( mobile_page_links.style.display === "inline-block" ) {

                mobile_fund_logo.classList.remove("fund-page-header__mobile-logo-white");
                mobile_page_links.style.display = "none";
                mobile_menu_open.style.display = "inline-block";
                mobile_menu_close.style.display = "none";
                mobile_header_link.style.display = "none";
            
            } else {
            
                mobile_fund_logo.classList.add("fund-page-header__mobile-logo-white");
                mobile_page_links.style.display = "inline-block";
                mobile_menu_open.style.display = "none";
                mobile_menu_close.style.display = "inline-block";
                mobile_header_link.style.display = "inline-block";
                mobile_header_link.classList.remove("fund-page-header__mobile-logo-white");
            }
        }

        // Back Button
        let subMenuBackButtons = document.getElementsByClassName("mobile-submenu-back");

        for (let i = 0; i < subMenuBackButtons.length; i++) {
            
            (function () {

                subMenuBackButtons[i].addEventListener("click", function() { 

                    let mobileSubParentMenus = document.getElementsByClassName("fund-page-header__mobile-subnav-container");

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
