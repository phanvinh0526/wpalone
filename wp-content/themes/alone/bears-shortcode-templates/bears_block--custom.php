<?php
/*
 * Layout Name: Custom
 * Author: Bearsthemes
 * Author URI: http://themebears.com
 * Param: tbbs_BearsBlockCustomParams
 */

# variable
$_id 		= sprintf( 'bears-element-%s', $atts['element_id'] );
$_class 	= sprintf( 'bs-block layout-%s bl-%s %s', str_replace( '.php', '', $atts['template_params']['template'] ), $atts['template_params']['layout_item'], $atts['class'] );

if( ! function_exists( 'bearsthemes_blockCustom_default' ) ) :
	function bearsthemes_blockCustom_default( $atts )
	{
		extract( $atts['template_params'] );
		$img_data = wp_get_attachment_image_src( $image, 'full' );
		$img_src = $img_data[0];

		$output = "
		<div class='item'>
			<div class='image-meta'><img src='{$img_src}' alt=''></div>
			<div class='info-meta'>
				<h6 class='sub-title'>{$sub_title}</h6>
				<h4 class='title'>{$title}</h4>
				<p class='text'>{$content}</p>
				<a class='link' data-smooth-link href='{$link['url']}'>{$link['text']}</a>
			</div>
		</div>";

		return $output;
	}
endif;

if( ! function_exists( 'bearsthemes_blockCustom_icon' ) ) :
	function bearsthemes_blockCustom_icon( $atts )
	{
		extract( $atts['template_params'] );

		$output = "
		<div class='item l-{$layout_item}'>
			<div class='icon-meta'><i class='$icon'></i></div>
			<div class='info-meta'>
				<h6 class='sub-title'>{$sub_title}</h6>
				<h4 class='title'>{$title}</h4>
				<p class='text'>{$content}</p>
				<a class='link' data-smooth-link href='{$link['url']}'>{$link['text']}</a>
			</div>
		</div>";

		return $output;
	}
endif;

if( ! function_exists( 'bearsthemes_blockCustom_icon2' ) ) :
	function bearsthemes_blockCustom_icon2( $atts ) 
	{
		extract( $atts['template_params'] );

		$output = "
		<div class='item l-{$layout_item}'>
			<div class='icon-meta'><i class='$icon'></i></div>
			<div class='info-meta'>
				<h4 class='title'>{$title}</h4>
				<p class='text'>{$content}</p>
			</div>
		</div>";

		return $output;
	}
endif;

if( ! function_exists( 'bearsthemes_blockCustom_background_image' ) ) :
	function bearsthemes_blockCustom_background_image( $atts )
	{
		extract( $atts['template_params'] );

		$output = "
		<div class='item l-{$layout_item}'>
			<div class='item-inner'>
				<h3 class='title'>{$title}</h3>
				<p class='des'>{$content}</p>
				<a class='link' href='{$link['url']}' data-smooth-link>{$link['text']}</a>
			</div>
		</div>";

		return $output;
	}
endif;
?>
<div id="<?php echo esc_attr( $_id ) ?>" class="<?php echo esc_attr( $_class ); ?>">
	<div class="bs-block-container">
		<?php echo call_user_func_array( 'bearsthemes_blockCustom_' . $atts['template_params']['layout_item'], array( $atts ) ); ?>
	</div>
</div>