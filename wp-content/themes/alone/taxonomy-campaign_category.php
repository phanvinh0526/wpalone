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
					echo do_shortcode( '[bears_blog element_id="1468490678091-6135ea7b-ded4" source="size:30|order_by:date|post_type:campaign|tax_query:'. $wp_query->get_queried_object_id() .'" template="eyJ0ZW1wbGF0ZSI6ImJlYXJzX2Jsb2ctLWNoYXJpdGFibGUtY2FtcGFpZ25zLnBocCIsInNob3dfcGFnaW5hdGlvbiI6InNob3ciLCJjb2x1bW5zIjoiMiIsIm9yZGVyYnkiOiJwb3N0X2RhdGUiLCJ0cmltX3dvcmQiOiIyMCIsInJlYWRtb3JlX3RleHQiOiJSZWFkbW9yZSIsImRvbmF0ZV90ZXh0IjoiRG9uYXRlIE5vdyIsImxheW91dF9pdGVtIjoiZGVmYXVsdCJ9"]' );
					/*
if( have_posts() ) {
						while ( have_posts() ) : the_post();
							get_template_part( 'framework/templates/blog/entry', get_post_format());
						endwhile;
						
						bearstheme_paging_nav();
					}else{
						get_template_part( 'framework/templates/entry', 'none');
					}
*/
					?>
				</div>
				<!-- End Content -->
				<!-- Start Right Sidebar -->
				<?php if ( $tb_blog_layout == '2cr' ) { ?>
					<div class="<?php echo esc_attr($cl_sb_right) ?> sidebar-right temp-default">
						<?php if (is_active_sidebar('bearstheme-right-sidebar')) { dynamic_sidebar('bearstheme-right-sidebar'); } else { dynamic_sidebar('bearstheme-main-sidebar'); } ?>
					</div>
				<?php } ?>
				<!-- End Right Sidebar -->
			</div>
		</div>
	</div>
<?php get_footer(); ?>