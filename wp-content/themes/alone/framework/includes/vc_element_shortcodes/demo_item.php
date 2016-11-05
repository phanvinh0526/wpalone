<?php
vc_map(array(
	"name" => __("Demo Item", 'bearsthemes'),
	"base" => "demo_item",
	"class" => "tb-demo-item",
	"category" => __('Extra Elements', 'bearsthemes'),
	"icon" => "tb-icon-for-vc",
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'bearsthemes'),
			"param_name" => "type",
			"value" => array(
				"Demo" => "demo",
				"Comming" => "comming"
			),
			"description" => __('Select box type for demo item.', 'bearsthemes')
		),
		array(
			"type" => "attach_image",
			"class" => "",
			"heading" => __("Image", 'bearsthemes'),
			"param_name" => "demo_image",
			"value" => "",
			"description" => __("Select box image for demo item.", 'bearsthemes')
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title", 'bearsthemes'),
			"param_name" => "title",
			"value" => "",
			"description" => __("Please, enter title for demo item.", 'bearsthemes')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Button Label", 'bearsthemes'),
			"param_name" => "btn_label",
			"value" => "",
			"dependency" => array(
				"element"=>"type",
				"value"=>"demo"
			),
			"description" => __("Please, enter button label for demo item.", 'bearsthemes')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Button Link", 'bearsthemes'),
			"param_name" => "btn_link",
			"value" => "",
			"dependency" => array(
				"element"=>"type",
				"value"=>"demo"
			),
			"description" => __("Please, enter button link for demo item.", 'bearsthemes')
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
