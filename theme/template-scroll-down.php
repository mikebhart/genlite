<?php 

/*
	Template Name: Scroll Down
*/


/**
 * The template for displaying all pages withscroll down
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hartsoft
 * @subpackage GenLite
 * @since 1.4.2
 * @version 1.4.2
 */

get_header();

if ( has_post_thumbnail( $post->ID ) ) { 
	$hero_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' )[0];
}

?>

<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

	<section class="genlite-page-scroll-down__image" style="background-image: url('<?php echo esc_url($hero_image); ?>')">
			
		<div class="genlite-page-scroll-down__overlay"></div>
				
		<div class="genlite-page-scroll-down__overlay-text">

			<h1><?php the_title(); ?></h1>
			
		</div>

	</section>

	<section class="text-center">

		<a id="genlite-page-down__button" href="#genlite-page-start-anchor" class="genlite-page-scroll-down__scroll-down"><i class="fas fa-chevron-down"></i></a>

	
	</section>

	<section id="genlite-page-start-anchor"><span></span></section>


	<?php

			// content editor has its own sections
			while(have_posts()) : the_post(); 

				the_content();

			endwhile; wp_reset_query();
					
			if ( get_comments_number() ) {
					comments_template();
			}	
			
	?>


	
</article>


<?php get_footer(); ?>



