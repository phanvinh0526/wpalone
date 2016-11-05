<?php
class Bearstheme_Recent_Donation_Widget extends Bearstheme_Widget {
	function __construct() {
		parent::__construct(
			'bt_recent_donation', // Base ID
			__('Recent Donation', 'bearsthemes'), // Name
			array('description' => __('Display a new post of your posts on your site.', 'bearsthemes'),) // Args
        );
		
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Recent Donation', 'bearsthemes' ),
				'label' => __( 'Title', 'bearsthemes' )
			),
			'el_class'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Extra Class', 'bearsthemes' )
			)
		);
		add_action('admin_enqueue_scripts', array($this, 'widget_scripts'));
	}
        
	function widget_scripts() {
		wp_enqueue_script('widget_scripts', URI_PATH . '/framework/widgets/widgets.js');
	}

	function widget( $args, $instance ) {

		ob_start();
		global $post;
		extract( $args );
                
		$title                  = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$el_class               = sanitize_title( $instance['el_class'] );
                
		echo ''.$before_widget;

		if ( $title )
				echo ''.$before_title . $title . $after_title;
		
		$query_args = array(
			'posts_per_page' => 1,
			'orderby' => 'date',
			'order' => 'DESC',
			'post_type' => 'tbdonations',
			'post_status' => 'publish');
		
		$wp_query = new WP_Query($query_args);   

		$currency = apply_filters('tb_currency', TBDonationsPageSetting::$currency);
		$tb_currency = get_option('tb_currency', 'USD');
		$symbol_position = get_option('symbol_position', 0);
		$symbol = $currency[$tb_currency]['symbol'];
		
		if ($wp_query->have_posts()){
			?>
			<div class="bt-recent-donation">
				<?php while ($wp_query->have_posts()){ $wp_query->the_post(); ?>
					<?php
						$result = apply_filters('tb_getmetadonors', get_the_ID());
						$goal = get_post_meta(get_the_ID(),'tbdonations_goals',true);
						$tbdonations_location = get_post_meta(get_the_ID(), 'tbdonations_location', true);
						$current_date = current_time('Y/m/d H:s');
						$start_date = get_the_date('Y/m/d H:s', get_the_ID());
						if(strtotime($start_date) < strtotime($current_date)) $start_date = $current_date;
						$end_date = get_post_meta(get_the_ID(),'tbdonations_endday',true);
						$days_left = round((strtotime($end_date) - strtotime($start_date))/86400);
						$width = '100';
						if($result['raised'] < $goal){
							$width = round($result['raised']*100/$goal, 2);
						}
					?>
					<article <?php post_class(); ?>>
						<div class="donation-item">
							<?php if (has_post_thumbnail()) { ?>
								<div class="donation-thumbnail">
									<?php
									$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
										$image_resize = mr_image_resize($attachment_image[0], 270, 345, true, false);
										echo '<img class="cropped" src="' . esc_url($image_resize) . '" alt="">';
									?>
									<div class="donation-overlay">
										<div class="donate-meta">
											<div class="donation-money">
												<?php
												if($symbol_position != 1) {
													$raised_item = $symbol.number_format($result['raised']);
													$goal_item = $symbol.number_format($goal);
												} else {
													$raised_item = number_format($result['raised']).$symbol;	
													$goal_item = number_format($goal).$symbol;
												}
												echo '<span class="raised">'.$raised_item.'</span><br>'.__(' Raised of ', 'bearsthemes').'<span class="goal">'.$goal_item.'</span>'.__(' Goal', 'bearsthemes');
												?>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
							<div class="donation-content">
								<div class="donation-progress-bar">
									<div class="donation-bar">
										<span style="width: <?php echo esc_attr($width);?>%;"></span>
									</div>
									<div class="donation-label"><?php echo $width.'%' ?></div>
								</div>
								<div class="donation-content-inner">
									<h3 class="donation-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>
									<div class="bt-location"><?php echo '<i class="fa fa-map-marker"></i>'.__('Cause in ', 'bearsthemes').'<span>'.$tbdonations_location.'</span>'; ?></div>
								</div>
							</div>
						</div>
					</article>
				<?php } ?>
			</div>
		<?php 
		}
		
		wp_reset_postdata();

		echo ''.$after_widget;
                
		$content = ob_get_clean();

		echo ''.$content;
		
	}
}
/* Class Bearstheme_Recent_Donation_Widget */
function bearstheme_recent_donation_widget() {
    register_widget('Bearstheme_Recent_Donation_Widget');
}

add_action('widgets_init', 'bearstheme_recent_donation_widget');
