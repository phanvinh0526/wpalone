<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();
$event_id = get_the_ID();
?>
<div class="main-content bt-blog-article">
	<div class="row">
		<div class="container"> 
			<div class="col-md-9">
				<div class="tb-event-signle">
					<p class="tb-events-back">
						<a href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( '<i class="fa fa-arrow-circle-o-left"></i> ' . esc_html__( 'All %s', 'the-events-calendar' ), $events_label_plural ); ?></a>
					</p>
					<?php while ( have_posts() ) :  the_post(); ?>
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php echo tribe_event_featured_image( $event_id, 'bearstheme_custom_blog_single_size', false ); ?>
							<div class="tb-event-info">
								<div class="header-info">
									<h2 class="title">
										<?php the_title(); ?>
									</h2>
									<?php echo tribe_events_event_schedule_details( $event_id, '<div class="event-date">', '</div>' ); ?>
									<div class="tbbs-events-content">
										<?php the_content(); ?>
									</div>
								</div>
								
							</div>
							
				
							<!-- Event meta -->
							<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
							<?php tribe_get_template_part( 'modules/meta' ); ?>
							<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
						</div> <!-- #post-x -->
						<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
					<?php endwhile; ?>
					
					<!-- event nav -->
					<div id="tbbs-events-nav">
						<ul class="tribe-events-sub-nav">
							<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
							<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
						</ul>
					</div>
					
				</div>
			</div>
			<div class="col-md-3">
				<div class="sidebar-right">
					<?php if (is_active_sidebar('bearstheme-right-sidebar')) { dynamic_sidebar( 'bearstheme-right-sidebar' ); } else { dynamic_sidebar('bearstheme-main-sidebar'); } ?>
				</div>
			</div>
		</div>
	</div>
</div>
