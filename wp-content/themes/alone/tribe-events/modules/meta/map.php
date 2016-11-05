<?php
/**
 * Single Event Meta (Map) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 */

$map = tribe_get_embedded_map();

if ( empty( $map ) ) {
	return;
}

?>
<div class="col-md-6">
	<div class="tb-event-segment tb-event-detail-wrap">
		<h4 class="header-detail"><?php esc_html_e( 'Map', 'bearsthemes' ); ?></h4>
		<?php
		// Display the map.
		do_action( 'tribe_events_single_meta_map_section_start' );
		echo $map;
		do_action( 'tribe_events_single_meta_map_section_end' );
		?>
	</div>
</div>