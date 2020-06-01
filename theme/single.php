<?php 

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Hartsoft
 * @subpackage GenLite
 * @since 1.4.2
 * @version 1.4.2
 */

get_header();

$postLastModified = Date('jS M, Y', get_post_modified_time());
$postFirstPublished = get_the_date( 'jS M, Y' );

if ( has_post_thumbnail( $post->ID ) ) { 
	$post_hero_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' )[0];
}



?>



<article id="post-<?php the_ID(); ?>" <?php post_class('genlite__content'); ?>>

	<div class="genlite-single__wrapper">

			<section class="genlite-single__image mb-4" style="background-image: url('<?php echo esc_url($post_hero_image); ?>')">
					
				<div class="genlite-single__overlay"></div>
			
			</section>


			<section class="genlite-single__text">

					<h1><?php the_title(); ?></h1>

			</section>
	</div>


		<?php 
	
			while(have_posts()) : the_post(); ?>


					<?php the_content(); ?>

					<div class="container">
					<div class="row">
					<div class="col-12">


						<i class="fas fa-folder-open" title="<?php esc_attr_e('Categories','genlite'); ?>"></i>&nbsp;<?php the_category( ' ' ); ?>
						<?php if(has_tag()) { ?>
						 	<i class="fas fa-tag" title="<?php esc_attr_e('Tags','genlite'); ?>"></i>
						 <?php the_tags( '', ', ', '<br />' );
						 } ?> 
					

					</div>
					</div>
					</div>

			

				

			<?php 
			endwhile; wp_reset_query();
		
			if ( comments_open() || get_comments_number() ) { ?>

				<h2><?php esc_attr_e('Comments','genlite'); ?></h2>
				<p>
					<?php 

							$noresponses = __('no responses','genlite');
							$oneresponse = __('one response','genlite');
							$responses = __('% responses','genlite');

							comments_number( $noresponses, $oneresponse, $responses ); ?>.
			    </p>

				<?php comments_template();
			} ?>		
				
		</article>
	
	<div class="container">
		<div class="row post-template-default__next-prev pt-3">
		
			<div class="col-6 text-left">
			
					<?php 
						get_previous_posts_link();
						$prev_post = get_previous_post();
						if (!empty( $prev_post )) { ?>
						<a href="<?php echo esc_url(get_permalink( $prev_post->ID )); ?>"><i class="fas fa-arrow-left"></i>&nbsp;Previous</a>
						<?php }  ?>
			</div>

			<div class= "col-6 text-right" >
			
				
				<?php 
				get_next_posts_link();
				$next_post = get_next_post();
				if (!empty( $next_post )) { ?>
				<a href="<?php echo esc_url( get_permalink( $next_post->ID )); ?>">Next&nbsp;<i class="fas fa-arrow-right"></i></a>
				<?php } ?>

			</div>	
		
		</div>	
	</div>

<?php get_footer(); ?>






