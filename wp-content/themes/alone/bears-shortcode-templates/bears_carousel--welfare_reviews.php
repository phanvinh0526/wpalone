<?php
/*
 * Layout Name: Welfare Reviews
 * Author: Bearsthemes
 * Author URI: http://themebears.com
 * Param: tbbs_BearsCarouselWelfareReviewsParams
 */

$_id 		= sprintf( 'bears-element-%s', $atts['element_id'] );
$_class 	= sprintf( 'bs-carousel-layout-%s %s', str_replace( '.php', '', $atts['template_params']['template'] ), $atts['class'] );
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

$tbdonations_payment = bearsthemes_get_list_tbdonations_payment( 'DESC', (int) $atts['template_params']['count_items'] );
// print_r( $tbdonations_payment );

if( ! function_exists( 'bearsthemes_carouselWelfareReviews_default' ) ) : 
	function bearsthemes_carouselWelfareReviews_default( $atts, $items )
	{
		if( empty( $items ) || count( $items ) <= 0 ) return '...';

		$output = '';
		foreach( $items as $item ) :
			$name = sprintf( '%s %s', $item->firstname, $item->lastname );

			$date = date_create( $item->date );
			$date_donation = date_format( $date, 'd F, Y' );
			$amount = sprintf( '$%s', number_format( (int) $item->amount, 2, ',', ' ' ) );
			$avatar = get_avatar( $item->user_id );
			$text = ( empty( $atts['template_params']['trim_text'] ) || $atts['template_params']['trim_text'] == 'full' ) 
				? $atts['template_params']['trim_text']
				: wp_trim_words( $item->addition_notes, (int) $atts['template_params']['trim_text'] , '...' );

			$output .= "
				<div class='item'>
					<div class='row item-inner'>
						<div class='col-md-3 text-right'>
							<h4 class='name'>{$name}</h4>
							<div class='date'>{$date_donation}</div>
							<div class='amount'>". __( 'Donated : ', 'bearsthemes' ) ." <span class='price'>{$amount}</span></div>
						</div>
						<div class='col-md-2'>
							<div class='avatar-meta'>{$avatar}</div>
						</div>
						<div class='col-md-7'>
							<div class='text-wrap'>
								<div class='icon-wrap'><i class='ion-quote'></i></div>
								<p class='note-meta'>{$text}</p>
							</div>
						</div>
					</div>
				</div>";
		endforeach;
		
		return $output;
	}
endif;
?>
<div id="<?php echo esc_attr( $_id ) ?>" class="bs-carousel <?php echo esc_attr( $_class ); ?>">
	<div class="bs-carousel-container owl-carousel" data-bs-courousel-owl='<?php echo esc_attr( json_encode( $_opts_carousel ) ); ?>'>
		<?php
		echo call_user_func_array( 'bearsthemes_carouselWelfareReviews_' . $atts['template_params']['layout_item'], array( $atts, $tbdonations_payment ) );
		?>
	</div>
</div>