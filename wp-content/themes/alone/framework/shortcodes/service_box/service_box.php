<?php
function bearsthemes_service_box_func($atts) {
    extract(shortcode_atts(array(
		'tpl' =>  'tpl1',
		'img' => '',
		'icon' => '',
		'title' => '',
        'desc' => '',
		'btn_label' => 'DONATE NOW',
        'btn_link' => '#',
        'el_class' => ''
    ), $atts));

    $class = array();
	$class[] = 'bt-service-wrap';
	$class[] = $tpl;
	$class[] = $el_class;
    ob_start();
    ?>
		<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
			<?php include $tpl.'.php'; ?>
		</div>
    <?php
    return ob_get_clean();
}
if(function_exists('bcore_shortcode')) { bcore_shortcode('service_box', 'bearsthemes_service_box_func');}
