<?php
/**
 * bears_purchaseref_func
 * [bears_purchaseref link_purchase=""]
 *
 * @param array $atts
 * @param string $content
 */
if( ! function_exists( 'bears_qrcodejs_func' ) ) :
	function bears_purchaseref_func( $atts, $content ){
		$atts = array_merge( array(
			'buy_name' => '',
			'title_purchase' => 'purchase theme',
			'link_purchase' => '',
			'title_contact' => 'send us a message',
			'link_contact' => '',
			'extra_class' => ''
			), $atts );

		extract( $atts );

		$contact_ui = "
			<a class='link-contact-ui' target='_blank' title='{$title_contact}' href='{$link_contact}'>
				<img alt='{$title_contact}' src='". TBBS_IMAGES ."/contact-us.png'>
			</a>";

		$purchase_ui = "
			<a class='link-purchase-iu' target='_blank' title='{$title_purchase}' href='{$link_purchase}'>
				<img src='". TBBS_IMAGES ."/cart-icon.png'>
				<span>Buy</span> 
				{$buy_name} 
				<span>on</span>
				<img alt='{$title_purchase}' src='". TBBS_IMAGES ."/envato-label.png'>
			</a>";

		return sprintf( "<div class='bears-purchaseref-wrap %s'>%s %s</div>", $extra_class, ( ! empty( $link_contact ) ) ? $contact_ui : '', $purchase_ui );
	}
endif;
add_shortcode( 'bears_purchaseref', 'bears_purchaseref_func' );