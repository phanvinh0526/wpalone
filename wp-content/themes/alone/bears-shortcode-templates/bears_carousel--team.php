<?php
/*
 * Layout Name: Team
 * Author: Bearsthemes
 * Author URI: http://themebears.com
 * Param: bearsthemes_BearsCarouselTeamParams
 */

/* define variable */
$_id 		= sprintf( 'bears-element-%s', $atts['element_id'] );
$_class 	= sprintf( 'bs-carousel temp-%s layout-%s %s', str_replace( '.php', '', $atts['template_params']['template'] ), $atts['template_params']['layout_item'], $atts['class'] );
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

/**
 * bearsthemes_carouselTeam_default
 *
 * @param [array] $atts
 * @param [array] $data
 * @return [html] $output
 */
if( ! function_exists( 'bearsthemes_carouselTeam_default' ) ) :
	function bearsthemes_carouselTeam_default( $atts, $data )
	{
		global $post;
		extract( $data );
		$template_params = $atts['template_params'];
		$team_position = get_post_meta( $post->ID, 'tb_team_position', true );
		$team_contact = array(
			'phone' 	=> get_post_meta( $post->ID, 'tb_team_phone', true ),
			'twitter'	=> get_post_meta( $post->ID, 'tb_team_twitter', true ),
			'google' 	=> get_post_meta( $post->ID, 'tb_team_google', true ),
			'facebook' 	=> get_post_meta( $post->ID, 'tb_team_facebook', true ),
			'email' 	=> get_post_meta( $post->ID, 'tb_team_email', true ) );

		# quickview
		$quickview_html = do_shortcode( "[bears_quickview title='". __( 'Info', 'bearsthemes' ) ."' layout='infoteam_default' pid='{$post->ID}' icon='ion-android-list']" ); 

		$output = "
		<div class='item-inner'>
			<div class='image-meta' style='background: url({$thumbnail}) no-repeat center center / cover, #fafafa; height: {$template_params['height']}'>
				{$quickview_html}
			</div>
			<div class='info-meta text-{$template_params['align']}'>
				<h5 class='title'>{$title}</h5>
				<p class='position'>{$team_position}</p>
				<p class='short-des'>{$content}</p>
			</div>
		</div>";

		return $output;
	}
endif;
?>
<div id="<?php echo esc_attr( $_id ) ?>" class="<?php echo esc_attr( $_class ); ?>">
	<div class="bs-carousel-container owl-carousel" data-bs-courousel-owl='<?php echo esc_attr( json_encode( $_opts_carousel ) ); ?>'>
		<?php
		while( $loop->have_posts() ) : 
			$loop->the_post();

			/* thumbnail */
			$thumbnail = '';
			if( has_post_thumbnail() ):
                $thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $atts['template_params']['image_size'] );
            	$thumbnail = $thumbnail_data[0];
            endif;

            /* title */
            $title = get_the_title();

            /* content */
            $content = wp_trim_words( get_the_content(), (int) 9, '...' );

            $data = array(
            	'thumbnail' 	=> $thumbnail,
            	'title' 		=> $title,
            	'content' 		=> $content,
            	'link' 			=> get_the_permalink(),
            	);

			$content_item = call_user_func_array( 'bearsthemes_carouselTeam_' . $atts['template_params']['layout_item'], array( $atts, $data ) );
			echo sprintf( '<div class="item">%s</div>', $content_item );
		endwhile;
		wp_reset_postdata();
		?>
	</div>
</div>
