<?php
require_once 'socials.php';
require_once 'post_list.php';
require_once 'combo-widgets.php';
if(class_exists('TBDonations')){
	require_once 'recent-donation.php';
}
if (class_exists('Woocommerce')) {
	require_once 'mini_cart.php';
}
if( class_exists( 'EM_MS_Globals' ) ) :
	require_once 'bears_event_list.php';
endif;
if( class_exists( 'Charitable' ) ) :
	require_once 'bears_cause_list.php';
endif;