<?php
/**
 * bearsthemes_eventSingleRender
 *
 */
if( ! function_exists( 'bearsthemes_eventSingleRender' ) ) :
	function bearsthemes_eventSingleRender()
	{
		global $post;
		$EM_Event = new EM_Event( $post->ID );
		$bearstheme_options = $GLOBALS['bearstheme_options'];
		$thumb_url = ( has_post_thumbnail( $post->ID ) ) ? wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'bearstheme_custom_blog_single_size' )[0] : '';

		ob_start();
		?>
		<article id="post-<?php echo esc_attr( $post->ID ); ?>" <?php post_class(); ?>>
			<div class="bears-event-item event-temp-default event-format-<?php echo esc_attr( basename( __FILE__, '.php' ) ); ?>">
				<div class="event-inner">
					<?php echo ( ! empty( $thumb_url ) ) ? "<img class='event-thumb' src='{$thumb_url}' alt=''>" : '' ?>
					<div class="info-meta">
						<div class="row">
							<div class="col-md-12">
								<div class="extra-meta">
									<div class="post-date">
										<!-- <i class="fa fa-list"></i>  -->
										<?php echo __( 'Created Date: ', 'bearsthemes' ) . get_the_date( 'F d, Y', $post->ID ) ?>
									</div><!--
									--><div class="post-author">
										<!-- <i class="fa fa-user"></i>  -->
										<?php echo __( 'Author: ', 'bearsthemes' ) .   get_the_author() ?>
									</div><!--
									--><div class="post-cate">
										<!-- <i class="fa fa-folder"></i>  -->
									 	<?php echo __( 'Category: ', 'bearsthemes' ) .  get_the_category_list( ', ' ); ?>
									</div><!--
									--><div class="post-count-comment">
										<!-- <i class="fa fa-comment"></i>  -->
										<?php echo __( 'Comment(s): ', 'bearsthemes' ) .  wp_count_comments( $post->ID )->total_comments; ?>
									</div>
								</div>
								<h3 class="title-meta">#_EVENTNAME</h3>
							</div>
							<div class="col-md-9 event-area-content">
								<div class="content-meta">
									<?php echo get_the_content(); ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="block-meta">
									<?php 
									# check allow booking form
									if( ! empty( $EM_Event->event_rsvp ) && (int) $EM_Event->event_rsvp == 1 ) : ?>
									<div class="block-meta-item b-booking">
										<i class="ion-android-people"></i>
										<label><?php _e( 'Book Online', 'bearsthemes' ); ?></label>
										<p>
											<a 
											href='#' 
											class='btn-book-online event-manager-ajax-loadform' 
											data-event-id='#_EVENTID' 
											data-event-title='#_EVENTNAME' 
											data-event-img='<?php echo esc_attr( $thumb_url ); ?>'
											data-redirect-to='{$link}'>
												<?php _e( 'Book Online Now', 'bearsthemes' ); ?>
												<span>#_BOOKEDSPACES/#_SPACES</span>
											</a>
										</p>
									</div>
									<?php endif; ?>
									<div class="block-meta-item b-date">
										<i class="ion-calendar"></i>
										<label><?php _e( 'Date', 'bearsthemes' ) ?></label>
										<p>#_{F j, Y}</p>
									</div>
									<div class="block-meta-item b-time">
										<i class="ion-android-time"></i>
										<label><?php _e( 'Time', 'bearsthemes' ) ?></label>
										<p>#_12HSTARTTIME</p>
									</div>
									<div class="block-meta-item b-location">
										<i class="ion-android-locate"></i>
										<label><?php _e( 'Location', 'bearsthemes' ) ?></label>
										<p>#_LOCATIONADDRESS</p>
									</div>
									<div class="block-meta-item b-share">
										<i class="ion-android-share-alt"></i>
										<label><?php _e( 'Share', 'bearsthemes' ); ?></label>
										<?php 
										$share_data = json_encode( array(
											'title' => '#_EVENTNAME',
											'thumbnail' => $thumb_url,
											'description' => wp_trim_words( get_the_content(), 20, '...' )
											) );

										if( function_exists( 'bears_social_func' ) ) : 
											echo do_shortcode( "[bears_social social='facebook,twitter,pinterest,google' url='#_EVENTURL' extra_data='{$share_data}']" );
										endif;
										?>
										<p> </p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</article>
		<?php
		$output = ob_get_clean();

		return $EM_Event->output( $output );
	}
endif; 

echo bearsthemes_eventSingleRender();
?>
