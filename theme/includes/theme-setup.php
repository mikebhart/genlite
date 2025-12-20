<?php

class ThemeSetup {
	

	public function __construct() {
		
        add_action( 'after_setup_theme', [ $this, 'theme_supports' ] );

	}

     function theme_supports() {
        
        if ( is_user_logged_in() ) {
            require_once get_template_directory() . '/includes/admin-functions.php';
        }
        
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
   

}

new ThemeSetup();
