<?php
vc_map ( array (
		"name" => 'Blog Carousel',
		"base" => "blog_carousel",
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
							"taxonomy" => "category",
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
					
		)
));