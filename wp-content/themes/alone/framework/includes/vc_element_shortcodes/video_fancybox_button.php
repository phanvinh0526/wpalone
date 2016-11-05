<?php
vc_map(array(
	"name" => __("Video Fancy Box Button", 'bearsthemes'),
	"base" => "video_fancybox_button",
	"category" => __('Extra Elements', 'bearsthemes'),
	"icon" => "tb-icon-for-vc",
	"params" => array(
		array(
			"type" => "attach_image",
			"class" => "",
			"heading" => __("Image", 'bearsthemes'),
			"param_name" => "image",
			"value" => "",
			"description" => __("Select box image in this element.", 'bearsthemes')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Video Link", 'bearsthemes'),
			"param_name" => "video_link",
			"value" => "",
			"description" => __("Please, enter video link in this element.", 'bearsthemes')
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
