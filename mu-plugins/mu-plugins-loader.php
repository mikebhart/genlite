<?php


$plugins = [
			//'timber-library/timber.php',
            'advanced-custom-fields-pro/acf.php'
		];

foreach ( $plugins as $plugin ) {

    $path = dirname( __FILE__ ) . '/' . $plugin;

	wp_register_plugin_realpath( $path );
    include $path;

}

