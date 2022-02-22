<?php

$plugins = [
			'timber-library/timber.php',
			 'duplicate-post/duplicate-post.php', 
		//	 'woocommerce/woocommerce.php',
             'svg-support/svg-support.php',
             'advanced-cron-manager/advanced-cron-manager.php'
		];

foreach ( $plugins as $plugin ) {

    $path = dirname( __FILE__ ) . '/' . $plugin;

	wp_register_plugin_realpath( $path );
    include $path;

}
