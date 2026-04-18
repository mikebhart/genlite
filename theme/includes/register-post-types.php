<?php 


class RegisterPostTypes {

	public function __construct() {

       add_action( 'init', [ $this, 'wesbsite_register_work' ] );
       add_action( 'init', [ $this, 'wesbsite_register_work_category' ] );

    }

    function wesbsite_register_work() {

        $labels = [
            'name'                  => 'Projects',
            'singular_name'         => 'Project',
            'menu_name'             => 'Projects',
            'name_admin_bar'        => 'Project',
            'add_new'               => 'Add New',
            'add_new_item'          => 'Add New Project',
            'new_item'              => 'New Project',
            'edit_item'             => 'Edit Project',
            'view_item'             => 'View Project',
            'all_items'             => 'All Projects',
            'search_items'          => 'Search Projects',
            'parent_item_colon'     => 'Parent Projects:',
            'not_found'             => 'No Projects found.',
            'not_found_in_trash'    => 'No Projects found in Trash.',
            'featured_image'        => 'Project Cover Image'
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
            'name'                  => 'Work Categories',
            'singular_name'         => 'Work Category',
            'menu_name'             => 'Work Categories',
            'name_admin_bar'        => 'Work Category',
            'add_new'               => 'Add New',
            'add_new_item'          => 'Add New Work Category',
            'new_item'              => 'New Work Category',
            'edit_item'             => 'Edit Work Category',
            'view_item'             => 'View Work Category',
            'all_items'             => 'All Work Categories',
            'search_items'          => 'Search Project Work Categories',
            'parent_item_colon'     => 'Parent Work Categories:',
            'not_found'             => 'No Work Categories found.', 
            'not_found_in_trash'    => 'No Work Categories found in Trash.',
            'featured_image'        => 'Work Category Cover Image'
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
