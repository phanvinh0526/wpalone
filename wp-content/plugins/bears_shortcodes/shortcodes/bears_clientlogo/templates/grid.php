<?php
/*
 * Layout Name: Grid
 * Author: Bearsthemes
 * Author URI: http://themebears.com
 * Param: tbbs_BearsClientlogoParams
 */

/* define variable */
$_id 		= sprintf( 'bears-element-%s', $atts['element_id'] );
$_class 	= sprintf( 'bs-clientlogo layout-%s %s', str_replace( '.php', '', $atts['template_params']['template'] ), $atts['class'] );

/**
 * tbbs_ClientlogoGrid_default
 *
 * @param [array] $atts
 */
if( ! function_exists( 'tbbs_ClientlogoGrid_default' ) ) :
	function tbbs_ClientlogoGrid_default( $atts )
	{
		if( empty( $atts['images'] ) || $atts['images'] == '' ) return;
		$template_params = $atts['template_params'];
		$image_ids = explode( ',', $atts['images'] );
		$output = "";

		foreach( $image_ids as $id ) :
			$img_data = wp_get_attachment_image_src( $id, 'full' );
			$img_src = $img_data[0];

			$output .= "
			<div class='bs-col-{$template_params['columns']}'>
				<div class='logo-item' style='padding:{$template_params['padding']}'>
					<div class='logo-item-img' style='background: url({$img_src}) no-repeat center center / contain; height: {$template_params['height']}'></div>
				</div>
			</div>";
		endforeach;

		return sprintf( '<div class="bs-row">%s</div>', $output );
	}
endif;
?>
<div id="<?php echo esc_attr( $_id ) ?>" class="<?php echo esc_attr( $_class ); ?>">
	<div class="bs-clientlogo-container">
		<?php 
		echo call_user_func_array( 'tbbs_ClientlogoGrid_' . $atts['template_params']['layout_item'], array( $atts ) );
		?>
	</div>
</div>