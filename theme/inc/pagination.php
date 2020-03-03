<?php 
function genlite_pagination($pages = '', $range = 2) 
{  
	$showitems = ($range * 2) + 1;  
	global $paged;
	$genlitePaged = $paged;
	
	if(empty($genlitePaged)) $genlitePaged = 1;
	if($pages == '')
	{
		global $wp_query; 
		$pages = $wp_query->max_num_pages;
	
		if(!$pages)
			$pages = 1;		 
	}   
	
	if(1 != $pages)
	{
	    echo '<nav aria-label="Page navigation" role="navigation">';
        echo '<span class="sr-only">Page navigation</span>';
        echo '<ul class="pagination justify-content-center ft-wpbs">';
		
        echo '<li class="page-item disabled hidden-md-down d-none d-lg-block"><span class="page-link">Page '.$genlitePaged.' of '.$pages.'</span></li>';
	
	 	if($genlitePaged > 2 && $genlitePaged > $range+1 && $showitems < $pages) 
			echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link(1).'" aria-label="First Page" title="First Page">&laquo;<span class="hidden-sm-down d-none d-md-block"></span></a></li>';
	
	 	if($genlitePaged > 1 && $showitems < $pages) 
			echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($genlitePaged - 1).'" aria-label="Previous Page" title="Previous Page">&lsaquo;<span class="hidden-sm-down d-none d-md-block"></span></a></li>';
	
		for ($i=1; $i <= $pages; $i++)
		{
		    if (1 != $pages &&( !($i >= $genlitePaged+$range+1 || $i <= $genlitePaged-$range-1) || $pages <= $showitems ))
				echo ($genlitePaged == $i)? '<li class="page-item active"><span class="page-link"><span class="sr-only">Current Page </span>'.$i.'</span></li>' : '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($i).'"><span class="sr-only">Page </span>'.$i.'</a></li>';
		}
		
		if ($genlitePaged < $pages && $showitems < $pages) 
			echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($genlitePaged + 1).'" aria-label="Next Page" title="Next Page"><span class="hidden-sm-down d-none d-md-block"></span>&rsaquo;</a></li>';  
	
	 	if ($genlitePaged < $pages-1 &&  $genlitePaged+$range-1 < $pages && $showitems < $pages) 
			echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($pages).'" aria-label="Last Page" title="Last Page"><span class="hidden-sm-down d-none d-md-block"></span>&raquo;</a></li>';
	
	 	echo '</ul>';
        echo '</nav>';
	}
}