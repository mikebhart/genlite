<?php

$plugins = [
			'user-role-editor/user-role-editor.php',
			'timber-library/timber.php', 
			'duplicate-post/duplicate-post.php', 
			'woocommerce/woocommerce.php',
			'advanced-custom-fields-pro/acf.php'
		];

foreach ( $plugins as $plugin ) {

    $path = dirname( __FILE__ ) . '/' . $plugin;

	wp_register_plugin_realpath( $path );
    include $path;

}
