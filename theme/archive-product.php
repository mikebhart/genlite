<?php
    
$context = Timber::context();

$posts = Timber::get_posts();
$context['products'] = $posts;

Timber::render( 'woo/archive-product.twig', $context );
