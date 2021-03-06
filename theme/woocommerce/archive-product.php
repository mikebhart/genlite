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
        case 'external': return __('Their site','genlite'); break;
        case 'grouped':  return __('Group items','genlite'); break;
        case 'simple': return  '+'; break;
        case 'variable': return __('Variations','genlite'); break;
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
                                <h5><?php the_title(); ?></h5>

                            
                            </div>

                            <div class="genlite-archive-shop__card-footer">

                            <?php if($sale) { ?>
                                        
                                            
                                        <del><?php echo esc_attr($currency); echo esc_attr($price); ?></del>
                                        <?php echo esc_attr($currency); echo esc_attr($sale); ?>
                                        
                
                                    <?php } else {
                                        
                
                                        echo $product->get_price_html();
                                                
                                    } ?>



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

  if (!function_exists('genlite_pagination') ) {
      require_once get_template_directory() .'/inc/pagination.php';
      genlite_pagination();
  }

  get_footer();

?>