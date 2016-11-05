<?php
function bearsthemes_demo_item($params, $content = null) {
    extract(shortcode_atts(array(
		'type' => 'demo',
        'demo_image' => '',
        'title' => '',
        'btn_label' => 'View Demo',
        'btn_link' => '#',
        'el_class' => ''
    ), $params));
    
    $attachment_image = wp_get_attachment_image_src($demo_image, 'full', false); 

	$output = "
	<div class='row'>
		<div class='bt-demo-item {$el_class} col-md-12 col-sm-12 col-sx-12'>
			<a href='{$btn_link}' target='_blank' title='{$title}'>
				<div class='item-inner'>
					<div class='frame-meta'>
						<div class='image-meta' style='background: url({$attachment_image[0]}) no-repeat left top / 100% auto'>
							
						</div>
					</div>
					<a href='{$btn_link}'><h4 class='title-meta'>{$title}</h4></a>
				</div>
			</a>
		</div>
	</div>";

	return $output;
}

if(function_exists('bcore_shortcode')) { bcore_shortcode('demo_item', 'bearsthemes_demo_item'); }