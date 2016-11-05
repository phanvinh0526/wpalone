<?php
/**
 * [btwg_cart icon='ion-ios-search-strong' extra_class='']
 *
 */

/**
 * btwg_cart_func
 * 
 * @param [array] $atts
 */
if( ! function_exists( 'btwg_cart_func' ) ) :
	function btwg_cart_func( $atts ) 
	{
	    $atts = shortcode_atts( array(
	        'icon' => 'ion-ios-cart',
	        'content_inner' => true,
	        'title' => __( 'Cart', 'bearsthemes' ),
	        'attr_container' => '.btwg-container-cart',
	        'extra_class' => '',
	    ), $atts );

	    # content_inner
	    $content_inner = ( $atts['content_inner'] == true ) ? do_shortcode( "[btwg_cart_container]" ) : '';

	    return "
	    <div class='scwg-item btwg-cart'>
	    	<a href='#' class='btwg-icon {$atts['extra_class']}' data-container='{$atts['attr_container']}' title='{$atts['title']}'>
	    		<i class='{$atts['icon']}'></i>
	    		<div class='cart-data'></div>
	    	</a>
	    	{$content_inner}
	    </div>";
	}
endif;
if( function_exists('bcore_shortcode') ) { bcore_shortcode( 'btwg_cart', 'btwg_cart_func' ); }

/**
 * btwg_cart_container_func
 *
 * @param [array] $atts
 */
if( ! function_exists( 'btwg_cart_container_func' ) ) :
	function btwg_cart_container_func( $atts )
	{
		$atts = shortcode_atts( array(
	       	'container_class' => 'btwg-container-cart',
	       	'extra_class' => '',
	    ), $atts );

	    return "
	    <div class='scwg-container {$atts['container_class']} {$atts['extra_class']}'>
			
	    </div>";
	}
endif;
if( function_exists( 'bcore_shortcode' ) ) { bcore_shortcode( 'btwg_cart_container', 'btwg_cart_container_func' ); }

/**
 * bearsthemes_mode_minicart_update
 * 
 */
if( ! function_exists( 'bearsthemes_mode_minicart_update' ) ) :
	function bearsthemes_mode_minicart_update() {
		global $woocommerce;

		# minicart_template
		ob_start(); 
			echo sprintf( '<h4 class="heading-minicart">%s</h4>', __( 'My Shopping Cart.', 'bearsthemes' ) );
			wc_get_template( 'cart/mini-cart.php' ); 
		$minicart_template = ob_get_clean();

		# cart_count
		$cart_count = ( ! empty( $woocommerce->cart->cart_contents_count ) || (int) $woocommerce->cart->cart_contents_count != 0 ) 
			? "<span class='cart-qty-total'>{$woocommerce->cart->cart_contents_count}</span>" 
			: '';
		
		# data
	    $data = array(
	        'cart_count' => $cart_count,
	        'cart_total' => WC()->cart->get_cart_total(),
	        'cart_template' => $minicart_template,
	    );

	    echo json_encode( $data ); exit;
	}
endif;
add_action('wp_ajax_bearsthemes_mode_minicart_update', 'bearsthemes_mode_minicart_update');
add_action('wp_ajax_nopriv_bearsthemes_mode_minicart_update', 'bearsthemes_mode_minicart_update');

if( ! function_exists( 'bearsthemes_remove_product_minicart' ) ) : 
	function bearsthemes_remove_product_minicart()
	{
		global $woocommerce;
		$cart = $woocommerce->cart;

		foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) {
	    	if( $cart_item['product_id'] == $_POST['product_id'] ){
		        // Remove product in the cart using  cart_item_key.
		        $cart->remove_cart_item( $cart_item_key );
	  		}
		}
	}
endif;
add_action('wp_ajax_bearsthemes_remove_product_minicart', 'bearsthemes_remove_product_minicart');
add_action('wp_ajax_nopriv_bearsthemes_remove_product_minicart', 'bearsthemes_remove_product_minicart');