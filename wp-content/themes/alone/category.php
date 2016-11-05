<?php get_header(); ?>
<?php
$bearstheme_options = $GLOBALS['bearstheme_options'];
$tb_show_page_title = isset($bearstheme_options['tb_post_show_page_title']) ? $bearstheme_options['tb_post_show_page_title'] : 1;
$tb_show_page_breadcrumb = isset($bearstheme_options['tb_post_show_page_breadcrumb']) ? $bearstheme_options['tb_post_show_page_breadcrumb'] : 1;
bearstheme_title_bar($tb_show_page_title, $tb_show_page_breadcrumb);
?>
	<div class="main-content bt-blog-list">
		<div class="container">
			<div class="row">
				<?php
				$tb_blog_layout = isset($bearstheme_options['tb_blog_layout']) ? $bearstheme_options['tb_blog_layout'] : '2cr';
				$cl_sb_left = isset($bearstheme_options['tb_blog_left_sidebar_col']) ? $bearstheme_options['tb_blog_left_sidebar_col'] : 'col-xs-12 col-sm-12 col-md-3 col-lg-3';
				$cl_content = isset($bearstheme_options['tb_blog_content_col']) ? $bearstheme_options['tb_blog_content_col'] : ( is_active_sidebar('bearstheme-main-sidebar') ? 'col-xs-12 col-sm-12 col-md-9 col-lg-9' : 'col-xs-12 col-sm-12 col-md-12 col-lg-12' );
				if ( !is_active_sidebar('bearstheme-main-sidebar') && !is_active_sidebar('bearstheme-left-sidebar') && !is_active_sidebar('bearstheme-left-sidebar') ) {
					$cl_content = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
				}
				$cl_sb_right = isset($bearstheme_options['tb_blog_right_siedebar_col']) ? $bearstheme_options['tb_blog_right_siedebar_col'] : 'col-xs-12 col-sm-12 col-md-3 col-lg-3';
				?>
				<!-- Start Left Sidebar -->
				<?php if ( $tb_blog_layout == '2cl' ) { ?>
					<div class="<?php echo esc_attr($cl_sb_left) ?> sidebar-left">
						<?php if (is_active_sidebar('bearstheme-left-sidebar')) { dynamic_sidebar('bearstheme-left-sidebar'); } else { dynamic_sidebar('bearstheme-main-sidebar'); } ?>
					</div>
				<?php } ?>
				<!-- End Left Sidebar -->
				<!-- Start Content -->
				<div class="<?php echo esc_attr($cl_content) ?> content">
					<?php
					if( have_posts() ) {
						while ( have_posts() ) : the_post();
							get_template_part( 'framework/templates/blog/entry', get_post_format());
						endwhile;
						
						bearstheme_paging_nav();
					}else{
						get_template_part( 'framework/templates/entry', 'none');
					}
					?>
				</div>
				<!-- End Content -->
				<!-- Start Right Sidebar -->
				<?php if ( $tb_blog_layout == '2cr' ) { ?>
					<div class="<?php echo esc_attr($cl_sb_right) ?> sidebar-right">
						<?php if (is_active_sidebar('bearstheme-right-sidebar')) { dynamic_sidebar('bearstheme-right-sidebar'); } else { dynamic_sidebar('bearstheme-main-sidebar'); } ?>
					</div>
				<?php } ?>
				<!-- End Right Sidebar -->
			</div>
		</div>
	</div>
<?php get_footer(); ?>