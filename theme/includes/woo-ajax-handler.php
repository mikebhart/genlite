<?php

function genlite_woo_post_ajax_handler() {

    $args= null;
    $posts_per_page = ( isset($_POST["posts_per_page"]) ) ? $_POST["posts_per_page"] : 10; 
    $page_no = ( isset($_POST['page_no']) ) ? $_POST['page_no'] : 0;
    $categories = ( isset($_POST['categories']) ) ? $_POST['categories'] : 0;
    $search_text = ( isset($_POST['search_text']) ) ? $_POST['search_text'] : null;
    $start_record_no = ( $page_no * $posts_per_page ) - $posts_per_page;

    header("Content-Type: text/html");

	global $wpdb;

	$myquery = "";

    // All Categories
	// if ( $categories == 0 ) {

		$myquery = "SELECT * FROM wp_posts WHERE post_status = 'publish' 
                    and ( post_type = 'post' ) 
                    and ( post_title LIKE '%" . $search_text . "%' OR post_content LIKE '%" . $search_text . "%' ) 
                    order by post_date DESC LIMIT " . $start_record_no . "," . $posts_per_page;

    // } else {

    //     $myquery = "SELECT *
    //                 FROM wp_posts
    //                 LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id)
    //                 LEFT JOIN wp_term_taxonomy ON (wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id)
    //                 WHERE wp_term_taxonomy.term_id IN (" . $categories . ") AND post_status = 'publish' AND  ( post_title LIKE '%" . $search_text . "%' OR post_content LIKE '%" . $search_text . "%' ) and ( post_type = 'post' ) 
    //                 order by post_date DESC
    //                 LIMIT " . $start_record_no . "," . $posts_per_page;   
     
	// } 

	$result = $wpdb->get_results( $myquery );

    $context['woo_results_row_count'] = $wpdb->num_rows;

    $woo_results_data = [];

	if ( $result ) {

		foreach( $result as $result_item ) {

			$id = $result_item->ID;

            $properties = [];
            $properties['id'] = $id;
            $properties['title'] = $result_item->post_title;
    
            $featured_img_url = get_the_post_thumbnail_url( $id, 'medium' );

            $properties['featured_image'] =  "https://via.placeholder.com/300x300.png?text=No+Featured+Image";

            if ($featured_img_url) {
                $properties['featured_image'] = $featured_img_url;
            }
            
            $excerpt = strip_shortcodes( $result_item->post_content );
            $excerpt = apply_filters( 'the_content', $excerpt );
            $excerpt = str_replace(']]>', ']]&gt;', $excerpt);
            $excerpt_length = apply_filters( 'excerpt_length', 18 );
            $excerpt_more = apply_filters( 'excerpt_more', '...' );
            $excerpt = wp_trim_words( $excerpt, $excerpt_length, $excerpt_more );


            $properties['excerpt'] = $excerpt;
            $properties['postdate'] = date('M d, Y', strtotime($result_item->post_date)); 
            $properties['firstname'] = ucwords( get_the_author_meta('first_name', $result_item->post_author));
            $properties['lastname'] = ucwords( get_the_author_meta('last_name', $result_item->post_author));
            
            
            $category_names = '';
            
            $category_detail=get_the_category($id);
            foreach($category_detail as $cd){
                $category_names.= $cd->cat_name . ', ';
            }
            
            if ( strlen( $category_names ) > 0 ) {
                $properties['categories'] = substr( $category_names, 0, strlen($category_names) - 2);
            } else {
                $properties['categories'] = 'Uncategorised';
            }

            $properties['link'] = get_permalink( $result_item->ID );

            $woo_results_data[] = $properties;

		}

	}

    $context['woo_results_page_no'] = $page_no;
    $context['woo_results_data'] = $woo_results_data;
  
    Timber::render('woo/woo-ajax-render.twig', $context );
	die();
    
}

add_action('wp_ajax_nopriv_genlite_woo_post_ajax_handler', 'genlite_woo_post_ajax_handler');
add_action('wp_ajax_genlite_woo_post_ajax_handler', 'genlite_woo_post_ajax_handler');
