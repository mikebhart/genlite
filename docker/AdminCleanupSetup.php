<?php
/**
 * For Cleaning up WP admin area
 * 
 * 1. Remove default Posts from showing since no blog
 * 2. Remove featured image and comments from pages
 *
 * @package RPS\PJ\Plugins
 */

declare( strict_types=1 );

namespace RPS\PJ\Mu\Plugins\AdminCleanup;

/**
 * Class AdminCleanupSetup
 *
 * @package RPS\PJ\Mu\Plugins\AdminCleanup
 */
class AdminCleanupSetup {
	/**
	 * Init hooks.
	 */
	public function init(): void {
		
		add_action( 'init', [ $this, 'pj_unregister_tags' ] );
		add_action( 'init', [ $this, 'pj_unregister_categories' ] );
		add_action( 'admin_menu', [ $this, 'pj_remove_admin_posts_menu' ] );
		add_action( 'admin_bar_menu', [ $this, 'pj_remove_default_post_type_menu_bar' ], 999 );
		add_action( 'wp_dashboard_setup', [ $this, 'pj_remove_draft_widget' ], 999 );
		add_action( 'admin_init', [ $this, 'pj_remove_page_admin_items' ] );
	}
	
	/**
	 * Remove tags from blog posts.
	 */
	public function pj_unregister_tags() {
		unregister_taxonomy_for_object_type( 'post_tag', 'post' );
	}
	

	/**
	 * Remove categories from blog posts.
	 */
	public function pj_unregister_categories() {
		unregister_taxonomy_for_object_type( 'category', 'post' );
	}
	
	/**
	 * Remove posts left sidebar menu from showing.
	 */
	public function pj_remove_admin_posts_menu() {
		remove_menu_page( 'edit.php' );
	}

	/**
	 * Remove new post in top Admin Menu Bar.
	 */
	public function pj_remove_default_post_type_menu_bar() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_node( 'new-post' );
	}

	/**
	 * Remove quick post draft dashboard widget.
	 */
	public function pj_remove_draft_widget() {
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	}

	/**
	 * Remove featured image and comments from pages.
	 */
	public function pj_remove_page_admin_items() {
		remove_post_type_support( 'page', 'thumbnail' );
		remove_post_type_support( 'page', 'comments' ); 
	}  
}
