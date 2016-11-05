<?php
function bearsthemes_blog_special_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'el_class' => '',
		'category' => '',
		'posts_per_page' => 4,
		'orderby' => 'none',
        'order' => 'none',
		'active_item' => 4,
        'excerpt_lenght' => 38,
        'excerpt_more' => '.',
        'view_all_text' => 'VIEW ALL NEWS',
        'view_all_link' => '#',
    ), $atts));
			
    $class = array();
    $class[] = 'bt-blog-special';
    $class[] = $el_class;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'orderby' => $orderby,
        'order' => $order,
        'post_type' => 'post',
        'post_status' => 'publish');
    if (isset($category) && $category != '') {
        $cats = explode(',', $category);
        $category = array();
        foreach ((array) $cats as $cat) :
        $category[] = trim($cat);
        endforeach;
        $args['tax_query'] = array(
                                array(
                                    'taxonomy' => 'category',
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
					<div class="col-md-4 bt-post-detail">
						<?php $count1 = 0; while ( $wp_query->have_posts() ) { $wp_query->the_post(); $count1++; ?>
							<article <?php if($count1 == $active_item){ post_class('active'); } else{post_class();} ?>>
								<div class="bt-post-item">
									<div class="bt-publish">
										<span class="bt-day"><?php echo get_the_date('d'); ?></span>
										<span class="bt-month"><?php echo get_the_date('M'); ?></span>
									</div>
									<h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<ul class="bt-meta">
										<li class="bt-author"><?php echo '<i class="fa fa-user"></i>'.__('By ', 'bearsthemes').'<span>'.get_the_author().'</span>'; ?></li>
										<li class="bt-location"><?php echo '<i class="fa fa-map-marker"></i>'.__('Cause in ', 'bearsthemes').'<span>'.get_post_meta(get_the_ID(),'bt_post_donation_location',true).'</span>'; ?></li>
									</ul>
									<div class="bt-excerpt"><?php echo bearstheme_custom_excerpt($excerpt_lenght, $excerpt_more); ?></div>
								</div>
							</article>
						<?php } ?>
						<a class="bt-btn-bd-main bt-view-all" href="<?php echo esc_url($view_all_link); ?>"><?php echo $view_all_text; ?></a>
					</div>
					<div class="col-md-8 bt-post">
						<div class="bt-post-items">
							<?php $count2 = 0; while ( $wp_query->have_posts() ) { $wp_query->the_post(); $count2++; ?>
								<article <?php if($count2 == $active_item){ post_class('active'); } else{post_class();} ?>>
									<div class="bt-post-item">
										<?php if (has_post_thumbnail()) the_post_thumbnail('bearstheme_custom_blog_archive_size'); ?>
										<div class="bt-overlay">
											<div class="bt-blog-item-inner">
												<div class="bt-publish">
													<span><?php echo get_the_date('M d, Y'); ?></span>
												</div>
												<h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
												<i class="fa fa-reply-all"></i>
											</div>
										</div>
									</div>
								</article>
							<?php } ?>
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

if(function_exists('bcore_shortcode')) { bcore_shortcode('blog_special', 'bearsthemes_blog_special_func'); }
