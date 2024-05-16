<?php

$context = Timber::context();
$context['post'] = Timber::get_posts();

Timber::render( [ 'archive.twig' ], $context, 3600, Timber\Loader::CACHE_TRANSIENT );
