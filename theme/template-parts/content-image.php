<?php
/**
 * Template part for displaying Image posts
 *
 */
?>
<span class="list-group-item">
	<div class = "row">
		<div class = "col-lg-12">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<a class = "text-center" href="<?php esc_url(the_permalink()); ?>">
					<h2><?php the_title(); ?></h2>
				</a>	
					
				<div class="text-center">
					<?php 

						global $post, $posts;
						$first_img = '';
						ob_start();
						ob_end_clean();
						$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
						$first_img = $matches [1] [0];
					 	echo '<img src="' . esc_attr($first_img) . '">';
					 ?>

				
				</div>
				
				<div class = "text-center">
					<?php get_template_part( '/template-parts/posts-list-info', get_post_format()); ?>
				</div>

			</article>
		</div>
	</div>
</span>
