<?php get_header(); ?>
<?php
$bearstheme_options = $GLOBALS['bearstheme_options'];
$tb_show_page_title = isset($bearstheme_options['tb_post_show_page_title']) ? $bearstheme_options['tb_post_show_page_title'] : 1;
$tb_show_page_breadcrumb = isset($bearstheme_options['tb_post_show_page_breadcrumb']) ? $bearstheme_options['tb_post_show_page_breadcrumb'] : 1;
$tb_post_show_post_nav = (int) isset($bearstheme_options['tb_team_post_show_post_nav']) ?  $bearstheme_options['tb_team_post_show_post_nav']: 1;
bearstheme_title_bar($tb_show_page_title, $tb_show_page_breadcrumb, $tb_post_show_post_nav);

$tb_post_show_post_tags = (int) isset($bearstheme_options['tb_team_post_show_post_tags']) ? $bearstheme_options['tb_team_post_show_post_tags'] : 1;
$tb_post_show_post_author = (int) isset($bearstheme_options['tb_team_post_show_post_author']) ? $bearstheme_options['tb_team_post_show_post_author'] : 1;
$tb_post_show_post_comment = (int) isset($bearstheme_options['tb_team_post_show_post_comment']) ?  $bearstheme_options['tb_team_post_show_post_comment']: 1;
?>
	<div class="main-content ro-blog-sub-article-container-3">
		<div class="container">
			<div class="row">
				<?php
				$tb_blog_layout = isset($bearstheme_options['tb_team_post_layout']) ? $bearstheme_options['tb_team_post_layout'] : '2cr';
				$sb_left = isset($bearstheme_options['tb_team_left_sidebar']) ? $bearstheme_options['tb_team_left_sidebar'] : 'Main Sidebar';
				$cl_sb_left = isset($bearstheme_options['tb_team_post_left_sidebar_col']) ? $bearstheme_options['tb_team_post_left_sidebar_col'] : 'col-xs-12 col-sm-4 col-md-3 col-lg-3';
				$cl_content = isset($bearstheme_options['tb_team_post_content_col']) ? $bearstheme_options['tb_team_post_content_col'] : 'col-xs-12 col-sm-8 col-md-9 col-lg-9';
				$sb_right = isset($bearstheme_options['tb_team_right_sidebar']) ? $bearstheme_options['tb_team_right_sidebar'] : 'Main Sidebar';
				$cl_sb_right = isset($bearstheme_options['tb_team_post_right_siedebar_col']) ? $bearstheme_options['tb_team_post_right_siedebar_col'] : 'col-xs-12 col-sm-4 col-md-3 col-lg-3';
				?>
				<!-- Start Left Sidebar -->
				<?php if ( $tb_blog_layout == '2cl' ) { ?>
					<div class="<?php echo esc_attr($cl_sb_left) ?> sidebar-left">
						<?php if (is_active_sidebar('bearstheme-left-sidebar')) { dynamic_sidebar($sb_left); } ?>
					</div>
				<?php } ?>
				<!-- End Left Sidebar -->
				<!-- Start Content -->
				<div class="<?php echo esc_attr($cl_content) ?> content tb-blog">
					<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'framework/templates/team/entry', get_post_format());
						
						if ( $tb_post_show_post_tags ) { the_tags('<div class="ro-blog-tag clearfix ro-uppercase"><span><h4>TAGS:</h4></span><span>', '</span><span>', '</span></div>'); }
		
						if ( $tb_post_show_post_author ) { echo bearstheme_author_render(); }
						// If comments are open or we have at least one comment, load up the comment template.
						if ( (comments_open() && $tb_post_show_post_comment) || (get_comments_number() && $tb_post_show_post_comment) ) comments_template();
					endwhile;
					?>
				</div>
				<!-- End Content -->
				<!-- Start Right Sidebar -->
				<?php if ( $tb_blog_layout == '2cr' ){ ?>
					<div class="<?php echo esc_attr($cl_sb_right) ?> sidebar-right temp-default">
						<?php if (is_active_sidebar('bearstheme-right-sidebar')) { dynamic_sidebar($sb_right); } ?>
					</div>
				<?php } ?>
				<!-- End Right Sidebar -->
			</div>
		</div>
	</div>
<?php get_footer(); ?>