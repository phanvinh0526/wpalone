<?php 
/**
 * Layout Name: Header Default
 * Preview Image: /assets/images/headers/header-v1.jpg
 */

# variable
$tb_show_button_donate = ( isset( $bearstheme_options['tb_show_button_donate'] ) && (int) $bearstheme_options['tb_show_button_donate'] == 1 && class_exists( 'TBDonations' ) ) ? true : false;
$tb_sticky_menu = ( isset( $bearstheme_options['tb_sticky_menu'] ) && (int) $bearstheme_options['tb_sticky_menu'] == 1 ) ? true : false;
?>

<!-- Start Header -->
<header>
	<div id="bt_header" class="bt-header-v1 <?php echo esc_attr( ( $tb_sticky_menu == true ) ? 'bt-header-stick' : '' ); ?>"><!-- bt-header-stick/bt-header-fixed -->
		<!-- Start Header Top -->
		<?php if( isset( $bearstheme_options['tb_show_header_top'] ) && (int) $bearstheme_options['tb_show_header_top'] == 1 ) : ?>
		<div class="bt-header-top">
			<div class="container">
				<div class="row">
					<!-- Start Header Sidebar Top Left -->
					<?php if (is_active_sidebar("bearstheme-header-top-widget")) { ?>
						<div class="col-md-5">
							<?php dynamic_sidebar("bearstheme-header-top-widget"); ?>
						</div>
					<?php } ?>
					<!-- End Header Sidebar Top Left -->
					<!-- Start Header Sidebar Top Right -->
					<?php if (is_active_sidebar("bearstheme-header-top-widget-2")) { ?>
						<div class="col-md-7 <?php echo esc_attr( ( $tb_show_button_donate == true ) ? '' : 'bt-no-donate-header-top' ); ?>">
							<?php 
								dynamic_sidebar("bearstheme-header-top-widget-2"); 
								echo ( $tb_show_button_donate == true ) ? do_shortcode('[tbdonations_form]') : '';
							?>
						</div>
					<?php } ?>
					<!-- End Header Sidebar Top Right -->
				</div>
			</div>
		</div>
		<?php endif; ?>
		<!-- End Header Top -->

		<!-- Start Header Menu -->
		<div class="bt-header-menu">
			<div class="container">
				<div class="row">
					<div class="col-md-2">
						<div class="bt-logo">
							<a href="<?php echo esc_url(home_url()); ?>">
								<?php bearstheme_logo('v1'); ?>
							</a>
						</div>
						<div id="bt-hamburger" class="bt-hamburger visible-xs visible-sm"><span></span></div>
					</div>
					<div class="col-md-10">
						<?php
						$attr = array(
							'menu_id' => 'nav',
							'menu' => '',
							'container_class' => 'bt-menu-list hidden-xs hidden-sm ',
							'menu_class'      => 'text-center',
							'echo'            => true,
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 0,
						);
						$menu_locations = get_nav_menu_locations();
						if (!empty($menu_locations['main_navigation'])) {
		                    $attr['theme_location'] = 'main_navigation';
							wp_nav_menu( $attr );
		                } else { ?>
							<div class="menu-list-default">
								<?php wp_page_menu();?>
							</div>    
						<?php } ?>
						<?php if (is_active_sidebar("bearstheme-menu-right-sidebar")){ ?>
							<?php dynamic_sidebar("bearstheme-menu-right-sidebar"); ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<!-- End Header Menu -->
	</div>
</header>
<div class="bt-menu-canvas-overlay"></div>
<div class="bt-menu-canvas">
	<?php dynamic_sidebar("bearstheme-menu-canvas-sidebar"); ?>
</div>
<!-- End Header -->
