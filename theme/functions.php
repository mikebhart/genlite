<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */

$timber = new Timber();

if ( ! class_exists( 'Timber' ) ) {

	echo 'Timber is not activated.';
	exit;
	
}

Timber::$dirname = ['templates'];
Timber::$autoescape = false;

class GenLiteSite extends TimberSite {

	function __construct() {

		add_action( 'after_setup_theme', [ $this, 'theme_supports' ] );
		add_filter( 'timber/context', [ $this, 'add_to_context' ] );
		add_filter( 'timber/twig', [ $this, 'add_to_twig' ] );
		add_filter( 'site_transient_update_plugins', [ $this, 'disable_update_default_plugins' ] );
		add_action( 'wp_enqueue_scripts', [$this, 'load_scripts_and_styles'] );
		add_filter( 'document_title_parts', [ $this, 'modify_title_format'] );
		add_action( 'login_enqueue_scripts', [ $this, 'admin_login_logo' ] );
        add_filter( 'wp_mail_from_name', [ $this, 'mail_sender_name' ] );
        add_action( 'enqueue_block_editor_assets', [ $this, 'setup_block_editor_assets' ] );
        add_filter( 'document_title_separator', [ $this, 'setup_document_title_separator' ] );

		parent::__construct();
	
	}

	function load_scripts_and_styles() {

		$theme = wp_get_theme();
		$app_version = $theme->Version;

		wp_enqueue_style( 'genlite_style', get_template_directory_uri() . '/dist/main.css', array(), $app_version );
        wp_enqueue_script( 'genlite_script', get_template_directory_uri() . '/dist/main.js', array('jquery'), $app_version );

	}
  
	function add_to_context( $context ) {

		$context['site']  = $this;
		$context['body_class'] = implode(' ', get_body_class());
        $context['header_menu'] = new TimberMenu('header menu');
   	
		// Options
		$option_fields = get_fields('options');

		if ( $option_fields != null ) {
           
            $context['footer_column_3'] = $option_fields['footer_column_3'];
            $context['footer_footnote_links'] = $option_fields['footer_footnote_links'];
	        $context['footer_footnote'] = $option_fields['footer_footnote'];
            $context['header_favicon'] = $option_fields['header_favicon'];
	        $context['header_logo'] = $option_fields['header_logo'];
            $context['google_analytics'] = $option_fields['google_analytics'];

        }

        return $context;
	}

	function theme_supports() {

        require_once get_template_directory() . '/includes/register-post-types.php';
        require_once get_template_directory() . '/includes/register-blocks.php';
		require_once get_template_directory() . '/includes/admin-cleanup.php';
      
      
		// Add Theme Support 
		add_theme_support( 'title-tag' );   
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'html5', ['comment-form', 'comment-list', 'gallery',	'caption'] );
		add_theme_support( 'post-formats', ['aside','image','video','quote','link',	'gallery','audio'] );
        add_theme_support( 'editor-styles' );
        add_theme_support( 'wp-block-styles' );

        if( function_exists('acf_add_options_page') ) {

            acf_add_options_page([
                'page_title'    => 'Contact Form Settings',
                'menu_title'    => 'Contact Form',
                'menu_slug'     => 'genlite-contact-settings',
                'capability'    => 'edit_posts',
                'redirect'      => false
            ]);

            acf_add_options_page([
                'page_title'    => 'Header Settings',
                'menu_title'    => 'Header',
                'menu_slug'     => 'genlite-header-settings',
                'capability'    => 'edit_posts',
                'redirect'      => false
            ]);

            acf_add_options_page([
                'page_title'    => 'Footer Settings',
                'menu_title'    => 'Footer',
                'menu_slug'     => 'genlite-footer-settings',
                'capability'    => 'edit_posts',
                'redirect'      => false
            ]);

            acf_add_options_page([
                'page_title'    => 'GTA Settings',
                'menu_title'    => 'GTA',
                'menu_slug'     => 'genlite-gta-settings',
                'capability'    => 'edit_posts',
                'redirect'      => false
            ]);

            acf_add_options_page([
                'page_title'    => 'General Settings',
                'menu_title'    => 'General',
                'menu_slug'     => 'genlite-general-settings',
                'capability'    => 'edit_posts',
                'redirect'      => false
            ]);


        }
	
	}
	
	function modify_title_format( $title ) {

		if ( !is_front_page() ) {

			$title_parts['site'] = $title['title'];
			//$title_parts['title'] = $title['site'];
		
		} else {
		
            // global $post;

            // $post_data = get_post( $post );
        	// $post_title = isset( $post_data->post_title ) ? $post_data->post_title : '';
          
			$title_parts['title'] = $title['title'];

		}
		
		return $title_parts;

	}

    function setup_block_editor_assets() {
        wp_enqueue_style('genlite_editor_style', get_template_directory_uri() . '/editor-styles.css' );
    }


	function add_to_twig( $twig ) {
		$twig->addExtension( new Twig\Extension\StringLoaderExtension() );
		$twig->addFilter( new Twig\TwigFilter( 'myfoo', array( $this, 'myfoo' ) ) );
		$twig->addFunction( new Timber\Twig_Function( 'wp_list_pages', 'wp_list_pages' ) );

		return $twig;
	}

	function disable_update_default_plugins( $value ) {
		unset( $value->response['akismet/akismet.php'] );
		unset( $value->response['hello.php'] );
		return $value;
	}

	function admin_login_logo() { 

        $login_form_logo = get_template_directory_uri() . '/dist/images/login-logo.svg';

		?>

		<style type="text/css">
			#login h1 a, .login h1 a {
				background: url(<?php echo $login_form_logo; ?>);
				background-repeat: no-repeat;
				background-size: 200px 80px;         
				width: 100%;
			    background-position-x: center;
				pointer-events: none;
			  	cursor: default;
			}
		</style>
	<?php }

    function mail_sender_name( $original_email_from ) {
        return strtoupper( get_bloginfo() );
    }

    function setup_document_title_separator( $sep ) {
        $sep = "|";

        return $sep;
    }

    
}

new GenLiteSite();
