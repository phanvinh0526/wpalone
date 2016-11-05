<?php
vc_map(array(
	"name" => __("Donation Box", 'bearsthemes'),
	"base" => "donation_box",
	"category" => __('Extra Elements', 'bearsthemes'),
	"icon" => "tb-icon-for-vc",
	"params" => array(
		array(
			"type" => "attach_image",
			"class" => "",
			"heading" => __("Image", 'bearsthemes'),
			"param_name" => "img",
			"value" => "",
			"description" => __("Select image in this element.", 'bearsthemes')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Sub Title", 'bearsthemes'),
			"param_name" => "subtitle",
			"value" => "",
			"description" => __("Please, enter sub title in this element.", 'bearsthemes')
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
			"type" => "textfield",
			"class" => "",
			"heading" => __("Button Label", 'bearsthemes'),
			"param_name" => "btn_label",
			"value" => "",
			"description" => __("Please, enter label button in this element. Default: DONATION NOW ", 'bearsthemes')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Button Link", 'bearsthemes'),
			"param_name" => "btn_link",
			"value" => "",
			"description" => __("Please, enter link button in this element. Default: # ", 'bearsthemes')
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
