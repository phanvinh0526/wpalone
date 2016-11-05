<?php
/**
 * [btwg_menu_off_canvas_func]
 *
 */

/**
 * btwg_menu_off_canvas_func
 * 
 * @param [array] $atts
 */
if( ! function_exists( 'btwg_menu_off_canvas_func' ) ) :
	function btwg_menu_off_canvas_func( $atts ) 
	{
	    $atts = shortcode_atts( array(
	        'icon' => 'ion-more',
	        'content_inner' => false,
	        'title' => __( '', 'bearsthemes' ),
	        'attr_container' => '.btwg-container-menu-off-canvas',
	        'extra_class' => '',
	    ), $atts );

	    # content_inner
	    $content_inner = ( $atts['content_inner'] == true ) ? do_shortcode( '[btwg_menu_off_canvas_container]' ) : '';

	    return "
	    <div class='scwg-item btwg-menu-off-canvas {$atts['extra_class']}'>
	    	<a href='#' class='btwg-icon' data-container='{$atts['attr_container']}' title='{$atts['title']}'><i class='{$atts['icon']}'></i></a>
	    	{$content_inner}
	    </div>";
	}
endif;
if( function_exists('bcore_shortcode') ) { bcore_shortcode( 'btwg_menu_off_canvas', 'btwg_menu_off_canvas_func' ); }

/**
 * btwg_search_container_func
 *
 * @param [array] $atts
 */
if( ! function_exists( 'btwg_menu_off_canvas_container_func' ) ) :
	function btwg_menu_off_canvas_container_func( $atts )
	{
		global $bearstheme_options, $post;

		$atts = shortcode_atts( array(
	        'container_class' => 'btwg-container-menu-off-canvas',
	       	'extra_class' => '',
	    ), $atts );


	    $header_layout = ( isset( $bearstheme_options["tb_header_layout"] ) && ! empty( $bearstheme_options["tb_header_layout"] ) ) ? $bearstheme_options["tb_header_layout"] : 'header-v1';
	    
	    if( $post ){
	        $tb_header = get_post_meta( $post->ID, 'tb_header', true ) ? get_post_meta( $post->ID, 'tb_header', true ) : 'global';
	        $header_layout = ( $tb_header == 'global' ) ? $header_layout : $tb_header;
	    }

	    $atts['extra_class'] .= " temp-header-{$header_layout}";

		# sidebar_right
		ob_start(); 
		( is_active_sidebar( 'bearstheme-menu-canvas-sidebar' ) ) ? dynamic_sidebar( 'bearstheme-menu-canvas-sidebar' ) : ''; 
		$sidebar = ob_get_clean();

	    return "
	    <div class='scwg-container {$atts['container_class']} {$atts['extra_class']}'>
	    	<div class='container-inner'>
				{$sidebar}
	    	</div>
	    </div>";
	}
endif;
if( function_exists( 'bcore_shortcode' ) ) { bcore_shortcode( 'btwg_menu_off_canvas_container', 'btwg_menu_off_canvas_container_func' ); }