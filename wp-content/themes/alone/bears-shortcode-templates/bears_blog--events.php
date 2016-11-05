<?php
/*
 * Layout Name: Evvents
 * Author: Bearsthemes
 * Author URI: http://themebears.com
 * Param: tbbs_BearsBlogEventsParams
 */

# variable
$_id 		= sprintf( 'bears-element-%s', $atts['element_id'] );
$_class 	= sprintf( 'bs-blog layout-%s %s', str_replace( '.php', '', $atts['template_params']['template'] ), $atts['class'] );
$loop 		= $atts['posts'];
$atts['columns_item'] = 12 / (int) $atts['template_params']['columns'];

# custom query
list( $args, $wp_query ) = vc_build_loop_query( $atts['source'] );
$args['post_type'] 	= 'tribe_events';
$args['meta_key'] 	= '_EventStartDate';
$args['orderby'] 	= 'meta_value';
$loop = new WP_Query( $args );

/**
 * bearsthemes_blogEvents_default
 *
 * @param [array] $atts
 * @param [array] $data
 * @return [html] $output
 */
if( ! function_exists( 'bearsthemes_blogEvents_default' ) ) :
	function bearsthemes_blogEvents_default( $atts, $data )
	{
		global $post;
		extract( $data );

		$create_date = sprintf( '<span class="d">%s</span><span class="m">%s</span>', get_the_date( 'd', $post->ID ), get_the_date( 'F', $post->ID ) );
		$start_date = tribe_get_start_date( $post, true, 'h:i a' );
		$end_date = tribe_get_end_date( $post, true, 'h:i a' );
		$address = tribe_get_address( $post->ID );

		$output = "
		<div class='blog-item col-md-{$atts['columns_item']} layout-{$atts['template_params']['layout_item']}'>
			<div class='blog-inner'>
				<div class='thumb-meta' style='background: url({$thumbnail}) no-repeat center center / cover, #333'></div>
				<div class='info-meta'>
					<a href='{$link}'><h4 class='title'>{$title}</h4></a>
					<p class='short-text'>{$content}</p>
					<div class='list-field-meta'>
						<div class='field-item'>
							<span class='icon-wrap'><i class='ion-clock'></i></span>
							<span class='field-data'>{$start_date} - {$end_date}</span>
						</div>
						<div class='field-item'>
							<span class='icon-wrap'><i class='ion-location'></i></span>
							<span class='field-data'>{$address}</span>
						</div>
					</div>
					<div class='create-date'>{$create_date}</div>
					<a class='link' href='{$link}'>". __( 'Join Us Now', 'bearsthemes' ) ."</a>
				</div>
			</div>
		</div>";

		return $output;
	}
endif;

if( ! function_exists( 'bearsthemes_blogEvents_grid_basic' ) ) : 
	function bearsthemes_blogEvents_grid_basic( $atts, $data )
	{
		global $post;
		extract( $data );

		$create_date = sprintf( '<span class="d">%s</span><span class="m">%s</span>', get_the_date( 'd', $post->ID ), get_the_date( 'F', $post->ID ) );
		$start_date = tribe_get_start_date( $post, true, 'd F' );
		$start_time = tribe_get_start_date( $post, true, 'h:i a' );
		$end_time = tribe_get_end_date( $post, true, 'h:i a' );
		$address = tribe_get_address( $post->ID );
		$short_des = wp_trim_words( get_post_field( 'post_content', $post->ID ), 10, ' ' );

		$s_data = json_encode( array(
			'title' => $title,
			'thumbnail' => $thumbnail,
			'description' => $content,
			) );
		$social_sharing = do_shortcode( "[bears_social social='facebook,twitter,pinterest,google' url='{$link}' extra_data='{$s_data}']" );

		$output = "
		<div class='blog-item col-md-{$atts['columns_item']} layout-{$atts['template_params']['layout_item']}'>
			<div class='blog-inner'>
				<div class='thumb-meta' style='background: url({$thumbnail}) no-repeat center center / cover, #fafafa;'>
					<a href='{$link}' class='title-link' title='{$title}'><h4 class='title'>{$title}</h4></a>
					<div class='sharing-wrap'>
						{$social_sharing}
					</div>
				</div>
				<div class='extra-meta'>
					<div class='e-item time'>
						<span class='icon-wrap'><i class='ion-android-time'></i></span> 
						{$start_date} @ {$start_time} - {$end_time}
					</div>
					<div class='e-item address'>
						<span class='icon-wrap'><i class='ion-ios-location'></i></span>
						{$address}
					</div>
					<div class='e-item short-des'>
						<span class='icon-wrap'><i class='ion-document-text'></i></span>
						{$short_des} <a href='{$link}'>". __( 'readmore...', 'bearsthemes' ) ."</a>
					</div>
				</div>
			</div>
		</div>";

		return $output;
	}
endif;

if( ! function_exists( 'bearsthemes_blogEvents_listing' ) ) :
	function bearsthemes_blogEvents_listing( $atts, $data )
	{
		global $post;
		extract( $data );

		$create_date = sprintf( '<span class="d">%s</span><span class="m">%s</span>', get_the_date( 'd', $post->ID ), get_the_date( 'F', $post->ID ) );
		$start_date_style = sprintf( '<span class="d">%s</span><span class="m">%s</span>', tribe_get_start_date( $post, true, 'd' ), tribe_get_start_date( $post, true, 'F' ) );
		$start_date = tribe_get_start_date( $post, true, 'd F' );
		$start_time = tribe_get_start_date( $post, true, 'h:i a' );
		$end_time = tribe_get_end_date( $post, true, 'h:i a' );
		$address = tribe_get_address( $post->ID );
		$short_des = wp_trim_words( get_post_field( 'post_content', $post->ID ), 20, '...' );

		$output = "
		<div class='blog-item col-md-{$atts['columns_item']} layout-{$atts['template_params']['layout_item']}'>
			<div class='blog-inner'>
				<div class='day-meta' style='background: url({$thumbnail}) no-repeat center center / cover, #333;'>
					<div class='e-start-date'>
						{$start_date_style}
					</div>
				</div>
				<div class='info-meta'>
					<div class='full-time-meta'>{$start_date} @ {$start_time} - {$end_time}</div>
					<a href='{$link}'>
						<h4 class='title'>{$title}</h4>
					</a>
					<p class='short-des'>{$short_des}</p>
				</div>
			</div>
		</div>";

		return $output;
	}
endif;
?>
<div id="<?php echo esc_attr( $_id ) ?>" class="<?php echo esc_attr( $_class ); ?>">
	<div class="bs-blog-container">
		<div class="row">
		<?php
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
            $content = wp_trim_words( get_the_content(), 10, '...' );

            $data = array(
            	'thumbnail' 	=> $thumbnail,
            	'title' 		=> $title,
            	'content' 		=> $content,
            	'link' 			=> get_the_permalink(),
            	);

			echo call_user_func_array( 'bearsthemes_blogEvents_' . $atts['template_params']['layout_item'], array( $atts, $data ) );
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