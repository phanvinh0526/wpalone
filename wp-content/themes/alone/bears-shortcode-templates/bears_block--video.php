<?php
/*
 * Layout Name: Video
 * Author: Bearsthemes
 * Author URI: http://themebears.com
 * Param: bearsthemes_BearsBlockVideoParams
 */

# variable
$_id 		= sprintf( 'bears-element-%s', $atts['element_id'] );
$_class 	= sprintf( 'bs-block temp-%s l-%s %s', str_replace( '.php', '', $atts['template_params']['template'] ), $atts['template_params']['layout_item'], $atts['class'] );

/**
 * bearsthemes_blockVideo_default
 *
 * @param [array] $atts
 */
if( ! function_exists( 'bearsthemes_blockVideo_default' ) ) :
	function bearsthemes_blockVideo_default( $atts )
	{
		$template_params = $atts['template_params'];

		$output = "
			<a 
				class='html5lightbox block-video-btn' 
				href='{$template_params['video_url']}'
				data-width='600' 
				data-height='400'>
				<i class='{$template_params['iconfont']}'></i>
			</a>
			<div class='inner-text'>
				<h5 class='title'>{$template_params['title']}</h5>
				<p class='sub-title'>{$template_params['sub_title']}</p>
			</div>
			";

		return $output;
	}
endif;
?>
<div id="<?php echo esc_attr( $_id ) ?>" class="<?php echo esc_attr( $_class ); ?>">
	<div class="bs-block-container">
		<?php echo call_user_func_array( 'bearsthemes_blockVideo_' . $atts['template_params']['layout_item'], array( $atts ) ); ?>
	</div>
</div>