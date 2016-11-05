<?php
function bearsthemes_blog_carousel_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'el_class' => '',
        'category' => '',
		'posts_per_page' => -1,
		'orderby' => 'none',
        'order' => 'none',
    ), $atts));
	
    $class = array();
    $class[] = 'bt-blog-carousel clearfix';
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
		<div class="owl-carousel">
			<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
				<article <?php post_class(); ?>>
					<div class="bt-post-item">
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
						<div class="bt-thumb" style="<?php echo esc_attr( $style ); ?>"></div>
						<div class="bt-content">
							<div class="bt-author"><?php echo __('Posted by: ', 'bearsthemes').'<span>'.get_the_author().'</span>'; ?></div>
							<h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="bt-excerpt"><?php echo bearstheme_custom_excerpt(20, '...'); ?></div>
							<div class="bt-publish"><?php echo get_the_date('d M Y'); ?></div>
						</div>
					</div>
				</article>
			<?php } ?>
		</div>
	</div>
    <?php
	}
    return ob_get_clean();
}

if(function_exists('bcore_shortcode')) { bcore_shortcode('blog_carousel', 'bearsthemes_blog_carousel_func'); }
