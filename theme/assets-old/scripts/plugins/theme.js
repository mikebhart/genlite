import genliteAnimations from "./animations";

export default {

    setup() {

        backToTopButton(); 
        globalEvents();
        bootstrapStyles();
        lightBoxSetup();
        archiveSetup();

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
				$('#navbarTogglerHeaderMenu').toggleClass('show');
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
                    .not( ".blocks-gallery-grid, .wp-block-column p, .wp-block-quote p, .post-template-default h1.entry-title,.comment-reply-title,.logged-in-as,.comment-notes, .genlite-page-scroll-down__overlay-text h1, .genlite-title-row h1, .page-template-default p, .post-card .post-title, .post-card p" )
                    .wrap( "<section><div class='container'><div class='row'><div class='col-12'></div></div></section>" );
            
                $( "article" ).find(".wp-block-columns").wrap("<div class='container-fluid'></div>");

                
        
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

        function archiveSetup() {


            if (document.querySelector('.genlite-archive-page')) {
                 
                    var pageNumber = 1;
                    var category;
                    var search_text;

				
					$('#category-select').on('change', function() {
						
						//search_text = null;
                        //document.getElementById("keyword-input").value = '';
						pageNumber = 0;
                        category = document.getElementById("category-select").value;
						search_text = document.getElementById("genlite-keyword-input").value;
                        
						//setTimeout(function(){
							genlite_load_posts();
						// }, 500);

                      


					});

                    $("#genlite-keyword-input").keyup(function() {
                
						//category  = null;
						//document.getElementById("category-select").value = 'all-categories';
						
						pageNumber = 0;

						category = document.getElementById("category-select").value;
						search_text = document.getElementById("genlite-keyword-input").value;

						
					// setTimeout(function(){
					
							genlite_load_posts();
					//  }, 4200);
							
                
                    });

					var xhr = false;
                
                    function genlite_load_posts() {

						
						
    
					    pageNumber++;
						
				        var data = {
                                    'action': 'genlite_more_post_ajax_handler',
                                    'pageNumber': pageNumber, 
                                    'postsPerPage' : genlite_ajax_object.posts_per_page,
                                    'category' : category,
                                    'search_text' : search_text
                                    };

						if(xhr && xhr.readystate != 4 && search_text.length != 0 ){
							xhr.abort();
						}

						console.log(search_text.length);
						
						xhr = $.ajax({
                                
                                type: "POST",
                                dataType: "html",
                                url: genlite_ajax_object.ajax_url,
                                data: data,
                                
                                success: function(data){
                                
                                        var more_posts_button = document.getElementById("genlite-archive__more-posts-button");
                        
                                        if(data){
                                        
											$("#genlite-archive__more-posts-placeholder").html("");
                                            $("#genlite-archive__more-posts-placeholder").append(data);
                                        
                                        } else {
                        
                                            $("#genlite-archive__more-posts-placeholder").append('<p>No results to show.</p>');
                                            more_posts.style.display = "none";
                        
                                        }
                                        
                                        if (document.getElementById("genlite_max_pages")) {
                        
                                            var max_pages = document.getElementById("genlite_max_pages").value;
                                            
                                            if (max_pages == pageNumber) {
                        
                                                more_posts_button.style.display = "none";
                        
                                            } else {
                        
                                                more_posts_button.style.display = "block";
                                            }
                        
                                        } 
                        
                                },
                                error : function(jqXHR, textStatus, errorThrown) {
                              //      $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
                                }
                
                        }).done(function() {
                          //  do something
						//  xhr = null;
                          });
                    
                        return false;
                    }
                
                    
                
                
                
                    // $("#genlite-archive__more-posts-button").bind("click",function(event) { 
                    //     genlite_load_posts();
                    // });

                }
        }
        
    }

};