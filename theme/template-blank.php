<?php 

/*
	Template Name: Blank
*/


/**
 * The template for displaying just the header and footer
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hartsoft
 * @subpackage GenLite
 * @since 1.4.2
 * @version 1.4.2
 */

get_header();


?>


<?php

while(have_posts()) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php the_content(); ?>	

    </article>



<?php endwhile; wp_reset_query(); ?>
    

<?php get_footer(); ?>




