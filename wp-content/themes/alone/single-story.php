<?php get_header(); ?>
<?php
$bearstheme_options = $GLOBALS['bearstheme_options'];
$tb_show_page_title = isset($bearstheme_options['tb_post_show_page_title']) ? $bearstheme_options['tb_post_show_page_title'] : 1;
$tb_show_page_breadcrumb = isset($bearstheme_options['tb_post_show_page_breadcrumb']) ? $bearstheme_options['tb_post_show_page_breadcrumb'] : 1;
bearstheme_title_bar($tb_show_page_title, $tb_show_page_breadcrumb);

?>
	<div class="main-content bt-story-article">
		<div class="row">
			<div class="container">
				<!-- Start Content -->
				<div class="col-md-9 content bt-story">
					<?php
					while ( have_posts() ) : the_post();
						?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="bt-story-item">
									<div class="bt-header">
									<?php if (has_post_thumbnail()) the_post_thumbnail('bearstheme_custom_blog_single_size'); ?>
										<div class="bt-header-inner">
											<ul class="bt-meta">
												<li class="bt-author"><?php echo '<i class="fa fa-user"></i>'.__('By ', 'bearsthemes').'<span>'.get_the_author().'</span>'; ?></li>
												<li class="bt-location"><?php echo '<i class="fa fa-map-marker"></i>'.__('In ', 'bearsthemes').'<span>'.get_post_meta(get_the_ID(),'tb_story_donate_location',true).'</span>'; ?></li>
											</ul>
											<h3 class="bt-title"><?php the_title(); ?></h3>
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