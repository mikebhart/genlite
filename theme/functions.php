<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */



// Load Composer dependencies.
require_once __DIR__ . '/vendor/autoload.php';

Timber\Timber::init();

if ( !class_exists( 'Timber' ) ) {

	echo 'Cannot find Timber in Vendor folder.';
    return;
	
}

// Sets the directories (inside your theme) to find .twig files.
Timber::$dirname = [ 'templates' ];

use Timber\Site;

class GenLiteSite extends Site {

    var $option_fields = [];

    function __construct() {

        add_action( 'wp_enqueue_scripts', [$this, 'load_scripts_and_styles'] );
        add_filter( 'timber/context', [ $this, 'add_to_context' ] );
        add_action( 'after_setup_theme', [ $this, 'theme_supports' ] );
            
        add_filter( 'document_title_parts', [ $this, 'modify_title_format'] );
        add_action( 'login_enqueue_scripts', [ $this, 'admin_login_logo' ] );
        add_filter( 'wp_mail_from_name', [ $this, 'mail_sender_name' ] );
        add_action( 'enqueue_block_editor_assets', [ $this, 'setup_block_editor_assets' ] );
        add_filter( 'document_title_separator', [ $this, 'setup_document_title_separator' ] );
        add_filter( 'wp_robots', [ $this, 'setup_robots_follow'] );

        add_filter( 'wp_sitemaps_add_provider', [ $this, 'remove_users_from_sitemap'], 10, 2 );
        add_filter( 'wp_sitemaps_posts_query_args', [ $this, 'remove_pages_from_sitemap'], 11, 2);

        add_filter( 'rest_api_init', [ $this, 'rest_only_for_authorized_users' ], 99 );

        add_action('upload_mimes', [ $this, 'add_svg_to_media_library' ] );
        add_action('mime_types', [ $this, 'extend_mime_types' ] );

        remove_action( 'wp_head', 'print_emoji_detection_script', 7);
        remove_action( 'wp_print_styles', 'print_emoji_styles');
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_action( 'wp_head', 'rel_canonical' );

        
        parent::__construct();



    }

    function rest_only_for_authorized_users( $wp_rest_server ) {

        if ( !is_user_logged_in() ) {

            wp_die('sorry you are not allowed to access this data', 'Forbidden', 403 );

        }

    }

    function load_scripts_and_styles() {

        $theme = wp_get_theme();
        $app_version = $theme->Version;

        wp_enqueue_style( 'genlite_style', get_template_directory_uri() . '/dist/main.css', array(), $app_version );
        wp_enqueue_script( 'genlite_script', get_template_directory_uri() . '/dist/main.js',  array(), $app_version );
        wp_localize_script( 'genlite_script', 'genlite_settings_object', [ 
                'ajax_url' => admin_url('admin-ajax.php'), 
                'posts_per_page' => get_option('posts_per_page') ]);


        if ( !is_user_logged_in() ) {

            wp_dequeue_script( 'jquery' );
            wp_deregister_script( 'jquery' ); 
            wp_dequeue_style( 'classic-theme-styles' );

        }
        

    }

    

    function add_to_context( $context ) {

        $context['site']  = $this;
        $context['body_class'] = implode(' ', get_body_class());
        $context['header_menu'] = Timber::get_menu('header menu');
   
        // Options
        if ( class_exists( 'ACF' ) ) {

            $option_fields = get_fields('options');

            if ( $option_fields != null ) {
                
                $context['general'] = $option_fields['general'];
                $context['footer'] = $option_fields['footer'];
                $context['contact_form'] = $option_fields['contact_form'];
                $context['script_code'] = $option_fields['script_code'];
                $context['work_archive'] = $option_fields['work_archive'];
               // $context['blog_archive'] = $option_fields['blog_archive'];

            }
        
        }

        return $context;

    }

    function theme_supports() {

        require_once get_template_directory() . '/includes/register-post-types.php';
        require_once get_template_directory() . '/includes/register-blocks.php';
    
        // Add Theme Support 
        add_theme_support( 'title-tag' );   
        add_theme_support( 'automatic-feed-links' );

        if ( class_exists('Woocommerce') ) {
        
             add_theme_support( 'woocommerce' );
             add_theme_support( 'woocommerce-blocks-patterns' );
        }

        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'menus' );
        add_theme_support( 'html5', ['comment-form', 'comment-list', 'gallery',	'caption'] );
        add_theme_support( 'post-formats', ['aside','image','video','quote','link',	'gallery','audio'] );
        add_theme_support( 'editor-styles' );
        add_theme_support( 'wp-block-styles' );
        

        if( function_exists('acf_add_options_page') ) {

            acf_add_options_page([
                'page_title'    => 'Theme Settings',
                'menu_title'    => 'Theme Settings',
                'menu_slug'     => 'genlite-theme-settings',
                'capability'    => 'edit_posts',
                'redirect'      => false
            ]);
        }

    }

    
    function setup_document_title_separator( $sep ) {
        
        $sep = "|";

        return $sep;
    }


    function modify_title_format( $title ) {

        if ( !class_exists( 'ACF' ) ) {
            return;
        }

        $title_override = get_field('genlite_title_override');

        if ( $title_override ) {

            $title_parts['title'] = $title_override;

        } else if ( is_front_page() ) {

            $title_parts['title'] = get_the_title( get_option('page_on_front') );
            $title_parts['site'] = $title['title'];
        

        } else {

            $title_parts['site'] = $title['title'];
            $title_parts['title'] = $title['site'];

        }
        
        return $title_parts;

    }

    function setup_block_editor_assets() {
        wp_enqueue_style( 'genlite_editor_style', get_template_directory_uri() . '/editor-styles.css' );
    }

    function admin_login_logo() { 

        if ( !class_exists( 'ACF' ) ) {
            return;
        }

        $general = get_field( 'general', 'options' );
        
        if ( !is_null( $general ) ) {

            $login_form_logo = $general['logo']['url'];

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
            
        <?php
        }
    }

    function mail_sender_name( $original_email_from ) {
        return strtoupper( get_bloginfo() );
    }


    function setup_robots_follow( $robots ) {
        $robots['follow'] = true;
        return $robots;
    }

    function remove_users_from_sitemap( $provider, $name ) {

        if ( 'users' === $name ) {
            return false;
        }

        return $provider;
    }

    function remove_pages_from_sitemap( $args, $post_type ) {

        if ( 'page' !== $post_type ) return $args;

        $args['post__not_in'] = isset( $args['post__not_in'] ) ? $args['post__not_in'] : array();
        $args['post__not_in'][] = 819; // contact-response1

        return $args;
    }

    function add_svg_to_media_library( $file_types ) {
        
        $new_filetypes = [];
        $new_filetypes['svg'] = 'image/svg+xml';
        $file_types = array_merge($file_types, $new_filetypes);

        return $file_types;
    }
    
    function extend_mime_types($existing_mimes) {
        
        $existing_mimes['webm'] = 'video/webm';
        $existing_mimes['mp4'] = 'video/mp4';
        $existing_mimes['ogg'] = 'video/ogg';
        
        return $existing_mimes;
    }
    



}


new GenLiteSite();
