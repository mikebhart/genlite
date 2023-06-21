<?php

class AdminCleanupSetup {
	/**
	 * Init hooks.
	 */
	public function __construct() {
		
		add_action( 'init', [ $this, 'kkr_unregister_tags' ] );
		add_action( 'init', [ $this, 'kkr_unregister_categories' ] );
		add_action( 'admin_menu', [ $this, 'kkr_remove_admin_posts_menu' ] );
		add_action( 'admin_bar_menu', [ $this, 'kkr_remove_default_post_type_menu_bar' ], 999 );
		add_action( 'wp_dashboard_setup', [ $this, 'kkr_remove_draft_widget' ], 999 );
		add_action( 'admin_init', [ $this, 'kkr_remove_page_admin_items' ] );
		add_action( 'admin_init', [ $this, 'kkr_remove_comment_menu' ]);
		add_action( 'wp_before_admin_bar_render', [ $this, 'kkr_remove_comments_bar' ] );
		add_action( 'wp_before_admin_bar_render', [ $this, 'kkr_remove_customize_bar' ] ); 

        if ( !current_user_can('administrator') ) { 
			add_action( 'admin_menu', [ $this, 'kkr_remove_tools' ], 99 );
		}


	}
	
	/**
	 * Remove tags from blog posts.
	 */
	public function kkr_unregister_tags() {
		unregister_taxonomy_for_object_type( 'post_tag', 'post' );
	}
	

	/**
	 * Remove categories from blog posts.
	 */
	public function kkr_unregister_categories() {
		unregister_taxonomy_for_object_type( 'category', 'post' );
	}
	
	/**
	 * Remove posts left sidebar menu from showing.
	 */
	public function kkr_remove_admin_posts_menu() {
		remove_menu_page( 'edit.php' );
	}

	/**
	 * Remove new post in top Admin Menu Bar.
	 */
	public function kkr_remove_default_post_type_menu_bar() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_node( 'new-post' );
	}

	/**
	 * Remove quick post draft dashboard widget.
	 */
	public function kkr_remove_draft_widget() {
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	}

	/**
	 * Remove featured image and comments from pages.
	 */
	public function kkr_remove_page_admin_items() {
		remove_post_type_support( 'page', 'comments' ); 
	}  

	/**
	 * Remove comments menu.
	 */
	function kkr_remove_comment_menu() {
		remove_menu_page( 'edit-comments.php' );
	}

	/**
	 * Remove comments from menu bar.
	 */
	function kkr_remove_comments_bar() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('comments');
	}

	/**
	 * Remove customize from menu bar.
	 */
	function kkr_remove_customize_bar() {
		global $wp_admin_bar;

		$wp_admin_bar->remove_menu('customize');
	}

	/**
	 * Remove Tools menu for editors.
	 */
	function kkr_remove_tools() {
		remove_menu_page( 'tools.php' );
	}


}

new AdminCleanupSetup();
