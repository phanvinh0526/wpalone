<?php
/**
 * Layout Name: Filter Alone
 * Author: Bearsthemes
 * Author URI: http://themebears.com
 */

# variable
list( $template_name ) = explode( '.', $atts['template'] );
$lemongrid_options = json_encode( array(
	'cell_height'		=> (int) $atts['cell_height'],
	'vertical_margin'	=> (int) $atts['space'],
	'animate'			=> true,
	) );

/**
 * bearsthemes_ItemPostTeamTemp
 *
 * @param [array] $atts
 * @return [html] $output
 */
if( ! function_exists( 'bearsthemes_ItemPostTeamTemp' ) ) :
	function bearsthemes_ItemPostTeamTemp( $atts )
	{
		$output = '';
		$grid = lbGetLemonGridLayouts( $atts['element_id'], count( $atts['posts']->posts ) ); /* v1.1 */
		$posts = $atts['posts'];
		$k = 0;

		while( $posts->have_posts() ) : 
			$posts->the_post();

			$thumbnail = '';
			if( has_post_thumbnail() ):
                $thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium_large' );
            	$thumbnail = $thumbnail_data[0];
            endif;
			$style = implode( ';', array( 
				"background: url({$thumbnail}) no-repeat center center / cover, #333", 
				) );

			# title
			$title = get_the_title();
			# link
			$link = get_permalink();
			# content
			$content = get_the_content();
			# social
			$infoTeam = array(
				'team_position' => get_post_meta( get_the_ID(), 'tb_team_position', true ),
				'team_phone' => get_post_meta( get_the_ID(), 'tb_team_phone', true ),
				'team_twitter' => get_post_meta( get_the_ID(), 'tb_team_twitter', true ),
				'team_google' => get_post_meta( get_the_ID(), 'tb_team_google', true ),
				'team_facebook' => get_post_meta( get_the_ID(), 'tb_team_facebook', true ),
				);

			$info = "
			<div class='lemongrid-info'>
				<div class='info-text text-center'>
					<h4 class='title'>$title</h4>
					<div class='position-meta'>{$infoTeam['team_position']}</div>
					<p class='text-meta'>{$content}</p>
					<div class='social-meta'>
						<a href='{$infoTeam['team_twitter']}' class='s-tw'><i class='ion-social-twitter'></i></a>
						<a href='{$infoTeam['team_google']}' class='s-g'><i class='ion-social-googleplus-outline'></i></a>
						<a href='{$infoTeam['team_facebook']}' class='s-fb'><i class='ion-social-facebook'></i></a>
					</div>
				</div>
			</div>";

			$output .= '
				<div class=\'lemongrid-item lg-animate-fadein grid-stack-item\' data-gs-x=\''. esc_attr( $grid[$k]['x'] ) .'\' data-gs-y=\''. esc_attr( $grid[$k]['y'] ) .'\' data-gs-width=\''. esc_attr( $grid[$k]['w'] ) .'\' data-gs-height=\''. esc_attr( $grid[$k]['h'] ) .'\'>
					<div class=\'grid-stack-item-content\' style=\''. esc_attr( $style ) .'\'>
						'. $info .'
					</div>
				</div>';

			$k += 1;
		endwhile;

		wp_reset_postdata();

		return $output;
	}
endif;
?>
<div class="lemongrid-wrap <?php esc_attr_e( $atts['class_id'] ); ?> lemongrid--element <?php esc_attr_e( $template_name ) ?> <?php esc_attr_e( $atts['class'] ); ?>">
	<?php echo apply_filters( 'lemongrid_toolbar_frontend', lgToolbarFrontend( array( 'atts' => $atts ) ), array() ); ?>
	<?php echo apply_filters( 'lemongrid_before_content', '', array() ); ?>
	<div class="lemongrid-inner grid-stack" data-lemongrid-options="<?php esc_attr_e( $lemongrid_options ); ?>">
		<?php 
		if( isset( $atts['posts']->posts ) && ( count( $atts['posts']->posts ) > 0 ) ) :
			_e( call_user_func( 'bearsthemes_ItemPostTeamTemp', $atts ) );
		else :
			_e( '...', TBLG_NAME );
		endif;
		?>
	</div>
	<?php echo apply_filters( 'lemongrid_after_content', '', array() ); ?>
</div>