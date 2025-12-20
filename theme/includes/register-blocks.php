<?php 

/*
* Add custom ACF Pro Gutenberg blocks
*/

class ThemeRegisterBlocks {

	public function __construct() {

		add_action( 'acf/init', [ $this, 'theme_acf_init' ]);
		add_filter( 'block_categories_all', [ $this, 'theme_blocks_category' ], 10, 2 );
	
	}

	public function theme_acf_init() {
	
		function register_block( $name ) {
	
			acf_register_block( array(
				'name'            => str_replace('-', ' ', $name),
				'title'           => __( str_replace('-', ' ', ucwords( $name, '-' )), 'theme' ),
				'description'     => __( str_replace('-', ' ', ucwords( $name, '-' )) . ' block.', 'theme' ),
				'render_callback' => function( $block, $content = '', $is_preview = false ) {

					$context = Timber::context();
					$context['block'] = $block;
					$context['fields'] = get_fields();
					$context['is_preview'] = $is_preview;

					Timber::render( 'templates/blocks/' . str_replace(' ', '-', strtolower( $block['title'] )) . '.twig', $context );
				},
				'category'        => 'theme-blocks',
				'icon'            => '',
				'keywords'        => [ $name ],
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

		register_block('test');


	}

	public function theme_blocks_category( $categories, $post ) {

		return array_merge( $categories, [ [ 'slug' => 'theme-blocks', 'title' => 'GenLite' ] ] );
		
	}

	
}

new ThemeRegisterBlocks();
