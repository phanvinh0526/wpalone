<?php
vc_map ( array (
		"name" => 'Story Recent',
		"base" => "recent_story",
		"icon" => "tb-icon-for-vc",
		"category" => __ ( 'Extra Elements', 'bearsthemes' ), 
		'admin_enqueue_js' => array(URI_PATH_FR.'/admin/assets/js/customvc.js'),
		"params" => array (
					array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Template", 'bearsthemes'),
							"param_name" => "tpl",
							"value" => array(
								"Template 1" => "tpl1",
								"Template 2" => "tpl2",
							),
							"description" => __('Select template of posts display in this element.', 'bearsthemes')
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
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("View All  Text", 'bearsthemes'),
						"param_name" => "view_all_text",
						"value" => "",
						"group" => __("Template", 'bearsthemes'),
						"dependency" => array(
							"element"=>"tpl",
							"value"=>"tpl2"
						),
						"description" => __("Please, Enter text of labe button view all in this element. Default: VIEW ALL STORIES ", 'bearsthemes')
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("View All Link", 'bearsthemes'),
						"param_name" => "view_all_link",
						"value" => "",
						"group" => __("Template", 'bearsthemes'),
						"dependency" => array(
							"element"=>"tpl",
							"value"=>"tpl2"
						),
						"description" => __("Please, Enter link of url button view all in this element. Default: # ", 'bearsthemes')
					),
		)
));