<?php
function bearsthemes_event_special_render($atts, $content = null) {			
	extract(shortcode_atts(array(
		'el_class'          	=> '',
		'category'          	=> '',
		'posts_per_page'    	=> '4',
		'order'             	=> 'date',
		'orderby'           	=> 'DESC',
		
	), $atts));
	
	ob_start();
	
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
	<div class="bt-events-special <?php echo $el_class;?>">
		<?php $loop = 0; while ($wp_query->have_posts()) : $wp_query->the_post(); 
			$loop++;
			$active = ($loop == 3) ? 'active': '';
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
		<article <?php post_class($active); ?>>
			<?php
				if( has_post_thumbnail() ):
					$thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'bearstheme_custom_blog_archive_size' );
					$thumbnail = $thumbnail_data[0];
				else:
					$thumbnail = '';
				endif;
				$style = implode( ';', array( 
					"background: url({$thumbnail}) no-repeat center center / cover, #333", 
				) );
			?>
			<div class="bt-event-item" style="<?php echo esc_attr( $style ); ?>">
				<div class="bt-overlay"></div>
				<div class="bt-start-date">
					<div class="date"><?php echo '<span class="day">'.date_format(date_create($start_date),'d').'</span><span class="month">'.date_format(date_create($start_date),'M').'</span>'; ?></div>
					<div class="time"><?php echo date_format(date_create($start_date),'g:i a'); ?></div>
				</div>
				<div class="bt-info">
					<h3 class="bt-title bt-text-ellipsis"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php if ( tribe_address_exists() ) echo sprintf( '<div class="bt-location bt-text-ellipsis"><i class="fa fa-map-marker"></i> %s</div>', tribe_get_full_address()); ?>
				</div>
			</div>
		</article>
		<?php endwhile; ?>
	</div>
<?php
	else: 
		echo 'No Result!';
	endif;
	wp_reset_postdata();
	return ob_get_clean();
}
if(function_exists('bcore_shortcode')) { bcore_shortcode('event_special', 'bearsthemes_event_special_render'); }
