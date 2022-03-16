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
        add_action( 'admin_init', [ $this, 'add_editor_user_role'] );


		parent::__construct();
	
	}

	public function load_scripts_and_styles() {

		wp_enqueue_style('genlite_font_awesome', get_template_directory_uri() . '/dist/fa/fontawesome.css');
		wp_enqueue_style('genlite_style', get_template_directory_uri() . '/dist/main.css');

		wp_enqueue_script('genlite_script', get_template_directory_uri() . '/dist/main.js', array('jquery'));
		wp_localize_script('genlite_script', 'genlite_ajax_object', array('ajax_url' => admin_url('admin-ajax.php'),
			'posts_per_page' => get_option('posts_per_page'),
		));

		if (get_theme_mod('genlite_general_lightbox') == true) {
			wp_enqueue_script('genlite_fancybox_script', get_template_directory_uri() . '/dist/jquery.fancybox.min.js', array('jquery'));
			wp_enqueue_style('genlite_fancybox_style', get_template_directory_uri() . '/dist/jquery.fancybox.min.css');
		}

	}
  
    public function add_editor_user_role() {

        if ( !is_a( get_role('editor_user'), 'WP_Role')) {

            $privilegedCapabilities = [
                'read'         => true,
                'edit_posts'   => true,
                'delete_posts' => true,
                'delete_users' => true,
                'create_users' => true,
                'manage_categories'  => true,
                'manage_links' => true,
                'edit_others_posts' => true,
                'edit_pages' => true,
                'edit_users' => true, 
                'list_users' => true,
                'promote_users' => true,
                'remove_users' => true,
                'edit_others_pages' => true,
                'edit_published_pages' => true,
                'publish_pages' => true,
                'delete_pages' => true,
                'delete_others_pages' => true,
                'delete_published_pages' => true,
                'delete_others_posts' => true,
                'delete_private_posts' => true,
                'edit_private_posts' => true,
                'read_private_posts' => true,
                'delete_private_pages' => true,
                'edit_private_pages' => true,
                'read_private_pages' => true ];

            add_role('editor_user', __('Editor User'), $privilegedCapabilities );
        }
    }

	public function add_to_context( $context ) {

		$context['site']  = $this;
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

		// Include customizer admin functions when in Customizer mode
		if ( is_customize_preview() ) {
			require_once get_template_directory() . '/includes/customizer.php';
		}

		require_once get_template_directory() . '/includes/archive-ajax-handler.php';
		require_once get_template_directory() . '/includes/custom-functions.php';
		require_once get_template_directory() . '/includes/nav-walker.php';

		// Register menu
		register_nav_menu('primary', 'Top Menu');

		// Add Theme Support 
		add_theme_support( 'title-tag' );   
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'custom-logo', ['height'=> 80, 'width'=> 200, 'flex-height' => false, 'flex-width'  => false] );
		add_theme_support( 'html5', ['comment-form', 'comment-list', 'gallery',	'caption'] );
		add_theme_support( 'post-formats', ['aside','image','video','quote','link',	'gallery','audio'] );

	}

	public function setup_widgets() {

		// 4 widgets for Footer columns.
		for ( $x = 1; $x <= 4; $x++ ) {

			register_sidebar( array(
				'name'          => 'Footer' . $x,
				'id'            => 'genlite_footer_' . $x,
				'description'   => __('Add widgets here to appear in your footer.', 'genlite' ),
				'before_widget' => '<section id="%1$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h6><u>',
				'after_title'   => '</u></h6>',
			) );

		}		  

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

 
// if ( null !== $result ) {
//     echo "Success: {$result->name} user role created.";
// }
// else {
//     echo 'Failure: user role already exists.';
// }

