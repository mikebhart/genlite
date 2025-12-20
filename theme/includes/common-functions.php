<?php 


class CommonFunctions {

	public function __construct() {

        add_action( 'enqueue_block_editor_assets', [ $this, 'setup_block_editor_assets' ] );
        add_action( 'upload_mimes', [ $this, 'add_svg_to_media_library' ] );
      	add_action( 'login_enqueue_scripts', [ $this, 'add_custom_login_logo' ], 101 );
        add_action( 'do_feed', [ $this, 'website_disable_feed' ], 1);
        add_action( 'do_feed_rdf', [ $this, 'website_disable_feed' ], 1);
        add_action( 'do_feed_rss', [ $this, 'website_disable_feed' ], 1);
        add_action( 'do_feed_rss2', [ $this, 'website_disable_feed' ], 1);
        add_action( 'do_feed_atom', [ $this, 'website_disable_feed' ], 1);
        add_action( 'do_feed_rss2_comments', [ $this, 'website_disable_feed' ], 1);
        add_action( 'do_feed_atom_comments', [ $this, 'website_disable_feed'], 1);

        remove_action( 'wp_head', 'feed_links_extra', 3 );
        remove_action( 'wp_head', 'feed_links', 2 );
        remove_action( 'wp_head', 'print_emoji_detection_script', 7);
        remove_action( 'wp_print_styles', 'print_emoji_styles');
        remove_action( 'wp_head', 'rel_canonical');

        add_filter( 'wp_sitemaps_add_provider', [ $this, 'remove_users_from_sitemap' ], 10, 2 );
        add_filter( 'template_include', [ $this, 'get_password_protected_template' ] );
        add_filter( 'document_title_parts', [ $this, 'modify_title_format'] );
        add_filter( 'document_title_separator', [ $this, 'setup_document_title_separator' ] );
        add_filter( 'wp_robots', [ $this, 'setup_robots_follow'] );
        add_filter( 'xmlrpc_enabled', '__return_false' );

    }

    function add_custom_login_logo() { 

        $context['custom_login_logo'] = get_template_directory_uri() . '/dist/images/hs-logo.webp';
        Timber::render('admin/admin-logo.twig', $context );

    }

    function remove_users_from_sitemap( $provider, $name ) {
		
        if ( 'users' === $name ) {

            return false;
        }
        
        return $provider;
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

        $title_override = get_field('theme_title_override');

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

        wp_enqueue_style( 'theme_editor_style', get_template_directory_uri() . '/editor-styles.css' );

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






}

new CommonFunctions();

