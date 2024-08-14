export const handleWooAjaxHandler = function () {

    if ( !document.querySelector('.woo-archive') ) { 
        return;
    }

    var xhr = false;
  //  var search_text = document.getElementById("search-input").value; 
 //   var categories = document.getElementsByClassName("category-filter-active");
    var pageNumber = 1;
//    var showStickyCatFilters = false;
   
    genlite_woo_load_posts();

    // function showStickyCategoryFilter() {
     
    //     var myID = document.getElementById("woo-sticky-category-filter");

    //     var y = window.scrollY;

    //     if ( y >= 50 || showStickyCatFilters == true ) {

    //         myID.className = "blog-woo__sticky-filters blog-woo__sticky-category-filter-show";

    //     } else {

    //         myID.className = "blog-woo__sticky-filters blog-woo__sticky-category-filter-hide";
    //     }

    // }

    // window.addEventListener( "scroll", showStickyCategoryFilter );



    // ------------------- Categories Sticky Select --------------------------------

    // var $filtersSticky = $('.category-filter-sticky'); 
    // var cFilterSticky, cFilterDataSticky; 
    // var filtersActiveSticky = []; 

    // $filtersSticky.click( function() { 

       

    //     cFilterSticky = $(this);
    //     cFilterDataSticky = cFilterSticky.attr('data-filter');

    //     highlightCategoryStickyFilter();        
    //     applyCategoryStickyFilter();

    // });

    // function highlightCategoryStickyFilter () {

    //     var filterStickyClass = 'category-filter-sticky-active';
        
    //     if (cFilterSticky.hasClass(filterStickyClass)) {

    //         cFilterSticky.removeClass(filterStickyClass);
    //         removeCategoryActiveFilter(cFilterDataSticky);
     
    //     } else {

    //         cFilterSticky.addClass(filterStickyClass);
    //         filtersActiveSticky.push(cFilterDataSticky);
    //     }
    // }

    // function applyCategoryStickyFilter() {

    //     getCategoriesSticky();

    //     $("#blog-woo__search-results-ajax-posts").html("");
    //     $("#no_rows_message").html("");
    //     pageNumber = 1;

    //     genlite_woo_load_posts();

    // }

    // function getCategoriesSticky() {

    //     var categoriesActive = document.getElementsByClassName("category-filter-sticky-active");
    //     var categoryFilter;
    //     var filterPostIds = "";
    //     var counter = 0;
      
    //     for ( var i = 0; i < categoriesActive.length; i++ ) {

    //         categoryFilter = categoriesActive[i];

    //         filterPostIds+= categoryFilter.getAttribute("data-filter") + ",";  
    //         counter++;
    //     }

    //     if ( counter == 0 ) {

    //         $("#blog-woo-banner").show();
    //         showStickyCatFilters = false;

    //         var myID2 = document.getElementById("woo-sticky-category-filter");
    //         myID2.className = "blog-woo__sticky-filters blog-woo__sticky-category-filter-hide"




    //     } else {

    //         showStickyCatFilters = true;

    //         $("#blog-woo-banner").hide();

    //     }

    //     categories = filterPostIds.substring( 0, filterPostIds.length -1 );  

    // }

    // ------------------- Categories Select --------------------------------

    // var $filters = $('.category-filter'); 
    // var cFilter, cFilterData; 
    // var filtersActive = []; 

    // $filters.click( function() { 
       
    //     cFilter = $(this);
    //     cFilterData = cFilter.attr('data-filter');

    //     highlightCategoryFilter();        
    //     applyCategoryFilter();

    // });

    

    // function highlightCategoryFilter () {

    //     var filterClass = 'category-filter-active';
        
    //     if (cFilter.hasClass(filterClass)) {

    //         cFilter.removeClass(filterClass);
    //         removeCategoryActiveFilter(cFilterData);
     
    //     } else {

    //         cFilter.addClass(filterClass);
    //         filtersActive.push(cFilterData);
    //     }
    // }

    // function applyCategoryFilter() {

    //     getCategories();

    //     $("#blog-woo__search-results-ajax-posts").html("");
    //     $("#no_rows_message").html("");
    //     pageNumber = 1;
        

    //     genlite_woo_load_posts();

    // }

    // function removeCategoryActiveFilter( item ) {
    //     var index = filtersActive.indexOf( item );

    //     if (index > -1) {
    //         filtersActive.splice(index, 1);
    //     }
    // }


    // function getCategories() {

    //     var categoriesActive = document.getElementsByClassName("category-filter-active");
    //     var categoryFilter;
    //     var filterPostIds = "";
      
    //     for ( var i = 0; i < categoriesActive.length; i++ ) {

    //         categoryFilter = categoriesActive[i];
    //         filterPostIds+= categoryFilter.getAttribute("data-filter") + ",";  
    //     }


    //     categories = filterPostIds.substring( 0, filterPostIds.length -1 );  

    // }

    // ---------------------------- Search text ------------------------------

    // function get_search_text() {


    //     if ( document.getElementById("search-input-sticky").value !== "") {

    //         search_text = document.getElementById("search-input-sticky").value;

    //         let search_text_length = search_text.length;

    //         if ( search_text_length == 0 ) {
    
    //             $("#blog-woo-banner").show();

    //             showStickyCatFilters = false;
    
    //         } else {
    
    //             $("#blog-woo-banner").hide();

    //             showStickyCatFilters = true;

    //             var myID3 = document.getElementById("woo-sticky-category-filter");
    //             myID3.className = "blog-woo__sticky-filters blog-woo__sticky-category-filter-show";


    
    //         }

    //     } else {
    //         search_text = document.getElementById("search-input").value;
    //     }
     

    // }

   
  
    // $("#search-input-sticky").on('keyup', function() {

    //     getCategoriesSticky();
    //     get_search_text();

    //     $("#blog-woo__search-results-ajax-posts").html("");
    //     $("#no_rows_message").html("");

    //     pageNumber = 1;

    //     genlite_woo_load_posts();

    // });

    // $("#search-input").on('keyup', function() {

    //     getCategories();
    //     get_search_text();

    //     $("#blog-woo__search-results-ajax-posts").html("");
    //     $("#no_rows_message").html("");

    //     pageNumber = 1;

    //     genlite_woo_load_posts();

    // });


    // More Buttton
    $( "#blog-woo__more-posts-button" ).on('click', function() {

        pageNumber++;
        genlite_woo_load_posts();

    });

    function genlite_woo_load_posts() {

        // if ( categories.length === 0 ) {

        //     categories = 0;

        // }


        
        var data = {
                    'action': 'genlite_woo_post_ajax_handler',
                    'page_no': page_no, 
                    'posts_per_page' : genlite_settings_object.posts_per_page,
                    'categories' : categories,
                    'search_text' : search_text
                    };


        if(xhr && xhr.readystate != 4 && search_text.length != 0 ) {
            xhr.abort();
        }
            
        xhr = $.ajax({
                
                type: "POST",
                dataType: "html",
                url: genlite_settings_object.ajax_url,
                data: data,
                
                beforeSend: function() {
                    $("#blog_posts_loader").show();
                },
                complete: function() {
                    $("#blog_posts_loader").hide();
                },
                
                success: function(data){


                    if ( data ) {

                        var ppp = parseInt( genlite_ajax_object.posts_per_page );
                        var more_posts_button = document.getElementById("blog-woo__more-posts-button");
                    
                        $("#blog-woo__search-results-ajax-posts").append(data);

                        var elements = document.getElementsByClassName('blog_no_rows');
                        var last_rows_displayed = parseInt( elements[elements.length-1].value );

                        if ( last_rows_displayed == 0 ) {

                            more_posts_button.style.display = "none";
                            $("#no_rows_message").append('<p class="spacer-top--large">No more posts to show</p>');

                        } else if ( last_rows_displayed < ppp ) {

                            more_posts_button.style.display = "none";

                        } else {

                            more_posts_button.style.display = "inline-block";

                        }
                  
                    }

       
                },
                error : function(jqXHR, textStatus, errorThrown) {
                     console.log( jqXHR + " :: " + textStatus + " :: " + errorThrown );

                     return false;
                }

        }).done(function() {});

        return true;
    }


  
}
