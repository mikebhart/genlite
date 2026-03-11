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


    // // Level 2

     // Back Button
    let subMenuBackButtonsLevel2 = document.getElementsByClassName("level2-mobile-submenu-back");

    for (let i = 0; i < subMenuBackButtonsLevel2.length; i++) {
        
        (function () {

            subMenuBackButtonsLevel2[i].addEventListener("click", function() { 

                let mobileSubParentMenus = document.getElementsByClassName("level2-subnav-container");

                for ( let i = 0; i < mobileSubParentMenus.length; i++ ) {
    
                 
                    mobileSubParentMenus[i].style.display = "none";
    
                }


                let mobileParentMenus = document.getElementsByClassName("level2-mobile-parent-menu");

                for ( let i = 0; i < mobileParentMenus.length; i++ ) {

                                       


                    mobileParentMenus[i].style.display = "block";
    
                }

            }, false);

        }()); 


    }


    let parentSubMenusLevel2 = document.getElementsByClassName("level2-mobile-parent-submenu");

    for (let i = 0; i < parentSubMenusLevel2.length; i++) {
        
        (function () {

            let subMenuId = 'level2-mobile-submenu-' + parentSubMenusLevel2[i].id;

            parentSubMenusLevel2[i].addEventListener("click", function() { 

                console.log('a=' + subMenuId);

                showMobileSubMenuLevel2( subMenuId );

            }, false);

        }()); 


    }

    function showMobileSubMenuLevel2( subMenuId ) {

        let mobileParentMenusLevel1 = document.getElementsByClassName("mobile-parent-menu");

      //  let mobileParentMenusLevel2 = document.getElementsByClassName("level2-mobile-parent-menu");


        for ( let i = 0; i < mobileParentMenusLevel1.length; i++ ) {

            mobileParentMenusLevel1[i].style.display = "none";

        }


        // for ( let i = 0; i < mobileParentMenusLevel2.length; i++ ) {

        //     mobileParentMenusLevel2[i].style.display = "block";
            

        // }

        let mobile_submenu_open =  document.getElementById( subMenuId );
        mobile_submenu_open.style.display = "block";

    }


    


}
