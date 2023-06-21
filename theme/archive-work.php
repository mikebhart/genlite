<?php
//echo 'in archive work.php';

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;


Timber::render( [ 'archive-work.twig' ], $context );
