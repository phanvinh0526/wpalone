<?php
vc_map(array(
	"name" => __("Info Box", 'bearsthemes'),
	"base" => "info_box",
	"category" => __('Extra Elements', 'bearsthemes'),
	"icon" => "tb-icon-for-vc",
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Icon", 'bearsthemes'),
			"param_name" => "icon",
			"value" => "",
			"description" => __("Please, enter class icon in this element.", 'bearsthemes')
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title", 'bearsthemes'),
			"param_name" => "title",
			"value" => "",
			"description" => __("Please, enter title in this element.", 'bearsthemes')
		),
		array(
			"type" => "textarea_html",
			"class" => "",
			"heading" => __("Content", 'bearsthemes'),
			"param_name" => "content",
			"value" => "",
			"description" => __("Please, enter content in this element.", 'bearsthemes')
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
