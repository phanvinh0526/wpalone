<?php
function bearsthemes_donation_upcoming_render($atts, $content = null) {			
	extract(shortcode_atts(array(
		'el_class'          	=> '',
	), $atts));
	ob_start();
	$args = array(
	'posts_per_page' => 1,
	'orderby' => 'date',
	'order' => 'ASC',
	'post_type' => 'tbdonations',
	'post_status' => 'future');
	$wp_query = new WP_Query($args);
	
	$currency = apply_filters('tb_currency', TBDonationsPageSetting::$currency);
	$tb_currency = get_option('tb_currency', 'USD');
	$symbol_position = get_option('symbol_position', 0);
	$symbol = $currency[$tb_currency]['symbol'];
?>
<?php if ( $wp_query->have_posts() ): ?>
	<div class="tbdonations_upcoming <?php echo $el_class;?>">
			<?php 
				while ($wp_query->have_posts()) : $wp_query->the_post();
					$goal = get_post_meta(get_the_ID(),'tbdonations_goals',true);
					$tbdonations_location = get_post_meta(get_the_ID(), 'tbdonations_location', true);
					$current_date = current_time('Y/m/d H:s');
					$start_date = get_the_date('Y/m/d H:s', get_the_ID());
					$end_date = get_post_meta(get_the_ID(),'tbdonations_endday',true);
					$count_date = strtotime($start_date) - strtotime($current_date);
					if($symbol_position != 1) {
						$goal_item = $symbol.number_format($goal);
					} else {
						$goal_item = number_format($goal).$symbol;
					}
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="donation-item">
					<div class="row">
						<div class="col-md-6">
							<div class="bt-content">
								<ul class="bt-meta">
									<li class="bt-location"><?php echo '<i class="fa fa-map-marker"></i><span>'.__('IN ', 'bearsthemes').$tbdonations_location.'</span>'; ?></li>
									<li class="bt-time"><?php echo '<i class="fa fa-calendar"></i>'.__('At ', 'bearsthemes').get_the_date('g:i a', get_the_ID()). ' - '.date_format(date_create($end_date),'g:i a'); ?></li>
								</ul>
								<h3 class="bt-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<div class="bt-so-far"><?php _e('Donation So Far: ', 'bearsthemes'); ?><span><?php echo $goal_item; ?></span></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="bt-counting">
								<?php echo do_shortcode('[countdown date_end="+0o +0d +0h +0m +'.$count_date.'s "]'); ?>
							</div>
						</div>
					</div>
				</div>
			</article>
	<?php
		endwhile;
		wp_reset_query();
	else: 
			echo 'No Result!';
	endif; ?>
<?php
	wp_reset_postdata();
	return ob_get_clean();
}
if(function_exists('bcore_shortcode')) { bcore_shortcode('donation_upcoming', 'bearsthemes_donation_upcoming_render'); }
