<?php

$context = Timber::context();
$context['post'] = Timber::get_posts();


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

Timber::render( [ 'archive.twig' ], $context );
