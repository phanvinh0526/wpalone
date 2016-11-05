<?php

/* shortcode */
if( function_exists( 'vc_map' ) ) :
	vc_map(
		array(
			"name" => __( "Donation Search Form", 'bearsthemes' ),
			// "content_element" => true,
			"is_container" => true,
		    "base" => "bears_donation_search",
		    "category" => __('Extra Elements', 'bearsthemes'),
		    "icon" => "tb-icon-for-vc",
		    "params" => array(
		    	array(
					'type' => 'el_id',
					'param_name' => 'element_id',
					'settings' => array(
						'auto_generate' => true,
						),
					'heading' => __( 'Element ID', 'bearsthemes' ),
					'description' => __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'bearsthemes' ),
					'group' => __( 'Source Settings', 'bearsthemes' ),
					),
		    	array(
		    		'type' => 'dropdown',
		    		'param_name' => 'layout',
		    		'heading' => __( 'Layout', 'bearsthemes' ),
		    		'value' => array(
						__( 'Block', 'bearsthemes' ) => 'block',
						__( 'Inline', 'bearsthemes' ) => 'inline',
						),
		    		'group' => __( 'Source Settings', 'bearsthemes' ),
		    		),
		    	array(
		    		'type' => 'textfield',
		    		'param_name' => 'extra_class',
		    		'heading' => __( 'Extra Class', 'bearsthemes' ),
		    		'value' => '',
		    		'group' => __( 'Source Settings', 'bearsthemes' ),
		    		),
		    	array(
		            'type' => 'css_editor',
		            'heading' => __( 'Css', TBBS_NAME ),
		            'param_name' => 'css',
		            'group' => __( 'Design options', TBBS_NAME ),
		        	),
				),
		    "js_view" => 'VcColumnView'
			)
		);

	class WPBakeryShortCode_bears_donation_search extends WPBakeryShortCodesContainer
	{
		protected function content( $atts, $content = null )
		{
			$atts = shortcode_atts( array(
				'element_id'	=> '',
				'layout'		=> 'block',
				'extra_class' 	=> '',
				'css' 			=> '',
			    ), $atts);

			$atts['extra_class'] .= apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $atts['css'], ' ' ), $this->settings['base'], $atts );

			ob_start();
			require __DIR__ . "/{$atts['layout']}.php"; 
			return ob_get_clean();
		}
	}
endif;