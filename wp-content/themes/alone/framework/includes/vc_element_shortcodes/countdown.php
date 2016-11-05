<?php
vc_map(array(
	"name" => __("Countdown", 'bearsthemes'),
	"base" => "countdown",
	"class" => "ro_countdown",
	"category" => __('Extra Elements', 'bearsthemes'),
	"icon" => "tb-icon-for-vc",
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Date End", 'bearsthemes'),
			"param_name" => "date_end",
			"value" => "",
			"description" => __("Please, Enter date end in this element. Ex: +6o +15d +8h +30m +15s", 'bearsthemes')
		),
	)
));
