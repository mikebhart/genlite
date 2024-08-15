<?php

if ( !class_exists('Timber') ) {

    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';

    return;
}

$context = Timber::context();

$context['woo_currency'] = get_woocommerce_currency_symbol();

if ( is_singular('product') ) {


    $context[ 'post' ] = Timber::get_post();
    $product = wc_get_product( $context[ 'post' ]->ID );
    $context[ 'product' ] = $product;
    $context[ 'breadcrumb' ] = new Timber\FunctionWrapper('woocommerce_breadcrumb');

    $related_limit = wc_get_loop_prop('columns');
    $related_ids = wc_get_related_products( $context[ 'post' ]->id, $related_limit );
    $context[ 'related_products' ] = Timber::get_posts( $related_ids );

    wp_reset_postdata();

    Timber::render( [ 'woo/single-product.twig' ], $context );

} else {

    $posts = Timber::get_posts();
    $context['products'] = $posts;
    $context[ 'breadcrumb' ] = new Timber\FunctionWrapper('woocommerce_breadcrumb');
    $context[ 'result_count' ] = new Timber\FunctionWrapper('woocommerce_result_count');
    $context[ 'categories' ] = Timber::get_terms([ 'taxonomy' => 'product_cat' ]);

    if ( is_product_category() ) {

        $queried_object = get_queried_object();
        $term_id = $queried_object->term_id;
        $context[ 'category' ] = get_term( $term_id, 'product_cat' );
        $context[ 'title' ] = single_term_title( '', false );

    }

    Timber::render( [ 'woo/archive-product.twig' ], $context );
}
