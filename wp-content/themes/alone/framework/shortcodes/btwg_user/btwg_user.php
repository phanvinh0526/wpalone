<?php
/**
 * [btwg_user icon='pe-7s-user' extra_class='']
 *
 */

/**
 * btwg_search_func
 * 
 * @param [array] $atts
 */
if( ! function_exists( 'btwg_user_func' ) ) :
	function btwg_user_func( $atts ) 
	{
	    $atts = shortcode_atts( array(
	        'icon' => 'pe-7s-user',
	        'content_inner' => true,
	        'title' => __( 'User', 'bearsthemes' ),
	        'attr_container' => '.btwg-container-user',
	        'extra_class' => '',
	    ), $atts );

	    # content_inner
	    $content_inner = ( $atts['content_inner'] == true ) ? do_shortcode( '[btwg_user_container]' ) : '';

	    # get avatar
	    $user_id = get_current_user_id();
	    $bg_avatar = ( is_user_logged_in() ) ? sprintf( 'style="background: url(%s) no-repeat center center; background-size: %s"', get_avatar_url( $user_id, 100 ), '100%' ) : '';
	    $atts['extra_class'] .= ( is_user_logged_in() ) ? 'user-is-login' : '';

	    return "
	    <div class='scwg-item btwg-user {$atts['extra_class']}'>
	    	<a href='#' class='btwg-icon' data-container='{$atts['attr_container']}' title='{$atts['title']}' {$bg_avatar}><i class='{$atts['icon']}'></i></a>
	    	{$content_inner}
	    </div>";
	}
endif;
if( function_exists('bcore_shortcode') ) { bcore_shortcode( 'btwg_user', 'btwg_user_func' ); }

/**
 * btwg_search_container_func
 *
 * @param [array] $atts
 */
if( ! function_exists( 'btwg_user_container_func' ) ) :
	function btwg_user_container_func( $atts )
	{
		$atts = shortcode_atts( array(
	        'container_class' => 'btwg-container-user',
	       	'extra_class' => '',
	    ), $atts );

		# user login
	    $is_login_arr = array(
	    	"<a data-smooth-link='' href='". wp_logout_url( home_url() ) ."'><i class='ion-ios-unlocked-outline'></i> ". __( 'Logout', 'bearsthemes' ) ."</a>", 
	    	);

	    $slug = 'my-donations';
		$wpdb = $GLOBALS['wpdb'];
	    $id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM " . $wpdb->posts . " WHERE post_name = '%s' AND ( post_type = 'page' OR post_type = 'post') ", $slug ) );
	    if ( ! empty( $id ) ) {
	        array_push( $is_login_arr, "<a data-smooth-link='' href='". get_permalink( $id ) ."' class='my-donations-item'><i class='ion-ios-heart'></i> ". __( 'My Donations', 'bearsthemes' ) ."</a>" );
	    }

	    # user not login
	    $no_login_arr = array(
	    	"<a href='#' data-form='register' onclick='false' class='pafl-trigger-overlay'><i class='ion-ios-personadd-outline'></i> ". __( 'Register', 'bearsthemes' ) ."</a>",
	    	"<a href='#' data-form='login' onclick='false' class='pafl-trigger-overlay'><i class='ion-ios-locked-outline'></i> ". __( 'Login', 'bearsthemes' ) ."</a>" );

	    # set nav
	    $nav = ( is_user_logged_in() ) ? $is_login_arr : $no_login_arr;
		
		# build content
	    $content = "";
	    foreach( $nav as $nav_item ) :
	    	$content .= sprintf( '<li class="nav-item">%s</li>', $nav_item );
	    endforeach;

	    return "
	    <div class='scwg-container {$atts['container_class']} {$atts['extra_class']}'>
			<ul>
				$content
			</ul>
	    </div>";
	}
endif;
if( function_exists( 'bcore_shortcode' ) ) { bcore_shortcode( 'btwg_user_container', 'btwg_user_container_func' ); }