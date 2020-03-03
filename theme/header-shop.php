<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hartsoft
 * @subpackage GenLite
 * @since 1.4.2
 * @version 1.4.2
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

	<head>
			
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<header>
					
		    <div class="container">	
					
				<div class="row">

					<!-- Socials -->

					<div class = "col-lg-4 text-left">

						<div class="row">
	
							<div class="col-lg-12">

								<div class="d-none d-sm-block">
						
							 		<ul class="social-header social-header-circle">

							   			<?php $GLOBALS["genlite_is_header"] = true;  get_template_part('/template-parts/render-socials'); ?>		
						   			 
									</ul>

								</div>

							</div>
								 
							 <div class="col-lg-12">

							 	 <div class="d-none d-sm-block">

									 	&nbsp; <!-- Placeholder for adding a new header item -->

								 </div>

							</div>	

							<!-- Shop Sidebar Filters -->

							<div class="col-lg-12">

							 	<?php

							 	if ( class_exists( 'WooCommerce' ) ) { ?>

									<div id="genlite-shop-wrapper">

				                        <nav class="fixed-top genlite-hyperlink" id="genlite-shop-sidebar-wrapper" role="navigation">

				                            <ul>
		                                    	<?php  dynamic_sidebar( 'genlite_shop_filters' ); ?>  
				                            </ul>

								        </nav>
									                
									    <div id="genlite-shop-page-content-wrapper">

									    	<button type="button" class="genlite-shop-hamburger animated fadeInLeft is-closed genlite-icon" data-toggle="offcanvas">
									        	
									        	<span class="genlite-shop-hamburger-block">
									            	<span class="hamb-top"></span>
									                <span class="hamb-middle"></span>
									                <span class="hamb-bottom"></span>
									            </span>
									            
									            <span class="genlite-show-filters-label"><?php esc_attr_e('Filter','genlite'); ?></span>						                              
									        
									        </button>
  																	
									    </div>

				                    </div>

                     			<?php 

                     			}  ?>

   							</div>



						</div>		 				

					</div>
					   
					<!-- Logo -->

			   		<div class = "col-lg-4 text-center">
			   		
			   			<a href ="<?php echo esc_url(get_home_url()); ?>" title="<?php echo bloginfo('name'); ?>">

						   	<?php if (has_custom_logo()) { 

									$custom_logo_id = get_theme_mod( 'custom_logo' );
									$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' ); ?>

						        	<img class="genlite-header__logo"  src="<?php echo esc_url( $logo[0] ) ?>" alt="<?php echo bloginfo('name'); ?>">

						  	<?php } else { ?>

						        	<h2><?php echo bloginfo( 'name' ); ?></h2>

						<?php	}  ?>

						</a>				
							
					</div>

					<!-- Search -->

					<div class = "col-lg-4 text-right"> 
						
						<div class="row">

						     <div class="col-lg-12">
 							
								<form method="get" class="form-horizontal my-2 my-md-0 genlite-header-search-form" action="<?php echo esc_url(home_url('/')); ?>">

							    	<div class="input-group">

							    		<?php  $genliteSearchLabel = __('Search for blogs and pages','genlite'); 	
							    			if ( class_exists( 'WooCommerce' ) ) { $genliteSearchLabel = __('Search for products','genlite'); } ?>

		           						<input type="text" value="" name="s" class="form-control" placeholder="<?php echo $genliteSearchLabel; ?>">
										<span class="input-group-btn fa fa-search form-control-feedback genlite-icon"></span>    

			        				</div>

			        					<?php 	if ( class_exists( 'WooCommerce' ) ) { ?>

						        				  <input type="hidden" name="post_type" value="product" />

					        			<?php } ?> 	  
							
							    </form>

							</div>

							<!-- Login / Logout -->

							<div class="col-lg-12">

								<?php 	

								if ( class_exists( 'WooCommerce' ) ) { ?>

									<div class="d-none d-sm-block">

										<span class="genlite-icon genlite-hyperlink">

									 	    <?php if ( is_user_logged_in() ) { ?>
	                     
					                            <a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id'))); ?>"><?php esc_attr_e('My Account','genlite'); ?></a>&nbsp;&#47;
					                            <a href="<?php echo esc_url(wp_logout_url()); ?>"><?php esc_attr_e('Logout','genlite'); ?></a>
	                       
									            <?php } else { ?>
	               
							                    <a href="<?php echo esc_url(wp_login_url()); ?>"><?php esc_attr_e('Login','genlite'); ?></a>&nbsp;&#47;
							                    <a href="<?php echo esc_url(wp_registration_url()); ?>"><?php esc_attr_e('Register','genlite'); ?></a>&nbsp;

								            <?php } ?>

								        </span>    

									</div>

						  		<?php

						  	    } ?>

							</div>

							<!-- Shopping Basket -->	

							<div class="col-md-12">



								<?php

							 	if ( class_exists( 'WooCommerce' ) ) {
								 	global $woocommerce; 
				             		$genliteCartTotal  = get_woocommerce_currency_symbol() . number_format($woocommerce->cart->total, 2); ?>
																			
							 		<div class="genlite-shop-basket">

							 			<span class="genlite-icon genlite-hyperlink">
	             		
						             		<a href="<?php echo esc_url(wc_get_cart_url()); ?>">

						             			<i class="fas fa-shopping-cart genlite-icon"></i>&nbsp;<?php echo esc_attr(WC()->cart->get_cart_contents_count()); ?>

						 								
							 								<div class="d-none d-sm-inline">
							 									&nbsp;<span class="genlite-main-color">/</span>&nbsp;

							 									<?php echo $genliteCartTotal; ?>
							 								</div>	

					                    	</a> 

					                	</span>    

					     		    </div> 
					              
					       		<?php

					       		} 	 ?>
			
							</div>
							
						</div>	    
		
					</div>	 

	        	</div>

				<!-- Tagline -->

		       	<div class="row">
	       		
	       			<div class="col-lg-12 text-center">
		       				
						<h1 class="genlite-header__tagline"><?php echo bloginfo('description');  ?></h1>
						
		        	</div>  

		        </div>
			
			</div>	<!-- End Container -->


			<!-- Menu -->

			<nav class="navbar navbar-expand-lg navbar-light bg-light stroke">

				<div class="mx-auto d-sm-flex d-block flex-sm-wrap">

				    <button class="navbar-toggler ml-auto hidden-sm-up float-xs-right genlite-navbar-button" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="<?php esc_html_e( 'Toggle Navigation', 'genlite' ); ?>">

        				<span><i class="fas fa-bars"></i>&nbsp;<?php esc_attr_e('Menu','genlite'); ?></span>

    				</button>

			     	<div class="collapse navbar-collapse text-center" id="navbar-content">

					<?php 
									if ( has_nav_menu( 'primary' ) ) {

											wp_nav_menu( array(
								                	'menu'              => 'primary',
								                	'theme_location'    => 'primary',
								                	'depth'             => 5,
							                		'menu_id'           => 'primary-menu',
							                		'menu_class'        => 'nav navbar-nav',
							                		'container'         => 'div',
													'container_id'      => 'genlite-navbar',
													'fallback_cb'       => 'genlite_Walker_Nav_Menu::fallback',
								                	'walker'            => new genlite_Walker_Nav_Menu())
								           			);		

									} else { 

										echo '<div class="genlite-red text-center">';
										echo esc_attr_e('You need to add a Menu. Go into Customizer | Menus | Select a Menu | Menu Location - Tick Top Menu checkbox.','genlite');
										echo '</div>'; 

									}


									 if ( class_exists( 'WooCommerce' ) ) {

							   ?>

												<div class="d-block d-sm-none">

													<div class="genlite-xs-login">

													  <?php if ( is_user_logged_in() ) { ?>
						                     
										                            <a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id'))); ?>"><?php esc_attr_e('My Account','genlite'); ?></a>&nbsp;&#47;
										                            <a href="<?php echo esc_url(wp_logout_url()); ?>"><?php esc_attr_e('Logout','genlite'); ?></a>
						                       
														            <?php } else { ?>
						               
												                    <a href="<?php echo esc_url(wp_login_url()); ?>"><?php esc_attr_e('Login','genlite'); ?></a>&nbsp;&#47;
												                    <a href="<?php echo esc_url(wp_registration_url()); ?>"><?php esc_attr_e('Register','genlite'); ?></a>&nbsp;

													            <?php } ?>



													</div>

												</div>

							<?php } ?>					

					</div>		
				
				</div>	

			</nav>
		
		</header>