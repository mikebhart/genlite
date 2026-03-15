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

            //    mobileMenuPath.pop();

                 mobileMenuPath = [];
                 console.log(mobileMenuPath);

                let mobileSubParentMenus = document.getElementsByClassName("level1-subnav-container");

                for ( let i = 0; i < mobileSubParentMenus.length; i++ ) {
    
                    mobileSubParentMenus[i].style.display = "none";
    
                }

         

                let mobileParentMenus = document.getElementsByClassName("mobile-parent-menu");

                for ( let i = 0; i < mobileParentMenus.length; i++ ) {

                    mobileParentMenus[i].style.display = "block";
    
                }

           //     let level2MobileParentMenus = document.getElementsByClassName("level2-mobile-parent-menu");
             //   let level2MobileParentLevel2Menus = document.getElementsByClassName("level2-mobile-parent-menu level2");



                // if ( level2MobileParentLevel2Menus.length > 0 ) {

                //     alert('level2');
                
                // }

// [                    for ( let i = 0; i < level2MobileParentMenus.length; i++ ) {

//                         level2MobileParentMenus[i].style.display = "block";
//                     }
// ]                    
//                 }




            }, false);

        }()); 


    }




    let level2SubMenuBackButtons = document.getElementsByClassName("mobile-submenu-back.level2");
    

    console.log(level2SubMenuBackButtons);

    for ( let j = 0; j < level2SubMenuBackButtons.length; j++ ) {
        
        (function () {

            level2SubMenuBackButtons[j].addEventListener("click", function() { 

              //  mobileMenuPath.pop(level2SubMenuBackButtons[j].innerText);

                mobileMenuPath = [];

                console.log(mobileMenuPath);

                let level2MobileSubParentMenus = document.getElementsByClassName("level2-mobile-parent-menu");

                for ( let i = 0; i < level2MobileSubParentMenus.length; i++ ) {
    
                    level2MobileSubParentMenus[i].style.display = "true";
    
                }

                // let level3MobileSubParentMenus = document.getElementsByClassName("level2-mobile-parent-submenu-level3");
                // console.log(level3MobileSubParentMenus);

                // for ( let i = 0; i < level3MobileSubParentMenus.length; i++ ) {
    
                //     level3MobileSubParentMenus[i].style.display = "false";
    
                // }


                // let mobileSubParentMenus = document.getElementsByClassName("level1-subnav-container");

                // for ( let i = 0; i < mobileSubParentMenus.length; i++ ) {
    
                //     mobileSubParentMenus[i].style.display = "block";
    
                // }





           //     alert(level2SubMenuBackButtons[j].id);

                // let level2MobileSubParentMenus = document.getElementsByClassName("level2-mobile-parent-submenu");
                // for ( let i = 0; i < level2MobileSubParentMenus.length; i++ ) {
    
                //     level2MobileSubParentMenus[i].style.display = "none";
    
                // }

               

                // let level2MobileSubParentMenus2 = document.getElementsByClassName("level2-mobile-parent-menu");
                // for ( let i = 0; i < level2MobileSubParentMenus2.length; i++ ) {
    
                //     level2MobileSubParentMenus2[i].style.display = "block";
    
                // }

            }, false);

        }()); 


    }

    const mobileMenuPath = [];



    // Parent Sub Menus
    let parentSubMenus = document.getElementsByClassName("mobile-parent-submenu");
    console.log(parentSubMenus);

    for (let i = 0; i < parentSubMenus.length; i++) {
        
        (function () {

            let subMenuId = 'mobile-submenu-' + parentSubMenus[i].id;

            parentSubMenus[i].addEventListener("click", function() { 

                mobileMenuPath.push(parentSubMenus[i].innerText);

                showMobileSubMenu( subMenuId );

                console.log(mobileMenuPath);

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

                mobileMenuPath.push(level2ParentMenus[i].innerText);

                showMobileSubMenuLevel2( subMenuId );

                console.log(mobileMenuPath);

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
