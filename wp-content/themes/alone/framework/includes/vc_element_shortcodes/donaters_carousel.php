<?php
vc_map ( array (
		"name" => 'Donaters Carousel',
		"base" => "donaters_carousel",
		"icon" => "tb-icon-for-vc",
		"category" => __ ( 'Extra Elements', 'bearsthemes' ), 
		'admin_enqueue_js' => array(URI_PATH_FR.'/admin/assets/js/customvc.js'),
		"params" => array (
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Extra Class", 'bearsthemes'),
						"param_name" => "el_class",
						"value" => "",
						"description" => __ ( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'bearsthemes' )
					),
		)
));