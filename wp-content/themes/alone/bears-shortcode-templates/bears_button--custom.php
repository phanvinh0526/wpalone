<?php
/*
 * Layout Name: Custom
 * Author: Bearsthemes
 * Author URI: http://themebears.com
 * Param: tbbs_BearsButtonCustomParams
 */

/* Define variable */
$_id 		= sprintf( 'bears-element-%s', $atts['element_id'] );
$_class 	= sprintf( 'bs-button layout-%s %s', str_replace( '.php', '', $atts['template_params']['template'] ), $atts['class'] );

if( ! function_exists( 'tbbs_buttonCustom_border_line' ) ) :
	function tbbs_buttonCustom_border_line( $atts )
	{
		$output = "<a class='tbbs-btn style-{$atts['template_params']['layout_item']} {$atts['class']}' href='{$atts['template_params']['link']['url']}' data-smooth-link>{$atts['template_params']['link']['text']}</a>";
		return $output;
	}
endif;

if( ! function_exists( 'tbbs_buttonCustom_background_color' ) ) :
	function tbbs_buttonCustom_background_color( $atts )
	{
		$output = "<a class='tbbs-btn style-{$atts['template_params']['layout_item']} {$atts['class']}' href='{$atts['template_params']['link']['url']}' data-smooth-link>{$atts['template_params']['link']['text']}</a>";
		return $output;
	}
endif;

if( ! function_exists( 'tbbs_buttonCustom_border_line_shadow_effect' ) ) :
	function tbbs_buttonCustom_border_line_shadow_effect( $atts )
	{
		$output = "<a class='tbbs-btn style-border_line style-{$atts['template_params']['layout_item']} {$atts['class']}' href='{$atts['template_params']['link']['url']}' data-smooth-link>{$atts['template_params']['link']['text']}</a>";
		return $output;
	}
endif;

if( ! function_exists( 'tbbs_buttonCustom_background_color_shadow_effect' ) ) :
	function tbbs_buttonCustom_background_color_shadow_effect( $atts )
	{
		$output = "<a class='tbbs-btn style-background_color style-{$atts['template_params']['layout_item']} {$atts['class']}' href='{$atts['template_params']['link']['url']}' data-smooth-link>{$atts['template_params']['link']['text']}</a>";
		return $output;
	}
endif;


?>
<div id="<?php echo esc_attr( $_id ); ?>" class="tbbs-button-wrap <?php echo esc_attr( $_class ); ?> text-<?php echo esc_attr( $atts['template_params']['align'] ); ?>">
	<?php echo call_user_func_array( 'tbbs_buttonCustom_' . $atts['template_params']['layout_item'], array( $atts ) );  ?>
</div>