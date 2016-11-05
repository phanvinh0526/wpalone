<?php
/*
 * Layout Name: Counter
 * Author: Bearsthemes
 * Author URI: http://themebears.com
 * Param: tbbs_BearsBlockCounterParams
 */

# variable
$_id 		= sprintf( 'bears-element-%s', $atts['element_id'] );
$_class 	= sprintf( 'bs-block temp-%s layout-%s %s', str_replace( '.php', '', $atts['template_params']['template'] ), $atts['template_params']['layout_item'], $atts['class'] );

$color = array( 'light' => array( '#fff', '#f6f6f6' ), 'dark' => array( '#222', '#555' ) );
$atts['color'] = $color[$atts['template_params']['color']];

if( ! function_exists( 'bearsthemes_blockCounter_default' ) ) :
	function bearsthemes_blockCounter_default( $atts )
	{
		$template_params = $atts['template_params'];

		$output = "
			<div class='item'>
				<div class='f-icon'>
					<i class='{$template_params['iconfont']}'></i>
				</div>
				<div class='title'>{$template_params['title']}</div>
				<div class='bears-number-counter bt-number' data-counterup-nums='{$template_params['number']}'>{$template_params['number']}</div>		
			</div>";

		return $output;
	}
endif;
?>
<div id="<?php echo esc_attr( $_id ) ?>" class="<?php echo esc_attr( $_class ); ?>">
	<div class="bs-block-container color-<?php echo "{$atts['template_params']['color']}"; ?>">
		<?php echo call_user_func_array( 'bearsthemes_blockCounter_' . $atts['template_params']['layout_item'], array( $atts ) ); ?>
	</div>
</div>