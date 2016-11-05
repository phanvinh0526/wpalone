<?php
/*
 * Layout Name: Gallery
 * Author: Bearsthemes
 * Author URI: http://themebears.com
 * Param: tbbs_BearsCarouselGalleryParams
 */

/* define variable */
$_id 		= sprintf( 'bears-element-%s', $atts['element_id'] );
$_class 	= sprintf( 'bs-carousel-layout-%s %s', str_replace( '.php', '', $atts['template_params']['template'] ), $atts['class'] );
$loop 		= $atts['posts'];
$atts['template_params']['gallery_ids'] = explode( ',', $atts['template_params']['gallery_ids'] );
$_opts_carousel = array(
	'items' 			=> (int) $atts['items'],
	'stagePadding' 		=> (int) $atts['stagepadding'],
	'loop' 				=> (int) $atts['loop'],
	'margin'	 		=> (int) $atts['margin'],
	'nav' 				=> ( (int) $atts['nav'] ) ? true : false,
	'dots' 				=> ( (int) $atts['dots'] ) ? true : false,
	'autoplay'			=> ( (int) $atts['autoplay'] ) ? true : false,
	'autoplayTimeout' 	=> (int) $atts['autoplaytimeout'],
	'autoplayHoverPause' => ( (int) $atts['autoplayhoverpause'] ) ? true : false, );

/* set responsive */
if( ! empty( $atts['responsive'] ) ) : 
	$responsive_data = explode( ',', $atts['responsive'] );
	$responsive_arr = array();	
	foreach( $responsive_data as $resItem ) : 
		list( $size, $item ) = explode( ':', $resItem );
		$responsive_arr[$size] = array( 'items' => (int) $item );
	endforeach;
	$_opts_carousel['responsive'] = $responsive_arr;
endif;

if( ! function_exists( 'bearsthemes_carouselGallery_default' ) ) :
	function bearsthemes_carouselGallery_default( $atts )
	{
		$template_params = $atts['template_params'];
		$gallery_ids = $template_params['gallery_ids'];
		$output = "";

		if( count( $gallery_ids ) > 0 ) :
			foreach( $gallery_ids as $gallery_id ) :
				$image_data = wp_get_attachment_image_src( (int) $gallery_id, $template_params['image_size'] );
				$src = $image_data[0];

				$output .= "
				<div class='item'>
					<div class='item-inner' style='background: url({$src}) no-repeat center center / cover, #fafafa; height: {$template_params['height']}'>
						
					</div>
				</div>";
			endforeach;
		endif;

		return $output;
	}
endif;
?>
<div id="<?php echo esc_attr( $_id ) ?>" class="bs-carousel <?php echo esc_attr( $_class ); ?>">
	<div class="bs-carousel-container owl-carousel" data-bs-courousel-owl='<?php echo esc_attr( json_encode( $_opts_carousel ) ); ?>'>
		<?php 
		echo call_user_func_array( 'bearsthemes_carouselGallery_' . $atts['template_params']['layout_item'], array( $atts ) );
		?>
	</div>
</div>