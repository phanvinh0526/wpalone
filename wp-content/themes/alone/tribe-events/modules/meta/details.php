<?php
/**
 * Single Event Meta (Details) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 */

/* define variable */
$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
$time_range_separator = tribe_get_option( 'timeRangeSeparator', ' - ' );
$start_datetime = tribe_get_start_date();
$start_date = tribe_get_start_date( null, false );
$start_time = tribe_get_start_date( null, false, $time_format );
$start_ts = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );
$end_datetime = tribe_get_end_date();
$end_date = tribe_get_display_end_date( null, false );
$end_time = tribe_get_end_date( null, false, $time_format );
$end_ts = tribe_get_end_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );
$time_formatted = null;
if ( $start_time == $end_time ) $time_formatted = esc_html( $start_time );
else $time_formatted = esc_html( $start_time . $time_range_separator . $end_time );
$event_id = Tribe__Main::post_id_helper();
$time_formatted = apply_filters( 'tribe_events_single_event_time_formatted', $time_formatted, $event_id );
$time_title = apply_filters( 'tribe_events_single_event_time_title', __( 'Time:', 'the-events-calendar' ), $event_id );
$cost = tribe_get_formatted_cost();
$cats = tribe_get_event_categories(
	get_the_id(), array(
		'before'       => '',
		'sep'          => ', ',
		'after'        => '',
		'label'        => __( 'Category', 'bearsthemes' ), // An appropriate plural/singular label will be provided
		'label_before' => '<label>',
		'label_after'  => '</label>',
		'wrap_before'  => '<span class="tb-events-event-categories">',
		'wrap_after'   => '</span>',
	)
);
$website = tribe_get_event_website_link();
?>
<div class="col-md-6">
	<div class="tb-event-segment tb-event-detail-wrap">
		<h4 class="header-detail"><?php esc_html_e( 'Detail', 'bearsthemes' ); ?></h4>
		<ul class="tb-list-data">
			<?php  
			if ( tribe_event_is_all_day() && tribe_event_is_multiday() ) :
				echo sprintf( '<li><label>%s</label> <span>%s</span></li>', esc_html( 'Start:', 'bearsthemes' ), esc_html( $start_date ) );
				echo sprintf( '<li><label>%s</label> <span>%s</span></li>', esc_html( 'End:', 'bearsthemes' ), esc_html( $end_date ) );
			elseif ( tribe_event_is_all_day() ):
				echo sprintf( '<li><label>%s</label> <span>%s</span></li>', esc_html( 'Date:', 'bearsthemes' ), esc_html( $start_date ) );
			elseif ( tribe_event_is_multiday() ) :
				echo sprintf( '<li><label>%s</label> <span>%s</span></li>', esc_html( 'Start:', 'bearsthemes' ), esc_html( $start_datetime ) );
				echo sprintf( '<li><label>%s</label> <span>%s</span></li>', esc_html( 'End:', 'bearsthemes' ), esc_html( $end_datetime ) );
			else :
				echo sprintf( '<li><label>%s</label> <span>%s</span></li>', esc_html( 'Date:', 'bearsthemes' ), esc_html( $time_formatted ) );
			endif;
			
			if ( ! empty( $cost ) ) : 
				echo sprintf( '<li><label>%s</label> <span>%s</span></li>', esc_html( 'Cost:', 'bearsthemes' ), esc_html( $cost ) );
			endif;
			
			echo sprintf( '<li>%s</li>', $cats );
			
			if ( ! empty( $website ) ) :
				echo sprintf( '<li><label>%s</label> <span>%s</span></li>', esc_html( 'Website:', 'bearsthemes' ), $website );
			endif;
			?>
		</ul>
	</div>
</div>