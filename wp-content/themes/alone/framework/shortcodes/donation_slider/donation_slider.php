<?php
function bearstheme_donation_slider_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'el_class' => '',
        'tpl' => '',
        'category' => '',
		'posts_per_page' => -1,
		'orderby' => 'none',
        'order' => 'none',
		'show_title' => 0,
		'show_meta' => 0,
		'excerpt_lenght' => 24,
        'excerpt_more' => '.',
		'show_progress_bar' => 0,
		'show_donation_money' => 0,
		'view_detail_text' => 'Donation Now',
    ), $atts));
	
    $class = array();
    $class[] = 'tbdonations_slider_wrap clearfix';
    $class[] = $tpl;
    $class[] = $el_class;
	
	ob_start();
	$paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
	$args = array(
	'posts_per_page' => $posts_per_page,
	'orderby' => $orderby,
	'order' => $order,
	'paged' => $paged,
	'post_type' => 'tbdonations',
	'post_status' => 'publish');
	if (isset($category) && $category != '') {
		$cats = explode(',', $category);
		$category = array();
		foreach ((array) $cats as $cat) :
		$category[] = trim($cat);
		endforeach;
		$args['tax_query'] = array(
								array(
									'taxonomy' => 'tbdonationcategory',
									'field' => 'id',
									'terms' => $category
								)
						);
	}
	$wp_query = new WP_Query($args);
	
	$currency = apply_filters('tb_currency', TBDonationsPageSetting::$currency);
	$tb_currency = get_option('tb_currency', 'USD');
	$symbol_position = get_option('symbol_position', 0);
	$symbol = $currency[$tb_currency]['symbol'];
	
    ob_start();
	if ( $wp_query->have_posts() ) {
    ?>
	<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
		<div class="owl-carousel">
			<?php 
				while ($wp_query->have_posts()) { $wp_query->the_post();
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
							<?php if($show_meta) { ?>
								<ul class="donate-meta">
									<li class="bt-author"><?php echo '<i class="fa fa-user"></i>'.__('By ', 'bearsthemes').'<span>'.get_the_author().'</span>'; ?></li>
									<li class="bt-location"><?php echo '<i class="fa fa-map-marker"></i>'.__('Cause in ', 'bearsthemes').'<span>'.get_post_meta(get_the_ID(), 'tbdonations_location', true).'</span>'; ?></li>
								</ul>
							<?php } ?>
							<?php if($show_title) { ?>
								<h3 class="donation-title bt-text-ellipsis">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
							<?php } ?>
							
							<div class="donation-excerpt"><?php echo bearstheme_custom_excerpt($excerpt_lenght, $excerpt_more); ?></div>
							
							<a class="donate-now-btn" href="<?php the_permalink(); ?>"><i class="fa fa-heart"></i> <?php echo '<span>'.$view_detail_text.'</span>'; ?></a>
							
							<?php if($show_progress_bar) { ?>
								<div class="donation-progress-bar">
									<div class="donation-bar">
										<span style="width: <?php echo esc_attr($width);?>%;"></span>
									</div>
									<div class="donation-label"><?php echo $width.'%' ?></div>
								</div>
							<?php } ?>
							
							<?php if($show_donation_money) { ?>
								<div class="donation-money">
									<?php
									if($symbol_position != 1) {
										$raised_item = $symbol.number_format($result['raised']);
										$goal_item = $symbol.number_format($goal);
									} else {
										$raised_item = number_format($result['raised']).$symbol;	
										$goal_item = number_format($goal).$symbol;
									}
									echo '<span class="raised">'.$raised_item.'</span>'.__(' Raised of ', 'bearsthemes').'<span class="goal">'.$goal_item.'</span>'.__(' Goal', 'bearsthemes');
									?>
								</div>
							<?php } ?>
							
						</div>
					</article>
					<?php
				}
				wp_reset_query();
			?>
		</div>
	</div>
    <?php
	} else {
		echo 'No Result!';
	}
	wp_reset_postdata();
    return ob_get_clean();
}

if(function_exists('bcore_shortcode')) { bcore_shortcode('donation_slider', 'bearstheme_donation_slider_func'); }
