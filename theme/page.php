<?php 

/**
 * The template for displaying all pages
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

get_header(); ?>

<div class="container">

	<div class="row genlite__content justify-content-center pt-3">
			<div class="genlite-archive-title">
				<h1><?php the_title(); ?></h1>
			</div>

		<div class="col-12">
		
		<?php

			while(have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="genlite-title-row"><h1 hidden><?php the_title(); ?></h1></div>

						<?php the_content(''); ?>	

				</article>



		<?php endwhile; wp_reset_query();
				
		if ( get_comments_number() ) {
				comments_template();
		}	?>
				
		</div>

	</div>
		
</div>					

<?php get_footer(); ?>



