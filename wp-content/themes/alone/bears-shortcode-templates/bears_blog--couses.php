<?php
/*
 * Layout Name: Couses
 * Author: Bearsthemes
 * Author URI: http://themebears.com
 * Param: tbbs_BearsBlogCousesParams
 */

# variable
$_id 		= sprintf( 'bears-element-%s', $atts['element_id'] );
$_class 	= sprintf( 'bs-blog layout-%s %s', str_replace( '.php', '', $atts['template_params']['template'] ), $atts['class'] );
$loop 		= $atts['posts'];
$atts['columns_item'] = 12 / (int) $atts['template_params']['columns'];

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
 * bearsthemes_blogCouses_default
 *
 */
if( ! function_exists( 'bearsthemes_blogCouses_default' ) ) :
	function bearsthemes_blogCouses_default( $atts, $data )
	{
		global $post;
		extract( $data );
		extract( $atts['donation_data'] );

		if( $symbol_position != 1 ) {
			$raised_item = $symbol.number_format( $result['raised'] );
			$goal_item = $symbol.number_format( $goal );
		} else {
			$raised_item = number_format( $result['raised'] ) . $symbol;	
			$goal_item = number_format( $goal ) . $symbol;
		}

		$days_left = ( (int) $days_left <= 0 ) ? 0 : $days_left;

		$output = "
		<div class='blog-item col-md-{$atts['columns_item']}'>
			<div class='blog-inner'>
				<div class='thumb-meta' style='background: url({$thumbnail}) no-repeat center center / cover, #999'>
					<div class='days-left-meta'>{$days_left} ". __( 'Days left', 'bearsthemes' ) ."</div>
				</div>
				<div class='info-meta'>
					<a href='{$link}' title='{$title}'><h4 class='title'>{$title}</h4></a>
					<div class='donate-meta'>
						<div class='goal-process'>
							<span class='raised'>{$raised_item}</span>". __( ' Raised of ', 'bearsthemes' ) ."
							<span class='goal'>{$goal_item}</span>". __(' Goal', 'bearsthemes') ."
						</div>
					</div>
					<div class='money-process-bar-wrap'>
						<div class='current-percent'>{$width}%</div>
						<div class='money-process-bar' style='width: {$width}%'></div>
					</div>
				</div>
			</div>
		</div>";

		return $output;
	}
endif;
?>
<div id="<?php echo esc_attr( $_id ) ?>" class="<?php echo esc_attr( $_class ); ?>">
	<div class="bs-blog-container">
		<div class="row">
			<?php
			while( $loop->have_posts() ) : 
				$loop->the_post();

				/* thumbnail */
				$thumbnail = '';
				if( has_post_thumbnail() ):
	                $thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
	            	$thumbnail = $thumbnail_data[0];
	            endif;

	            /* title */
	            $title = get_the_title();

	            /* content */
	            $content = wp_trim_words( get_the_content(), 20, '...' );

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
	            	'days_left'		=> $days_left,
	            	'width'			=> $width,
	            	);

				echo call_user_func_array( 'bearsthemes_blogCouses_' . $atts['template_params']['layout_item'], array( $atts, $data ) );
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>
</div>