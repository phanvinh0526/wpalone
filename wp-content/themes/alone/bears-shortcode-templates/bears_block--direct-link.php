<?php
/*
 * Layout Name: Direct Link
 * Author: Bearsthemes
 * Author URI: http://themebears.com
 * Param: tbbs_BearsBlockDirectLinkParams
 */

# variable
$_id 		= sprintf( 'bears-element-%s', $atts['element_id'] );
$_class 	= sprintf( 'bs-block temp-%s layout-%s %s', str_replace( '.php', '', $atts['template_params']['template'] ), $atts['template_params']['layout_item'], $atts['class'] );

if( ! function_exists( 'bearsthemes_blockDirectLink_default' ) ) :
	function bearsthemes_blockDirectLink_default( $atts ) 
	{
		$template_params = $atts['template_params'];
		
		$output = "
		<div class='item text-center'>
			<h2 class='title'>{$template_params['title']}</h2>
			<a class='btn-redirect' href='{$template_params['link']['url']}'>{$template_params['link']['text']}</a>
		</div>";

		return $output;
	}
endif;

if( ! function_exists( 'bearsthemes_blockDirectLink_title_vertical' ) ) :
	function bearsthemes_blockDirectLink_title_vertical( $atts )
	{
		$template_params = $atts['template_params'];

		$output = "
		<div class='item'>
			<h6 class='sub-title'>{$template_params['sub_title']}</h6>
			<h2 class='title'>{$template_params['title']}</h2>
			<a class='btn-redirect' href='{$template_params['link']['url']}'>{$template_params['link']['text']}</a>
		</div>";

		return $output;
	}
endif; 
?>
<div id="<?php echo esc_attr( $_id ) ?>" class="<?php echo esc_attr( $_class ); ?>">
	<div class="bs-block-container">
		<?php
		$content_item = call_user_func_array( 'bearsthemes_blockDirectLink_' . $atts['template_params']['layout_item'], array( $atts ) ); 
		echo sprintf( '%s', $content_item );
		?>
	</div>
</div>
