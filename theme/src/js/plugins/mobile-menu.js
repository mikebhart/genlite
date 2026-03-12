export const handleMobileMenu = function () {

    if ( !document.querySelector('#website-mobile-menu') ) {
        return;
    }
   
    let mobile_menu_open =  document.getElementById("website-mobile-menu-show");
    let mobile_menu_close =  document.getElementById("website-mobile-menu-close");
    let mobile_page_links = document.getElementById("website_mobile_page_links");

    mobile_menu_open.addEventListener("click", openMobileMenu );
    mobile_menu_close.addEventListener("click", closeMobileMenu );

    function openMobileMenu() {
        mobile_page_links.style.width = "100%";
    } 

    function closeMobileMenu() {

        mobile_page_links.style.width = "0";

    } 
    
    // Back Button
    let subMenuBackButtons = document.getElementsByClassName("mobile-submenu-back");

    for (let i = 0; i < subMenuBackButtons.length; i++) {
        
        (function () {

            subMenuBackButtons[i].addEventListener("click", function() { 

                let mobileSubParentMenus = document.getElementsByClassName("level1-subnav-container");

                for ( let i = 0; i < mobileSubParentMenus.length; i++ ) {
    
                    mobileSubParentMenus[i].style.display = "none";
    
                }

                let level2MobileSubParentMenus = document.getElementsByClassName("level2-subnav-container");

                for ( let i = 0; i < level2MobileSubParentMenus.length; i++ ) {
    
                    level2MobileSubParentMenus[i].style.display = "none";
    
                }


                let mobileParentMenus = document.getElementsByClassName("mobile-parent-menu");

                for ( let i = 0; i < mobileParentMenus.length; i++ ) {

                    mobileParentMenus[i].style.display = "block";
    
                }

                let level2MobileParentMenus = document.getElementsByClassName("level2-mobile-parent-menu");

                for ( let i = 0; i < level2MobileParentMenus.length; i++ ) {

                    level2MobileParentMenus[i].style.display = "block";
    
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

    // Level 2

    // Clear submenus

    let level2ParentSubMenus = document.getElementsByClassName("level2-mobile-parent-submenu");

    for ( let i = 0; i < level2ParentSubMenus.length; i++ ) {

        level2ParentSubMenus[i].style.display = "none";

    }

    // add event listner to level2 parent nodes

    let level2ParentMenus = document.getElementsByClassName("level2-mobile-parent-menu");

    for (let i = 0; i < level2ParentMenus.length; i++) {
        
        (function () {

            let subMenuId = 'level2-mobile-submenu-container-' + level2ParentMenus[i].id;

            level2ParentMenus[i].addEventListener("click", function() { 

                showMobileSubMenuLevel2( subMenuId );

            }, false);

        }()); 


    }



     function showMobileSubMenuLevel2( subMenuId ) {

        let mobileParentMenus = document.getElementsByClassName("level2-mobile-parent-menu");

        for ( let i = 0; i < mobileParentMenus.length; i++ ) {

            mobileParentMenus[i].style.display = "none";

        }

        let mobile_submenu_open =  document.getElementById( subMenuId );
        mobile_submenu_open.style.display = "block";

    }

    // Clear submenus

    let level2SubMenus = document.getElementsByClassName("level2-mobile-parent-submenu");

    for ( let i = 0; i < level2SubMenus.length; i++ ) {

        level2SubMenus[i].style.display = "block";

    }


   


}
