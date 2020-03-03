<?php



function genlite_more_post_ajax_handler(){

    $args= null;
    $postsPerPage = (isset($_POST["postsPerPage"])) ? $_POST["postsPerPage"] : 2;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
    $category = (isset($_POST['category'])) ? $_POST['category'] : 'all-categories';
    $search_text = (isset($_POST['search_text'])) ? $_POST['search_text'] : null;
  
    header("Content-Type: text/html");

    if ($category == 'all-categories' && $month == null && $search_text == null) {

        $args = array(
            'suppress_filters' => true,
            'post_type' => 'post',
            'posts_per_page' => $postsPerPage,
            'paged'    => $page,
        );

    } else if ($category != 'all-categories' && $month == null && $search_text == null) {

        $args = array (
                'orderby' => 'title',
                'order'   => 'ASC',
                'post_type' => 'post',
                'posts_per_page' => $postsPerPage,
                'paged' => $page,
                'tax_query' => array(
                  array (
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms' => $category
                  )          
                )
              );

    } else if ($search_text != null) {

        $args = array (
            's' => $search_text,
            'orderby' => 'title',
            'order'   => 'ASC',
            'post_type' => 'post',
            'posts_per_page' => $postsPerPage,
            'paged' => $page
        );

    }

    $loop = new WP_Query($args);
    $row_count = $loop->found_posts; 
    $max_pages = ceil($row_count / $postsPerPage);

    $out = '';

    if ($loop -> have_posts()) {

        $out .= '<div class="container"><div class="card-deck">';

        while ($loop -> have_posts()) : $loop -> the_post();

            $post_format = get_post_format( get_the_ID() );

            $header_html = "";

            if ($post_format == 'video') {

                $header_html = genlite_get_first_video_embed( get_the_ID() ); 
            
            } else {

                $featured_img_url =  "http://placehold.it/300x300?text=No+Featured+Image";

                if ( has_post_thumbnail() ) { 
                  
                    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'medium'); 
        
                }

                $header_html = '<div class="genlite-card__header-placeholder-image" style="background-image: url(' . $featured_img_url .');"></div>';

            }


            $excerpt = get_the_excerpt();
            $excerpt = substr($excerpt, 0, 50);
            $excerpt_result = substr($excerpt, 0, strrpos($excerpt, ' '));

            $post_date = get_the_date( 'j M Y' );
            $out .= '<input id="genlite_max_pages" type="hidden" value="' . $max_pages . '">';
            $out .= '<div class="card genlite-card mb-4">';
            $out .= '<div class="genlite-card__header-placeholder">';
            $out .= $header_html;
            $out .= '</div>';
            $out .= '<div class="card-body">';
            $out .= '<h5 class="card-title">' . get_the_title() . '</h5>';
            $out .= '<p class="card-text">' . $excerpt_result . '</p>';
            $out .= '<a href="' . get_post_permalink() . '" class="stretched-link"></a>';
            $out .= '</div>';
            $out .= '<div class="card-footer">';
            $out .=  esc_attr($post_date);
            $out .= '</div>';
            $out .= '</div>';


        endwhile;

        $out .= '</div>';
        $out .= '</div>';

    }

    wp_reset_postdata();

    die($out);
    
}
add_action('wp_ajax_nopriv_genlite_more_post_ajax_handler', 'genlite_more_post_ajax_handler');
add_action('wp_ajax_genlite_more_post_ajax_handler', 'genlite_more_post_ajax_handler');



$GLOBALS['content_width'] = 1200;

define( 'GENLITE_SOCIAL_PREFIX', 'genlite_social_' );
define( 'GENLITE_SOCIAL_IDS', 'genlite_social_ids' );
 
// Store social ids for processing later, the ids match the font awesome icon class names and the style sheet names for header / footer icons. 
function genlite_social_init() {


	$genlite_social_identifiers = array( 'bitbucket', 'delicious', 'deviantart', 'dropbox' , 'facebook-f', 'facebook-messenger', 'flickr', 'foursquare','github-alt','google-plus-g', 'instagram', 'line', 'linkedin-in','medium-m','meetup','odnoklassniki', 'openid', 'pinterest','qq', 'quora', 'ravelry', 'reddit-alien','renren',  'skype', 'snapchat-ghost','soundcloud' , 'stack-overflow', 'stumbleupon', 'telegram', 'twitch', 'tumblr','twitter','vimeo-v','vine','vk','viadeo', 'viber', 'weibo','weixin','whatsapp', 'xing', 'yahoo', 'youtube'); 

		$GLOBALS[GENLITE_SOCIAL_IDS] = $genlite_social_identifiers;

}
genlite_social_init();


// Lookup ids to display icon names. Used in the title hover over caption.
function genlite_social_get_display_name($myLinkType) {

	$linkClassName = '';

	switch ($myLinkType) {

		case 'bitbucket':  $linkClassName = __('BitBucket','genlite'); break;
		case 'delicious':  $linkClassName = __('Delicious','genlite'); break;
		case 'deviantart':  $linkClassName = __('Deviantart','genlite'); break;
		case 'dropbox':  $linkClassName = __('Dropbox','genlite'); break;
		case 'facebook-f':  $linkClassName = __('Facebook','genlite'); break;	
		case 'facebook-messenger':  $linkClassName = __('Facebook Messenger','genlite'); break;			
		case 'flickr':  $linkClassName = __('Flickr','genlite'); break;
		case 'foursquare':  $linkClassName = __('Foursquare','genlite'); break;
		case 'github-alt':  $linkClassName = __('GitHub','genlite'); break;
		case 'google-plus-g':  $linkClassName = __('Google+','genlite'); break;
		case 'instagram':  $linkClassName = __('Instagram','genlite'); break;	
		case 'line':  $linkClassName = __('Line','genlite'); break;	
		case 'linkedin-in':  $linkClassName = __('LinkedIn','genlite'); break;
		case 'medium-m':  $linkClassName = __('Medium','genlite'); break;	
		case 'meetup':  $linkClassName = __('Meetup','genlite'); break;				
		case 'odnoklassniki':  $linkClassName = __('Odnoklassniki','genlite'); break;
		case 'openid':  $linkClassName = __('OpenID','genlite'); break;
		case 'pinterest':  $linkClassName = __('Pinterest','genlite'); break;
		case 'qq':  $linkClassName = __('QQ','genlite'); break;
		case 'quora':  $linkClassName = __('Quora','genlite'); break;
		case 'ravelry':  $linkClassName = __('Ravelry','genlite'); break;
		case 'reddit-alien':  $linkClassName = __('Reddit','genlite'); break;
		case 'renren':  $linkClassName = __('Renren','genlite'); break;
		case 'skype':  $linkClassName = __('Skype','genlite'); break;
 		case 'snapchat-ghost':  $linkClassName = __('Snapchat','genlite'); break;
		case 'soundcloud' :  $linkClassName = __('SoundCloud','genlite'); break;
		case 'stack-overflow':  $linkClassName = __('Stackoverflow','genlite'); break;
		case 'stumbleupon':  $linkClassName = __('StumbleUpon','genlite'); break;
		case 'telegram':  $linkClassName = __('Telegram','genlite'); break;
		case 'twitch':  $linkClassName = __('Twitch','genlite'); break;	
		case 'tumblr':  $linkClassName = __('Tumblr','genlite'); break;
		case 'twitter':  $linkClassName = __('Twitter','genlite'); break;
		case 'vimeo-v':  $linkClassName = __('Vimeo','genlite'); break;
		case 'vine':  $linkClassName = __('Vine','genlite'); break;
		case 'vk':  $linkClassName = __('VK','genlite'); break;
		case 'viadeo':  $linkClassName = __('Viadeo','genlite'); break;
		case 'viber':  $linkClassName =__( 'Viber','genlite'); break;
		case 'weibo':  $linkClassName = __('Weibo','genlite'); break;
		case 'weixin':  $linkClassName =__( 'WeChat','genlite'); break;
		case 'whatsapp':  $linkClassName = __('WhatsApp','genlite'); break;
		case 'xing':  $linkClassName =__( 'Xing','genlite'); break;
		case 'yahoo':  $linkClassName = __('Yahoo','genlite'); break;
		case 'youtube':  $linkClassName = __('YouTube','genlite'); break;
	}

	return $linkClassName;

}

// Change wp login screen logo to customizer chosen logo
function genlite_admin_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
        	background: url(<?php
            	if (has_custom_logo()) {
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' )[0];
					echo esc_attr($logo);
		        }  ?>);

		    background-repeat: no-repeat;
            background-size: 200px 80px;         
            width:65%;
	       
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'genlite_admin_login_logo' );

// Don't show Private posts
function genlite_no_privates($where) {
  if( is_admin() ) return $where;

  global $wpdb;
  return " $where AND {$wpdb->posts}.post_status != 'private' ";
}
add_filter('posts_where', 'genlite_no_privates');

// Remove Query String from Static Resources ensure urls with ? are cached 
function genlite_remove_query_string( $src ) {
	if( strpos( $src, '?ver=' ) )
		$src = remove_query_arg( 'ver', $src );
		return $src;
}
add_filter( 'style_loader_src', 'genlite_remove_query_string', 10, 2 );
add_filter( 'script_loader_src', 'genlite_remove_query_string', 10, 2 );

function genlite_add_file_types_to_uploads($file_types) {
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
}
add_action('upload_mimes', 'genlite_add_file_types_to_uploads');

// Add Header Code to wp_head
function genlite_header_metadata_setup() {
    echo get_theme_mod( 'genlite_general_headercode');
}
add_action('wp_head', 'genlite_header_metadata_setup');

// Get first embed media item from Custom Post Type
function genlite_get_first_video_embed($post_id) {
    $post = get_post($post_id);
    $content = do_shortcode(apply_filters('the_content', $post->post_content));
	$embeds = get_media_embedded_in_content($content, array('object', 'embed', 'iframe'));

    if (!empty($embeds)) {
        return $embeds[0];
    } else {
        return false;
    }
}


