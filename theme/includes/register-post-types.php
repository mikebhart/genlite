<?php 


class RegisterPostTypes {

	public function __construct() {

       add_action( 'init', [ $this, 'cptui_register_my_cpts' ] );
       add_action( 'init', [ $this, 'cptui_register_my_cpts_work' ] );
       add_action( 'init', [ $this, 'cptui_register_my_taxes' ] );
       add_action( 'init', [ $this, 'cptui_register_my_taxes_work_category' ] );

    }

    // Work Post Type
    function cptui_register_my_cpts() {

        
        /**
         * Post Type: Projects.
         */

        $labels = array(
            "name" => __( "Projects", "genlite" ),
            "singular_name" => __( "Project", "genlite" ),
        );

        $args = array(
            "label" => __( "Projects", "genlite" ),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => false,
            "rest_base" => "",
            "has_archive" => true,
            "show_in_menu" => true,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "rewrite" => array( "slug" => "work", "with_front" => true ),
            "query_var" => true,
            "supports" => array( "title", "editor", "thumbnail", "custom-fields" ),
            "taxonomies" => array( "work_category" ),
        );

        register_post_type( "work", $args );
    }

    function cptui_register_my_cpts_work() {

        /**
         * Post Type: Projects.
         */

        $labels = array(
            "name" => __( "Projects", "genlite" ),
            "singular_name" => __( "Project", "genlite" ),
        );

        $args = array(
            "label" => __( "Projects", "genlite" ),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => false,
            "rest_base" => "",
            "has_archive" => true,
            "show_in_menu" => true,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "rewrite" => array( "slug" => "work", "with_front" => true ),
            "query_var" => true,
            "supports" => array( "title", "editor", "thumbnail", "custom-fields" ),
            "taxonomies" => array( "work_category" ),
        );

        register_post_type( "work", $args );
    }

    function cptui_register_my_taxes() {

        /**
         * Taxonomy: Work Categories.
         */

        $labels = array(
            "name" => __( "Work Categories", "genlite" ),
            "singular_name" => __( "Work Category", "genlite" ),
        );

        $args = array(
            "label" => __( "Work Categories", "genlite" ),
            "labels" => $labels,
            "public" => true,
            "hierarchical" => false,
            "label" => "Work Categories",
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => array( 'slug' => 'work-type', 'with_front' => true, ),
            "show_admin_column" => false,
            "show_in_rest" => false,
            "rest_base" => "",
            "show_in_quick_edit" => false,
        );
        register_taxonomy( "work_category", array( "work" ), $args );
    }

    function cptui_register_my_taxes_work_category() {

        /**
         * Taxonomy: Work Categories.
         */

        $labels = array(
            "name" => __( "Work Categories", "genlite" ),
            "singular_name" => __( "Work Category", "genlite" ),
        );

        $args = array(
            "label" => __( "Work Categories", "genlite" ),
            "labels" => $labels,
            "public" => true,
            "hierarchical" => false,
            "label" => "Work Categories",
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => array( 'slug' => 'work-type', 'with_front' => true, ),
            "show_admin_column" => false,
            "show_in_rest" => false,
            "rest_base" => "",
            "show_in_quick_edit" => false,
        );
        register_taxonomy( "work_category", array( "work" ), $args );
    }
   

}

new RegisterPostTypes();
