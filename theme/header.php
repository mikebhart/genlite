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

	<body <?php body_class('genlite__fade_in'); ?>>


 	
		<header>

		

				

					

						<div id="genlite-header__navbar">

							<a href ="<?php echo esc_url(get_home_url()); ?>" title="<?php echo bloginfo('name'); ?>">

								<?php if (has_custom_logo()) { 

									$custom_logo_id = get_theme_mod( 'custom_logo' );
									$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' ); ?>

									<img id="genlite-header__image"  src="<?php echo esc_url( $logo[0] ) ?>" alt="<?php echo bloginfo('name'); ?>">

								<?php } else { ?>

									<h2><?php echo bloginfo( 'name' ); ?></h2>

								<?php	}  ?>

							</a>				

							<div id="genlite-header__navbar-right">
							
								<nav class="navbar navbar-expand-lg">

									 <!-- Collapse button -->

										<!-- <button class="navbar-toggler ml-auto hidden-sm-up float-xs-right genlite-navbar-button" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="<?php esc_html_e( 'Toggle Navigation', 'genlite' ); ?>">

											<span><i class="fas fa-bars"></i>&nbsp;<?php esc_attr_e('Menu','genlite'); ?></span>

										</button> -->

										<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerHeaderMenu" aria-controls="navbarTogglerHeaderMenu" aria-expanded="false" aria-label="Toggle navigation">
  											  <span class="navbar-toggler-icon"></span>
									  </button>


										<div class="collapse navbar-collapse" id="navbarTogglerHeaderMenu">


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
													?>

													
												<ul class="genlite-social">

													<?php  get_template_part('/template-parts/render-socials'); ?>		

												</ul>

												<!-- <div class="search-button">
														<a href="#" class="search-toggle" data-selector="#header-1"></a>
												</div>
												<section id="header-1">
												<form method="get" class="search-box" action="<?php echo esc_url(home_url('/')); ?>">

													<input type="text" value="" name="s" class="text search-input" placeholder="Type here to search..." />
												</form>



												</section> -->

										</div>
								

								</nav>



							</div>

						


						</div>

						

					
						
					

				
					

		
		</header>
	

	
