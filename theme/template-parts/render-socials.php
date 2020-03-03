<?php 

	$maxSocials = 0;
	$genlite_social_links = $GLOBALS[GENLITE_SOCIAL_IDS];

	for($u = 0; $u < count($genlite_social_links); $u++) {
									
		$socialId = GENLITE_SOCIAL_PREFIX . $genlite_social_links[$u];
				
		if(get_theme_mod($socialId) && $maxSocials < 9) {  

			$maxSocials++;

			$socialUrl = get_theme_mod($socialId); 
			$socialIconClassName = $genlite_social_links[$u];
			$socialDisplayName = genlite_social_get_display_name($socialIconClassName);	 ?>
	
		    <li>
			  	<a href="<?php echo esc_url($socialUrl); ?>" title="<?php echo esc_attr($socialDisplayName); ?>">
				 	<i class="fab fa-<?php echo esc_attr($socialIconClassName); ?>"></i>
		    	</a>
		 	</li>

  <?php }

	}  
	
?>

