<?php
/**
 * Single Event Meta (Venue) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/venue.php
 *
 * @package TribeEventsCalendar
 */

if ( ! tribe_get_venue_id() ) {
	return;
}

$phone   = tribe_get_phone();
$website = tribe_get_venue_website_link();

?>
<div class="col-md-6">
	<div class="tb-event-segment tb-event-detail-wrap">
		<h4 class="header-detail"><?php echo tribe_get_venue_label_singular(); ?></h4>
		<ul class="tb-list-data">
			<?php  
			if ( tribe_address_exists() ) :
			
				$tribe_get_map_link_html = ( tribe_show_google_map_link() ) 
					? sprintf( '<span>%s</span>', tribe_get_map_link_html() ) 
					: '';
					
				echo sprintf( '<li><span>%s</span> %s</li>', tribe_get_full_address(), $tribe_get_map_link_html );
			endif;
			
			if ( ! empty( $phone ) ) :
				echo sprintf( '<li><label>%s</label> <span>%s</span></li>', esc_html( 'Phone:', 'bearsthemes' ), $phone );
			endif;
			
			if ( ! empty( $website ) ) :
				echo sprintf( '<li><label>%s</label> <span>%s</span></li>', esc_html( 'Website:', 'bearsthemes' ), $website );
			endif;
			?>
		</ul>
	</div>
</div>