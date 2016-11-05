<?php
/*
 * Layout Name: Events Manager Plg - Template
 * Author: Bearsthemes
 * Author URI: http://themebears.com
 * Param: bearsthemes_BearsBlogEvents2Params
 */

# variable
$_id 		= sprintf( 'bears-element-%s', $atts['element_id'] );
$_class 	= sprintf( 'bs-blog temp-%s layout-%s %s', str_replace( '.php', '', $atts['template_params']['template'] ),  $atts['template_params']['layout_item'], $atts['class'] );
// $loop 		= $atts['posts'];

# custom query
list( $args, $wp_query ) = vc_build_loop_query( $atts['source'] );
$loop = bearsthemes_em_wp_query( $args );

/**
 * bearsthemes_blogEvents2_timelife
 *
 * @param [array] $atts
 * @param [array] $data
 * @return [html] $output
 */
if( ! function_exists( 'bearsthemes_blogEvents2_timelife' ) ) : 
	function bearsthemes_blogEvents2_timelife( $atts, $data )
	{	
		global $post;
		extract( $data );
		$template_params = $atts['template_params'];

		$EM_Event = new EM_Event( $post->ID );

		# check allow booking form
		$booking_button = '';
		if( ! empty( $EM_Event->event_rsvp ) && (int) $EM_Event->event_rsvp == 1 ) : 
			$booking_button = "
			<a href='#' 
			class='btn-book-online event-manager-ajax-loadform' 
			data-event-id='#_EVENTID' 
			data-event-title='#_EVENTNAME' 
			data-event-img='{$thumbnail}'
			data-redirect-to='{$link}'>
				". __( 'Book Online', 'bearsthemes' ) ." 
				<span>#_BOOKEDSPACES/#_SPACES</span>
			</a>";
		endif;

		$output = $EM_Event->output( "
			<div class='col-md-12 item'>
				<div class='item-inner'>
					<div class='thumb-meta'>
						<div class='thumb-meta-dislay' style='background: url({$thumbnail}) no-repeat center center / cover, #fafafa;'>
							{$booking_button}
						</div>
						<div class='thumb-meta-shadow' style='background: url({$thumbnail}) no-repeat center center / cover, #fafafa;'></div>
					</div>
					<div class='info-meta'>
						<div class='date-meta'>#_{F j, Y}</div>
						<a href='{$link}' data-smooth-link><h4 class='title'>#_EVENTNAME</h4></a>
						<div class='extra-event-meta'>
							<div class='e-time'><i class='ion-android-time'></i> #_24HSTARTTIME</div>
							<div class='e-location'><i class='ion-location'></i> #_LOCATIONADDRESS</div>
						</div>
						<p class='short-des'>{$content}</p>
						<a class='link' href='{$link}' data-smooth-link>{$template_params['readmore_text']}</a>
					</div>
				</div>
			</div>" );

		return $output;
	}
endif;

/**
 * bearsthemes_blogEvents2_grid_classic
 *
 * @param [array] $atts
 * @param [array] $data
 * @return [html] $output
 */
if( ! function_exists( 'bearsthemes_blogEvents2_grid_classic' ) ) :
	function bearsthemes_blogEvents2_grid_classic( $atts, $data )
	{
		global $post;
		extract( $data );
		$template_params = $atts['template_params'];

		$col = 12 / (int) $template_params['columns'];

		$EM_Event = new EM_Event( $post->ID );
		$output = $EM_Event->output( "
			<div class='col-md-{$col} item'>
				<div class='item-inner' style='height: {$template_params['height']};'>
					<div class='image-meta' style='background: url({$thumbnail}) no-repeat center center / cover, #333;'></div>
					<div class='info-meta'>
						<div class='info-meta-inner'>
							<a href='{$link}' data-smooth-link><h5 class='title'>#_EVENTNAME</h5></a>
							<div class='time'>#_{F j, Y}/#_24HSTARTTIME</div>
						</div>
					</div>
				</div>
			</div>" );

		return $output;
	}
endif;

/**
 * bearsthemes_blogEvents2_listing
 *
 * @param [array] $atts
 * @param [array] $data
 * @return [html] $output
 */
if( ! function_exists( 'bearsthemes_blogEvents2_listing' ) ) :
	function bearsthemes_blogEvents2_listing( $atts, $data )
	{
		global $post;
		extract( $data );
		$template_params = $atts['template_params'];
		$col = 12 / (int) $template_params['columns'];
		$EM_Event = new EM_Event( $post->ID );

		$output = "
		<div class='col-md-{$col} item'>
			<div class='item-inner'>
				<div class='image-meta' style='background: url({$thumbnail}) no-repeat center center / cover, #fafafa;'></div>
				<div class='info-meta'>
					<a href='{$link}' data-smooth-link><h5 class='title'>#_EVENTNAME</h5></a>
					<p class='short-des'>{$content}</p>
					<div class='extra-meta'>
						<div class='meta-item e-time'><i class='ion-android-time'></i> #_{F j, Y}/#_24HSTARTTIME</div>
						<div class='meta-item e-location'><i class='ion-map'></i> #_LOCATIONADDRESS</div>
					</div>
				</div>
			</div>
		</div>";

		return $EM_Event->output( $output );
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
	            $content = wp_trim_words( get_the_content(), $atts['template_params']['trim_word'], '...' );

	            $data = array(
	            	'thumbnail' 	=> $thumbnail,
	            	'title' 		=> $title,
	            	'content' 		=> $content,
	            	'link' 			=> get_the_permalink(),
	            	);

	            echo call_user_func_array( 'bearsthemes_blogEvents2_' . $atts['template_params']['layout_item'], array( $atts, $data ) );
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