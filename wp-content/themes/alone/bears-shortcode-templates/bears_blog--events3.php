<?php
/*
 * Layout Name: Events 3
 * Author: Bearsthemes
 * Author URI: http://themebears.com
 * Param: bearsthemes_BearsBlogEvents3Params
 */

# variable
$_id 		= sprintf( 'bears-element-%s', $atts['element_id'] );
$_class 	= sprintf( 'bs-blog temp-%s layout-%s %s', str_replace( '.php', '', $atts['template_params']['template'] ),  $atts['template_params']['layout_item'], $atts['class'] );

# custom query
list( $args, $wp_query ) = vc_build_loop_query( $atts['source'] );
$loop = bearsthemes_em_wp_query( $args );

$owl_responsive = array(
	1 => array( 0 => array( 'items' => 1 ), 600 => array( 'items' => 1 ), 1000 => array( 'items' => 1 ) ),
	2 => array( 0 => array( 'items' => 1 ), 600 => array( 'items' => 2 ), 1000 => array( 'items' => 2 ) ),
	3 => array( 0 => array( 'items' => 1 ), 600 => array( 'items' => 2 ), 1000 => array( 'items' => 3 ) ),
	4 => array( 0 => array( 'items' => 1 ), 600 => array( 'items' => 2 ), 1000 => array( 'items' => 4 ) ),
	);
$owl_opts = json_encode( array(
	'items' 				=> (int) $atts['template_params']['columns'],
	// 'stagePadding'			=> 100,
	'margin' 				=> 20,
	'loop' 					=> true,
    'nav' 					=> true,
    'autoplay' 				=> true,
    'autoplayHoverPause' 	=> true, 
    'responsive' 			=> $owl_responsive[ (int) $atts['template_params']['columns'] ],
	) );
$wrap_attr = array(
	'carousel' 	=> array( 'class="layout-carousel owl-carousel"', 'data-bs-courousel-owl=\''. $owl_opts .'\'' ),
	'grid' 		=> array( 'class="layout-grid row"' ),
	'listing' 	=> array( 'class="layout-listing row"' ),
	'masonry' 	=> array( 'class="layout-masonry row-masonry bears-gridmasonry-col-'. $atts['template_params']['columns'] .'"', 'data-bears-masonry-elem=\'\'' ) );

if( ! function_exists( 'bearsthemes_blogEvents3_carousel' ) ) :
	function bearsthemes_blogEvents3_carousel( $atts, $data )
	{
		global $post;
		extract( $data );

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

		$output = "
		<div class='item'>
			<div class='item-inner'>
				<div class='image-meta' style='background: url({$thumbnail}) no-repeat center center / cover, #333;'>
					{$booking_button}
				</div>
				<div class='info-meta'>
					<div class='info-meta-inner'>
						<div class='address'><i class='ion-location'></i> #_LOCATIONADDRESS</div>
						<div class='time'><i class='ion-android-time'></i> #_{F j, Y}/#_24HSTARTTIME</div>
						<a href='{$link}' data-smooth-link title='#_EVENTNAME'><h5 class='title'>#_EVENTNAME</h5></a>
						<p class='des'>{$content}</p>
					</div>
				</div>
			</div>
		</div>";

		return $EM_Event->output( $output );
	}
endif;

if( ! function_exists( 'bearsthemes_blogEvents3_grid' ) ) :
	function bearsthemes_blogEvents3_grid( $attr, $data )
	{
		global $post;
		extract( $data );
		$template_params = $attr['template_params'];
		$col = 12 / (int) $template_params['columns'];

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

		$output = "
		<div class='item col-md-{$col}'>
			<div class='item-inner'>
				<div class='image-meta' style='background: url({$thumbnail}) no-repeat center center / cover, #333;'>
					{$booking_button}
				</div>
				<div class='info-meta'>
					<div class='info-meta-inner'>
						<div class='address'><i class='ion-location'></i> #_LOCATIONADDRESS</div>
						<div class='time'><i class='ion-android-time'></i> #_{F j, Y}/#_24HSTARTTIME</div>
						<a href='{$link}' data-smooth-link title='#_EVENTNAME'><h5 class='title'>#_EVENTNAME</h5></a>
						<p class='des'>{$content}</p>
						<a class='link' href='{$link}' data-smooth-link>{$template_params['readmore_text']}</a>
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
		<?php
		echo sprintf( '<div %s>', implode( ' ', $wrap_attr[$atts['template_params']['layout_item']] ) );
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

	            echo call_user_func_array( 'bearsthemes_blogEvents3_' . $atts['template_params']['layout_item'], array( $atts, $data ) );
			endwhile;
		echo '</div>';
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