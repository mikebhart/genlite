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

<div class="card genlite-card mb-4">

  	<div class="genlite-card__header-placeholder">
		<div class="genlite-card__header-placeholder-image" style="background-image: url('<?php echo esc_url($featured_img_url); ?>');"></div>
	</div>

    <div class="card-body">
      
	  <h5 class="card-title"><?php the_title(); ?></h5>
      <p class="card-text"><?php echo $excerpt_result; ?></p>
	  <a href="<?php esc_url(the_permalink()); ?>" class="stretched-link"></a>
    
	</div>
    
	<div class="card-footer">

		<?php echo esc_attr($post_date); ?>
    
	</div>
	
</div>
