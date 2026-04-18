<?php 


class RegisterPostTypes {

	public function __construct() {

       add_action( 'init', [ $this, 'wesbsite_register_work' ] );
       add_action( 'init', [ $this, 'wesbsite_register_work_category' ] );

    }

    function wesbsite_register_work() {

        $labels = [
            'name'                  => __( 'Projects', 'genlite' ),
            'singular_name'         => __( 'Project', 'genlite' ),
            'menu_name'             => __( 'Projects','genlite' ),
            'name_admin_bar'        => __( 'Project', 'genlite' ),
            'add_new'               => __( 'Add New', 'genlite' ),
            'add_new_item'          => __( 'Add New Project', 'genlite' ),
            'new_item'              => __( 'New Project', 'genlite' ),
            'edit_item'             => __( 'Edit Project', 'genlite' ),
            'view_item'             => __( 'View Project', 'genlite' ),
            'all_items'             => __( 'All Projects', 'genlite' ),
            'search_items'          => __( 'Search Projects', 'genlite' ),
            'parent_item_colon'     => __( 'Parent Projects:', 'genlite' ),
            'not_found'             => __( 'No Projects found.', 'genlite' ),
            'not_found_in_trash'    => __( 'No Projects found in Trash.', 'genlite' ),
            'featured_image'        => __( 'Project Cover Image', 'genlite' )
        ];


        $args = [
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_rest' => true,
            'rest_base' => '',
            'has_archive' => true,
            'show_in_menu' => true,
            'exclude_from_search' => false,
            'capability_type' => 'post',
            'map_meta_cap' => true,
            'hierarchical' => false,
            'rewrite' => [ 'slug' => 'work', 'with_front' => true ],
            'query_var' => true,
            'supports' => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
            'taxonomies' => [ 'work_category' ]
        ];

        register_post_type( 'work', $args );
    }


    function wesbsite_register_work_category() {

        $labels = [
            'name'                  => __( 'Work Categories', 'genlite' ),
            'singular_name'         => __( 'Work Category', 'genlite' ),
            'menu_name'             => __( 'Work Categories','genlite' ),
            'name_admin_bar'        => __( 'Work Category', 'genlite' ),
            'add_new'               => __( 'Add New', 'genlite' ),
            'add_new_item'          => __( 'Add New Work Category', 'genlite' ),
            'new_item'              => __( 'New Work Category', 'genlite' ),
            'edit_item'             => __( 'Edit Work Category', 'genlite' ),
            'view_item'             => __( 'View Work Category', 'genlite' ),
            'all_items'             => __( 'All Work Categories', 'genlite' ),
            'search_items'          => __( 'Search Project Work Categories', 'genlite' ),
            'parent_item_colon'     => __( 'Parent Work Categories:', 'genlite' ),
            'not_found'             => __( 'No Work Categories found.', 'genlite' ),
            'not_found_in_trash'    => __( 'No Work Categories found in Trash.', 'genlite' ),
            'featured_image'        => __( 'Work Category Cover Image', 'genlite' )
        ];


        $args = [
            'labels' => $labels,
            'public' => true,
            'hierarchical' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'query_var' => true,
            'rewrite' => [ 'slug' => 'work-type', 'with_front' => true ],
            'show_admin_column' => false,
            'show_in_rest' => true,
            'rest_base' => '',
            'show_in_quick_edit' => false
        ];
        register_taxonomy( 'work_category', ['work'], $args );
    }

   
}

new RegisterPostTypes();
