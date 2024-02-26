<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */


// Load Composer dependencies.
require_once __DIR__ . '/vendor/autoload.php';

Timber\Timber::init();

if ( ! class_exists( 'Timber' ) ) {

	echo 'Timber is not activated.';
	exit;
	
}

if ( !class_exists('ACF')) {
    
    echo 'ACF is not activated.';
	exit;
}


require_once __DIR__ . '/src/GenLiteSite.php';


// Sets the directories (inside your theme) to find .twig files.
Timber::$dirname = [ 'templates' ];

new GenLiteSite();
