<?php
/**
 * Template part for displaying Quotes in posts
 *
 */
?>

<a href="<?php the_permalink(); ?>" class="list-group-item">

	<div class="row justify-content-center">
		
		<div class = "col-lg-12">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h2 style="font-style: italic;" class="text-center"><?php echo esc_attr(get_the_excerpt()); ?></h2>
			</article>
		</div>

		<div class = "text-center">
			<?php get_template_part( '/template-parts/posts-list-info', get_post_format()); ?>
		</div>



	</div>	

</a>