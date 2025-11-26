<?php

if ( post_password_required( $post->ID ) ) {

    $context = Timber::context([
        'post' => Timber::get_post(),
        'password_form' => get_the_password_form(),
    ]);

    Timber::render('base/single-password.twig', $context);

} 
