<?php

class MainContext {
	

	public function __construct() {
		
		add_filter( 'timber/context', [ $this, 'add_to_context' ] );

	}

    function add_to_context( $context ) {

        $post_id = get_the_ID();
        $post_content = get_post_field( 'post_content', $post_id );
        $blocks = parse_blocks( $post_content );

        $context['home_url']  = home_url();
        $context['body_class'] = implode(' ', get_body_class() );
        $context['header_menu'] = Timber::get_menu( 'header menu' );

        $excerpt = wp_strip_all_tags( get_the_excerpt() );
        $excerpt = substr( $excerpt, 0, 140 );
        $meta_description = substr( $excerpt, 0, strrpos( $excerpt, ' ') );
        $context['auto_meta_description'] = $meta_description . '...';

        if ( class_exists( 'ACF' ) ) {

            $option_fields = get_fields('options');

            if ( $option_fields != null ) {
                
                $context['header'] = $option_fields['header'];
                $context['footer'] = $option_fields['footer'];
                $context['contact_form'] = $option_fields['contact_form'];
                $context['script_code'] = $option_fields['script_code'];
                $context['work_archive'] = $option_fields['work_archive'];

            }
        
        }

        return $context;

    
    }

}

new MainContext();
