<?php

$plugins = [
			'timber-library/timber.php',
			// 'duplicate-post/duplicate-post.php', 
			 'woocommerce/woocommerce.php',
			 'advanced-custom-fields-pro/acf.php',
			// 'ldap-login/LDAP-Login.php',
//			'wordfence/wordfence.php',
		//	 'wordpress-seo/wp-seo.php'
		];

foreach ( $plugins as $plugin ) {

    $path = dirname( __FILE__ ) . '/' . $plugin;

	wp_register_plugin_realpath( $path );
    include $path;

}
