<?php
function bearstheme_countdown_func($params, $content = null) {
    extract(shortcode_atts(array(
        'date_end' => '+6o +15d +8h +30m +15s',
    ), $params));
	wp_enqueue_script('jquery.plugin.min', URI_PATH . '/assets/vendors/countdown/jquery.plugin.min.js');
	wp_enqueue_script('jquery.countdown.min', URI_PATH . '/assets/vendors/countdown/jquery.countdown.min.js');
    ob_start();
    ?>
	<div data-countdown="<?php echo esc_attr($date_end); ?>" class="bt-countdown-clock"></div>
    <?php
    return ob_get_clean();
}

if(function_exists('bcore_shortcode')) { bcore_shortcode('countdown', 'bearstheme_countdown_func'); }
?>