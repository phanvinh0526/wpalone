<?php
if(class_exists('TBDonations')){
	vc_map ( array (
			"name" => 'Donation Grid',
			"base" => "donation_grid",
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
								"Template 2" => "tpl2"
							),
							"description" => __('Select template in this elment.', 'bearsthemes')
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Columns", 'bearsthemes'),
							"param_name" => "columns",
							"value" => array(
								"4 Columns" => "4",
								"3 Columns" => "3",
								"2 Columns" => "2",
								"1 Column" => "1",
							),
							"description" => __('Select columns display in this element.', 'bearsthemes')
						),
						array(
							"type" => "checkbox",
							"class" => "",
							"heading" => __("Show Pagination", 'bearsthemes'),
							"param_name" => "show_pagination",
							"value" => array (
								__ ( "Yes, please", 'bearsthemes' ) => true
							),
							"description" => __("Show or not pagination in this element.", 'bearsthemes')
						),
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
							"taxonomy" => "tbdonationcategory",
							"heading" => __ ( "Categories", 'bearsthemes' ),
							"param_name" => "category",
							"group" => __("Build Query", 'bearsthemes'),
							"description" => __ ( "Note: By default, all your projects will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'bearsthemes' )
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
						array(
							"type" => "checkbox",
							"class" => "",
							"heading" => __("Show Title", 'bearsthemes'),
							"param_name" => "show_title",
							"value" => array (
								__ ( "Yes, please", 'bearsthemes' ) => true
							),
							"group" => __("Template", 'bearsthemes'),
							"description" => __("Show or not title of post in this element.", 'bearsthemes')
						),
						array(
							"type" => "checkbox",
							"class" => "",
							"heading" => __("Show Days Left", 'bearsthemes'),
							"param_name" => "show_days_left",
							"value" => array (
								__ ( "Yes, please", 'bearsthemes' ) => true
							),
							"dependency" => array(
								"element"=>"tpl",
								"value"=>"tpl1"
							),
							"group" => __("Template", 'bearsthemes'),
							"description" => __("Show or not days left of post in this element.", 'bearsthemes')
						),
						array(
							"type" => "checkbox",
							"class" => "",
							"heading" => __("Show Meta", 'bearsthemes'),
							"param_name" => "show_meta",
							"value" => array (
								__ ( "Yes, please", 'bearsthemes' ) => true
							),
							"dependency" => array(
								"element"=>"tpl",
								"value"=>"tpl2"
							),
							"group" => __("Template", 'bearsthemes'),
							"description" => __("Show or not info meta of post in this element.", 'bearsthemes')
						),
						array(
							"type" => "checkbox",
							"class" => "",
							"heading" => __("Show Progress Bar", 'bearsthemes'),
							"param_name" => "show_progress_bar",
							"value" => array (
								__ ( "Yes, please", 'bearsthemes' ) => true
							),
							"group" => __("Template", 'bearsthemes'),
							"description" => __("Show or not progress bar of post in this element.", 'bearsthemes')
						),
						array(
							"type" => "checkbox",
							"class" => "",
							"heading" => __("Show Donation Money", 'bearsthemes'),
							"param_name" => "show_donation_money",
							"value" => array (
								__ ( "Yes, please", 'bearsthemes' ) => true
							),
							"group" => __("Template", 'bearsthemes'),
							"description" => __("Show or not donation money of post in this element.", 'bearsthemes')
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("Veiw Detail Text", 'bearsthemes'),
							"param_name" => "view_detail_text",
							"value" => "",
							"group" => __("Template", 'bearsthemes'),
							"description" => __("Please, Enter label of buton view detail of post in this element. Default: Donation Now ", 'bearsthemes')
						),
			)
	));
}