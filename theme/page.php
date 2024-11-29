<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/templates/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */


// $post_blocks = [];

// if ( has_blocks( $post->post_content ) ) {
     
//     $blocks = parse_blocks( $post->post_content );
             
//     foreach( $blocks as $block ) {

//         if ( !in_array( $block['blockName'], $post_blocks )) {
//             $post_blocks[] = $block['blockName'];
//         }

//     }
 
// }

$context = Timber::context();

$timber_post     = Timber::get_post();
$context['post'] = $timber_post;

Timber::render( [ 'page.twig' ], $context );
