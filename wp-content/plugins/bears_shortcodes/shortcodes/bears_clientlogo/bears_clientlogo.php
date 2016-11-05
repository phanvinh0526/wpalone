<?php

/* shortcode */
vc_map(
	array(
		"name" => __( "Bears Client Logo", TBBS_NAME ),
	    "base" => "bears_clientlogo",
	    "class" => "vc-bears-clientlogo",
	    "category" => __("Bears", TBBS_NAME),
	    "params" => array(
	    	array(
				'type' => 'el_id',
				'param_name' => 'element_id',
				'settings' => array(
					'auto_generate' => true,
					),
				'heading' => __( 'Element ID', TBBS_NAME ),
				'description' => __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', TBBS_NAME ),
				'group' => __( 'Source Settings', TBBS_NAME ),
				),
			array(
				'type' => 'attach_images',
				'heading' => __( 'Images', TBBS_NAME ),
				'param_name' => 'images',
				'value' => '',
				'description' => __( 'Select images from media library.', TBBS_NAME ),
				'group' => __( 'Source Settings', TBBS_NAME ),
				),
	    	array(
	            'type' => 'textfield',
	            'heading' => __( 'Extra Class',TBBS_NAME ),
	            'param_name' => 'class',
	            'value' => '',
	            'description' => __( '',TBBS_NAME ),
	            'group' => __( 'Template', TBBS_NAME )
	        ),
			array(
	            'type' => 'btbs_supper_template',
	            'heading' => __( 'Template', TBBS_NAME ),
	            'param_name' => 'template',
	            'shortcode' => basename( __FILE__, '.php' ),
	            'group' => __( 'Template', TBBS_NAME ),
	        	),
	    	)
		)
	);

class WPBakeryShortCode_bears_clientlogo extends WPBakeryShortCode
{
	protected function content( $atts, $content = null )
	{
		$atts = shortcode_atts( array(
			'element_id'	=> '',
			'images'		=> '',
			'template'		=> '',
			'class' 		=> '',
		    ), $atts);

		return tbbs_LoadTemplate( basename( __FILE__, '.php' ), $atts, $content );
	}
}

/**
 * tbbs_BearsClientlogoParams
 *
 */
if( ! function_exists( 'tbbs_BearsClientlogoParams' ) ) :
	function tbbs_BearsClientlogoParams()
	{
		return array(
			array(
				'name' => 'height',
				'title' => __( 'Height', TBBS_NAME ),
				'type' => 'text',
				'value' => '122px'
				),
			array(
				'name' => 'padding',
				'title' => __( 'Padding', TBBS_NAME ),
				'type' => 'text',
				'value' => '30px'
				),
			array(
				'name' => 'columns',
				'title' => 	__( 'Columns', TBBS_NAME ),
				'type' => 'select',
				'value' => 4,
				'options' => array(
					array(
						'value' => 3,
						'text' => __( 'Three', TBBS_NAME ),
						),
					array(
						'value' => 4,
						'text' => __( 'Four', TBBS_NAME ),
						),
					array(
						'value' => 5,
						'text' => __( 'Five', TBBS_NAME ),
						),
					array(
						'value' => 6,
						'text' => __( 'Six', TBBS_NAME ),
						),
					),
				),
			array(
				'name' => 'layout_item',
				'title' => __( 'Layout Item', TBBS_NAME ),
				'type' => 'select',
				'value' => 'default',
				'options' => array(
					array(
						'value' => 'default',
						'text' => __( 'Default', TBBS_NAME ),
						),
					)
				)
		);
	}
endif;