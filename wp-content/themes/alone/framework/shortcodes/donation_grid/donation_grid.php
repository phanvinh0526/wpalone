<?php
function bearsthemes_donation_grid_render($atts, $content = null) {			
	extract(shortcode_atts(array(
		'columns' 				=>  3,
		'show_pagination'   	=> 0,
		'el_class'          	=> '',
		'category'          	=> '',
		'posts_per_page'    	=> '-1',
		'order'             	=> 'none',
		'orderby'           	=> 'none',
		'tpl' 					=>  'tpl1',
		'crop_image'        	=> true,
		'width_image'       	=> 370,
		'height_image'      	=> 345,
		'show_title'      		=> 0,
		'show_days_left'    	=> 0,
		'show_meta'    			=> 0,
		'show_progress_bar' 	=> 0,
		'show_donation_money' 	=> 0,
		'view_detail_text' 		=> 'Donation Now',
		
	), $atts));
	
	$class = array();
    $class[] = 'tbdonations_grid_wrap clearfix';
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
?>
<?php if ( $wp_query->have_posts() ) { ?>
	<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
		<div class="row">
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
					
					$class_columns = '';
					switch ($columns) {
						case 1:
							$class_columns = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
							break;
						case 2:
							$class_columns = 'col-xs-12 col-sm-6 col-md-6 col-lg-6';
							break;
						case 3:
							$class_columns = 'col-xs-12 col-sm-6 col-md-4 col-lg-4';
							break;
						case 4:
							$class_columns = 'col-xs-12 col-sm-6 col-md-3 col-lg-3';
							break;
						default:
							$class_columns = 'col-xs-12 col-sm-6 col-md-4 col-lg-4';
							break;
					}
					include $tpl.'.php';
				}
				wp_reset_query();
			?>
		</div>
		<div class="clear"></div> 
		<?php
		if($show_pagination){ ?>
			<nav class="bt-pagination" role="navigation">
				<?php
					$big = 999999999; // need an unlikely integer

					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages,
						'prev_text' => __( '<i class="fa fa-angle-double-left"></i>', 'bearsthemes' ),
						'next_text' => __( '<i class="fa fa-angle-double-right"></i>', 'bearsthemes' ),
					) );
				?>
			</nav>
		<?php } ?>
	</div>
<?php
	} else {
		echo 'No Result!';
	}
	wp_reset_postdata();
	return ob_get_clean();
}
if(function_exists('bcore_shortcode')) { bcore_shortcode('donation_grid', 'bearsthemes_donation_grid_render'); }
