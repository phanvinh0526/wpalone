<?php
function bearsthemes_testimonial_slider_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'category' => '',
		'posts_per_page' => -1,
		'orderby' => 'none',
        'order' => 'none',
        'el_class' => '',
    ), $atts));
			
    $class = array();
    $class[] = 'bt-testimonial-slider';
    $class[] = $el_class;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'orderby' => $orderby,
        'order' => $order,
        'post_type' => 'testimonial',
        'post_status' => 'publish');
    if (isset($category) && $category != '') {
        $cats = explode(',', $category);
        $category = array();
        foreach ((array) $cats as $cat) :
        $category[] = trim($cat);
        endforeach;
        $args['tax_query'] = array(
                                array(
                                    'taxonomy' => 'testimonial_category',
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
		<div class="owl-carousel">
			<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
				<article <?php post_class(); ?>>
					<div class="testimonial-item">
						<div class="bt-thumb">
							<?php if (has_post_thumbnail()) the_post_thumbnail('thumbnail'); ?>
						</div>
						<div class="bt-excerpt">
							<?php the_excerpt(); ?>
						</div>
						<h4 class="bt-title">
							<?php the_title(); ?>
						</h4>
					</div>
				</article>
			<?php } ?>
		</div>
	</div>
    <?php
	}
    return ob_get_clean();
}

if(function_exists('bcore_shortcode')) { bcore_shortcode('testimonial_slider', 'bearsthemes_testimonial_slider_func'); }
