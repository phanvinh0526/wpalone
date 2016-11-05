<?php 
/**
 * Layout Name: Special
 * Author: Bearsthemes
 * Author URI: http://themebears.com
 * Param: bearsthemes_BearsBlogSpecialParams
 */

# variable
$_id 		= sprintf( 'bears-element-%s', $atts['element_id'] );
$_class 	= sprintf( 'bs-blog temp-%s layout-%s %s', str_replace( '.php', '', $atts['template_params']['template'] ), $atts['template_params']['layout_item'], $atts['class'] );
$loop 		= $atts['posts'];

if( ! function_exists( 'bearsthemes_blogSpecial_zigzag_inline' ) ) : 
	function bearsthemes_blogSpecial_zigzag_inline( $atts, $data, $index )
	{
		global $post;
		extract( $data );
		$template_params = $atts['template_params'];
		$col_item = 12 / (int) $atts['template_params']['columns'];

		$output = "
		<div class='col-md-{$col_item} item'>
			<div class='item-inner'>
				<div class='thumb-meta' style='background: url({$thumbnail}) no-repeat center center / cover, #fafafa;'></div>
				<div class='info-meta'>
					<a href='$link' data-smooth-link><h3 class='title'>{$title}</h3></a>
					<p class='short-des'>{$content}</p>
					<a href='{$link}' class='morelink' data-smooth-link>{$template_params['readmore_text']}</a>
				</div>
			</div>
		</div>";

		return $output;
	}
endif;
?>
<div id="<?php echo esc_attr( $_id ) ?>" class="row <?php echo esc_attr( $_class ); ?>">
	<div class="bs-blog-container">
	<?php
	$index = 0;
	while( $loop->have_posts() ) : 
		$loop->the_post();

		/* thumbnail */
		$thumbnail = '';
		if( has_post_thumbnail() ):
            $thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium_large' );
        	$thumbnail = $thumbnail_data[0];
        endif;

        /* title */
        $title = get_the_title();

        /* content */
        $content = wp_trim_words( get_the_content(), $atts['template_params']['trim_word'], '...' );

        $data = array(
        	'thumbnail' 	=> $thumbnail,
        	'title' 		=> $title,
        	'content' 		=> $content,
        	'link' 			=> get_the_permalink(),
        	'author'		=> get_the_author(),
        	'count_comment' => wp_count_comments( get_the_ID() ),
        	);

        echo call_user_func_array( 'bearsthemes_blogSpecial_' . $atts['template_params']['layout_item'], array( $atts, $data, $index ) );
		$index += 1;
	endwhile;
	wp_reset_postdata();
	?>
	</div>
</div>