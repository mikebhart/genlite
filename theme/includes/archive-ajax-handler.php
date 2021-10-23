<?php

function genlite_more_post_ajax_handler(){

    $args= null;
    $postsPerPage = (isset($_POST["postsPerPage"])) ? $_POST["postsPerPage"] : get_option( 'posts_per_page' );
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
    $category = (isset($_POST['category'])) ? $_POST['category'] : 'all-categories';
    $search_text = (isset($_POST['search_text'])) ? $_POST['search_text'] : null;
  
    header("Content-Type: text/html");

    if ($category == 'all-categories' && $month == null && $search_text == null) {

        $args = array(
            'suppress_filters' => true,
            'post_type' => 'post',
			'ignore_sticky_posts' => 1,
            'posts_per_page' => $postsPerPage,
            'paged'    => $page,
        );

    } else if ($category != 'all-categories' && $month == null && $search_text == null) {

        $args = array (
                'orderby' => 'title',
                'order'   => 'ASC',
                'post_type' => 'post',
				'ignore_sticky_posts' => 1,
                'posts_per_page' => $postsPerPage,
                'paged' => $page,
                'tax_query' => array(
                  array (
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms' => $category
                  )          
                )
              );

    } else if ($search_text != null) {

        $args = array (
            's' => $search_text,
            'orderby' => 'title',
			'ignore_sticky_posts' => 1,
            'order'   => 'ASC',
            'post_type' => 'post',
            'posts_per_page' => $postsPerPage,
            'paged' => $page
        );

    }

    $loop = new WP_Query($args);
    $row_count = $loop->found_posts; 
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

