<?php 
/**
 * Layout Name: Footer v2
 * Preview Image: /assets/images/footers/footer-v2.jpg
 */

$footer_class = basename( __FILE__, '.php' );
?>
		<footer id="bt_footer" class="bt-footer <?php echo esc_attr( $footer_class ); ?>">
			<!-- Start Footer Top -->
			<div class="bt-footer-top">
				<div class="container">
					<div class="row">
						<!-- Start Footer Sidebar Top 1 -->
						<?php if (is_active_sidebar("bearstheme-footer-top-widget")) { ?>
							<div class="col-sm-6 col-md-4 col-lg-4">
								<?php dynamic_sidebar("bearstheme-footer-top-widget"); ?>
							</div>
						<?php } ?>
						<!-- End Footer Sidebar Top 1 -->
						<!-- Start Footer Sidebar Top 2 -->
						<?php if (is_active_sidebar("bearstheme-footer-top-widget-2")) { ?>
							<div class="col-sm-6 col-md-3 col-lg-3">
								<?php dynamic_sidebar("bearstheme-footer-top-widget-2"); ?>
							</div>
						<?php } ?>
						<!-- End Footer Sidebar Top 2 -->
						<!-- Start Footer Sidebar Top 3 -->
						<?php if (is_active_sidebar("bearstheme-footer-top-widget-3")) { ?>
						<div class="col-sm-6 col-md-5 col-lg-5">
							<?php dynamic_sidebar("bearstheme-footer-top-widget-3"); ?>
						</div>
						<?php } ?>
						<!-- End Footer Sidebar Top 3 -->
					</div>
				</div>
			</div>
			<!-- End Footer Top -->
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