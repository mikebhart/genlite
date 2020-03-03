
<div class="container">

    <div class="card-deck">
           
        <?php 
        
        while(have_posts()) : the_post(); 
                              
             get_template_part( '/template-parts/content', get_post_format());

         endwhile; wp_reset_query(); ?>

    </div>

</div>
