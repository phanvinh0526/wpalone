<?php
/*
 * Layout Name: Post
 * Author: Bearsthemes
 * Author URI: http://themebears.com
 * Param: tbbs_BearsBlogPostParams
 */

# variable
$_id 		= sprintf( 'bears-element-%s', $atts['element_id'] );
$_class 	= sprintf( 'bs-blog temp-%s layout-%s %s', str_replace( '.php', '', $atts['template_params']['template'] ), $atts['template_params']['layout_item'], $atts['class'] );
$loop 		= $atts['posts'];

if( ! function_exists( 'bearsthemes_blogPost_special_style4' ) ) :
	function bearsthemes_blogPost_special_style4( $atts, $data )
	{
		global $post;
		extract( $data );
		$create_date = sprintf( '<span class="d">%s</span><span class="m">%s</span>', get_the_date( 'd', $post->ID ), get_the_date( 'F', $post->ID ) );

		$output = "
		<div class='col-md-6'>
			<div class='item-inner item-special4'>
					<div class='thumb-meta' style='background: url({$thumbnail}) no-repeat center center / cover, #333;'>
						<a 
							class='html5lightbox zoom-img-meta' 
							href='{$thumbnail}' 
							title='{$title}' 
							data-group='{$atts['element_id']}' 
							data-thumbnail='{$thumbnail}' 
							data-autoslide=true 
							data-fullscreenmode=true ><i class='ion-android-image'></i></a>
						<div class='createdate-meta'>{$create_date}</div>
					</div>
					<div class='info-meta'>
						<div class='extra-meta'>
							<div class='author'>
								<i class='ion-person'></i> 
								". __( 'By', 'bearsthemes' ) ." 
								{$author}
							</div>
							<div class='comment'>
								<i class='ion-chatbox'></i> 
								{$count_comment->total_comments} 
								". __( 'Comment(s)', 'bearsthemes' ) ."
							</div>
						</div>
						<a href='{$link}' title='{$title}'><h4 class='title'>{$title}</h4></a>
						<p class='short-des'>{$content}</p>
						<a href='{$link}' class='btn-readmore'>". __( 'Read more...', 'bearsthemes' ) ."</a>
					</div>
				</div>
		</div>";

		return $output;
	}
endif;

if( ! function_exists( 'bearsthemes_blogPost_special_style3' ) ) :
	function bearsthemes_blogPost_special_style3( $atts, $data )
	{
		global $post;
		extract( $data );
		$create_date = sprintf( '<span class="d">%s</span><span class="m">%s</span>', get_the_date( 'd', $post->ID ), get_the_date( 'F', $post->ID ) );

		$output = "
		<div class='col-md-8'>
			<div class='item-inner item-special4'>
					<div class='thumb-meta' style='background: url({$thumbnail}) no-repeat center center / cover, #333;'>
						<a 
							class='html5lightbox zoom-img-meta' 
							href='{$thumbnail}' 
							title='{$title}' 
							data-group='{$atts['element_id']}' 
							data-thumbnail='{$thumbnail}' 
							data-autoslide=true 
							data-fullscreenmode=true ><i class='ion-android-image'></i></a>
						<div class='createdate-meta'>{$create_date}</div>
					</div>
					<div class='info-meta'>
						<div class='extra-meta'>
							<div class='author'>
								<i class='ion-person'></i> 
								". __( 'By', 'bearsthemes' ) ." 
								{$author}
							</div>
							<div class='comment'>
								<i class='ion-chatbox'></i> 
								{$count_comment->total_comments} 
								". __( 'Comment(s)', 'bearsthemes' ) ."
							</div>
						</div>
						<a href='{$link}' title='{$title}'><h4 class='title'>{$title}</h4></a>
						<p class='short-des'>{$content}</p>
						<a href='{$link}' class='btn-readmore'>". __( 'Read more...', 'bearsthemes' ) ."</a>
					</div>
				</div>
		</div>";

		return $output;
	}
endif;

if( ! function_exists( 'bearsthemes_blogPost_special_style2' ) ) :
	function bearsthemes_blogPost_special_style2( $atts, $data )
	{
		global $post;
		extract( $data );
		$create_date = sprintf( '<span class="d">%s</span><span class="m">%s</span>', get_the_date( 'd', $post->ID ), get_the_date( 'F', $post->ID ) );

		$output = "
		<div class='col-md-6'>
			<div class='item-inner item-special4'>
					<div class='thumb-meta' style='background: url({$thumbnail}) no-repeat center center / cover, #333;'>
						<a 
							class='html5lightbox zoom-img-meta' 
							href='{$thumbnail}' 
							title='{$title}' 
							data-group='{$atts['element_id']}' 
							data-thumbnail='{$thumbnail}' 
							data-autoslide=true 
							data-fullscreenmode=true ><i class='ion-android-image'></i></a>
						<div class='createdate-meta'>{$create_date}</div>
					</div>
					<div class='info-meta'>
						<div class='extra-meta'>
							<div class='author'>
								<i class='ion-person'></i> 
								". __( 'By', 'bearsthemes' ) ." 
								{$author}
							</div>
							<div class='comment'>
								<i class='ion-chatbox'></i> 
								{$count_comment->total_comments} 
								". __( 'Comment(s)', 'bearsthemes' ) ."
							</div>
						</div>
						<a href='{$link}' title='{$title}'><h4 class='title'>{$title}</h4></a>
						<p class='short-des'>{$content}</p>
						<a href='{$link}' class='btn-readmore'>". __( 'Read more...', 'bearsthemes' ) ."</a>
					</div>
				</div>
		</div>";

		return $output;
	}
endif;

/**
 * bearsthemes_blogPost_special_first_item
 *
 * @param [array] $atts
 * @param [array] $data
 * @param [int] $index
 * @return [html] $output
 */
if( ! function_exists( 'bearsthemes_blogPost_special_first_item' ) ) :
	function bearsthemes_blogPost_special_first_item( $atts, $data, $index )
	{
		global $post;
		extract( $data );
		$col_item = 12 / (int) $atts['template_params']['columns'];
		$create_date = sprintf( '<span class="d">%s</span><span class="m">%s</span>', get_the_date( 'd', $post->ID ), get_the_date( 'F', $post->ID ) );

		if( $index == 0 ) :
			$output = call_user_func_array( 'bearsthemes_blogPost_special_style' . $atts['template_params']['columns'], array( $atts, $data ) );
		else :
			$output = "
			<div class='col-md-{$col_item}'>
				<div class='item-inner'>
					<div class='thumb-meta' style='background: url({$thumbnail}) no-repeat center center / cover, #333;'>
						<a 
							class='html5lightbox zoom-img-meta' 
							href='{$thumbnail}' 
							title='{$title}' 
							data-group='{$atts['element_id']}' 
							data-thumbnail='{$thumbnail}' 
							data-autoslide=true 
							data-fullscreenmode=true ><i class='ion-android-image'></i></a>
						<div class='createdate-meta'>{$create_date}</div>
					</div>
					<div class='info-meta'>
						<div class='extra-meta'>
							<div class='author'>
								<i class='ion-person'></i> 
								". __( 'By', 'bearsthemes' ) ." 
								{$author}
							</div>
							<div class='comment'>
								<i class='ion-chatbox'></i> 
								{$count_comment->total_comments} 
								". __( 'Comment(s)', 'bearsthemes' ) ."
							</div>
						</div>
						<a href='{$link}' title='{$title}'><h4 class='title'>{$title}</h4></a>
					</div>
				</div>
			</div>";
		endif;

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
            $content = wp_trim_words( get_the_content(), 30, '...' );

            $data = array(
            	'thumbnail' 	=> $thumbnail,
            	'title' 		=> $title,
            	'content' 		=> $content,
            	'link' 			=> get_the_permalink(),
            	'author'		=> get_the_author(),
            	'count_comment' => wp_count_comments( get_the_ID() ),
            	);

            echo call_user_func_array( 'bearsthemes_blogPost_' . $atts['template_params']['layout_item'], array( $atts, $data, $index ) );
			$index += 1;
		endwhile;
		wp_reset_postdata();
		?>
	</div>
</div>
