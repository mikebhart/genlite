<div class="genlite-archive__container">

    <?php 

        $postsPerPage = get_option( 'posts_per_page' );

        $args = [
                    'post_type' => 'post',
					'ignore_sticky_posts' => 1,
                    'posts_per_page' => $postsPerPage ];

        $loop = new WP_Query($args);

        $row_count = $loop->found_posts; 

        while ($loop->have_posts()) : $loop->the_post();

            get_template_part( '/template-parts/content', get_post_format());

        endwhile;
          
        wp_reset_postdata();

    ?>

</div>
