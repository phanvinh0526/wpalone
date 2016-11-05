<?php
/*
 * Layout Name: Causes
 * Author: Bearsthemes
 * Author URI: http://themebears.com
 * Param: tbbs_BearsCarouselCausesParams
 */

/* define variable */
$_id 		= sprintf( 'bears-element-%s', $atts['element_id'] );
$_class 	= sprintf( 'bs-carousel-layout-%s %s layout-%s', str_replace( '.php', '', $atts['template_params']['template'] ), $atts['class'], $atts['template_params']['layout_item'] );
$loop 		= $atts['posts'];
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

/* donation data */
$currency = apply_filters('tb_currency', TBDonationsPageSetting::$currency);
$tb_currency = get_option('tb_currency', 'USD');
$symbol_position = get_option('symbol_position', 0);
$symbol = $currency[$tb_currency]['symbol'];
$atts['donation_data'] = array(
	'currency' => $currency,
	'tb_currency' => $tb_currency,
	'symbol_position' => $symbol_position,
	'symbol' => $symbol );

/**
 * bearsthemes_carouselCauses_urgent
 *
 */
if( ! function_exists( 'bearsthemes_carouselCauses_urgent' ) ) :
	function bearsthemes_carouselCauses_urgent( $atts, $data )
	{	
		global $post;
		extract( $data );
		extract( $atts['donation_data'] );

		# variable 
		$tbdonations_location = get_post_meta( $post->ID, 'tbdonations_location', true );

		if( $symbol_position != 1 ) {
			$raised_item = $symbol.number_format( $result['raised'] );
			$goal_item = $symbol.number_format( $goal );
		} else {
			$raised_item = number_format( $result['raised'] ) . $symbol;	
			$goal_item = number_format( $goal ) . $symbol;
		}

		$output = "
		<div class='col-md-12'>
			<div class='item-inner' style='background: url({$thumbnail}) no-repeat center center / cover, #333;'>
				<div class='row'>
					<div class='col-md-7 col-md-offset-1 text-left'>
						<div class='info-meta'>
							<div class='urgent-text'>". __( 'Urgently Needed Donation', 'bearsthemes' ) ."</div>
							<a href='{$link}' title='{$tbdonations_location}: {$title}'><h4 class='title'>{$tbdonations_location}: {$title}</h4></a>
							<p class='short-content'>{$content}</p>
						</div>
					</div>
					<div class='col-md-4 text-center'>
						<div class='donate-meta'>
							<div class='goal-process'>
								<span class='raised'>{$raised_item}</span>". __( ' Raised of ', 'bearsthemes' ) ."
								<span class='goal'>{$goal_item}</span>". __(' Goal', 'bearsthemes') ."
							</div>
							<a class='donate-now-btn' href='{$link}'>". __( 'Donation Now', 'bearsthemes' ) ."</a>
						</div>
					</div>
				</div>
			</div>
		</div>";

		return $output;
	}
endif;

/**
 * bearsthemes_carouselCauses_urgent
 *
 */
if( ! function_exists( 'bearsthemes_carouselCauses_default' ) ) :
	function bearsthemes_carouselCauses_default( $atts, $data )
	{	
		global $post;
		extract( $data );
		extract( $atts['donation_data'] );

		# variable 
		$tbdonations_location = get_post_meta( $post->ID, 'tbdonations_location', true );

		if( $symbol_position != 1 ) {
			$raised_item = $symbol.number_format( $result['raised'] );
			$goal_item = $symbol.number_format( $goal );
		} else {
			$raised_item = number_format( $result['raised'] ) . $symbol;	
			$goal_item = number_format( $goal ) . $symbol;
		}

		$output = "
		<div class='col-md-12'>
			<div class='item-inner' style='background: url({$thumbnail}) no-repeat center center / cover, #333;'>
				<div class='row'>
					<div class='col-md-7 col-md-offset-1 text-left'>
						<div class='info-meta'>
							<a href='{$link}' title='{$tbdonations_location}: {$title}'><h4 class='title'>{$tbdonations_location}: {$title}</h4></a>
							<p class='short-content'>{$content}</p>
						</div>
					</div>
					<div class='col-md-4 text-center'>
						<div class='donate-meta'>
							<div class='goal-process'>
								<span class='raised'>{$raised_item}</span>". __( ' Raised of ', 'bearsthemes' ) ."
								<span class='goal'>{$goal_item}</span>". __(' Goal', 'bearsthemes') ."
							</div>
							<a class='donate-now-btn' href='{$link}'>". __( 'Donation Now', 'bearsthemes' ) ."</a>
						</div>
					</div>
				</div>
			</div>
		</div>";

		return $output;
	}
endif;

if( ! function_exists( 'bearsthemes_carouselCauses_basic' ) ) :
	function bearsthemes_carouselCauses_basic( $atts, $data ) 
	{
		global $post;
		extract( $data );
		extract( $atts['donation_data'] );

		# variable 
		$tbdonations_location = get_post_meta( $post->ID, 'tbdonations_location', true );
		$color_arr = array(
			'white' => array( '#ffffff' ), 
			'black' => array( '#222222' ) );

		$color = $color_arr[$atts['template_params']['color']];

		if( $symbol_position != 1 ) {
			$raised_item = $symbol.number_format( $result['raised'] );
			$goal_item = $symbol.number_format( $goal );
		} else {
			$raised_item = number_format( $result['raised'] ) . $symbol;	
			$goal_item = number_format( $goal ) . $symbol;
		}

		$days_left_str = sprintf( '%s Day%s Left', $days_left, ( (int) $days_left ) > 1 ? 's' : '' );


		$output = "
		<div class='item-inner'>
			<div class='thumb-meta' style='background: url({$thumbnail}) no-repeat center center / cover, #333;'>
				<a class='view-detail-meta' href='{$link}'><i class='ion-ios-search-strong'></i></a>
			</div>
			<div class='info-meta'>
				<div class='date-left-meta'>{$days_left_str}</div>
				<a href='{$link}' title='{$title}'><h4 class='title' style='color: {$color[0]};'>{$title}</h4></a>
				<div class='goal-process' style='color: {$color[0]};'>
					<span class='raised'>{$raised_item}</span>". __( ' Raised of ', 'bearsthemes' ) ."
					<span class='goal'>{$goal_item}</span>". __(' Goal', 'bearsthemes') ."
				</div>
			</div>
		</div>";

		return $output;
	}
endif;
?>
<div id="<?php echo esc_attr( $_id ) ?>" class="bs-carousel <?php echo esc_attr( $_class ); ?>">
	<div class="bs-carousel-container owl-carousel" data-bs-courousel-owl='<?php echo esc_attr( json_encode( $_opts_carousel ) ); ?>'>
		<?php
		while( $loop->have_posts() ) : 
			$loop->the_post();

			/* thumbnail */
			$thumbnail = '';
			if( has_post_thumbnail() ):
                $thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
            	$thumbnail = $thumbnail_data[0];
            endif;

            /* title */
            $title = get_the_title();

            /* content */
            $content = wp_trim_words( get_the_content(), (int) $atts['template_params']['trims_description'], '...' );

            $result = apply_filters( 'tb_getmetadonors', get_the_ID() );
			$goal = get_post_meta( get_the_ID(), 'tbdonations_goals', true );
			$tbdonations_location = get_post_meta( get_the_ID(), 'tbdonations_location', true );
			$current_date = current_time( 'Y/m/d H:s' );
			$start_date = get_the_date( 'Y/m/d H:s', get_the_ID() );
			if( strtotime( $start_date ) < strtotime( $current_date ) ) $start_date = $current_date;
			$end_date = get_post_meta( get_the_ID(), 'tbdonations_endday', true );
			$days_left = round( (strtotime( $end_date ) - strtotime( $start_date ) ) / 86400 );
			$width = '100';
			if( $result['raised'] < $goal ){ $width = round( $result['raised'] * 100 / $goal, 2 ); }

            $data = array(
            	'thumbnail' 	=> $thumbnail,
            	'title' 		=> $title,
            	'content' 		=> $content,
            	'link' 			=> get_the_permalink(),
            	'result'		=> $result,
            	'goal'			=> $goal,
            	'width'			=> $width,
            	'days_left'		=> $days_left,
            	);

			$content_item = call_user_func_array( 'bearsthemes_carouselCauses_' . $atts['template_params']['layout_item'], array( $atts, $data ) );
			echo sprintf( '<div class="item">%s</div>', $content_item );
		endwhile;
		wp_reset_postdata();
		?>
	</div>
</div>
