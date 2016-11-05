		<footer id="bt_footer" class="bt-footer">
			<!-- Start Footer Bottom -->
			<div class="bt-footer-bottom">
				<div class="container">
					<div class="row">
						<?php if (is_active_sidebar("bearstheme-footer-bottom-widget")) { ?>
							<div class="col-md-12">
								<?php dynamic_sidebar("bearstheme-footer-bottom-widget"); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<!-- End Footer Bottom -->
		</footer>
	</div><!-- #wrap -->
	<div id="bt-backtop"><i class="fa fa-arrow-up"></i></div>
	<?php
		$bearstheme_options = $GLOBALS['bearstheme_options'];
		if(isset($bearstheme_options["style_selector"])&&$bearstheme_options["style_selector"]) {
			require_once ABS_PATH_FR.'/box-style.php';
		}
	?>
	<?php wp_footer(); ?>
</body>