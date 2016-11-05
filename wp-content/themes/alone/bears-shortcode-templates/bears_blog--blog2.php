<?php
/*
 * Layout Name: Blog 2
 * Author: Bearsthemes
 * Author URI: http://themebears.com
 * Param: bearsthemes_BearsBlog2PostParams
 */

# variable
$_id 		= sprintf( 'bears-element-%s', $atts['element_id'] );
$_class 	= sprintf( 'bs-blog temp-%s layout-%s %s', str_replace( '.php', '', $atts['template_params']['template'] ), $atts['template_params']['layout_item'], $atts['class'] );
$loop 		= $atts['posts'];

if( ! function_exists( 'bearsthemes_blog2Post_grid_classic' ) ) :
	function bearsthemes_blog2Post_grid_classic( $atts, $data, $index ) 
	{
		global $post;
		$post_format = get_post_format( $post->ID );
		$icon_posttype = array( 
			'i' 		=> 'ion-document-text', 
			'ivideo' 	=> 'ion-ios-videocam', 
			'iaudio' 	=> 'ion-ios-mic', 
			'iquote' 	=> '', 
			'ilink' 	=> '' , 
			'igallery' 	=> 'ion-images' );

		ob_start();
		bearsthemes_template_part( 
			ABS_PATH_FR . '/templates/blog2/listing/entry', 
			$post_format, 
			array( 
				'post' => $post, 
				'atts' => $atts, 
				'data' => $data, 
				'index' => $index, 
				'icon' => $icon_posttype['i' . $post_format] ) );
		$output = ob_get_clean();

		return $output;
	}
endif;
?>
<div id="<?php echo esc_attr( $_id ) ?>" class="<?php echo esc_attr( $_class ); ?>">
	<div class="bs-blog-container">
		<div class="row">
			<?php
			$index = 0;
			while( $loop->have_posts() ) : 
				$loop->the_post();

				/* thumbnail */
				$thumbnail = '';
				if( has_post_thumbnail() ):
	                $thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $atts['template_params']['image_size'] );
	            	$thumbnail = $thumbnail_data[0];
	            endif;

	            /* title */
	            $title = get_the_title();

	            /* content */
	            $content = wp_trim_words( get_the_content(), (int) $atts['template_params']['trim_word'], '...' );

	            $data = array(
	            	'thumbnail' 	=> $thumbnail,
	            	'title' 		=> $title,
	            	'content' 		=> $content,
	            	'link' 			=> get_the_permalink(),
	            	'author'		=> get_the_author(),
	            	'count_comment' => wp_count_comments( get_the_ID() ),
	            	);

	            echo call_user_func_array( 'bearsthemes_blog2Post_' . $atts['template_params']['layout_item'], array( $atts, $data, $index ) );
				$index += 1;
			endwhile;
			?>
		</div>
		
		<!-- pagination -->
		<?php if( 'show' == $atts['template_params']['show_pagination'] ) : ?>
		<div class='bt-pagination-style'>
			<?php 
			$big = 999999999;
			$args = array(
				'base'               => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'             => '?paged=%#%',
				'total'              => $loop->max_num_pages,
				'current'            => max( 1, get_query_var('paged') ),
				'prev_next'          => true,
				'prev_text'          => __('<i class="ion-arrow-left-c"></i>'),
				'next_text'          => __('<i class="ion-arrow-right-c"></i>'),
				);
			echo paginate_links( $args ); 
			?>
		</div>
		<?php endif; ?>

		<!-- reset post -->
		<?php wp_reset_postdata(); ?>
	</div>
</div>