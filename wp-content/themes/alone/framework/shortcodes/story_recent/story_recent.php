<?php
function bt_recent_story_func($atts, $content = null) {
    extract(shortcode_atts(array(
		'tpl' => 'tpl1',
		'el_class' => '',
		'posts_per_page' => 1,
		'orderby' => 'date',
        'order' => 'DESC',
        'view_all_text' => 'VIEW ALL STORIES',
        'view_all_link' => '#',
    ), $atts));
	
	$content = wpb_js_remove_wpautop($content, true);
	
    $class = array();
    $class[] = 'bt-recent-story clearfix';
    $class[] = $tpl;
    $class[] = $el_class;
    
    $args = array(
        'posts_per_page' => $posts_per_page,
        'orderby' => $orderby,
        'order' => $order,
        'post_type' => 'story',
        'post_status' => 'publish');
    $wp_query = new WP_Query($args);
	
    ob_start();
	
	if ( $wp_query->have_posts() ) {
    ?>
	<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
		<div class="row">
			<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
				<?php include $tpl.'.php'; ?>
			<?php } ?>
		</div>
	</div>
    <?php
	}
    return ob_get_clean();
}

if(function_exists('bcore_shortcode')) { bcore_shortcode('recent_story', 'bt_recent_story_func'); }
