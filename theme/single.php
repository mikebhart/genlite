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

get_header(); ?>



<article id="post-<?php the_ID(); ?>" <?php post_class('genlite-article'); ?>>

			<?php 
	
			while(have_posts()) : the_post(); ?>

			

					<h1 class="entry-title"><u><?php the_title(); ?></u></h1>
					<div>
						<?php the_post_thumbnail( 'medium' );  
							  $postLastModified = Date('jS M, Y h:i:s A', get_post_modified_time());
							  $postFirstPublished = get_the_date( 'jS M, Y' );
					    ?>							  	
					</div>				
							
					

					<?php the_content(''); ?>

					<div>
						<i class="fas fa-folder-open pl-3" title="<?php esc_attr_e('Categories','genlite'); ?>"></i>&nbsp;<?php the_category( ' ' ); ?>
						<?php if(has_tag()) { ?>
						 	<i class="fas fa-tag  pl-3" title="<?php esc_attr_e('Tags','genlite'); ?>"></i>
						 <?php the_tags( '', ', ', '<br />' ); } ?> 
						 <i class="fas fa-clock" title="<?php esc_attr_e('Time Last Updated','genlite'); ?>"></i>&nbsp;<span class="date updated"><?php echo esc_attr($postLastModified); ?></span>
						<i class="fas fa-calendar pl-3" title="<?php esc_attr_e('Date First Published', 'genlite'); ?>"></i>&nbsp;<span class="date published"><?php echo esc_attr($postFirstPublished); ?></span>
						<i class="fas fa-user pl-3" title="<?php esc_attr_e('Author','genlite'); ?>"></i>&nbsp;<span class="vcard author"><span class="fn"><?php the_author(); ?></span></span> 

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
		<div class="row">
		
			<div class="col-md-6 text-left">
			
					<?php 
						get_previous_posts_link();
						$prev_post = get_previous_post();
						if (!empty( $prev_post )) { ?>
						<a href="<?php echo esc_url(get_permalink( $prev_post->ID )); ?>"><i class="fas fa-arrow-left"></i>&nbsp;<?php echo esc_attr($prev_post->post_title); ?></a>
						<?php }  ?>
			</div>

			<div class = "col-md-6 text-right" >
				<br>
				
				<?php 
				get_next_posts_link();
				$next_post = get_next_post();
				if (!empty( $next_post )) { ?>
				<a href="<?php echo esc_url( get_permalink( $next_post->ID )); ?>"><?php echo esc_attr( $next_post->post_title ); ?>&nbsp;<i class="fas fa-arrow-right"></i></a>
				<?php } ?>

			</div>	
		
		</div>	
	</div>

<?php get_footer(); ?>