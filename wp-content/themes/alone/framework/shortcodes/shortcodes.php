<?php
$elements = array(
	'video',
	'video_fancybox_button',
	'countdown',
	'counter_up',
	'service_box',
	'info_box',
	'map_v3',
	'blog',
	'blog_carousel',
	'blog_special',
	'story_special',
	'story_grid',
	'story_recent',
	'team',
	'testimonial_slider',
	'demo_item',
	'btwg_search',
	'btwg_menu_off_canvas',
);

foreach ($elements as $element) {
	include($element .'/'. $element.'.php');
}

if( class_exists( 'Bears_Fullscreen_Login' ) ) :
	$shortcode_fullscreen_login = array(
		'btwg_user', );

	foreach ( $shortcode_fullscreen_login as $file_item ) {
		include( $file_item .'/'. $file_item.'.php' ); 
	}
endif;

if(class_exists('TBDonations')){
	$donations = array(
		'donation_box',
		'donaters_carousel',
		'donation_grid',
		'donation_upcoming',
		'donation_total_custom',
		'donation_slider',
		'donation_search',
	);
	
	foreach ($donations as $donation) {
		include($donation .'/'. $donation.'.php'); 
	}
}

if(class_exists('Tribe__Events__Main')){
	$events = array(
		'event_slider',
		'event_special',
	);
	
	foreach ($events as $event) {
		include($event .'/'. $event.'.php'); 
	}
}

if(class_exists('Woocommerce')){
	$wooshops = array(
		'product_grid',
		'btwg_cart',
	);
	
	foreach ($wooshops as $wooshop) {
		include($wooshop .'/'. $wooshop.'.php'); 
	}
}
