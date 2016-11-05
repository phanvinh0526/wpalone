<?php 
/* variable */	
list( $template_name ) = explode( '.', $atts['template'] );
$lemongrid_options = json_encode( array(
	'cell_height'		=> (int) $atts['cell_height'],
	'vertical_margin'	=> (int) $atts['space'],
	'animate'			=> true,
	) );

/**
 * lgItemPostTemp
 *
 * @param array $atts
 * @return HTML
 */
if( ! function_exists( 'lgItemPostTemp' ) ) :
	function lgItemPostTemp( $atts )
	{
		$output = '';
		// $grid = lgGetLayoutLemonGridPerPage( get_the_ID(), $atts['element_id'], count( $atts['posts']->posts ) );
		$grid = lbGetLemonGridLayouts( $atts['element_id'], count( $atts['posts']->posts ) ); /* v1.1 */
		$posts = $atts['posts'];
		$k = 0;
		
		$currency = apply_filters('tb_currency', TBDonationsPageSetting::$currency);
		$tb_currency = get_option('tb_currency', 'USD');
		$symbol_position = get_option('symbol_position', 0);
		$symbol = $currency[$tb_currency]['symbol'];

		while( $posts->have_posts() ) : 
			$posts->the_post();
			
			$result = apply_filters('tb_getmetadonors', get_the_ID());
			$goal = get_post_meta(get_the_ID(),'tbdonations_goals',true);
			$tbdonations_location = get_post_meta(get_the_ID(), 'tbdonations_location', true);

			if( has_post_thumbnail() ):
                $thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
            	$thumbnail = $thumbnail_data[0];
            else:
                $thumbnail = '';
            endif;
			$style = implode( ';', array( 
				"background: url({$thumbnail}) no-repeat center center / cover, #333", 
				) );

			/**
			 * Title
			 */
			$_title = '<h2 class=\'title\' title=\''. get_the_title() .'\'><a href="'.get_the_permalink().'">'. get_the_title() .'</a></h2>';

			/**
			 * Data
			 */
			$_date = '<p class=\'date\'>'. get_the_date( 'M d Y' ) .'</p>';

			$_location = '<div class="lemongrid-location"><span>'.__('in', 'bearsthemes').'</span>'.$tbdonations_location.'</div>';
			
			if($symbol_position != 1) {
				$_donation_so_far = '<div class="donation-so-far">'.__('Donation So Far: ', 'bearsthemes').'<span>'.$symbol.number_format($goal - $result['raised']).'</span></div>';
			} else {
				$_donation_so_far = '<div class="donation-so-far">'.__('Donation So Far: ', 'bearsthemes').'<span>'.number_format($goal - $result['raised']).$symbol.'</span></div>';
			}
			
			$_donation_btn = '<a class="donation-btn" title="'. get_the_title() .'" href="'. get_permalink() .'"><i class="fa fa-heart"></i> '.__('Donate Now', 'bearsthemes').'</a>';
			
			$info = '
			<div class=\'lemongrid-info\'>
				<div class=\'info-text\'>
					'. $_title .'
					'. $_donation_so_far .'
					'. $_donation_btn .'
				</div>
			</div>';

			$output .= '
				<div class=\'lemongrid-item lg-animate-fadein grid-stack-item\' data-gs-x=\''. esc_attr( $grid[$k]['x'] ) .'\' data-gs-y=\''. esc_attr( $grid[$k]['y'] ) .'\' data-gs-width=\''. esc_attr( $grid[$k]['w'] ) .'\' data-gs-height=\''. esc_attr( $grid[$k]['h'] ) .'\'>
					<div class=\'grid-stack-item-content\' style=\''. esc_attr( $style ) .'\'>
						<div class="lemongrid-overlay"></div>
						'.$_location. $info .'
					</div>
				</div>';

			$k += 1;
		endwhile;

		wp_reset_postdata();

		return $output;
	}
endif;
?>
<div class="lemongrid-wrap <?php echo esc_attr( $atts['class_id'] ); ?> lemongrid--element <?php echo esc_attr( $template_name ) ?> <?php echo esc_attr( $atts['class'] ); ?>">
	<?php echo apply_filters( 'lemongrid_toolbar_frontend', lgToolbarFrontend( array( 'atts' => $atts ) ), array() ); ?>
	<?php echo apply_filters( 'lemongrid_before_content', '', array() ); ?>
	<div class="lemongrid-inner grid-stack" data-lemongrid-options="<?php echo esc_attr( $lemongrid_options ); ?>">
		<?php 
		if( isset( $atts['posts']->posts ) && ( count( $atts['posts']->posts ) > 0 ) ) :
			echo call_user_func( 'lgItemPostTemp', $atts );
		else :
			_e( '...', 'bearsthemes' );
		endif;
		?>
	</div>
	<?php echo apply_filters( 'lemongrid_after_content', '', array() ); ?>
</div>