<?php 

/**
 * Template for displaying search forms in GenLite
 *
 * @package Hartsoft
 * @subpackage GenLite
 * @since 1.4.2
 * @version 1.4.2
 */


$s = get_search_query(); ?>

<form method="GET" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>/">
	<br>
	 	<div class="input-group">

	    	<input type="text" value="" placeholder="<?php esc_attr_e('What are you looking for?','genlite'); ?>" name="s" class="form-control" />

	  		    <span class="input-group-btn">
	        	    <button class="btn btn-primary submit search_submit" type="submit">
	        	    	<i class="fas fa-search"></i>
	        	    </button>
	        	</span>
	   	</div>

	<br>

</form>