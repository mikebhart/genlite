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

    function __construct() {

        add_filter( 'timber/context', [ $this, 'add_to_context' ] );
        add_filter( 'document_title_parts', [ $this, 'modify_title_format'] );
        add_filter( 'wp_mail_from_name', [ $this, 'mail_sender_name' ] );
        add_filter( 'document_title_separator', [ $this, 'setup_document_title_separator' ] );
        add_filter( 'wp_robots', [ $this, 'setup_robots_follow'] );
        add_filter( 'xmlrpc_enabled', '__return_false' );
        add_action( 'login_enqueue_scripts', [ $this, 'genlite_add_custom_login_logo' ] );

        add_action( 'wp_enqueue_scripts', [$this, 'load_scripts_and_styles'] );
        add_action( 'after_setup_theme', [ $this, 'theme_supports' ] );
        add_action( 'enqueue_block_editor_assets', [ $this, 'setup_block_editor_assets' ] );
        add_action( 'upload_mimes', [ $this, 'add_svg_to_media_library' ] );

        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('wp_head', 'rel_canonical');

        add_action('do_feed', [ $this, 'website_disable_feed' ], 1);
        add_action('do_feed_rdf', [ $this, 'website_disable_feed' ], 1);
        add_action('do_feed_rss', [ $this, 'website_disable_feed' ], 1);
        add_action('do_feed_rss2',[ $this, 'website_disable_feed' ], 1);
        add_action('do_feed_atom', [ $this, 'website_disable_feed' ], 1);
        add_action('do_feed_rss2_comments', [ $this, 'website_disable_feed' ], 1);
        add_action('do_feed_atom_comments', [ $this, 'website_disable_feed'], 1);

        add_filter('template_include', [ $this, 'get_password_protected_template' ] );

        remove_action( 'wp_head', 'feed_links_extra', 3 );
        remove_action( 'wp_head', 'feed_links', 2 );


        add_action( 'admin_bar_menu', [ $this, 'genlite_add_menu_bar' ], 100 );
        add_action( 'admin_menu', [ $this, 'genlite_add_custom_admin_pages'], 101 );


        parent::__construct();

    }

    function genlite_add_custom_admin_pages() {
       
        add_submenu_page(
            ' ',             
            'Custom Admin Page Clear Cache Form',  
            'Custom Admin Page Clear Cache Form',
            'editor',   
            'custom-admin-page-cache-form',   
            [ $this, 'genlite_custom_page_clear_cache_form']     
        );

        add_submenu_page(
            ' ',             
            'Custom Admin Page Clear Cache Run',  
            'Custom Admin Page Clear Cache Run',
            'editor',   
            'custom-admin-page-cache-run',   
            [ $this, 'genlite_custom_page_clear_cache_run']     
        );


    }

    function genlite_custom_page_clear_cache_form() {

        Timber::render('admin/clear-cache-form.twig' );
	    die();

    }

    function genlite_custom_page_clear_cache_run() {

        $result = "";

        try {

            // clear cache code

            $result = "Cache cleared Successfully";

        } catch ( Exception $e ) {

            $result = $e->getMessage();
        
        }

        $context['result'] = $result;

        Timber::render('admin/clear-cache-result.twig', $context );
	    die();

    }


   
    function genlite_add_menu_bar ( WP_Admin_Bar $admin_bar ) {

        $admin_bar->add_menu( array(
            'id'    => 'clear-cache-admin-page',
            'parent' => null,
            'group'  => null,
            'title' => '<span class="ab-icon dashicons dashicons-update"></span>Clear Cache',
            'href'  => admin_url('admin.php?page=custom-admin-page-cache-form'),
            'meta' => [ 'title' => 'Clear the Cache' ]
        ) );
    
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

        $post_id = get_the_ID();
        $post_content = get_post_field( 'post_content', $post_id );
        $blocks = parse_blocks( $post_content );

        $context['has_test']  = '';

        foreach ( $blocks as $block ) {

            if ( 'acf/test' === $block['blockName'] ) {

                $context['has_test']  = 'has-test';

                break;
            }
        }

        $context['site']  = $this;
        $context['body_class'] = implode(' ', get_body_class() );
        $context['header_menu'] = Timber::get_menu( 'header menu' );

        $excerpt = wp_strip_all_tags( get_the_excerpt() );
        $excerpt = substr( $excerpt, 0, 140 );
        $meta_description = substr( $excerpt, 0, strrpos( $excerpt, ' ') );
        $context['auto_meta_description'] = $meta_description . '...';
  
        // Options
        if ( class_exists( 'ACF' ) ) {

            $option_fields = get_fields('options');

            if ( $option_fields != null ) {
                
                $context['header'] = $option_fields['header'];
                $context['footer'] = $option_fields['footer'];
                $context['contact_form'] = $option_fields['contact_form'];
                $context['script_code'] = $option_fields['script_code'];
                $context['work_archive'] = $option_fields['work_archive'];

            }
        
        }

        return $context;

    }

    function theme_supports() {

        require_once get_template_directory() . '/includes/register-post-types.php';
        require_once get_template_directory() . '/includes/register-blocks.php';

        add_theme_support( 'title-tag' );   
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'menus' );
        add_theme_support( 'html5', ['comment-form', 'comment-list', 'gallery',	'caption'] );
        add_theme_support( 'post-formats', ['aside','image','video','quote','link',	'gallery','audio'] );
        add_theme_support( 'editor-styles' );
        add_theme_support( 'wp-block-styles' );

        if ( class_exists('Woocommerce') ) {
        
             add_theme_support( 'woocommerce' );
             add_theme_support( 'woocommerce-blocks-patterns' );
        }

        if ( function_exists('acf_add_options_page') ) {

            acf_add_options_page([
                'page_title'    => 'Theme Settings',
                'menu_title'    => 'GenLite',
                'menu_slug'     => 'genlite-theme-settings',
                'capability'    => 'edit_posts',
                'redirect'      => false
            ]);
        }

    }

    function get_password_protected_template( $template ) {

        global $post;

        if ( !empty( $post ) && post_password_required( $post->ID ) ) {

            $template = locate_template([
                'password-protected.php',
                "password-protected-{$post->post_type}.php",
            ]) ?: $template;
        }

        return $template;
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

    function mail_sender_name( $original_email_from ) {

        return strtoupper( get_bloginfo() );

    }

    function setup_robots_follow( $robots ) {

        if ( get_option('blog_public') == true ) {
        
            $robots['nofollow'] = false;
            $robots['noindex'] = false;
            $robots['index'] = true;
            $robots['follow'] = true;

        } else {

            $robots['nofollow'] = true;
            $robots['noindex'] = true;
            $robots['index'] = false;
            $robots['follow'] = false;

        }

        return $robots;

    }

    function website_disable_feed() {

        echo('No feed available');
        exit;
       
    }


    function add_svg_to_media_library( $file_types ) {
        
        $new_filetypes = [];
        $new_filetypes['svg'] = 'image/svg+xml';
        $file_types = array_merge($file_types, $new_filetypes);

        return $file_types;

    }

    function rest_only_for_authorized_users( $wp_rest_server ) {

        if ( !is_user_logged_in() ) {

            wp_die('Sorry you are not allowed to access this data', 'Forbidden', 403 );

        }

    } 

    function genlite_add_custom_login_logo() { 

        $context['custom_login_logo'] = get_template_directory_uri() . '/dist/images/hs-logo.webp';
        Timber::render('admin/admin-logo.twig', $context );

    }

         
}

new GenLiteSite();
