<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 10.0.0
 */

defined( 'ABSPATH' ) || exit;

global $post, $product;

?>

<div class="row">
	
	<div class = "col-lg-6 genlite-hyperlink">
		<?php woocommerce_breadcrumb();

			$productImageId = $product->get_image_id();
            $shop_catalog_image_url = wp_get_attachment_image_src( $productImageId, 'shop_catalog' )[0];
            $shop_single_image_url = wp_get_attachment_image_src( $productImageId, 'shop_single' )[0];       ?>            

            <a class="fancybox-shop-product" href="<?php echo esc_url($shop_single_image_url); ?>" data-fancybox="images" data-fancybox-group="gallery" title="<?php the_title(); ?>">
            	<img class="genlite-border" src="<?php echo esc_url($shop_single_image_url); ?>" alt="<?php the_title(); ?>"  />
            </a>
	</div>
	
	<div class = "col-lg-6 text-right">

		<?php
			$prev_post = get_previous_post();
			if (!empty( $prev_post )) { ?>
			   <a id="genlite-shop__product-prev" title="<?php echo esc_attr($prev_post->post_title); ?>" class="btn btn-primary" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>"><i class="fas fa-chevron-left"></i></a>
	  <?php }  
		
	   	    $next_post = get_next_post();
			if (!empty( $next_post )) { ?>
				 <a id="genlite-shop__product-next" title="<?php echo esc_attr($next_post->post_title); ?>" class="btn btn-primary" href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>"><i class="fas fa-chevron-right"></i></a>
	  <?php } ?>

		
	</div>	

</div>
		
<br>

<div class="row no-gutters">

      	<?php 

		
   		   $attachment_ids = $product->get_gallery_image_ids();

			foreach( $attachment_ids as $attachment_id ) 
			{ 
				$shop_catalog_image_url = wp_get_attachment_image_src( $attachment_id, 'shop_catalog' )[0];
	            $shop_single_image_url = wp_get_attachment_image_src( $attachment_id, 'shop_single' )[0]; 	?>
			
				<div class = "col-6 col-md-6 col-lg-3 col-xl-2">

					<div class="genlite-product-box">

						<a data-fancybox="images" class="" href="<?php echo esc_url($shop_single_image_url); ?>" data-fancybox-group="gallery" title="<?php the_title(); ?>">
							<img src="<?php echo esc_url($shop_catalog_image_url); ?>" alt="<?php the_title(); ?>" />
						</a>

					</div>

				</div>
						
						 
	  <?php } ?>
							

</div>

<div style="float:none">&nbsp;</div>		 