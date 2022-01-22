<?php 

/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hartsoft
 * @subpackage GenLite
 * @since 1.4.2
 * @version 1.4.2
 */

get_header();

$category_chosen = null;
$search_chosen = null;

$categories = get_terms( array(
  'taxonomy' => 'category',
  'hide_empty' => false,
));

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

?>

<section class="genlite-archive-page">
	<div class="container">

		<div class="row genlite__content justify-content-center">
			<div class="genlite-archive-title">
			  <h1><?php the_archive_title(); ?></h1>
			</div>
		</div>

	</div>

	<div class="container">

		<div class="row mb-3">
			
			<div class="col-12 col-md-3 offset-md-3">
				<div class="form-group">
					<select id="category-select" name="category-select" class="form-control d-inline-block" onchange="genlite_categories_filter()">
						<option value="all-categories">All Categories</option>
						<?php foreach ($categories as $category) : ?>
							<option value="<?php echo $category->slug ?>" ><?php echo $category->name ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			
			<div class="col-12 col-md-3">
				<div><input id="genlite-keyword-input" name="genlite-keyword-input" type="text" class="form-control" placeholder="Keyword Search"></div>
			</div>
			
		</div>

	</div>

	<div class="container-fluid">

		<div class="row">

				<div id="genlite-archive__more-posts-placeholder">

					<?php get_template_part('template-parts/blog-list', get_post_type()); ?>
				</div>
			
		</div>

		<div class="row">

			<div class="genlite-archive__more-posts-button">
				<a id="genlite-archive__more-posts-button" class="btn btn-outline-primary">Show More</a>
			</div>

		</div>
		
	</div>

</section>



<?php get_footer(); ?>




