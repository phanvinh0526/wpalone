<?php
function bearsthemes_products_grid_render($atts) {
    extract(shortcode_atts(array(
		'product_cat'       	=> '',
        'show'              	=> 'all_products',
        'number'            	=> -1,
        'hide_free'         	=> 0,
        'show_hidden'       	=> 0,
		'orderby'           	=> 'none',
        'order'             	=> 'none',
		'tpl'					=> 'tpl1',
		'columns'				=> 4,
		'show_pagination' 		=> 0,
		'el_class' 				=> '',
		'show_sale_flash'       => 0,
		'show_price'        	=> 0,
		'show_title'        	=> 0,
        'show_rating'        	=> 0,
		'show_excerpt' 			=> 0,
        'excerpt_lenght' 		=> 11,
        'excerpt_more' 			=> '.',
        'show_add_to_cart'      => 0,
    ), $atts));
	
    $class = array();
    $class[] = 'woocommerce tb-products-grid';
    $class[] = $tpl;
	$class[] = $el_class;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $query_args = array(
			'post_type' 	 => 'product',
			'post_status' 	 => 'publish',
			'ignore_sticky_posts' => 1,
            'posts_per_page' => $number,
			'paged' 		 => $paged,
            //'no_found_rows'  => 1,
            'order'          => $order
    );

    $query_args['meta_query'] = array();

    if ( empty( $show_hidden ) ) {
                    $query_args['meta_query'][] = WC()->query->visibility_meta_query();
                    $query_args['post_parent']  = 0;
            }

            if ( ! empty( $hide_free ) ) {
            $query_args['meta_query'][] = array(
                        'key'     => '_price',
                        'value'   => 0,
                        'compare' => '>',
                        'type'    => 'DECIMAL',
                    );
    }

    $query_args['meta_query'][] = WC()->query->stock_status_meta_query();
    $query_args['meta_query']   = array_filter( $query_args['meta_query'] );

    if (isset($product_cat) && $product_cat != '') {
        $cats = explode(',', $product_cat);
        $product_cat = array();
        foreach ((array) $cats as $cat) :
        $category[] = trim($cat);
        endforeach;

        $query_args['tax_query'] = array(
                    array(
                            'taxonomy' 		=> 'product_cat',
                            'terms' 		=> $category,
                            'field' 		=> 'id',
                            'operator' 		=> 'IN'
                    )
        );
    }
    switch ( $show ) {
            case 'featured' :
                    $query_args['meta_query'][] = array(
                                    'key'   => '_featured',
                                    'value' => 'yes'
                            );
                    break;
            case 'onsale' :
                    $product_ids_on_sale = wc_get_product_ids_on_sale();
                            $product_ids_on_sale[] = 0;
                            $query_args['post__in'] = $product_ids_on_sale;
                    break;
    }
    switch ( $orderby ) {
			case 'price' :
				$query_args['meta_key'] = '_price';
				$query_args['orderby']  = 'meta_value_num';
				break;
			case 'rand' :
				$query_args['orderby']  = 'rand';
				break;
			case 'selling' :
				$query_args['meta_key'] = 'total_sales';
				$query_args['orderby']  = 'meta_value_num';
				break;
			case 'rated' :
				$query_args['orderby'] = 'title';
				break;
			default :
				$query_args['orderby']  = 'date';
    }

    $wp_query = new WP_Query( $query_args );
	
	$class_columns = array();
	switch ($columns) {
		case 1:
			$class_columns[] = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
			break;
		case 2:
			$class_columns[] = 'col-xs-12 col-sm-6 col-md-6 col-lg-6';
			break;
		case 3:
			$class_columns[] = 'col-xs-12 col-sm-6 col-md-4 col-lg-4';
			break;
		case 4:
			$class_columns[] = 'col-xs-12 col-sm-6 col-md-3 col-lg-3';
			break;
		default:
			$class_columns[] = 'col-xs-12 col-sm-6 col-md-3 col-lg-3';
			break;
	}
	
	ob_start();	
	if ( $wp_query->have_posts() ) {
    ?>
    <div class="<?php echo esc_attr(implode(' ', $class)); ?>">
		<div class="row">
			<?php 
				$rtl_class = '';
				$count = 0;
				while ( $wp_query->have_posts() ) { $wp_query->the_post();
					$count++;
					if($count > $columns) {
						$rtl_class = 'bt-rlt';
					}
					?>
						<div class="<?php echo esc_attr(implode(' ', $class_columns)); ?>">
							
							<?php include $tpl.'.php'; ?>
							
						</div>
					<?php
					if($count > ($columns * 2)) $count = 0;
				}
			?>
			<div style="clear: both;"></div>
		</div>
        <?php if($show_pagination && $wp_query->max_num_pages > 1){ ?>
			<nav class="bt-pagination" role="navigation">
				<?php
					$big = 999999999; // need an unlikely integer

					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages,
						'prev_text' => __( '<i class="fa fa-angle-double-left"></i>', 'bearsthemes' ),
						'next_text' => __( '<i class="fa fa-angle-double-right"></i>', 'bearsthemes' ),
					) );
				?>
			</nav>
		<?php } ?> 
    </div>
    <?php
    }else {
		echo 'Post not found!';
    } 
    ?>
    
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}

if(function_exists('bcore_shortcode')) { bcore_shortcode('products_grid', 'bearsthemes_products_grid_render'); }