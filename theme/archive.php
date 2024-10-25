<?php

$context = Timber::context();
$context['post'] = Timber::get_posts();

$context['title'] = single_cat_title( '', false );
$context['description'] = category_description();

Timber::render( [ 'archive.twig' ], $context );
