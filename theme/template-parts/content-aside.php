<?php
/**
 * Template part for displaying Aside posts
 */
?>

<a href="<?php the_permalink(); ?>" class="list-group-item">

	<div class="row">
		

	<?php if ( has_post_thumbnail() ) { ?>
									
			<div class="hidden-xs hidden-sm">
				
				<div class = "col-md-3 col-sm-4 col-xs-6">
					<div class="text-center genlite-post-list-thumbnail">
					    <?php the_post_thumbnail( 'thumbnail' ); ?>
					</div>
				</div>

			</div>	

			<div class = "col-md-9">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<p class="genlite-black"><?php echo esc_attr(get_the_excerpt()); ?></p>
					<p class="genlite-info">
					<i class="fas fa-calendar genlite-icon"></i>&nbsp;<?php $post_date = get_the_date( 'j M Y' ); echo esc_attr($post_date); ?>						
					<i class="fas fa-user genlite-icon"></i>&nbsp;<?php the_author(); ?> 	
				</p>
				</article>
			</div>

	<?php } else { ?>

			<div class = "col-md-12">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<p class="genlite-black"><?php echo esc_attr(get_the_excerpt()); ?></p>
					<p class="genlite-info">
					<i class="fas fa-calendar genlite-icon"></i>&nbsp;<?php $post_date = get_the_date( 'j M Y' ); echo esc_attr($post_date); ?>						
					<i class="fas fa-user genlite-icon"></i>&nbsp;<?php the_author(); ?> 	
				</p>
			</article>
			</div>

	<?php } ?>

	</div>	

</a>