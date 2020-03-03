<?php
/**
 * Template part for displaying video posts
 *
 */

$excerpt = get_the_excerpt();
$excerpt = substr($excerpt, 0, 150);
$excerpt_result = substr($excerpt, 0, strrpos($excerpt, ' '));

$post_date = get_the_date( 'j M Y' );

?>

<div class="card genlite-card mb-4">

	<div class="genlite-card__header-placeholder">
		<?php echo genlite_get_first_video_embed( get_the_ID() ); ?>
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
