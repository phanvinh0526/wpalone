<?php
function bearsthemes_counter_up_func($atts) {
    extract(shortcode_atts(array(
        'number' => '1750',
        'title' => 'PROJECT COMPLETE',
        'el_class' => ''
    ), $atts));

    $class = array();
    $class[] = 'bt-counter-up-wrap';
    $class[] = $el_class;
	
	wp_enqueue_script('jquery.counterup.min', URI_PATH . '/assets/js/jquery.counterup.min.js',array('jquery'),'1.0');
	wp_enqueue_script('waypoints.min', URI_PATH . '/assets/js/waypoints.min.js',array('jquery'),'1.6.2');
	
    ob_start();
    ?>
		<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
			<div class="bt-counter">
				<?php
					if($number) echo '<span class="bt-number">'.number_format($number).'</span>';
					if($title) echo '<h4 class="bt-title">'.$title.'</h4>';
				?>
			</div>
		</div>
    <?php
    return ob_get_clean();
}

if(function_exists('bcore_shortcode')) { bcore_shortcode('counter_up', 'bearsthemes_counter_up_func'); }
