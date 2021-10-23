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

$timber = new Timber();

if ( ! class_exists( 'Timber' ) ) {

	echo 'Timber is not activated.';
	exit;
	
}

Timber::$dirname = ['templates'];
Timber::$autoescape = false;


class GenLiteSite extends TimberSite {

	public function __construct() {

		add_action( 'after_setup_theme', [ $this, 'theme_supports' ] );
		add_filter( 'timber/context', [ $this, 'add_to_context' ] );
		add_filter( 'timber/twig', [ $this, 'add_to_twig' ] );
		add_action( 'wp_enqueue_scripts', [$this, 'load_scripts_and_styles'] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'setup_block_editor_assets'] );
		add_action( 'widgets_init', [ $this, 'setup_widgets'] );	

		parent::__construct();
	
	}

	public function load_scripts_and_styles() {

		wp_enqueue_style('genlite_font_awesome', get_template_directory_uri() . '/dist/styles/fontawesome.css');
		wp_enqueue_style('genlite_style', get_template_directory_uri() . '/dist/styles/index.css');

		wp_enqueue_script('genlite_script', get_template_directory_uri() . '/dist/scripts/index.js', array('jquery'));
		wp_localize_script('genlite_script', 'genlite_ajax_object', array('ajax_url' => admin_url('admin-ajax.php'),
			'posts_per_page' => get_option('posts_per_page'),
		));

		if (get_theme_mod('genlite_general_lightbox') == true) {
			wp_enqueue_script('genlite_fancybox_script', get_template_directory_uri() . '/dist/scripts/jquery.fancybox.min.js', array('jquery'));
			wp_enqueue_style('genlite_fancybox_style', get_template_directory_uri() . '/dist/styles/jquery.fancybox.min.css');
		}

	}
  
	public function add_to_context( $context ) {

		$context['site']  = $this;
		$context['miketest']  = 'hello 123mike was erte';
		$context['language_attributes'] = language_attributes(); 
		$context['blog_charset'] = bloginfo( 'charset' );
		$context['blog_name'] = bloginfo( 'name' ); 	

		//$context['wp_head'] = wp_head(); 
		$context['body_class'] = body_class( 'genlite__fade_in' );
		$context['body_open'] = wp_body_open();
		$context['has_logo'] =  has_custom_logo() ? 'true' : 'false'; 

		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$context['logo']  = wp_get_attachment_image_src( $custom_logo_id , 'full' )[0];
		$context['is_woocommerce'] = class_exists( 'WooCommerce' ) ? 'true' : 'false'; 

		$menu_items = '';

		if ( has_nav_menu( 'primary' ) ) {

			$menu_items = wp_nav_menu( array(
				'menu'              => 'primary',
				'theme_location'    => 'primary',
				'depth'             => 5,
				'menu_id'           => 'primary-menu',
				'menu_class'        => 'navbar-nav pr-lg-3',
				'container'         => 'div',
				'container_id'      => 'genlite-navbar',
				'container_class'   => 'ml-auto',
				'fallback_cb'       => 'genlite_Walker_Nav_Menu::fallback',
				'echo' 				=> false,
				'walker'            => new genlite_Walker_Nav_Menu())
				);		

		}

		$context['header_nav_menu'] = $menu_items;
		

		return $context;
	}

	public function theme_supports() {

		// 	// Translation Ready
		load_theme_textdomain('genlite', get_template_directory() . '/languages');

		require_once get_template_directory() . '/includes/custom-functions.php';
		require_once get_template_directory() . '/includes/walker.php';

		// Register menu
		register_nav_menu('primary', 'Top Menu');

		// Include customizer admin functions when in Customizer mode
		if (is_customize_preview()) {
			require_once get_template_directory() . '/includes/customizer.php';
		}

		// Add Theme Support 
		add_theme_support( 'title-tag' );   
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );

		add_theme_support( 'custom-logo', array(
			'height'      => 80,
			'width'       => 200,
			'flex-height' => false,
			'flex-width'  => false
		));

		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

	}

	// Create Widgets area - 1 sidebar widget for left and right side bar pages.  4 widgets for Footer columns.
	public function setup_widgets() {

		register_sidebar( array(
			'name'          => 'Footer 1',
			'id'            => 'genlite_footer_1',
			'description'   => __('Add widgets here to appear in your footer.','genlite'),
			'before_widget' => '<section id="%1$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h6><u>',
			'after_title'   => '</u></h6>',
		) );

		register_sidebar( array(
			'name'          => 'Footer 2',
			'id'            => 'genlite_footer_2',
			'description'   => __('Add widgets here to appear in your footer.','genlite'),
			'before_widget' => '<section id="%1$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h6><u>',
			'after_title'   => '</u></h6>',
		) );

		register_sidebar( array(
			'name'          => 'Footer 3',
			'id'            => 'genlite_footer_3',
			'description'   => __('Add widgets here to appear in your footer.','genlite'),
			'before_widget' => '<section id="%1$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h6><u>',
			'after_title'   => '</u></h6>',
		) );

		register_sidebar( array(
			'name'          => 'Footer 4',
			'id'            => 'genlite_footer_4',
			'description'   => __('Add widgets here to appear in your footer.','genlite'),
			'before_widget' => '<section id="%1$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h6><u>',
			'after_title'   => '</u></h6>',
		) );

		register_sidebar( array(
			'name'          => 'Footer Footnote',
			'id'            => 'genlite_footer_footnote',
			'description'   => __('Add widgets here to appear in your footer.','genlite'),
			'before_widget' => '<section id="%1$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h6><u>',
			'after_title'   => '</u></h6>',
		) );

		register_sidebar( array(
			'name'          => 'Shop Filters',
			'id'            => 'genlite_shop_filters',
			'description'   => __('Add widgets here to appear in your Woocommerce Shop Filter.','genlite'),
			'before_widget' => '<section id="%1$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h6><u>',
			'after_title'   => '</u></h6>',
		) );

	
	}



	public function add_to_twig( $twig ) {
		$twig->addExtension( new Twig\Extension\StringLoaderExtension() );
		$twig->addFilter( new Twig\TwigFilter( 'myfoo', array( $this, 'myfoo' ) ) );
		return $twig;
	}

}


new GenLiteSite();
