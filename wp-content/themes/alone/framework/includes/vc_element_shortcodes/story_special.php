<?php
vc_map ( array (
		"name" => 'Story Special',
		"base" => "story_special",
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
					array (
							"type" => "bt_taxonomy",
							"taxonomy" => "story_category",
							"heading" => __ ( "Categories", 'bearsthemes' ),
							"param_name" => "category",
							"group" => __("Build Query", 'bearsthemes'),
							"description" => __ ( "Note: By default, all your projects will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'bearsthemes' )
					),
					array (
							"type" => "dropdown",
							"heading" => __ ( 'Order by', 'bearsthemes' ),
							"param_name" => "orderby",
							"value" => array (
									"None" => "none",
									"Title" => "title",
									"Date" => "date",
									"ID" => "ID"
							),
							"group" => __("Build Query", 'bearsthemes'),
							"description" => __ ( 'Order by ("none", "title", "date", "ID").', 'bearsthemes' )
					),
					array (
							"type" => "dropdown",
							"heading" => __ ( 'Order', 'bearsthemes' ),
							"param_name" => "order",
							"value" => Array (
									"None" => "none",
									"ASC" => "ASC",
									"DESC" => "DESC"
							),
							"group" => __("Build Query", 'bearsthemes'),
							"description" => __ ( 'Order ("None", "Asc", "Desc").', 'bearsthemes' )
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Excerpt Length", 'bearsthemes'),
						"param_name" => "excerpt_lenght",
						"value" => "",
						"group" => __("Template", 'bearsthemes'),
						"description" => __("Please, Enter number excerpt lenght of post in this element. Default: 50", 'bearsthemes')
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Excerpt More", 'bearsthemes'),
						"param_name" => "excerpt_more",
						"value" => "",
						"group" => __("Template", 'bearsthemes'),
						"description" => __("Please, Enter text excerpt more of post in this element. Default: . ", 'bearsthemes')
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("View All  Text", 'bearsthemes'),
						"param_name" => "view_all_text",
						"value" => "",
						"group" => __("Template", 'bearsthemes'),
						"description" => __("Please, Enter text of labe button view all in this element. Default: VIEW ALL STORIES ", 'bearsthemes')
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("View All Link", 'bearsthemes'),
						"param_name" => "view_all_link",
						"value" => "",
						"group" => __("Template", 'bearsthemes'),
						"description" => __("Please, Enter link of url button view all in this element. Default: # ", 'bearsthemes')
					),
		)
));