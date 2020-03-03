<?php 

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Hartsoft
 * @subpackage GenLite
 * @since 1.4.2
 * @version 1.4.2
 */


get_header(); ?>

<div class="container">

	<div class="row">

		<div class = "col-md-12">

				<h1 class="text-center"><u><?php esc_attr_e('404 Error','genlite'); ?></u></h1>
				<p class="text-center"><?php esc_attr_e('Web Page Cannot be found!','genlite'); ?></p>
				<br>
				<p class="text-center"><a href ="<?php echo esc_url(get_home_url()); ?>"><?php esc_attr_e('Click here to return home','genlite'); ?></a></p>
				<br>
				<br>
		</div> 

	</div><!-- /row -->
	
</div><!-- /container -->

<?php get_footer(); ?>