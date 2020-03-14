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

?>



<article id="post-<?php the_ID(); ?>" <?php post_class('genlite__content'); ?>>

			<?php 
	
			while(have_posts()) : the_post(); ?>


				<div class="container">
					<div class="row">
						<div class="col-12">
		
								<div class="date updated"><?php echo esc_attr($postLastModified); ?> by <span class="vcard author"><span class="fn"><?php the_author(); ?></span></span></div>

								<h1 class="entry-title"><?php the_title(); ?></h1>
								<div class="genlite-post__image">
									<?php the_post_thumbnail( 'medium' ); ?>							  	
								</div>	

						</div>
					</div>
				</div>			
										
					

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