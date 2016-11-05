<?php
/**
 * Single Event Meta (Organizer) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 */

$organizer_ids = tribe_get_organizer_ids();
$multiple = count( $organizer_ids ) > 1;

$phone = tribe_get_organizer_phone();
$email = tribe_get_organizer_email();
$website = tribe_get_organizer_website_link();
?>
<div class="col-md-6">
	<div class="tb-event-segment tb-event-detail-wrap">
		<h4 class="header-detail"><?php echo tribe_get_organizer_label( ! $multiple ); ?></h4>
		<ul class="tb-list-data">
			<?php  
			do_action( 'tribe_events_single_meta_organizer_section_start' );

			foreach ( $organizer_ids as $organizer ) :
				if ( ! $organizer ) continue;
				echo sprintf( '<li><label>%s</label> <span>%s</span></li>', esc_html( 'Start:', 'bearsthemes' ), tribe_get_organizer_link( $organizer ) );
			endforeach;
			
			if( ! $multiple ) : 
				if ( ! empty( $phone ) ) :
					echo sprintf( '<li><label>%s</label> <span>%s</span></li>', esc_html( 'Phone:', 'bearsthemes' ), esc_html( $phone ) );
				endif;
				
				if ( ! empty( $email ) ) :
					echo sprintf( '<li><label>%s</label> <span>%s</span></li>', esc_html( 'Email:', 'bearsthemes' ), esc_html( $email ) );
				endif;
				
				if ( ! empty( $website ) ) :
					echo sprintf( '<li><label>%s</label> <span>%s</span></li>', esc_html( 'Website:', 'bearsthemes' ), $website );
				endif;
			endif;
	
			do_action( 'tribe_events_single_meta_organizer_section_end' );
			?>
		</ul>
	</div>
</div>
