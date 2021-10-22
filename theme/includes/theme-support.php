<?php


function genlite_add_theme_support() {

	// Add Theme Support 
	add_theme_support( 'title-tag' );   
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-thumbnails' );

    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 200,
        'flex-height' => false,
        'flex-width'  => false
    ));

    add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	));

	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	));

	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 650,
		'single_image_width'    => 1920,
        'product_grid'          => array(
        'default_rows'    		=> 2,
        'min_rows'        		=> 1,
        'max_rows'        		=> 10,
        'default_columns' 		=> 5,
        'min_columns'     		=> 1,
        'max_columns'     		=> 5),
	));

	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'wp-block-styles');
	add_theme_support( 'editor-styles');
	add_theme_support( 'align-wide');

	add_theme_support( 'editor-color-palette', array(
		array(
			'name' => __('Primary','genlite'),
			'slug' => 'genlite-theme-primary',
			'color'=> '#ff4d01',
		),
		array(
			'name' => __('Secondary','genlite'),
			'slug' => 'genlite-theme-secondary',
			'color'=> '#041048',
		),
		array(
			'name' => __('Black','genlite'),
			'slug' => 'genlite-theme-black',
			'color'=> '#000000',
		),
		array(
			'name' => __('White','genlite'),
			'slug' => 'genlite-theme-white',
			'color'=> '#FFFFFF',
		),
		array(
			'name' => __('Red','genlite'),
			'slug' => 'genlite-theme-red',
			'color'=> '#CC0000',
		),
	));

	add_theme_support( 'disable-custom-font-sizes');
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name' => __('Small','genlite'),
			'shortName' => __('S','genlite'),
			'size' => 14,
			'slug' => 'small',
		),
		array(
			'name' => __('Normal','genlite'),
			'shortName' => __('M','genlite'),
			'size' => 20,
			'slug' => 'normal',
		),
		array(
			'name' => __('Large','genlite'),
			'shortName' => __('L','genlite'),
			'size' => 36,
			'slug' => 'large',
		),
		array(
			'name' => __('Extra Large','genlite'),
			'shortName' => __('XL','genlite'),
			'size' => 50,
			'slug' => 'larger',
		)
	));

	add_theme_support('responsive-embeds');

}
genlite_add_theme_support();

// Create Widgets area - 1 sidebar widget for left and right side bar pages.  4 widgets for Footer columns.
function genlite_widgets_init() {

	register_sidebar( array(
		'name'          => 'Footer 1',
		'id'            => 'genlite_footer_1',
		'description'   => __('Add widgets here to appear in your footer.','genlite'),
		'before_widget' => '<section id="%1$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6><u>',
		'after_title'   => '</u></h6>',
	) );

	register_sidebar( array(
		'name'          => 'Footer 2',
		'id'            => 'genlite_footer_2',
		'description'   => __('Add widgets here to appear in your footer.','genlite'),
		'before_widget' => '<section id="%1$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6><u>',
		'after_title'   => '</u></h6>',
	) );

	register_sidebar( array(
		'name'          => 'Footer 3',
		'id'            => 'genlite_footer_3',
		'description'   => __('Add widgets here to appear in your footer.','genlite'),
		'before_widget' => '<section id="%1$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6><u>',
		'after_title'   => '</u></h6>',
	) );

	register_sidebar( array(
		'name'          => 'Footer 4',
		'id'            => 'genlite_footer_4',
		'description'   => __('Add widgets here to appear in your footer.','genlite'),
		'before_widget' => '<section id="%1$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6><u>',
		'after_title'   => '</u></h6>',
	) );

	register_sidebar( array(
		'name'          => 'Footer Footnote',
		'id'            => 'genlite_footer_footnote',
		'description'   => __('Add widgets here to appear in your footer.','genlite'),
		'before_widget' => '<section id="%1$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6><u>',
		'after_title'   => '</u></h6>',
	) );

	register_sidebar( array(
		'name'          => 'Shop Filters',
		'id'            => 'genlite_shop_filters',
		'description'   => __('Add widgets here to appear in your Woocommerce Shop Filter.','genlite'),
		'before_widget' => '<section id="%1$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6><u>',
		'after_title'   => '</u></h6>',
	) );

 
}
add_action( 'widgets_init', 'genlite_widgets_init' );

