<?php

if ( !class_exists('Timber') ) {

    echo 'Timber not activated.';

    return;
}

$context = Timber::context();

if ( is_singular('product') ) {

    $post = Timber::get_post();

    $post_id = $post->ID;
    $product = wc_get_product( $post_id );
    $related_limit = wc_get_loop_prop('columns');
    $related_ids = wc_get_related_products( $post_id, $related_limit );

    $context[ 'post' ] = $post;  
    $context[ 'product' ] = $product;
    $context[ 'breadcrumb' ] = new Timber\FunctionWrapper('woocommerce_breadcrumb');
    $context[ 'related_products' ] = Timber::get_posts( $related_ids );

    wp_reset_postdata();

    Timber::render( [ 'woo/single-product.twig' ], $context );

} else {

    $posts = Timber::get_posts();

    $context[ 'products' ] = $posts;
    $context[ 'breadcrumb' ] = new Timber\FunctionWrapper('woocommerce_breadcrumb');
    $context[ 'result_count' ] = new Timber\FunctionWrapper('woocommerce_result_count');
    $context[ 'post_type' ] = new Timber\FunctionWrapper('get_post_type');
    $context[ 'woo_currency' ] = get_woocommerce_currency_symbol();

    $context[ 'categories' ] = wp_list_categories( [
        'taxonomy' => 'product_cat',
        'echo' => false,
        'show_count' => true,
        'title_li' => '<h2>Categories</h2>'
    ] );

    if ( is_product_category() ) {

        $queried_object = get_queried_object();
        $term_id = $queried_object->term_id;
        $context[ 'category' ] = get_term( $term_id, 'product_cat' );
        $context[ 'title' ] = single_term_title( '', false );

    }

    Timber::render( [ 'woo/archive-product.twig' ], $context );
}
