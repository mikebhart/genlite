<?php

$context = Timber::context();

$timber_post     = Timber::get_post();
$context['post'] = $timber_post;

$title = single_cat_title( '', false );
$cat_description = category_description();

if ( empty( $title ) ) {

    $option_fields = get_fields('options');
    $blog_archive = $option_fields['blog_archive'];

    $title = $blog_archive['title'];
    $cat_description = $blog_archive['description'];

}

$context['title'] = $title;
$context['description'] = $cat_description;

$category_data = [];

$categories = get_categories();

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
