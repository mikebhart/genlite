<?php

/**
 * Template part for displaying Standard Card posts
 */


$featured_img_url =  "http://placehold.it/300x300?text=No+Featured+Image";

if ( has_post_thumbnail() ) { 
	$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'medium'); 
}

$excerpt = get_the_excerpt();
$excerpt = substr($excerpt, 0, 50);
$excerpt_result = substr($excerpt, 0, strrpos($excerpt, ' '));

$post_date = get_the_date( 'j M Y' );

?>



<div class="genlite-archive__card">

	<a href="<?php esc_url(the_permalink()); ?>">

			<div class="genlite-archive__card-header-placeholder">
				<div class="genlite-archive__card-header-placeholder-image" style="background-image: url('<?php echo esc_url($featured_img_url); ?>');"></div>
			</div>

			<div class="genlite-archive__card-body">
				<h5><?php the_title(); ?></h5>
				<p><?php echo $excerpt_result; ?></p>
			</div>
			<div class="genlite-archive__card-footer">
				<h6><?php echo esc_attr($post_date); ?></h6>
			</div>

	</a>

</div>
