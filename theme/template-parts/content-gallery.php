<?php
/**
 * Template part for displaying Gallery posts
 *
 */

	global $post;

 	// Only do this on singular items
 	$image_list = array();

 	// Make sure the post has a gallery in it
 		 	// Retrieve the first gallery in the post
 		$gallery = get_post_gallery_images();

 	//	var_dump($gallery);

		// Loop through each image in each gallery
		foreach( $gallery as $image_url ) {
			array_push($image_list, $image_url);		
		}

	$rowCount =1;
	$divClassString = '';


?>

<span class="list-group-item">

	<div class = "row">

		<div class = "col-lg-12">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<a class = "text-center" href="<?php esc_url(the_permalink()); ?>">
					<h2><?php the_title(); ?></h2>
				</a>	

				<div id="genliteGalleryCarousel" class="carousel slide carousel-fade" data-ride="carousel">
			  	
					<ol class="carousel-indicators genlite-gallery-carousel-indicators">

						<?php 
				
								$x = 1;

								foreach( $image_list as $image_url ) {

									$divClassString = ''; 

									if ($x==1) {
										$divClassString = ' active'; 
									}

									?>
			
									 <li data-target="#genliteCarouselIndicators" data-slide-to="<?php echo $x; ?>" class="<?php echo $divClassString; ?>"></li>
					
								<?php

									$x++;

								}	
	

				  		?>	

	  				</ol>	


		  		    <!-- Slides stuff goes here --> 		    
					<div class="carousel-inner text-center" role="listbox">

					<?php 
		
						$x = 1;
		
						foreach( $image_list as $image_url ) {
								
							$divClassString = ''; 

							if ($x==1) {
								$divClassString = ' active'; 
							}
						
							?>

	     					<div class="carousel-item<?php echo $divClassString; ?> align-items-center flex-column">
							  
		      					<img class="d-block w-100" src="<?php echo esc_url($image_url) . '?auto=yes'; ?>">
		      													
							</div>	 
									 
				<?php	    $x++;
		
						}	

				  	?>	
			
				</div>

  			  	<a class="carousel-control-prev" href="#genliteGalleryCarousel" role="button" data-slide="prev">
			    	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    	<span class="sr-only">Previous</span>
			  	</a>

			 	<a class="carousel-control-next" href="#genliteGalleryCarousel" role="button" data-slide="next">
			    	<span class="carousel-control-next-icon" aria-hidden="true"></span>
			    	<span class="sr-only">Next</span>
			  	</a>
	

				<div class="text-center">
					<?php get_template_part( '/template-parts/posts-list-info', get_post_format()); ?>
				</div>	
	
			</article>

		</div>

	</div>

</span>