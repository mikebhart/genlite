<?php

class AdminFunctions {
	

	public function __construct() {
		
		add_action( 'admin_bar_menu', [ $this, 'theme_add_menu_bar' ], 100 );
        add_action( 'admin_menu', [ $this, 'theme_add_custom_admin_pages'] );
	  

	}

	function theme_add_menu_bar ( WP_Admin_Bar $admin_bar ) {

        if ( current_user_can('editor') ) {

            $admin_bar->add_menu( array(
                'id'    => 'clear-cache-admin-page',
                'parent' => null,
                'group'  => null,
                'title' => '<span class="ab-icon dashicons dashicons-update"></span>Clear Cache',
                'href'  => admin_url('admin.php?page=custom-admin-page-cache-form'),
                'meta' => [ 'title' => 'Clear the Cache' ]
            ) );

        }
    
    }
	
	function theme_add_custom_admin_pages() {
       
        add_submenu_page(
            ' ',             
            'Custom Admin Page Clear Cache Form',  
            'Custom Admin Page Clear Cache Form',
            'editor',   
            'custom-admin-page-cache-form',   
            [ $this, 'theme_custom_page_clear_cache_form']     
        );

        add_submenu_page(
            ' ',             
            'Custom Admin Page Clear Cache Run',  
            'Custom Admin Page Clear Cache Run',
            'editor',   
            'custom-admin-page-cache-run',   
            [ $this, 'theme_custom_page_clear_cache_run']     
        );


    }

    function theme_custom_page_clear_cache_form() {

        Timber::render('admin/clear-cache-form.twig' );
	    die();

    }

    function theme_custom_page_clear_cache_run() {

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

	



   
   



}

new AdminFunctions();
