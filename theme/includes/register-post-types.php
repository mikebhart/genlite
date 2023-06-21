<?php 


class RegisterPostTypes {

	public function __construct() {

       add_action( 'init', [ $this, 'cptui_register_my_cpts' ] );
       add_action( 'init', [ $this, 'cptui_register_my_cpts_work' ] );
       add_action( 'init', [ $this, 'cptui_register_my_taxes' ] );
       add_action( 'init', [ $this, 'cptui_register_my_taxes_work_type' ] );
        
	
	}

    function cptui_register_my_cpts() {

        /**
         * Post Type: Projects.
         */
    
        $labels = [
            "name" => esc_html__( "Projects", "genlite" ),
            "singular_name" => esc_html__( "Project", "genlite" ),
        ];
    
        $args = [
            "label" => esc_html__( "Projects", "genlite" ),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => true,
            "rest_base" => "",
            "rest_controller_class" => "WP_REST_Posts_Controller",
            "rest_namespace" => "wp/v2",
            "has_archive" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "delete_with_user" => false,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "can_export" => false,
            "rewrite" => [ "slug" => "work", "with_front" => true ],
            "query_var" => true,
            "supports" => [ "title", "editor", "thumbnail" ],
            "show_in_graphql" => false,
        ];
    
        register_post_type( "work", $args );
    }
    
   // add_action( 'init', 'cptui_register_my_cpts' );

   function cptui_register_my_cpts_work() {

	/**
	 * Post Type: Projects.
	 */

	$labels = [
		"name" => esc_html__( "Projects", "genlite" ),
		"singular_name" => esc_html__( "Project", "genlite" ),
	];

	$args = [
		"label" => esc_html__( "Projects", "genlite" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "work", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "work", $args );
}


function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Work Categories.
	 */

	$labels = [
		"name" => esc_html__( "Work Categories", "genlite" ),
		"singular_name" => esc_html__( "Work Category", "genlite" ),
	];

	
	$args = [
		"label" => esc_html__( "Work Categories", "genlite" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'work-type', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "work-type",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "work-type", [ "work" ], $args );
}

function cptui_register_my_taxes_work_type() {

	/**
	 * Taxonomy: Work Categories.
	 */

	$labels = [
		"name" => esc_html__( "Work Categories", "genlite" ),
		"singular_name" => esc_html__( "Work Category", "genlite" ),
	];

	
	$args = [
		"label" => esc_html__( "Work Categories", "genlite" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'work-type', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "work-type",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "work-type", [ "work" ], $args );
}




    


    // Work Post Type


}

new RegisterPostTypes();



