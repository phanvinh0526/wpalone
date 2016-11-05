<?php
class Bearsthemes_ComboWidgets_Widget extends Bearstheme_Widget {
	function __construct() {
		parent::__construct(
			'bt_combowigets', // Base ID
			__( 'Combo Widgets', 'bearsthemes' ), // Name
			array( 'description' => __( 'Display a list icon: Search, Cart, ...', 'bearsthemes') ) // Args
        );
		
		$this->settings = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Combo Widgets', 'bearsthemes' ),
				'label' => __( 'Title', 'bearsthemes' )
			),
			'shortcode'  => array(
				'type'  => 'text',
				'std'   => __( '[btwg_search] [btwg_cart]', 'bearsthemes' ),
				'label' => __( 'Shortcode', 'bearsthemes' )
			),
			'el_class'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Extra Class', 'bearsthemes' )
			)
		);
		add_action('admin_enqueue_scripts', array($this, 'widget_scripts'));
	}
        
	function widget_scripts() {
		wp_enqueue_script('widget_scripts', URI_PATH . '/framework/widgets/widgets.js');
	}

	function widget( $args, $instance ) {
		global $post;
		extract( $args );
                
		$title 		= apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$el_class 	= sanitize_title( $instance['el_class'] );
		$_title		= ( $title ) ? "{$before_title} {$title} {$after_title}" : '';
		$shortcode 	= do_shortcode( $instance['shortcode'] );

		$output 	= "
		{$before_widget}
			{$_title}
			<div class='combo-widgets-shortcode-wrap'>{$shortcode}</div>
		{$after_widget}";

		echo $output;
	}
}
/* Class Bearsthemes_ComboWidgets_Widget */
function bearstheme_combowidgets_widget() {
    register_widget('Bearsthemes_ComboWidgets_Widget');
}

add_action('widgets_init', 'bearstheme_combowidgets_widget');
