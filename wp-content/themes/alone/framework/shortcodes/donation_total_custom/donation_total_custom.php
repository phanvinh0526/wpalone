<?php
function bearstheme_donation_total_custom_func($atts, $content = null) {
    extract(shortcode_atts(array(
		'el_class'          => '',
	), $atts));
	ob_start();
	$args = array(
	'posts_per_page' => -1,
	'post_type' => 'tbdonations',
	'post_status' => 'publish');
	$wp_query = new WP_Query($args);
	
	$currency = apply_filters('tb_currency', TBDonationsPageSetting::$currency);
	$tb_currency = get_option('tb_currency', 'USD');
	$symbol_position = get_option('symbol_position', 0);
	$symbol = $currency[$tb_currency]['symbol'];
	$goal_total = $raised_total = 0;
	
	if ( $wp_query->have_posts() ):
		while ($wp_query->have_posts()) : $wp_query->the_post();
			$result = apply_filters('tb_getmetadonors', get_the_ID());
			$goal_total = $goal_total + get_post_meta(get_the_ID(),'tbdonations_goals',true);
			$raised_total = $raised_total + $result['raised'];
		endwhile;
		wp_reset_query();
	endif;

	$width = '100';
	if($raised_total < $goal_total){
		$width = round($raised_total*100/$goal_total, 2);
	}

	if($symbol_position != 1):
		$raised_total = $symbol.number_format($raised_total);
	else:
		$raised_total = number_format($raised_total).$symbol;				
	endif;
	?>
	<div class="tb-donation-total-2 <?php echo $el_class;?>">
		<ul>
			<li><?php echo __('TOTAL: ', 'bearsthemes').number_format($goal_total); ?></li>
			<li><?php echo __('RAISED: ', 'bearsthemes').$raised_total; ?></li>
			<li><?php echo __('DONATE: ', 'bearsthemes').number_format($goal_total - $raised_total); ?></li>
		</ul>
		<div class="donation-bottom">
			<div class="donation-progress-bar">
				<div class="donation-bar" style="width: <?php echo esc_attr($width); ?>%"></div>
				<div class="donation-label"><div class="percent"><?php echo esc_attr($width); ?><span class="unit">%</span></div><?php _e('DONATED', 'bearsthemes'); ?></div>
			</div>
			<a href="#" data-target="#site_donate_form0" data-toggle="modal"><?php _e('DONATE NOW', 'bearsthemes'); ?></a>
		</div>
	</div>
	<?php
	wp_reset_postdata();
	return ob_get_clean();
}

if(function_exists('bcore_shortcode')) { bcore_shortcode('donation_total_custom', 'bearstheme_donation_total_custom_func'); }
