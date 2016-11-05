<?php

/* Post gallery */
if (!function_exists('bearstheme_grab_ids_from_gallery')) {

    function bearstheme_grab_ids_from_gallery() {
        global $post;
        $gallery = bearstheme_get_shortcode_from_content('gallery');
        $object = new stdClass();
        $object->columns = '3';
        $object->link = 'post';
        $object->ids = array();
        if ($gallery) {
            $object = bearstheme_extra_shortcode('gallery', $gallery, $object);
        }
        return $object;
    }

}
/* Extra shortcode */
if (!function_exists('bearstheme_extra_shortcode')) {
    function bearstheme_extra_shortcode($name, $shortcode, $object) {
        if ($shortcode && is_object($object)) {
            $attrs = str_replace(array('[', ']', '"', $name), null, $shortcode);
            $attrs = explode(' ', $attrs);
            if (is_array($attrs)) {
                foreach ($attrs as $attr) {
                    $_attr = explode('=', $attr);
                    if (count($_attr) == 2) {
                        if ($_attr[0] == 'ids') {
                            $object->$_attr[0] = explode(',', $_attr[1]);
                        } else {
                            $object->$_attr[0] = $_attr[1];
                        }
                    }
                }
            }
        }
        return $object;
    }
}
/* Get Shortcode Content */
if (!function_exists('bearstheme_get_shortcode_from_content')) {

    function bearstheme_get_shortcode_from_content($param) {
        global $post;
        $pattern = get_shortcode_regex();
        $content = $post->post_content;
        if (preg_match_all('/' . $pattern . '/s', $content, $matches) && array_key_exists(2, $matches) && in_array($param, $matches[2])) {
            $key = array_search($param, $matches[2]);
            return $matches[0][$key];
        }
    }

}
/* Remove Shortcode */
if (!function_exists('bearstheme_remove_shortcode_gallery')) {
	function bearstheme_remove_shortcode_gallery() {
		return null;
	}
}

/*Author*/
if ( ! function_exists( 'bearstheme_author_render' ) ) {
	function bearstheme_author_render() {
		ob_start();
		?>
		<?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
			<span class="featured-post"> <?php _e( 'Sticky', 'bearsthemes' ); ?></span>
		<?php } ?>
		<div class="bt-about-author clearfix">
			<div class="bt-author-avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 170 ); ?></div>
			<div class="bt-author-info">
				<h6 class="bt-name"><?php the_author(); ?></h6>
				<?php the_author_meta('description'); ?>
			</div>
		</div>
		<?php
		return  ob_get_clean();
	} 
}
/*Custom comment list*/
function bearstheme_custom_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo esc_html( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? 'ro-comment-item' : 'ro-comment-item parent' ) ?> id="comment-<?php comment_ID() ?>">
	<div class="ro-avatar">
		<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		<div class="ro-info clearfix">
			<h6 class="ro-name">
				<?php comment_author( get_comment_ID() ); ?>
			</h6>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'bearsthemes' ); ?></em>
				<br />
			<?php endif; ?>
			<span class="ro-time">
				<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php echo get_comment_date().' '.get_comment_time(); ?>
				</a>
				<?php edit_comment_link( __( '(Edit)', 'bearsthemes' ), '  ', '' ); ?>
			</span>
			<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
	</div>
	<div class="ro-comment">
		
		<div class="ro-content"><?php comment_text(); ?></div>
	</div>
<?php
}
