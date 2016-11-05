<?php
function bearsthemes_info_box_func($atts, $content = null) {
    extract(shortcode_atts(array(
		'icon' => '',
		'title' => '',
		'desc' => '',
        'el_class' => ''
    ), $atts));
	
	$content = wpb_js_remove_wpautop($content, true);
	
    $class = array();
	$class[] = 'bt-info-wrap';
	$class[] = $el_class;
    ob_start();
    ?>
		<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
			<div class="bt-info">
				<?php
					if($icon) echo '<i class="'.esc_attr($icon).'"></i>';
					if($title) echo '<h4 class="bt-title">'.esc_html($title).'</h4>';
					if($content) echo '<div class="bt-content">'.$content.'</div>';
				?>
			</div>
		</div>
		
    <?php
    return ob_get_clean();
}
if(function_exists('bcore_shortcode')) { bcore_shortcode('info_box', 'bearsthemes_info_box_func');}
