<?php
/*
 * Layout Name: Charitable - Campaign 2
 * Author: Bearsthemes
 * Author URI: http://themebears.com
 * Param: bearsthemes_BearsBlogCharitableCampaign2Params
 */

# variable
$_id 		= sprintf( 'bears-element-%s', $atts['element_id'] );
$_class 	= sprintf( 'bs-blog temp-%s layout-%s %s', str_replace( '.php', '', $atts['template_params']['template'] ), $atts['template_params']['layout_item'], $atts['class'] );

# get data
list( $args, $wp_query ) = vc_build_loop_query( $atts['source'] );

$campaign_args = array(
	'number' => $args['posts_per_page'],
	'include_inactive' => true,
	'orderby' => $atts['template_params']['orderby'],
	'paged' => ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1,
	);

# build taxonomy
$taxonomy = array();
if( isset( $args['tax_query'] ) && count( $args['tax_query'][0]['terms'] ) > 0 ) :
	foreach( $args['tax_query'][0]['terms'] as $term_id ) :
		$term_data = get_term_by( 'id', $term_id, 'campaign_category' );
		( isset( $term_data->slug ) ) ? array_push( $taxonomy, $term_data->slug ) : '';
	endforeach;

	if( count( $taxonomy ) > 0 ) $campaign_args['category'] = $taxonomy;
endif;

$color = array(
	'dark' => ['#222', '#555'],
	'white' => ['#FFF', '#F6F6F6'],
	);
$atts['color'] = $color[$atts['template_params']['color']];
$atts['campaign_args'] = $campaign_args;
?>
<div id="<?php echo esc_attr( $_id ) ?>" class="<?php echo esc_attr( $_class ); ?>">
	<div class="bs-blog-container">
		<div class='container-items'>
			<?php echo call_user_func_array( 'bearsthemes_blogCharitableCampaign2_default', array( $atts, $atts['template_params']['layout_item'] ) ); ?>
		</div>
	</div>
</div>