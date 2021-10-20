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

 /**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

/**
 * If you are installing Timber as a Composer dependency in your theme, you'll need this block
 * to load your dependencies and initialize Timber. If you are using Timber via the WordPress.org
 * plug-in, you can safely delete this block.
 */
//$composer_autoload = WP_CONTENT_DIR. '/vendor/autoload.php';

// echo $composer_autoload;
// exit;

require_once WPMU_PLUGIN_DIR . '/timber-library/timber.php';

// if ( file_exists( $composer_autoload ) ) {
// 	require_once $composer_autoload;
	$timber = new Timber\Timber();
//}

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if ( ! class_exists( 'Timber' ) ) {

	echo 'Timber is not activated.';
	exit;
	
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'templates', 'views' );

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;




function genlite_setup()
{

    // Translation Ready
    load_theme_textdomain('genlite', get_template_directory() . '/languages');

    // Run init vars

	require_once WPMU_PLUGIN_DIR . '/woocommerce/woocommerce.php';

    require_once get_template_directory() . '/inc/theme-support.php';
    require_once get_template_directory() . '/inc/custom-functions.php';
    require_once get_template_directory() . '/inc/walker.php';

    // Register menu
    register_nav_menu('primary', 'Top Menu');

    // Include customizer admin functions when in Customizer mode
    if (is_customize_preview()) {
        require_once get_template_directory() . '/inc/customizer.php';
    }

}
add_action('after_setup_theme', 'genlite_setup');

function genlite_styles_and_scripts()
{

    // Load Styles & Scripts
    wp_enqueue_style('genlite_font_awesome', get_template_directory_uri() . '/dist/css/fontawesome.css');
    wp_enqueue_style('genlite_style', get_template_directory_uri() . '/dist/css/app.css');

    wp_enqueue_script('genlite_script', get_template_directory_uri() . '/dist/js/app.js', array('jquery'));
    wp_localize_script('genlite_script', 'genlite_ajax_object', array('ajax_url' => admin_url('admin-ajax.php'),
        'posts_per_page' => get_option('posts_per_page'),
    ));

    if (get_theme_mod('genlite_general_lightbox') == true) {
        // Load FancyBox Lighbox used for images
        wp_enqueue_script('genlite_fancybox_script', get_template_directory_uri() . '/dist/js/jquery.fancybox.min.js', array('jquery'));
        wp_enqueue_style('genlite_fancybox_style', get_template_directory_uri() . '/dist/css/jquery.fancybox.min.css');
    }

}
add_action('wp_enqueue_scripts', 'genlite_styles_and_scripts');
