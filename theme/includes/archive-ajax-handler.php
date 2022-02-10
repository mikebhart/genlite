<?php

function genlite_more_post_ajax_handler(){

    $args= null;
    $postsPerPage = (isset($_POST["postsPerPage"])) ? $_POST["postsPerPage"] : get_option( 'posts_per_page' );
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
    $category = (isset($_POST['category'])) ? $_POST['category'] : 'all-categories';
    $search_text = (isset($_POST['search_text'])) ? $_POST['search_text'] : null;

  
    header("Content-Type: text/html");

	global $wpdb;


	$catid = get_cat_ID ( $category );

	$myquery = "";

	if ($catid==0) {

		$myquery = "SELECT *
		FROM wp_posts
		WHERE post_content LIKE '%" . $search_text . "%' and post_status = 'publish' LIMIT 0, 19";

	} else {

		$myquery = "SELECT *
		FROM wp_posts
		LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id)
		LEFT JOIN wp_term_taxonomy ON (wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id)
		WHERE wp_term_taxonomy.term_id IN (" . $catid . ") AND post_content LIKE '%" . $search_text . "%' and post_status = 'publish' LIMIT 0, 19";

	} 
	
//	else {
//		$myquery = "SELECT * FROM wp_posts WHERE post_content LIKE '%" . $search_text . "%' and post_status = 'publish'  LIMIT 0, 19";
//	}



	$result = $wpdb->get_results( $myquery );

	// var_dump($result);
	// exit;

	echo $wpdb->num_rows;

	if ($result){
		foreach($result as $pageThing){


			$cars = [ $pageThing->ID, $pageThing->post_title, get_permalink( $pageThing->ID ) ];
	//echo "I like " . $cars[0] . ", " . $cars[1] . " and " . $cars[2] . ".";

		echo $pageThing->ID . ' = ' . $pageThing->post_title . '<a href="' . get_permalink( $pageThing->ID ) . '">Link</a><br>';
		}
	}

	global $post;

    $context = Timber::get_context();
    $context['get_page'] = empty($_POST['get_page']) ? 1 : $_POST['get_page'];

    $category = get_the_category($post->ID);
    $category = $category[0]->cat_ID;

    $context['posts'] = Timber::get_posts(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'category__in' => array($category),
        'posts_per_page' => 10,
        'paged' => $context['get_page'],
        'has_password' => FALSE
    ));
    $count = count(Timber::get_posts(array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'category__in' => array($category)
    )));

    if($count <= $context['get_page'] * 10) $context['ended'] = 'ended';

    Timber::render( 'bloc_news.twig', $context );

    die();
	


exit;


//$result->post_count = count( $result->posts );



    //$loop = new WP_Query($args);
    // $row_count = $loop->found_posts; 

	// echo $row_count;
	// exit;

	//$row_count = count($result->posts );

    $max_pages = ceil($row_count / $postsPerPage);

    $out = '';

    if ($loop -> have_posts()) {

        $out .= '<div class="genlite-archive__container">';

        while ($loop -> have_posts()) : $loop -> the_post();

            $post_format = get_post_format( get_the_ID() );

            $header_html = "";

            if ($post_format == 'video') {

                $header_html = genlite_get_first_video_embed( get_the_ID() ); 
            
            } else {

                $featured_img_url =  "http://placehold.it/300x300?text=No+Featured+Image";

                if ( has_post_thumbnail() ) { 
                  
                    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'medium'); 
        
                }

                $header_html = '<div class="genlite-archive__card-header-placeholder-image" style="background-image: url(' . $featured_img_url .');"></div>';

            }


            $excerpt = get_the_excerpt();
            $excerpt = substr($excerpt, 0, 50);
            $excerpt_result = substr($excerpt, 0, strrpos($excerpt, ' '));

            $post_date = get_the_date( 'j M Y' );
            $out .= '<input id="genlite_max_pages" type="hidden" value="' . $max_pages . '">';
            $out .= '<div class="genlite-archive__card">';
            $out .= '<a href="' .  get_post_permalink() . '">';
            $out .= '<div class="genlite-archive__card-header-placeholder">';
            $out .= $header_html;
            $out .= '</div>';
            $out .= '<div class="genlite-archive__card-body">';
            $out .= '<h5>' . get_the_title() . '</h5>';
            $out .= '<p>' . $excerpt_result . '</p>';
            $out .= '</div>';
            $out .= '<div class="genlite-archive__card-footer">';
            $out .=  '<h6>' . esc_attr($post_date) . '</h6>';
            $out .= '</div>';
            $out .= '</a>';
            $out .= '</div>';


        endwhile;

        $out .= '</div>';

    }

    wp_reset_postdata();

    die($out);
    
}
add_action('wp_ajax_nopriv_genlite_more_post_ajax_handler', 'genlite_more_post_ajax_handler');
add_action('wp_ajax_genlite_more_post_ajax_handler', 'genlite_more_post_ajax_handler');

