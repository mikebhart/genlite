<?php


class GenLiteSocial {

	public $name;
	public $description;

	function __construct( $name, $description ) {
		$this->name = $name;
		$this->description = $description;
	}

	function get_name() {
	 	return $this->name;
	}
	  
	function get_description() {
		return $this->description;
	}  
}

$socials_array = [ 
			new GenLiteSocial('bitbucket', 'BitBucket'),
			new GenLiteSocial('delicious', 'Delicious'),
			new GenLiteSocial('deviantart', 'Deviantart') 
		];

		// for( $x = 0; $x < count( $socials_array ); $x++) {

		// 	echo $socials_array[$x]->get_name();
		// 	echo $socials_array[$x]->get_description();



		// }



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

// Add Body Code to <body>
function genlite_body_metadata_setup() {
    echo get_theme_mod( 'genlite_general_bodycode');
}
add_action('wp_body_open', 'genlite_body_metadata_setup');

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


