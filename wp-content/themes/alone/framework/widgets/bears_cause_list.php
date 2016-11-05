<?php
class Bearstheme_Cause_List_Widget extends Bearstheme_Widget {
	function __construct() {
		parent::__construct(
			'bt_cause_list', // Base ID
			__('Cause List', 'bearsthemes'), // Name
			array('description' => __('Display a list of your Causes on your site.', 'bearsthemes'),) // Args
        );
		
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Cause List', 'bearsthemes' ),
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
			'orderby' => array(
				'type'  => 'select',
				'std'   => 'post_date',
				'label' => __( 'Order by', 'bearsthemes' ),
				'options' => array(
					'post_date'  => __( 'Post date', 'bearsthemes' ),
					'popular'  => __( 'Popular', 'bearsthemes' ),
					'ending'  => __( 'Ending', 'bearsthemes' ),
				)
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
		$orderby         		= absint( $instance['orderby'] );
		$layout                 = sanitize_title( $instance['layout'] );
		$el_class               = sanitize_title( $instance['el_class'] );
                
		echo ''.$before_widget;

		if ( $title )
				echo ''.$before_title . $title . $after_title;
		
		$query_args = array(
			'number' => $posts_per_page,
			'include_inactive' => true,
			'post_status' => 'publish',
			'paged' => ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1,
			'orderby' => $orderby,
			);

		$wp_query = Charitable_Campaigns_Shortcode::get_campaigns( $query_args );
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

					echo call_user_func_array( 'bearsthemes_widget_cause_list_' . $layout, array( $params ) );
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
function bearstheme_cause_list_widget() {
    register_widget('Bearstheme_Cause_List_Widget');
}

add_action('widgets_init', 'bearstheme_cause_list_widget');

/**
 * bearsthemes_widget_cause_list_default
 *
 * @param [array] $params
 */
if( ! function_exists( 'bearsthemes_widget_cause_list_default' ) ) :
	function bearsthemes_widget_cause_list_default( $params )
	{
		global $post;
		extract( $params );
		$campaign = new Charitable_Campaign( $post );
		$currency_helper = charitable_get_currency_helper();

		/* thumbnail */
		$thumbnail = '';
		if( has_post_thumbnail() ):
            $thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) );
        	$thumbnail = $thumbnail_data[0];
        endif;

		$output = "
		<li class='item'>
			<div class='item-inner'>
				<img class='post-thumb' src='$thumbnail' alt=''>
				<div class='info-meta'>
					<div class='title'><a href='{$link}' title='{$title}' data-smooth-link>{$title}</a></div>
					<span class='amount'>". $currency_helper->get_monetary_amount( $campaign->get_donated_amount() ) ."</span>/<span class='goal'>". $currency_helper->get_monetary_amount( $campaign->get( 'goal' ) ) ."</span>
				</div>
			</div>
		</li>";

		return $output;
	}
endif;