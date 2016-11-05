<?php
vc_map(array(
	"name" => __("Counter Up", 'bearsthemes'),
	"base" => "counter_up",
	"category" => __('Extra Elements', 'bearsthemes'),
	"icon" => "tb-icon-for-vc",
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Number", 'bearsthemes'),
			"param_name" => "number",
			"value" => "",
			"description" => __("Please, enter number in this element.", 'bearsthemes')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Title", 'bearsthemes'),
			"param_name" => "title",
			"value" => "",
			"description" => __("Please, enter title in this element.", 'bearsthemes')
		),
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
