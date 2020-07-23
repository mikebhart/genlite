<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     10.0.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20,0);



?>
  		

<div class="container">
	
	<?php 
		
	do_action( 'woocommerce_before_main_content' );
	
	while(have_posts()) : the_post(); ?>

		<div class="row justify-content-center">
		
			<div class="genlite-archive-title">

				<h1 class="text-center"><?php the_title(); ?></h1>

			</div>	
			
		</div>
		
		<div class="row">

			<div class = "col-lg-12">			

				<?php wc_get_template_part( 'content', 'single-product' );  ?>	

			</div>

		</div>

		
				
	<?php endwhile; 

	 do_action( 'woocommerce_after_main_content' );   ?> 

</div>		<!-- End Container -->

<script>   
(function( $ ) {

  $(document).ready(function(){

      	$(".woocommerce-review-link").after('&nbsp;');
    });
})( jQuery );


</script>
	
<?php get_footer( 'shop' ); ?>

