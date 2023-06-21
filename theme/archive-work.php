<?php

echo 'in archive';
exit;


get_header(); 

function genlite_empty_content($str) {
    return trim(str_replace('&nbsp;','',strip_tags($str))) == '';
}

$args = array(
		'post_type' => 'work',
		'posts_per_page' => -1);

$loop = new WP_Query($args);

$row_count = $loop->found_posts; 

?>

<div class="container">
	<div class="row genlite__content justify-content-center pt-3">
		<div class="genlite-archive-title">
			<h1>My Portfolio</h1>
		</div>
        <p class="pl-1 pr-1 pt-1 pb-1 pt-md-4 pb-md-4">I’m proud to have worked on some amazing projects.  Below shows some of my latest and best work.</p>
	</div>
</div>
	
<?php
	
    while ( $loop->have_posts()) : $loop->the_post();

			$featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' ); 
            ?>

        <div class="post-card__layout">
            <article class="post-card" style="background-image: url( <?php echo esc_url( $featured_img_url ); ?> );">
                <div class="post-card__overlay">
                    <div class="post-card__overlay-content">
                        <h3 class="post-title"><?php the_title(); ?></h3>
                            <p> 
							    <?php 
	                    		
                                    $post_categories = wp_get_object_terms( $post->ID, 'work_category' );
                                    $post_cat_count = 0;

                                    foreach( $post_categories as $c ) {

                                        $cat = get_category( $c );
                                            
                                        if ( $post_cat_count > 0 ) {
                                            echo ', ' . esc_attr( $cat->name );
                                        } else {	
                                            echo esc_attr( $cat->name );
                                        }
                
                                        $post_cat_count++;

                                    }

		                        ?>

							</p>

                            <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title(); ?>">View Project <i class="fas fa-angle-double-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </article>
        </div>

<?php
    
    endwhile;
    wp_reset_postdata(); ?>

<div class="clearfix"></div>

<?php get_footer(); ?>

