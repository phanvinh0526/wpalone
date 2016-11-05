<?php
/**
 * [btwg_search icon='ion-ios-search-strong' extra_class='']
 *
 */

/**
 * btwg_search_func
 * 
 * @param [array] $atts
 */
if( ! function_exists( 'btwg_search_func' ) ) :
	function btwg_search_func( $atts ) 
	{
	    $atts = shortcode_atts( array(
	        'icon' => 'ion-ios-search-strong',
	        'content_inner' => true,
	        'title' => __( 'Search', 'bearsthemes' ),
	        'attr_container' => '.btwg-container-search',
	        'extra_class' => '',
	    ), $atts );

	    # content_inner
	    $content_inner = ( $atts['content_inner'] == true ) ? do_shortcode( '[btwg_search_container]' ) : '';

	    return "
	    <div class='scwg-item btwg-search {$atts['extra_class']}'>
	    	<a href='#' class='btwg-icon' data-container='{$atts['attr_container']}' title='{$atts['title']}'><i class='{$atts['icon']}'></i></a>
	    	{$content_inner}
	    </div>";
	}
endif;
if( function_exists('bcore_shortcode') ) { bcore_shortcode( 'btwg_search', 'btwg_search_func' ); }

/**
 * btwg_search_container_func
 *
 * @param [array] $atts
 */
if( ! function_exists( 'btwg_search_container_func' ) ) :
	function btwg_search_container_func( $atts )
	{
		$atts = shortcode_atts( array(
	        'container_class' => 'btwg-container-search',
	       	'extra_class' => '',
	    ), $atts );

		# get_search_form
	    $search_form = get_search_form( false );

	    return "
	    <div class='scwg-container {$atts['container_class']} {$atts['extra_class']}'>
			{$search_form}
	    </div>";
	}
endif;
if( function_exists( 'bcore_shortcode' ) ) { bcore_shortcode( 'btwg_search_container', 'btwg_search_container_func' ); }