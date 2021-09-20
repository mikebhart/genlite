<?php

/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hartsoft
 * @subpackage GenLite
 * @since 1.4.2
 * @version 1.4.2
 */

// Return early no password has been entered for protected posts.
if (post_password_required()) {
    return;
}

/**
 * Display template for comments and pingbacks.
 *
 */
if (!function_exists('genlite_bootstrapwp_comment')):
    function genlite_bootstrapwp_comment($comment, $args, $depth)
{
        switch ($comment->comment_type):
    case 'pingback':
    case 'trackback': ?>

	                <li class="comment media" id="comment-<?php comment_ID();?>">
	                    <div class="media-body">
	                        <p>
	                            <?php esc_html_e('Pingback:', 'genlite');?> <?php comment_author_link();?>
	                        </p>
	                    </div><!--/.media-body -->
	                <?php
    break;
    default:
        // Proceed with normal comments.
        global $post;?>

	                <li class="comment media" id="li-comment-<?php comment_ID();?>">
	                        <a href="<?php echo esc_url($comment->comment_author_url); ?>" class="pull-left">
	                            <?php echo get_avatar($comment, 64); ?>
	                        </a>
	                        <div class="media-body">
	                            <h4 class="media-heading comment-author vcard">
	                                <?php printf('<cite class="fn">%1$s %2$s</cite>',
            get_comment_author_link(),
            // If current post author is also comment author, make it known visually.
            ($comment->user_id === $post->post_author) ? '<span class="label"> ' . esc_attr_e('Post author', 'genlite') . '</span> ' : '');?>
	                            </h4>

	                            <?php if ('0' == $comment->comment_approved): ?>
	                                <p class="comment-awaiting-moderation"><?php esc_attr_e('Your comment is awaiting moderation.', 'genlite');?></p>
	                            <?php endif;?>

                            <?php comment_text();?>
                            <p class="meta">
                            	<h6>
  	                              <?php echo get_comment_date() . ' ' . get_comment_time(); ?>
  	                            </h6>
                            </p>
                            <p class="reply">
                                <?php comment_reply_link(array_merge($args, array(
        'reply_text' => __('Reply', 'genlite'),
        'depth' => $depth,
        'max_depth' => $args['max_depth'],
    )
    ));?>
                            </p>
                        </div>
                        <!--/.media-body -->
                <?php
break;
    endswitch;
}
endif;
if (is_singular()) {
        wp_enqueue_script("comment-reply");
}

function genlite_bootstrap3_comment_form($args)
{

    $comment = __('Comment', 'genlite');

    $args['comment_field'] = '<div class="form-group comment-form-comment">
            <label for="comment">' . $comment . '</label>
            <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
        </div>';
    $args['class_submit'] = 'btn btn-outline-primary'; // since WP 4.1

    return $args;
}
add_filter('comment_form_defaults', 'genlite_bootstrap3_comment_form');

// comments customisation
function genlite_bootstrap3_comment_form_fields($fields)
{
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');
    $html5 = current_theme_supports('html5', 'comment-form') ? 1 : 0;

    $fields = array(
        'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __('Name', 'genlite') . ($req ? ' <span class="required">*</span>' : '') . '</label> ' .
        '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></div>',
        'email' => '<div class="form-group comment-form-email"><label for="email">' . __('Email (will not be published)', 'genlite') . ($req ? ' <span class="required">*</span>' : '') . '</label> ' .
        '<input class="form-control" id="email" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></div>',
        'url' => '<div class="form-group comment-form-url"><label for="url">' . __('Website', 'genlite') . '</label> ' .
        '<input class="form-control" id="url" name="url" ' . ($html5 ? 'type="url"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></div>',
    );

    return $fields;
}
add_filter('comment_form_default_fields', 'genlite_bootstrap3_comment_form_fields');

?>
<div id="comments" class="comments-area">
    <?php if (have_comments()): ?>

        <ul class="media-list">
            <?php wp_list_comments(array('callback' => 'genlite_bootstrapwp_comment'));?>
        </ul><!-- /.commentlist -->

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
            <nav id="comment-nav-below" class="navigation" role="navigation">
                <div class="nav-previous">
                    <?php previous_comments_link(esc_attr_e('Older Comments', 'genlite'));?>
                </div>
                <div class="nav-next">
                    <?php next_comments_link(esc_attr_e('Newer Comments', 'genlite'));?>
                </div>
            </nav>
        <?php endif; // check for comment navigation ?>

        <?php elseif (!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')): ?>
            <p class="nocomments"><?php esc_attr_e('Comments are closed.', 'genlite');?></p>
    <?php endif;?>

    <?php comment_form();?>
</div><!-- #comments .comments-area -->