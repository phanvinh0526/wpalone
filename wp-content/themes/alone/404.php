<?php
/*
Template Name: 404 Template
*/
?>
<?php get_header(); ?>
<?php
$bearstheme_options = $GLOBALS['bearstheme_options'];
$tb_show_page_title = isset($bearstheme_options['tb_page_show_page_title']) ? $bearstheme_options['tb_page_show_page_title'] : 1;
$tb_show_page_breadcrumb = isset($bearstheme_options['tb_page_show_page_breadcrumb']) ? $bearstheme_options['tb_page_show_page_breadcrumb'] : 1;
bearstheme_title_bar($tb_show_page_title, $tb_show_page_breadcrumb);
?>
	<div class="main-content">
		<div class="container">
			<div class="bt-error404-wrap">
				<h3>OOOPS! <span>SORRY, PAGE NOT FOUND</span></h3>
				<div class="bt-404">
					<h1>4<span>0</span>4</h1>
					<h4>Feel Free Contact Us</h4>
				</div>
				<p>Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan  ipsuy veli. Nam <br class="hidden-xs hidden-sm">nec tellus a odio tincidunt auctor. Vivamus at cursus diam. Duis erosfelis, luctus id gravida <br class="hidden-xs hidden-sm">a, vehicula in est. Sed elementum, justo sodales.</p>
				<a class="bt-back-to-home" href="<?php echo esc_url( home_url( '/'  ) );?>">BACK TO HOMEPAGE</a>
			</div>
		</div>
	</div>
<?php get_footer(); ?>