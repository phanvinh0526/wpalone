<?php
/*
 * Layout Name: Charitable Plg - Campaign
 * Author: Bearsthemes
 * Author URI: http://themebears.com
 * Param: bearsthemes_BearsBlogCharitableParams
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

# build loop
$loop = Charitable_Campaigns_Shortcode::get_campaigns( $campaign_args );

/**
 * bearsthemes_blogCharitable_default
 * 
 * @param [array] $atts
 * @param [array] $data
 * @return [html] $output
 */
if( ! function_exists( 'bearsthemes_blogCharitable_default' ) ) :
	function bearsthemes_blogCharitable_default( $atts, $data )
	{
		global $post; extract( $data );
		$template_params = $atts['template_params']; 
		$col = 12 / (int) $template_params['columns'];

		$campaign = new Charitable_Campaign( $post );
		$percent_donated_raw = $campaign->get_percent_donated_raw();
		$time_left = $campaign->get_time_left();
		$donation_summary = $campaign->get_donation_summary();

		$output = "
		<div class='col-md-{$col}'>
			<div class='item'>
				<div class='image-meta' style='background: url({$thumbnail}) no-repeat center center / cover, #333;'>
					<div class='time-left-meta'>{$time_left}</div>
				</div>
				<div class='charitable-meta'>
					<div class='donation-summary'>{$donation_summary}</div>
					<div class='campaign-progress-bar'><span class='bar' style='width: {$percent_donated_raw}%;'></span></div>
				</div>
				<div class='info-meta'>
					<a href='{$link}' title='{$title}' data-smooth-link><h3 class='title'>{$title}</h3></a>
					<p class='short-des'>{$content}</p>
					<div class='button-meta'>
						<div class='button-meta-inner'>
							<a 
								href='#' 
								class='donate-button charitable-donate-ajax-loadform' 
								data-campaign-id='{$post->ID}' 
								data-campaign-title='{$title}' 
								data-campaign-img='{$thumbnail}'>{$template_params['donate_text']}</a>
							<a href='{$link}' class='readmore-button' data-smooth-link>{$template_params['readmore_text']}</a>
						</div>
					</div>
				</div>
				<div class='extra-meta'>
					<div class='category'><i class='ion-ios-folder-outline'></i> {$cat_list}</div>
					<div class='author'><i class='ion-ios-person-outline'></i> {$author}</div>
					<div class='comment'><i class='ion-ios-chatbubble-outline'></i> {$count_comments->total_comments}</div>
				</div>
			</div>
		</div>";

		return $output;
	}
endif;
?>
<div id="<?php echo esc_attr( $_id ) ?>" class="<?php echo esc_attr( $_class ); ?>">
	<div class="bs-blog-container">
		<div class='row'>
		<?php
		while( $loop->have_posts() ) : 
			$loop->the_post();

			/* thumbnail */
			$thumbnail = '';
			if( has_post_thumbnail() ):
                $thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium_large' );
            	$thumbnail = $thumbnail_data[0];
            endif;

            /* title */
            $title = get_the_title();

            /* content */
            $content = wp_trim_words( get_post_meta( get_the_ID(), '_campaign_description', true ), (int) $atts['template_params']['trim_word'], '...' );

            $data = array(
            	'thumbnail' 	=> $thumbnail,
            	'title' 		=> $title,
            	'content' 		=> $content,
            	'link' 			=> get_the_permalink(),
            	'author'   		=> get_the_author(),
            	'cat_list'		=> get_the_term_list( get_the_ID(), 'campaign_category', '', ', ' ),
            	'count_comments'=> wp_count_comments( get_the_ID() ),
            	);

            echo call_user_func_array( 'bearsthemes_blogCharitable_' . $atts['template_params']['layout_item'], array( $atts, $data ) );
		endwhile;
		?>
		</div>

		<!-- pagination -->
		<?php if( 'show' == $atts['template_params']['show_pagination'] ) : ?>
		<div class='bt-pagination-style'>
			<?php 
			$big = 999999999;
			$args = array(
				'base'               => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'             => '?paged=%#%',
				'total'              => $loop->max_num_pages,
				'current'            => max( 1, get_query_var('paged') ),
				'prev_next'          => true,
				'prev_text'          => __('<i class="ion-arrow-left-c"></i>'),
				'next_text'          => __('<i class="ion-arrow-right-c"></i>'),
				);
			echo paginate_links( $args ); 
			?>
		</div>
		<?php endif; ?>

		<!-- reset post -->
		<?php wp_reset_postdata(); ?>
	</div>
</div>