<?php get_header(); ?>
<?php
$bearstheme_options = $GLOBALS['bearstheme_options'];
$tb_show_page_title = isset($bearstheme_options['tb_post_show_page_title']) ? $bearstheme_options['tb_post_show_page_title'] : 1;
$tb_show_page_breadcrumb = isset($bearstheme_options['tb_post_show_page_breadcrumb']) ? $bearstheme_options['tb_post_show_page_breadcrumb'] : 1;
bearstheme_title_bar($tb_show_page_title, $tb_show_page_breadcrumb);

?>
	<div class="main-content bt-event-article">
		<div class="row">
			<div class="container">
				<!-- Start Content -->
				<div class="col-md-9 content bt-event">
					<?php
					while ( have_posts() ) : the_post();
						?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="bt-event-item">
									<div class="bt-header">
									<?php if (has_post_thumbnail()) the_post_thumbnail('bearstheme_custom_blog_single_size'); ?>
										<div class="bt-header-inner">
											<ul class="bt-meta">
												<li class="bt-author"><?php echo '<i class="fa fa-user"></i>'.__('By ', 'bearsthemes').'<span>'.get_the_author().'</span>'; ?></li>
												<li class="bt-location"><?php echo '<i class="fa fa-map-marker"></i><span>'.get_post_meta(get_the_ID(),'tbevents_location',true).'</span>'; ?></li>
											</ul>
											<h3 class="bt-title"><?php the_title(); ?></h3>
											<ul class="bt-info">
												<li class="bt-date"><?php echo '<i class="fa fa-calendar"></i>'.get_the_date('M d', get_the_ID()).__(' - AT ', 'bearsthemes').get_the_date('g:i a', get_the_ID()); ?></li>
												<li class="bt-oganizer"><?php echo __('ORGANIZER: ', 'bearsthemes').'<span>'.get_post_meta(get_the_ID(),'tbevents_organizer',true).'</span>'; ?></li>
												<li class="bt-category"><?php the_terms(get_the_ID(), 'tbeventcategory', 'EVENT CATEGORIES: <span>' , ', ', '</span>' ); ?></li>
												<li class="bt-cost"><?php echo __('EVENT COST: ', 'bearsthemes').'<span>'.get_post_meta(get_the_ID(),'tbevents_cost',true).'</span>'; ?></li>
												<a href="#" class="bt-btn-buy-ticket"><?php _e('BUY TICKET', 'bearsthemes'); ?></a>
											</ul>
										</div>
									</div>
									<div class="bt-content">
										<?php the_content(); ?>
									</div>
								</div>
							</article>
						<?php 
					endwhile;
					?>
				</div>
				<!-- End Content -->
				<!-- Start Right Sidebar -->
				<div class="col-md-3 sidebar-right">
					<?php if (is_active_sidebar('bearstheme-main-sidebar')) { dynamic_sidebar('bearstheme-main-sidebar'); } ?>
				</div>
				<!-- End Right Sidebar -->
			</div>
		</div>
	</div>
<?php get_footer(); ?>