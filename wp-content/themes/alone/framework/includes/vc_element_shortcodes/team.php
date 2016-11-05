<?php
vc_map ( array (
		"name" => 'Testimonial Slider',
		"base" => "testimonial_slider",
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
							"type" => "textfield",
							"heading" => __ ( 'Count', 'bearsthemes' ),
							"param_name" => "posts_per_page",
							'value' => '',
							"group" => __("Build Query", 'bearsthemes'),
							"description" => __ ( 'The number of posts to display on each page. Set to "-1" for display all posts on the page.', 'bearsthemes' )
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
		)
));
