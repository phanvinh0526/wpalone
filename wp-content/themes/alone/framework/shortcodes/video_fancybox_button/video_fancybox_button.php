<?php
function bearsthemes_video_fancybox_button_func($atts) {
    extract(shortcode_atts(array(
        'image' => '',
        'video_link' => '#',
        'el_class' => ''
    ), $atts));

    $class = array();
	$class[] = 'bt-fancybox-wrap';
	$class[] = $el_class;
    ob_start();
    ?>
		<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
			<a id="bt-play-button" class="fancybox fancybox.iframe" href="<?php echo esc_url($video_link); ?>">
				<?php echo wp_get_attachment_image($image, 'full'); ?>
			</a>
		</div>
    <?php
    return ob_get_clean();
}
if(function_exists('bcore_shortcode')) { bcore_shortcode('video_fancybox_button', 'bearsthemes_video_fancybox_button_func');}
