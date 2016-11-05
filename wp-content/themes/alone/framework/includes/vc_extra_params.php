<?php
//Add extra params vc_row
vc_add_param ( "vc_row", array (
		"type" 			=> "colorpicker",
		"class" 		=> "",
		"heading" 		=> __( "Baground Overlay", 'bearsthemes' ),
		"param_name" 	=> "bt_bg_overlay",
		"value" 		=> "",
		"description" 	=> __( "Select color background in this row.", 'bearsthemes' )
) );

vc_add_param ( "vc_row", array (
		"type" 			=> "checkbox",
		"heading" 		=> __( "Baground Attachment (Fixed)", 'bearsthemes' ),
		"param_name" 	=> "bt_background_attachment_fixed",
		"value" 		=> 'false',
		"description" 	=> __( "Select background attachment fixed in this row.", 'bearsthemes' ),
		"group"	 		=> __( "Custom Row Style", "bearsthemes" ),
) );