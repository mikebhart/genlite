<?php 

/**
 * GenLite functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Hartsoft
 * @subpackage GenLite
 * @since 1.4.2
 * @version 1.4.2
 */

function genlite_setup() {

	// Translation Ready
	load_theme_textdomain( 'genlite', get_template_directory() . '/languages' );

	// Run init vars
	require_once get_template_directory() .'/inc/theme-support.php';
	require_once get_template_directory() .'/inc/custom-functions.php';
	require_once get_template_directory() .'/inc/walker.php';
	
	// Register menu
	register_nav_menu( 'primary', 'Top Menu' );

	// Include customizer admin functions when in Customizer mode
	if ( is_customize_preview() ) {	
		require_once get_template_directory() .'/inc/customizer.php';	
	}


} 
add_action( 'after_setup_theme', 'genlite_setup' );

function genlite_styles_and_scripts() {

	// Load Styles & Scripts
	wp_enqueue_style( 'genlite_font_awesome', get_template_directory_uri() . '/dist/css/fontawesome.css' );
	wp_enqueue_style( 'genlite_style', get_template_directory_uri() . '/dist/css/main.css' );
	wp_enqueue_script( 'genlite_script', get_template_directory_uri() . '/dist/js/main.js', array( 'jquery' ) );
	wp_enqueue_script( 'genlite_lazy_loading_images', get_template_directory_uri() . '/dist/js/echo.js' );

}
add_action( 'wp_enqueue_scripts', 'genlite_styles_and_scripts' );



