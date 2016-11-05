<?php
function bearsthemes_story_special_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'el_class' => '',
		'category' => '',
		'posts_per_page' => 2,
		'orderby' => 'none',
        'order' => 'none',
		'active_item' => 2,
        'excerpt_lenght' => 50,
        'excerpt_more' => '.',
        'view_all_text' => 'VIEW ALL STORIES',
        'view_all_link' => '#',
    ), $atts));
			
    $class = array();
    $class[] = 'bt-story-special';
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
    ?>
	<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row">
					<div class="col-md-6 bt-post">
						<?php $count1 = 0; while ( $wp_query->have_posts() ) { $wp_query->the_post(); $count1++; ?>
							<article <?php if($count1 == $active_item){ post_class('active'); } else{post_class();} ?>>
								<div class="bt-story-item">
									<?php if (has_post_thumbnail()) the_post_thumbnail('full'); ?>
									<div class="bt-overlay">
										<div class="bt-inner-content">
											<div class="bt-content-item">
												<h3 class="bt-title bt-text-ellipsis"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
												<ul class="bt-meta">
													<li class="bt-donation-so-far"><?php _e('Donation So Far: ', 'bearsthemes'); ?><span><?php echo get_post_meta(get_the_ID(),'tb_story_donate_so_far',true); ?></span></li>
													<li class="bt-location"><?php _e('IN ', 'bearsthemes'); echo get_post_meta(get_the_ID(),'tb_story_donate_location',true); ?></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</article>
						<?php } ?>
					</div>
					<div class="col-md-8 col-md-offset-4 bt-post-detail">
						<div class="bt-story-detail-inner">
							<div class="row">
								<div class="col-md-8 col-md-offset-4 bt-story-items">
									<?php $count2 = 0; while ( $wp_query->have_posts() ) { $wp_query->the_post(); $count2++; ?>
										<article <?php if($count2 == $active_item){ post_class('active'); } else{post_class();} ?>>
											<div class="bt-story-item-detail">
												<div class="bt-location"><span><?php _e('IN ', 'bearsthemes'); echo get_post_meta(get_the_ID(),'tb_story_donate_location',true); ?></span></div>
												<h3 class="bt-title bt-text-ellipsis"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
												<div class="bt-donation-so-far"><?php _e('Donation So Far: ', 'bearsthemes'); ?><span><?php echo get_post_meta(get_the_ID(),'tb_story_donate_so_far',true); ?></span></div>
												<div class="bt-excerpt"><?php echo bearstheme_custom_excerpt($excerpt_lenght, $excerpt_more); ?></div>
											</div>
										</article>
									<?php } ?>
									<a class="bt-btn-bd-main bt-view-all" href="<?php echo esc_url($view_all_link); ?>"><?php echo $view_all_text; ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <?php
	}
    return ob_get_clean();
}

if(function_exists('bcore_shortcode')) { bcore_shortcode('story_special', 'bearsthemes_story_special_func'); }
