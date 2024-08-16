<?php 

/*
* Add custom ACF Pro Gutenberg blocks
*/

class RegisterBlocks {

	public function __construct() {

		add_action( 'acf/init', [ $this, 'genlite_acf_init' ]);
		add_filter( 'block_categories_all', [ $this, 'genlite_blocks_category' ], 10, 2 );
	
	}

	public function genlite_acf_init() {

                if ( ! function_exists( 'acf_register_block' ) ) {
			return;
		}
	
		// register gutenberg block with ACF
		function register_block( $name ) {
	
			acf_register_block( array(
				'name'            => str_replace('-', ' ', $name),
				'title'           => __( str_replace('-', ' ', ucwords( $name, '-' )), 'genlite' ),
				'description'     => __( str_replace('-', ' ', ucwords( $name, '-' )) . ' block.', 'genlite' ),
				'render_callback' => function( $block, $content = '', $is_preview = false ) {
					$context = Timber::context();
				
					// Store block values.
					$context['block'] = $block;
				
					// Store field values.
					$context['fields'] = get_fields();
				
					// Store $is_preview value.
					$context['is_preview'] = $is_preview;

					// Render the block.
					Timber::render( 'templates/blocks/' . str_replace(' ', '-', strtolower( $block['title'] )) . '.twig', $context );
				},
				'category'        => 'genlite-blocks',
				'icon'            => '',
				'keywords'        => array( $name ),
				'mode' 			  => 'edit'
			) );	
		}

                register_block('banner');
                register_block('contact-us');
                register_block('hero-image');
                register_block('five-column-table');        
                register_block('four-icon-boxes');
                register_block('four-image');
                register_block('gallery');
                register_block('icons-left-image-right');
                register_block('image-text');
                register_block('nav-sections');
                register_block('text-left-image-right');
                register_block('text-left-background-image');
                register_block('three-icon-boxes');
                register_block('three-image-boxes');
                register_block('wide-image');
                register_block('what-you-see');

	}

	public function genlite_blocks_category( $categories, $post ) {

		return array_merge( $categories, [ [ 'slug' => 'genlite-blocks', 'title' => 'Theme' ] ] );
		
	}

	
}

new RegisterBlocks();
