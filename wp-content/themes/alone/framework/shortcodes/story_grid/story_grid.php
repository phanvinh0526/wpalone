<?php
function bt_story_grid_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'category' => '',
		'posts_per_page' => -1,
		'orderby' => 'none',
        'order' => 'none',
		'show_pagination' => 0,
		'columns' =>  2,
        'el_class' => '',
		'show_title' => 0,
        'show_meta' => 0,
    ), $atts));
			
    $class = array();
    $class[] = 'bt-story-grid clearfix';
    $class[] = $el_class;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'orderby' => $orderby,
        'order' => $order,
        'post_type' => 'story',
        'post_status' => 'publish');
    if (isset($category) && $category != '') {
        $cats = explode(',', $category);
        $category = array();
        foreach ((array) $cats as $cat) :
        $category[] = trim($cat);
        endforeach;
        $args['tax_query'] = array(
                                array(
                                    'taxonomy' => 'story_category',
                                    'field' => 'id',
                                    'terms' => $category
                                )
                        );
    }
    $wp_query = new WP_Query($args);
	
    ob_start();
	
	if ( $wp_query->have_posts() ) {
		$class_columns = '';
		switch ($columns) {
			case 1:
				$class_columns = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
				break;
			case 2:
				$class_columns = 'col-xs-12 col-sm-12 col-md-6 col-lg-6';
				break;
			default:
				$class_columns = 'col-xs-12 col-sm-12 col-md-6 col-lg-6';
				break;
		}
    ?>
	<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
		<div class="row">
			<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
				<div class="<?php echo esc_attr($class_columns); ?>">
					<article <?php post_class(); ?>>
						<div class="bt-story-item">
							<?php if (has_post_thumbnail()) the_post_thumbnail('full'); ?>
							<div class="bt-overlay">
								<div class="bt-inner-content">
									<div class="bt-content-item">
										<?php if ($show_title) { ?>
											<h3 class="bt-title bt-text-ellipsis"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<?php } ?>
										<?php if ($show_meta) { ?>
											<ul class="bt-meta">
												<li class="bt-donation-so-far"><?php _e('Donation So Far: ', 'bearsthemes'); ?><span><?php echo get_post_meta(get_the_ID(),'tb_story_donate_so_far',true); ?></span></li>
												<li class="bt-location"><?php _e('IN ', 'bearsthemes'); echo get_post_meta(get_the_ID(),'tb_story_donate_location',true); ?></li>
											</ul>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</article>
				</div>
			<?php } ?>
			<div style="clear: both;"></div>
			<?php if ($show_pagination) { ?>
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
	</div>
    <?php
	}
    return ob_get_clean();
}

if(function_exists('bcore_shortcode')) { bcore_shortcode('story_grid', 'bt_story_grid_func'); }
