<?php
$currency = apply_filters('tb_currency', TBDonationsPageSetting::$currency);
$tb_currency = get_option('tb_currency', 'USD');
$symbol_position = get_option('symbol_position', 0);
$symbol = $currency[$tb_currency]['symbol'];

if( $atts['goal_total'] != '' && $atts['raised_total'] != '' ){
	$raised_total = $atts['raised_total'];
	$goal_total = $atts['goal_total'];
	$width = '100';
	if($raised_total < $goal_total){
		$width = round($raised_total*100/$goal_total, 2);
	}
	
	if($symbol_position != 1):
		$goal_total = $symbol.number_format($goal_total);
	else:
		$goal_total = number_format($goal_total).$symbol;				
	endif;

	if($symbol_position != 1):
		$raised_total = $symbol.number_format($raised_total);
	else:
		$raised_total = number_format($raised_total).$symbol;				
	endif;
}else{

	$goal_total = $raised_total = 0;
	?>
	<?php 
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
		$goal_total = $symbol.number_format($goal_total);
	else:
		$goal_total = number_format($goal_total).$symbol;				
	endif;

	if($symbol_position != 1):
		$raised_total = $symbol.number_format($raised_total);
	else:
		$raised_total = number_format($raised_total).$symbol;				
	endif;
}
?>
<div class="tb-donation-total <?php echo $el_class;?>">
	<h3 class="bt-goal"><?php _e('DONATION GOAL', TBDONS) ?> <br><span class="bt-goal-total"><?php echo $goal_total; ?></span></h3>
	<div class="donation-progress-bar">
		<div class="donation-bar">
			<span style="width: <?php echo esc_attr($width); ?>%"></span>
		</div>
		<div class="donation-label"><?php echo esc_attr($width); ?>%</div>
	</div>
	<h4 class="bt-raised"><?php _e('RAISED:', TBDONS) ?> <span class="bt-raised-total"><?php echo $raised_total; ?></span></h4>
</div>

