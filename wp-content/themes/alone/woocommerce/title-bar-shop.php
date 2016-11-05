<?php
$bearstheme_options = $GLOBALS['bearstheme_options'];
$tb_show_page_title = isset($bearstheme_options['tb_page_show_page_title']) ? $bearstheme_options['tb_page_show_page_title'] : 1;
$tb_show_page_breadcrumb = isset($bearstheme_options['tb_page_show_page_breadcrumb']) ? $bearstheme_options['tb_page_show_page_breadcrumb'] : 1;
$subtext = isset($bearstheme_options['title_bar_subtext']) ? $bearstheme_options['title_bar_subtext'] : '';
$delimiter = isset($bearstheme_options['page_breadcrumb_delimiter']) ? $bearstheme_options['page_breadcrumb_delimiter'] : '/';

?>
<div class="bt-title-bar-wrap">
	<div class="row">
		<div class="container">
			<div class="col-md-12">
				<div class="bt-title-bar">
				<?php if($tb_show_page_title){  ?>
					<?php if($subtext) echo '<h6>'.$subtext.'</h6>'; ?>
					<h2 class="bt-text-ellipsis"><?php echo bearsthemes_woocommerce_page_title(); ?></h2>
				<?php } ?>
				<?php if($tb_show_page_breadcrumb){  ?>
					<div class="bt-path">
						<div class="bt-path-inner">
							<?php echo bearstheme_page_breadcrumb($delimiter); ?>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
