<?php
/**
 * Template part for displaying Links in posts
 */

$content = apply_filters( 'the_content', get_the_content() );
$content_urls = wp_extract_urls( $content );
$postFormatLink = $content_urls[0];

?>
<span class="list-group-item">
	<div class = "row justify-content-center">
		<div class = "col-lg-12">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<object>
					<div class="text-center">
						<a href="<?php the_permalink(); ?>">
							<h2><?php the_title(); ?></h2>
						</a>	
						<a href="<?php echo esc_url($postFormatLink); ?>" class="btn btn-primary genlite-btn-circle"><i class="fas fa-link"></i></a>
					</div>
				</object>
			</article>

		</div>

		<div class = "text-center">
			<?php get_template_part( '/template-parts/posts-list-info', get_post_format()); ?>
		</div>

	</div>
</span>