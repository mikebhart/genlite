<?php

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;


Timber::render( [ 'single-work.twig' ], $context );