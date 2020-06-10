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
	
  		<main>

		  	<div class="genlite-main-content">
 	
				<header <?php body_class(); ?>>

					<nav class="navbar navbar-expand-lg">

						<a class="navbar-brand" data-type="page-transition" href="<?php echo esc_url(get_home_url()); ?>" title="<?php echo bloginfo('name'); ?>">

							<?php if (has_custom_logo()) { 

									$custom_logo_id = get_theme_mod( 'custom_logo' );
									$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' ); ?>

									<img id="genlite-header__image"  src="<?php echo esc_url( $logo[0] ) ?>" alt="<?php echo bloginfo('name'); ?>">

								<?php } else { ?>

									<h2><?php echo bloginfo( 'name' ); ?></h2>
								
								<?php	}  ?>

						</a>				

						<button class="navbar-toggler second-button genlite-header-navbar__buttton" type="button" data-toggle="collapse" data-target="#navbarTogglerHeaderMenu" aria-controls="navbarTogglerHeaderMenu" aria-expanded="false" aria-label="Toggle navigation">
							<span></span><span></span><span></span><span></span>
						</button>


						<div class="collapse navbar-collapse" id="navbarTogglerHeaderMenu">

									<?php	

										if ( has_nav_menu( 'primary' ) ) {

															wp_nav_menu( array(
																'menu'              => 'primary',
																'theme_location'    => 'primary',
																'depth'             => 5,
																'menu_id'           => 'primary-menu',
																'menu_class'        => 'navbar-nav pr-lg-3',
																'container'         => 'div',
																'container_id'      => 'genlite-navbar',
																'container_class'   => 'ml-auto',
																'fallback_cb'       => 'genlite_Walker_Nav_Menu::fallback',
																'walker'            => new genlite_Walker_Nav_Menu())
																);		

										} else { 

															echo '<div class="text-center">';
															echo esc_attr_e('You need to add a Menu. Go into Customizer | Menus | Select a Menu | Menu Location - Tick Top Menu checkbox.','genlite');
															echo '</div>'; 

										}
									?>

							<div class="d-none d-lg-block pr-lg-3">

								<ul class="genlite-social">

									<?php  get_template_part('/template-parts/render-socials'); ?>		

								</ul>

						
							</div>

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
								
					</nav>
								
				</header>








	

	
