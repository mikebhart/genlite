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

if ( !class_exists( 'Timber' ) ) {

	echo 'Cannot find Timber in Vendor folder.';
    return;
	
}

// Sets the directories (inside your theme) to find .twig files.
Timber::$dirname = [ 'templates' ];

use Timber\Site;

class GenLiteSite extends Site {

    function __construct() {

        require_once get_template_directory() . '/includes/theme-setup.php';
        require_once get_template_directory() . '/includes/context-store.php';
        require_once get_template_directory() . '/includes/load-resources.php';
        require_once get_template_directory() . '/includes/common-functions.php';

        parent::__construct();

    }
        
}

new GenLiteSite();
