<?php

$context = Timber::context();

$timber_post     = Timber::get_post();
$context['post'] = $timber_post;

$title = single_cat_title( '', false );
$cat_description = category_description();

$option_fields = get_fields('options');
$blog_archive = $option_fields['blog_archive'];

if ( empty( $title ) ) {

    $title = $blog_archive['title'];
    $cat_description = $blog_archive['description'];

}

$sidebar = $blog_archive['sidebar'];

$context['title'] = $title;
$context['description'] = $cat_description;
$context['sidebar'] = $sidebar;



$category_data = [];

$workobj = get_queried_object();

$work_cat = $workobj->taxonomy;
$categories = [];

if ( $work_cat == 'work_category' ) {

    $work_cat_args = ['taxonomy' => 'work_category', 'orderby' => 'name', 'order' => 'ASC' ];
    $categories = get_categories( $work_cat_args );
    $context['blog_url'] = get_site_url() . '/work';

} else {

    $context['blog_url'] = get_permalink( get_option( 'page_for_posts' ) );
    $categories = get_categories();

}

foreach ( $categories as $category ) :
    $category_link = get_category_link( $category->term_id );

    $category_item = [];

    $category_item["category"]['name'] = $category->name;
    $category_item["category"]['slug'] = $category->slug;
    $category_item["category"]['count'] = $category->count;
    $category_item["category"]['category_link'] = $category_link;


    $category_data[] = $category_item;

 endforeach;


$context['category_data'] = $category_data;

Timber::render( [ 'archive.twig' ], $context );
