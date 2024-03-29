<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see       https://docs.woocommerce.com/document/template-structure/
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version   10.0.0
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

get_header('shop');

// Change add to cart text on archives depending on product type
function genlite_custom_woocommerce_product_add_to_cart_text() {
    global $product;
    
    $product_type = $product->get_type();
    
    switch ( $product_type ) {
        case 'external': return __('THEIR SITE','genlite'); break;
        case 'grouped':  return __('GROUP ITEMS','genlite'); break;
        case 'simple': return  'ADD TO CART'; break;
        case 'variable': return __('VARIATIONS','genlite'); break;
        default: return __('Read more','genlite');
    }
    
}
add_filter( 'woocommerce_product_add_to_cart_text' , 'genlite_custom_woocommerce_product_add_to_cart_text' ); 

?>


<!-- ######################## Header Shop Bar Toolbar ==> Categories | Sort  ######################### -->


<div class="container-fluid">

    <div class="row pt-2">
   
        <div class="col-md-4 mt-2">
            <?php echo woocommerce_breadcrumb(); ?>
        </div>  

        <div class="col-md-4 text-center mt-2">
              <?php woocommerce_result_count(); ?>
        </div>

        <div class="col-md-1 text-center pb-3 pb-sm-0">

            <?php if (get_theme_mod('genlite_general_shop_filter') == true) { ?>

                <div class="genlite-shop__filter-basket">

                    <div class="genlite-shop__filter-link pr-2">
                    
                        <a data-toggle="modal" data-target="#genlite-shop-filter" title="Filter Products"><i class="fas fa-filter"></i></a>
                    
                    </div>

                
                </div>

            <?php } ?>


        </div>

        <div class="col-md-2">
            
            <div class="form-group">

               <?php 
     
                 $paramOrderBy = "";
     
                 if (isset($_GET['orderby'])) {
                   $paramOrderBy = esc_attr($_GET['orderby']);
                 }          

               ?>
                 <select  id="genlite-sort" name="genlite-sort" class="form-control" onchange="genlite_sort();">
                     <option value="<?php echo esc_url($homeUrl); ?>">Default Sorting</option>
                     <option<?php if ($paramOrderBy == 'popularity') echo ' selected="selected"'; ?> value="<?php echo esc_url(site_url()) . '/?post_type=product&orderby=popularity' ?>" ><?php esc_attr_e('Sort by popularity','genlite'); ?></option>
                     <option<?php if ($paramOrderBy == 'rating') echo ' selected="selected"'; ?> value="<?php echo esc_url(site_url()) . '/?post_type=product&orderby=rating' ?>" ><?php esc_attr_e('Sort by average rating','genlite'); ?></option>
                     <option <?php if ($paramOrderBy == 'date') echo ' selected="selected"';  ?> value="<?php echo esc_url(site_url()) . '/?post_type=product&orderby=date' ?>" ><?php esc_attr_e('Sort by newness','genlite'); ?></option>  
                     <option <?php if ($paramOrderBy == 'price') echo ' selected="selected"'; ?> value="<?php echo esc_url(site_url()) . '/?post_type=product&orderby=price' ?>" ><?php esc_attr_e('Sort by price: low to high','genlite'); ?></option>                                                
                     <option <?php if ($paramOrderBy == 'price-desc') echo ' selected="selected"'; ?> value="<?php echo esc_url(site_url()) . '/?post_type=product&orderby=price-desc' ?>" ><?php esc_attr_e('Sort by price: high to low','genlite'); ?></option>  
                 </select>
             </div>     

         </div>

        

        <div class="col-md-1 text-right pb-3 pb-sm-0">

            <div class="genlite-shop__filter-basket">

                  <?php if ( class_exists( 'WooCommerce' ) ) {
                                global $woocommerce;
                                $genliteCartTotal  = get_woocommerce_currency_symbol() . number_format($woocommerce->cart->total, 2); ?>

                                <div class="genlite-shop__basket">           

                                    <a href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php echo $genliteCartTotal; ?>">

                                        <i class="fas fa-shopping-cart"></i>&nbsp;<?php echo esc_attr(WC()->cart->get_cart_contents_count()); ?>

                                    </a> 

                                </div>


                      <?php    } 	 ?>


            </div>
        
        </div>





    </div> <!-- End Row ----->
</div> <!-- End container ----->

  



<!----------------------------Products Items ------------------------------->    

<div class="container-fluid2">

<div class="genlite-archive-shop">

    <div class="genlite-archive-shop__container">

    
    <?php 

        while(have_posts()) : the_post(); 

          global $product;
          global $woocommerce;

          $title = get_the_title();   
          $currency = get_woocommerce_currency_symbol();
          $price = esc_attr(get_post_meta( get_the_ID(), '_regular_price', true));
          $sale = esc_attr(get_post_meta( get_the_ID(), '_sale_price', true));      
          $curr_prod_id = $product->get_id();
          $items = $woocommerce->cart->get_cart();        
          $productImageId = $product->get_image_id();
          $review_count = esc_attr($product->get_review_count());   
          $cartItemTotal = '';
          
          foreach($items as $item => $values) {
              if ($values['product_id'] == $curr_prod_id) {
                $cartItemTotal = "&nbsp;" . esc_attr($values['quantity']);
              }
            }

          $productImageId = $product->get_image_id();
          $shop_catalog_image_url = "";
          $shop_catalog_image2_url ="";

          $shop_catalog_image_url = wp_get_attachment_image_src( $productImageId, 'shop_catalog' )[0]; 
          $attachment_ids = $product->get_gallery_image_ids();

          $rowCount = 0;
          foreach( $attachment_ids as $attachment_id ) 
          { 
            if ($rowCount == 0) {
              $shop_catalog_image2_url = wp_get_attachment_image_src( $attachment_id, 'shop_catalog' )[0];
              $rowCount++;
            }
          }

          if ($rowCount==0) {
               $shop_catalog_image2_url = $shop_catalog_image_url;
          }

          ?>

            <!-- ################################## Product Item Start ####################################### -->

            

            <div class="genlite-archive-shop__card">

                    <a href="<?php esc_url(the_permalink()); ?>">

                            <div class="genlite-archive-shop__card-header-placeholder">
                                <div class="genlite-archive-shop__card-header-placeholder-image" style="background-image: url('<?php echo esc_url($shop_catalog_image_url); ?>');"></div>
                            </div>

                            <div class="genlite-archive-shop__card-body">
                                <h6 class="genlite-archive-shop__card-body-heading text-center"><?php the_title(); ?></h6>
								<div class="genlite-archive-shop__card-body-price text-center"><?php if($sale) { ?>
                                        
                                            
                                        <del><?php echo esc_attr($currency); echo esc_attr($price); ?></del>
                                        <?php echo esc_attr($currency); echo esc_attr($sale); ?>
                                        
                
                                    <?php } else {
                                        
                
                                        echo $product->get_price_html();
                                                
                                    } ?>

								</div>

                            
                            </div>

                            <div class="genlite-archive-shop__card-footer text-center">

								<!-- <input type="submit" class="text-center genlite-archive-shop__card-footer-button" value="Add to Cart" title="Add to Cart">		 -->
								<?php

									echo apply_filters( 'woocommerce_loop_add_to_cart_link',
										sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s product_type_%s genlite-archive-shop__card-footer-button">%s</a>',
											esc_url( $product->add_to_cart_url() ),
											esc_attr( $product->get_id() ),
											esc_attr( $product->get_sku() ),
											$product->is_purchasable() ? 'ADD TO CART' : '',
											esc_attr( $product->get_type()),
											esc_html( $product->add_to_cart_text())
										), $product ); 
									?>


                            </div>
                        

                    </a>

            </div>


            
           <!-- ################################## Product Item End #######################################   -->
       

     <?php   endwhile; wp_reset_query(); ?>

</div>

  
   
    </div>  <!-- Container End -->

</div>


<!-- Modal Shop Filter -->
<div class="modal fade" id="genlite-shop-filter" tabindex="-1" role="dialog" aria-labelledby="genlite-shop-filter__label" aria-hidden="true">

<div class="modal-dialog">

    <div class="modal-content">

          <div class="modal-header pt-0 pb-0">
            <h5 class="modal-title" id="genlite-shop-filter__label">Filter Products</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <?php  dynamic_sidebar( 'genlite_shop_filters' ); ?>  
          </div>

      </div>

  </div>
</div>






                
<script type="text/javascript">  

    function genlite_category() {
        var e = document.getElementById("genlite-category");
        var strCategory = e.options[e.selectedIndex].value;
        window.location.assign(strCategory);
    }

    function genlite_sort() {
        var e = document.getElementById("genlite-sort");
        var strSort = e.options[e.selectedIndex].value;
        window.location.assign(strSort);
    }
  
</script>

<?php 

function genlite_pagination($pages = '', $range = 2) {  
	$showitems = ($range * 2) + 1;  
	global $paged;
	$genlitePaged = $paged;
	
	if(empty($genlitePaged)) $genlitePaged = 1;
	if($pages == '')
	{
		global $wp_query; 
		$pages = $wp_query->max_num_pages;
	
		if(!$pages)
			$pages = 1;		 
	}   
	
	if(1 != $pages)
	{
	    echo '<nav aria-label="Page navigation" role="navigation">';
        echo '<span class="sr-only">Page navigation</span>';
        echo '<ul class="pagination justify-content-center ft-wpbs">';
		
        echo '<li class="page-item disabled hidden-md-down d-none d-lg-block"><span class="page-link">Page '.$genlitePaged.' of '.$pages.'</span></li>';
	
	 	if($genlitePaged > 2 && $genlitePaged > $range+1 && $showitems < $pages) 
			echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link(1).'" aria-label="First Page" title="First Page">&laquo;<span class="hidden-sm-down d-none d-md-block"></span></a></li>';
	
	 	if($genlitePaged > 1 && $showitems < $pages) 
			echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($genlitePaged - 1).'" aria-label="Previous Page" title="Previous Page">&lsaquo;<span class="hidden-sm-down d-none d-md-block"></span></a></li>';
	
		for ($i=1; $i <= $pages; $i++)
		{
		    if (1 != $pages &&( !($i >= $genlitePaged+$range+1 || $i <= $genlitePaged-$range-1) || $pages <= $showitems ))
				echo ($genlitePaged == $i)? '<li class="page-item active"><span class="page-link"><span class="sr-only">Current Page </span>'.$i.'</span></li>' : '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($i).'"><span class="sr-only">Page </span>'.$i.'</a></li>';
		}
		
		if ($genlitePaged < $pages && $showitems < $pages) 
			echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($genlitePaged + 1).'" aria-label="Next Page" title="Next Page"><span class="hidden-sm-down d-none d-md-block"></span>&rsaquo;</a></li>';  
	
	 	if ($genlitePaged < $pages-1 &&  $genlitePaged+$range-1 < $pages && $showitems < $pages) 
			echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($pages).'" aria-label="Last Page" title="Last Page"><span class="hidden-sm-down d-none d-md-block"></span>&raquo;</a></li>';
	
	 	echo '</ul>';
        echo '</nav>';
	}
}

genlite_pagination();



get_footer();

?>

