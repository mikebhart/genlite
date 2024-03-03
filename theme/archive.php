<?php

$context = Timber::context();
$context['post'] = Timber::get_posts();

Timber::render( [ 'archive.twig' ], $context, 600, Timber\Loader::CACHE_OBJECT );
