<?php
class Bearstheme_Post_List_Widget extends Bearstheme_Widget {
	function __construct() {
		parent::__construct(
			'bt_post_list', // Base ID
			__('Post List', 'bearsthemes'), // Name
			array('description' => __('Display a list of your posts on your site.', 'bearsthemes'),) // Args
        );
		
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Post List', 'bearsthemes' ),
				'label' => __( 'Title', 'bearsthemes' )
			),
			'category' => array(
				'type'   => 'bt_taxonomy',
				'std'    => '',
				'label'  => __( 'Categories', 'bearsthemes' ),
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
				'std'   => 'none',
				'label' => __( 'Order by', 'bearsthemes' ),
				'options' => array(
					'none'   => __( 'None', 'bearsthemes' ),
					'comment_count'  => __( 'Comment Count', 'bearsthemes' ),
					'title'  => __( 'Title', 'bearsthemes' ),
					'date'   => __( 'Date', 'bearsthemes' ),
					'ID'  => __( 'ID', 'bearsthemes' ),
				)
			),
			'order' => array(
				'type'  => 'select',
				'std'   => 'none',
				'label' => __( 'Order', 'bearsthemes' ),
				'options' => array(
					'none'  => __( 'None', 'bearsthemes' ),
					'asc'  => __( 'ASC', 'bearsthemes' ),
					'desc' => __( 'DESC', 'bearsthemes' ),
				)
			),
			'layout' => array(
				'type'  => 'select',
				'std'   => 'default',
				'label' => __( 'Layout', 'bearsthemes' ),
				'options' => array(
					'default'  => __( 'Default', 'bearsthemes' ),
					'layout2'  => __( 'Layout 2 - has thumbnail', 'bearsthemes' ),
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
		$category               = isset($instance['category'])? $instance['category'] : '';
		$posts_per_page         = absint( $instance['posts_per_page'] );
		$orderby                = sanitize_title( $instance['orderby'] );
		$order                  = sanitize_title( $instance['order'] );
		$layout                 = sanitize_title( $instance['layout'] );
		$el_class               = sanitize_title( $instance['el_class'] );
                
		echo ''.$before_widget;

		if ( $title )
				echo ''.$before_title . $title . $after_title;
		
		$query_args = array(
			'posts_per_page' => $posts_per_page,
			'orderby' => $orderby,
			'order' => $order,
			'post_type' => 'post',
			'post_status' => 'publish');
		if (isset($category) && $category != '') {
			$cats = explode(',', $category);
			$category = array();
			foreach ((array) $cats as $cat) :
			$category[] = trim($cat);
			endforeach;
			$query_args['tax_query'] = array(
									array(
										'taxonomy' => 'category',
										'field' => 'id',
										'terms' => $category
									)
							);
		}
		
		$wp_query = new WP_Query($query_args);                
		
		if ($wp_query->have_posts()){
			?>
			<ul class="bt-post-list <?php echo esc_attr( $layout ); ?>">
				<?php 
				while ($wp_query->have_posts()) { 
					$wp_query->the_post(); 
					$params = array(
						'title' => get_the_title(),
						'link' => get_the_permalink(),
						'date' => get_the_date( 'M d, Y' ),
						'author' => get_the_author(),
						);

					echo call_user_func_array( 'bearsthemes_widget_post_list_' . $layout, array( $params ) );
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
function bearstheme_post_list_widget() {
    register_widget('Bearstheme_Post_List_Widget');
}

add_action('widgets_init', 'bearstheme_post_list_widget');

/**
 * bearsthemes_widget_post_list_default
 *
 * @param [array] $params
 */
if( ! function_exists( 'bearsthemes_widget_post_list_default' ) ) :
	function bearsthemes_widget_post_list_default( $params )
	{
		extract( $params );

		$output = "
		<li>
			<h6 class='bt-title bt-text-ellipsis'>
				<a href='{$link}'>{$title}</a>
			</h6>
			<div class='bt-meta'>
				<span>{$date}</span>
				<span>". __( 'By', 'bearsthemes' ) ." {$author}</span>
			</div>
		</li>";

		return $output;
	}
endif;

/**
 * bearsthemes_widget_post_list_layout2
 *
 * @param [array] $params
 */
if( ! function_exists( 'bearsthemes_widget_post_list_layout2' ) ) :
	function bearsthemes_widget_post_list_layout2( $params )
	{
		global $post;
		extract( $params );

		/* thumbnail */
		$thumbnail = '';
		if( has_post_thumbnail() ):
            $thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) );
        	$thumbnail = $thumbnail_data[0];
        endif;

		$output = "
		<li class='item'>
			<div class='item-inner'>
				<img class='post-thumb' src='{$thumbnail}' alt=''>
				<div class='info-meta'>
					<div class='title'><a href='{$link}' title='{$title}' data-smooth-link>{$title}</a></div>
					<span>{$date}</span>
				</div>
			</div>
		</li>";

		return $output;
	}
endif;