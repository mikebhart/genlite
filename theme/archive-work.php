<?php

$context         = Timber::context();
$timber_post     = Timber::get_post();
$context['post'] = $timber_post;

Timber::render( [ 'archive-work.twig' ], $context, 600, Timber\Loader::CACHE_OBJECT );
