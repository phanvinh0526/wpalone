<?php
function bearsthemes_team_slider_func($atts, $content = null) {
    extract(shortcode_atts(array(
		'columns' =>  3,
        'el_class' => '',
        'category' => '',
		'posts_per_page' => -1,
		'orderby' => 'none',
        'order' => 'none',
        'show_title' => 0,
        'show_meta' => 0,
    ), $atts));
			
    $class = array();
    $class[] = 'bt-team-wrapper clearfix';
    $class[] = $el_class;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'orderby' => $orderby,
        'order' => $order,
        'post_type' => 'team',
        'post_status' => 'publish');
    if (isset($category) && $category != '') {
        $cats = explode(',', $category);
        $category = array();
        foreach ((array) $cats as $cat) :
        $category[] = trim($cat);
        endforeach;
        $args['tax_query'] = array(
                                array(
                                    'taxonomy' => 'team_category',
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
				$class_columns = 'col-xs-12 col-sm-6 col-md-6 col-lg-6';
				break;
			case 3:
				$class_columns = 'col-xs-12 col-sm-12 col-md-4 col-lg-4';
				break;
			case 4:
				$class_columns = 'col-xs-12 col-sm-6 col-md-3 col-lg-3';
				break;
			default:
				$class_columns = 'col-xs-12 col-sm-6 col-md-3 col-lg-3';
				break;
		}
    ?>
	<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
		<div class="bt-team">
			<div class="row">
				<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
					<div class="<?php echo esc_attr($class_columns); ?>">
						<article <?php post_class(); ?>>
							<?php if ( has_post_thumbnail() ) the_post_thumbnail('full'); ?>
							<?php if($show_title) { ?>
								<h3 class="bt-title"><?php the_title(); ?></h3>
							<?php } ?>
							<?php if($show_meta) { ?>
								<div class="bt-meta">
									<span class="bt-position"><?php echo get_post_meta(get_the_ID(),'tb_team_position',true); ?></span>
									<div class="bt-phone"><?php echo '<i class="fa fa-phone"></i>'.get_post_meta(get_the_ID(),'tb_team_phone',true); ?></div>
								</div>
							<?php } ?>
						</article>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
    <?php
	}
    return ob_get_clean();
}

if(function_exists('bcore_shortcode')) { bcore_shortcode('team', 'bearsthemes_team_slider_func'); }
