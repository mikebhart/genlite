<?php
/**
 * Template part for displaying Audio posts
 *
 */
?>
<span class="list-group-item">
	<div class = "row justify-content-center">
		<div class = "col-lg-12">
			<a class = "text-center" href="<?php the_permalink(); ?>">
				<h2><?php the_title(); ?></h2>
			</a>	
		</div>
		<div class = "col-lg-4 col-md-offset-4">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<p>
					<?php
						
						$content = apply_filters( 'the_content', get_the_content() );
			    		$audio = false;

						// if audio wordpress embed -Only get audio from the content if a playlist isn't present.
						if ( false === strpos( $content, 'wp-playlist-script' ) ) {
							$audio = get_media_embedded_in_content( $content, array( 'audio' ) );
						}

						if ( ! empty( $audio ) ) {

							foreach ( $audio as $audio_html ) {
								echo '<object><div class="entry-audio">';
								echo $audio_html;
								echo '</div></object>';
							}

						} else {

							// Soundcloud embed

							$embeds = get_media_embedded_in_content($content, array('object', 'embed', 'iframe'));
			    			
			    			if (!empty($embeds)) {

						        $soundCloudEmbed = str_replace('?visual=true','?visual=false', $embeds[0]);

						        echo str_replace('height="300"','height="166"',  $soundCloudEmbed);    				
						    }

						}	?>
				</p>	

					<div class = "text-center">
					<?php get_template_part( '/template-parts/posts-list-info', get_post_format()); ?>
				</div>

			</article>
		</div>
	</div>
</span>