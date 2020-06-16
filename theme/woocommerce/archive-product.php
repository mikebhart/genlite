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
  
<div class="container">

  <div class="row genlite-archive-header" style="font-size: 16px;">

   <!-- Categories -->
   <div class="col">

      <div style="margin-top:10px; text-align: center;" class="row justify-content-center genlite-hyperlink">
            <?php echo woocommerce_breadcrumb(); ?>
        </div>  
  </div>   

   


   <div class="col-12 col-md-6 col-lg-3">

      <a id="genlite-archive__more-posts-button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-bars"></i>&nbsp;Filter</a>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php  dynamic_sidebar( 'genlite_shop_filters' ); ?>  
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>










     
      

        </div>
      
        <div class="d-md-none d-block"><p><br><br></p></div>
       
        <div class="col-12 col-md-6 col-lg-3">
         
           <div style="margin-top:10px;" class="row justify-content-center">
               <?php woocommerce_result_count(); ?>
           </div>  
        </div>

         <div class="col">
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


        

      </div>

</div> <!-- End top bar row ----->

<!----------------------------Products Items ------------------------------->    

<div class="container-fluid">
    
    <div class="row">
    
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

            <div  class="col-6 col-md-6 col-lg-3 col-xl-2">
              
                 <div class="genlite-product-box">
                
                  <a href="<?php the_permalink(); ?>"> 
                  
                    <?php if ($sale != NULL) { ?> 
                      <span class="onsale-archive"><?php esc_attr_e('Sale','genlite'); ?></span>
                    <?php } ?>  

                      <div class="genlite-shop-product-image">

                          <img src='<?php echo esc_url($shop_catalog_image_url); ?>' onmouseover="this.src='<?php echo esc_url($shop_catalog_image2_url); ?>';" onmouseout="this.src='<?php echo esc_url($shop_catalog_image_url); ?>';" alt="<?php the_title(); ?>" />

                      </div>    

                    
                    <object id="myScroll">

                      <?php

                                          echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                                                sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s genlite-add-to-cart-button">%s</a>',
                                                    esc_url( $product->add_to_cart_url() ),
                                                    esc_attr( $product->get_id() ),
                                                    esc_attr( $product->get_sku() ),
                                                    $product->is_purchasable() ? '+' : '',
                                                    esc_attr( $product->get_type()),
                                                    esc_html( $product->add_to_cart_text() . $cartItemTotal)
                                                ), $product ); 
                                    ?>

                    </object>

                    <hr>
                
                    <div class="genlite-product-shop-title"><?php echo esc_attr($title); ?></div>                      
                                    
                        <?php 
      
                           if ($product->get_average_rating() > 0) { ?>
                                   
                                <div class="genlite-float-center">

                                      <?php 
                                               
                                        if ($average = $product->get_average_rating()) :

                                            $reviewedBy = __('reviewers', 'genlite');
                                              $ratingTitle = __('Rated %s out of 5.','genlite');
                                              $ratingByLabel = __('By','genlite');

                                              echo '<div class="star-rating genlite-float-center-child" title="' . esc_attr(sprintf( $ratingTitle, $average)) . ' ' . esc_attr($ratingByLabel)  . ' ' . esc_attr($review_count) . ' ' . esc_attr($reviewedBy) . '."><span style="width:'.( ( esc_attr($average) / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.esc_attr($average).'</strong></span></div>'; 

                                           endif; ?>
                                </div>

                                <br>

                          <?php } ?>     

                                <div class="genlite-product-shop-price">
                                
                                  <?php if($sale) : ?>
                                
                                      <p class="product-price-tickr">
                                          <del><?php echo esc_attr($currency); echo esc_attr($price); ?></del>
                                            <?php echo esc_attr($currency); echo esc_attr($sale); ?>
                                        </p>    
                                        <?php elseif($price) : ?>
                                          <p class="product-price-tickr">     
                                              <?php echo esc_attr($currency); echo esc_attr($price); ?> 
                                            </p>    
                                        <?php elseif(!$price) : ?>
                                          <p class="genlite-red">     
                                              <?php echo esc_attr('Free'); ?> 
                                            </p>    
                                
                                   <?php endif; ?>

                                </div>
                     
                          
                  </a>
              
                </div>

             
           
            </div>        <!-- end col -->

       
               
           <!-- ################################## Product Item End #######################################   -->
       

     <?php   endwhile; wp_reset_query(); ?>
  
   
    </div>  <!-- Container End -->

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