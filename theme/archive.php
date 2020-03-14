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

	<div class="container">

		<div class="row genlite__content justify-content-center">
			<div class="genlite-archive-title">
				<h1><?php the_archive_title(); ?></h1>
			</div>
		</div>

	</div>

	<div class="container">

		<div class="row mb-3">
			
			<div class="col-12 col-sm-6">
				<label><h6>CATEGORY</h6></label>
				<div class="form-group">
				<select id="category-select" name="category-select" class="form-control d-inline-block" onchange="genlite_categories_filter()">
					<option value="all-categories">All Categories</option>
					<?php foreach ($categories as $category) : ?>
						<option value="<?php echo $category->slug ?>" ><?php echo $category->name ?></option>
					<?php endforeach; ?>
				</select>
				</div>
			</div>
			
			
			
			<div class="col-12 col-sm-6">
				<label><h6>KEYWORD SEARCH</h6></label>
				<div><input id="keyword-input" name="keyword-input" type="text" class="form-control" placeholder="Enter Keyword"></div>
			</div>
			
		</div>

		<div class="row">

				<div id="genlite-archive__more-posts-placeholder">

					<?php get_template_part('template-parts/blog-list', get_post_type()); ?>
				</div>
			
		</div>

		<div class="row">

			<div class="mx-auto mt-3 mb-5">
				<div id="genlite-archive__more-posts-button" class="btn btn-outline-primary">Show More</div>
			</div>

		</div>
		
	</div>

      



<?php get_footer(); ?>

<script type="text/javascript">

	var postsPerPage = "<?php echo get_option( 'posts_per_page' ); ?>";
	var pageNumber = 1;
	var category;
	var search_text;

	function genlite_categories_filter() {

		search_text = null;
		document.getElementById("keyword-input").value = '';
			
		pageNumber = 0;
		category = document.getElementById("category-select").value;
		
		$("#genlite-archive__more-posts-placeholder").html("");
		genlite_load_posts();

	}

	$("#keyword-input").keyup(function(event) {


		if (event.keyCode === 13) {
			
			category  = null;
			document.getElementById("category-select").value = 'all-categories';
			
			pageNumber = 0;

			search_text = document.getElementById("keyword-input").value;

			$("#genlite-archive__more-posts-placeholder").html("");
			genlite_load_posts();

		}

	});

	function genlite_load_posts() {

		var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

		pageNumber++;

		var data = {
					'action': 'genlite_more_post_ajax_handler',
					'pageNumber': pageNumber, 
					'postsPerPage' : postsPerPage,
					'category' : category,
					'search_text' : search_text
					};

		$.ajax({
				
				type: "POST",
				dataType: "html",
				url: ajaxurl,
				data: data,
				
				success: function(data){
				
				var more_posts_button = document.getElementById("genlite-archive__more-posts-button");

				if(data){
				
					$("#genlite-archive__more-posts-placeholder").append(data);
				
				} else {

					$("#genlite-archive__more-posts-placeholder").append('<p>No results to show.</p>');
				    more_posts.style.display = "none";

				}
				
				   if (document.getElementById("genlite_max_pages")) {

				     var max_pages = document.getElementById("genlite_max_pages").value;
					
				     if (max_pages == pageNumber) {

						more_posts_button.style.display = "none";

				     } else {

						more_posts_button.style.display = "block";
				     }

				   } 

				},
				error : function(jqXHR, textStatus, errorThrown) {
					$loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
				}

		});
	
		return false;
	}

	$("#genlite-archive__more-posts-button").on("click",function() { 
		genlite_load_posts();

	});


</script>
