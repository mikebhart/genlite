<?php 

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Hartsoft
 * @subpackage GenLite
 * @since 1.4.2
 * @version 1.4.2
 */

get_header(); ?>

<div class="container">

    <div class="row">

        <div class="col-lg-12">
           
           <h1><?php esc_attr_e('Search Results: ','genlite'); ?>&quot;<?php echo get_search_query(); ?>&quot;</h1>
           <br>

            <?php if ( have_posts() ) :  // results found?>
               <?php get_template_part('template-parts/blog-list', get_post_type()); ?>
            <?php else :  // no results?>
          
                <h3><?php esc_attr_e('No Results Found.','genlite'); ?></h3>
                <br>
          
        <?php endif; ?>
        </div>
        
    </div>

  </div>

<?php get_footer(); ?>