<?php 

get_header();

?>

	<div class="container">
	
		<div class="row">		
			<div class = "col-md-12 text-center">
				<h1><?php the_archive_title(); ?></h1>
			</div>		
		</div>
			
		
		<div class="row">
			<div class = "col-md-12">
				<?php echo category_description(); ?>
			</div>
		</div>	
		
		<div class="row">		
			<div class = "col-md-12">
				<div class ="list-group">

					<?php while(have_posts()) : the_post(); ?>

						<a href="<?php the_permalink(); ?>" class="list-group-item">


							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

								<h2><?php the_title(); ?></h2>
								<?php the_excerpt(); ?>

							</article>

						</a>	

					<?php endwhile; wp_reset_query(); ?>

				</div>

			</div>
		</div>	

	</div>		

<?php get_footer(); ?>
