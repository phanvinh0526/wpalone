<?php
class Bearstheme_Event_List_Widget extends Bearstheme_Widget {
	function __construct() {
		parent::__construct(
			'bt_event_list', // Base ID
			__('Event List', 'bearsthemes'), // Name
			array('description' => __('Display a list of your events on your site.', 'bearsthemes'),) // Args
        );
		
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Event List', 'bearsthemes' ),
				'label' => __( 'Title', 'bearsthemes' )
			),
			'posts_per_page' => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '',
				'std'   => 3,
				'label' => __( 'Number of posts to show', 'bearsthemes' )
			),
			'layout' => array(
				'type'  => 'select',
				'std'   => 'default',
				'label' => __( 'Layout', 'bearsthemes' ),
				'options' => array(
					'default'  => __( 'Default', 'bearsthemes' ),
				)
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

		ob_start();
		global $post;
		extract( $args );
                
		$title                  = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$posts_per_page         = absint( $instance['posts_per_page'] );
		$layout                 = sanitize_title( $instance['layout'] );
		$el_class               = sanitize_title( $instance['el_class'] );
                
		echo ''.$before_widget;

		if ( $title )
				echo ''.$before_title . $title . $after_title;
		
		$query_args = array(
			'posts_per_page' => $posts_per_page,
			'post_status' => 'publish');

		$wp_query = bearsthemes_em_wp_query( $query_args );
		// $wp_query = new WP_Query($query_args);                
		
		if ($wp_query->have_posts()){
			?>
			<ul class="bt-event-list <?php echo esc_attr( $layout ); ?>">
				<?php 
				while ($wp_query->have_posts()) { 
					$wp_query->the_post(); 
					$params = array(
						'title' => get_the_title(),
						'link' => get_the_permalink(),
						'date' => get_the_date( 'M d, Y' ),
						'author' => get_the_author(),
						);

					echo call_user_func_array( 'bearsthemes_widget_event_list_' . $layout, array( $params ) );
				} 
				?>
			</ul>
		<?php 
		}
		
		wp_reset_postdata();

		echo ''.$after_widget;
                
		$content = ob_get_clean();

		echo ''.$content;
		
	}
}
/* Class Bearstheme_Post_List_Widget */
function bearstheme_event_list_widget() {
    register_widget('Bearstheme_Event_List_Widget');
}

add_action('widgets_init', 'bearstheme_event_list_widget');

/**
 * bearsthemes_widget_event_list_default
 *
 * @param [array] $params
 */
if( ! function_exists( 'bearsthemes_widget_event_list_default' ) ) :
	function bearsthemes_widget_event_list_default( $params )
	{
		extract( $params );
		$EM_Event = new EM_Event( get_the_ID() );

		/* thumbnail */
		$thumbnail = '';
		if( has_post_thumbnail() ):
            $thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) );
        	$thumbnail = $thumbnail_data[0];
        endif;

		$output = "
		<li class='item'>
			<div class='item-inner'>
				<div class='post-thumb'>
					<img src='$thumbnail' alt=''>
					<div class='date-meta'><div class='date-meta-inner'><div>#_{M}</div>#_{j, Y}</div></div>
				</div>
				<div class='info-meta'>
					<div class='title'><a href='{$link}' title='#_EVENTNAME' data-smooth-link>#_EVENTNAME</a></div>
					<span>#_LOCATIONNAME</span>
					<span>#_24HSTARTTIME</span>
				</div>
			</div>
		</li>";

		return $EM_Event->output( $output );
	}
endif;