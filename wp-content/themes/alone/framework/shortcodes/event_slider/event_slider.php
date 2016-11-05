<?php
function bearsthemes_event_slider_render($atts, $content = null) {			
	extract(shortcode_atts(array(
		'el_class'          	=> '',
		'category'          	=> '',
		'posts_per_page'    	=> '-1',
		'order'             	=> 'none',
		'orderby'           	=> 'none',
		'show_title'      		=> 0,
		'show_days_left'    	=> 0,
		'show_meta'    			=> 0,
		'show_excerpt'    		=> 0,
		'excerpt_lenght' 		=> 25,
        'excerpt_more' 			=> '.',
        'view_all_text' 		=> 'VIEW OUR CALENDAR',
        'view_all_link' 		=> '#',
		
	), $atts));
	
	ob_start();
	$view_all_link = ($view_all_link != '#') ? $view_all_link : tribe_get_events_link();
	
	$paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
	$args = array(
	'posts_per_page' => $posts_per_page,
	'orderby' => $orderby,
	'order' => $order,
	'paged' => $paged,
	'post_type' => 'tribe_events',
	'post_status' => 'publish');
	if (isset($category) && $category != '') {
		$cats = explode(',', $category);
		$category = array();
		foreach ((array) $cats as $cat) :
		$category[] = trim($cat);
		endforeach;
		$args['tax_query'] = array(
								array(
									'taxonomy' => 'tribe_events_cat',
									'field' => 'id',
									'terms' => $category
								)
						);
	}
	$wp_query = new WP_Query($args);
	
?>
<?php if ( $wp_query->have_posts() ): ?>
	<div class="bt-events_slider <?php echo $el_class;?>">
		<div class="owl-carousel">
			<?php while ($wp_query->have_posts()) : $wp_query->the_post(); 
				$current_date = current_time('Y-m-d H:i:s');
				$start_date = get_post_meta(get_the_ID(),'_EventStartDate',true);
				$end_date = get_post_meta(get_the_ID(),'_EventEndDate',true);
				if(strtotime($start_date) < strtotime($current_date)) $start_date = $end_date;
				$days_left = round((strtotime($start_date) - strtotime($current_date))/86400);
				$cost = tribe_get_cost( null, true );
				if($cost) {
					$cost = 'Cost: '.$cost;
				} else {
					$cost = 'Cost: free';
				}
			?>
			<article <?php post_class(); ?>>
				<div class="bt-event-item">
					<?php if($show_days_left) { ?>
						<div class="tb-event-days-left">
							<span>
								<?php echo $days_left.__(' Days left', 'bearsthemes') ?>
							</span>
						</div>
					<?php } ?>
					<?php if($show_title) { ?>
						<h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php } ?>
					<?php if($show_excerpt) { ?>
						<div class="bt-excerpt"><?php echo bearstheme_custom_excerpt($excerpt_lenght, $excerpt_more); ?></div>
					<?php } ?>
					<?php if($show_meta) { ?>
						<ul class="bt-meta">
							<?php
								echo '<li class="bt-date">'.date_format(date_create($start_date),'M d'). ' - '.date_format(date_create($end_date),'M d').'</li>'
								.'<li class="bt-location">'.$cost.'</li>'
								.'<li class="bt-time">'.date_format(date_create($start_date),'g:i a'). ' - '.date_format(date_create($end_date),'g:i a').'</li>';
							?>
						</ul>
					<?php } ?>
				</div>
			</article>
			<?php endwhile; ?>
		</div>
		<a class="bt-btn-bd-main bt-view-all" href="<?php echo esc_url($view_all_link); ?>"><?php echo $view_all_text; ?></a>
	</div>
<?php
	else: 
		echo 'No Result!';
	endif;
	wp_reset_postdata();
	return ob_get_clean();
}
if(function_exists('bcore_shortcode')) { bcore_shortcode('event_slider', 'bearsthemes_event_slider_render'); }
