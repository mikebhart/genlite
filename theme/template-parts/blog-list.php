<div class="container-fluid">

    <div class="card-deck">
           
        <?php 

            $postsPerPage = get_option( 'posts_per_page' );

            $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => $postsPerPage -1);

            $loop = new WP_Query($args);

            $row_count = $loop->found_posts; 

            while ($loop->have_posts()) : $loop->the_post();

                              
                get_template_part( '/template-parts/content', get_post_format());

            endwhile;
          
            wp_reset_postdata();

        ?>

    </div>

</div>
