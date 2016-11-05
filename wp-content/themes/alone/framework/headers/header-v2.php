<?php 
/**
 * Layout Name: Header Fixed
 * Preview Image: /assets/images/headers/header-v2.jpg
 */
?>

<!-- Start Header -->
<header>
	<div id="bt_header" class="bt-header-v2 bt-header-fixed"><!-- bt-header-stick/bt-header-fixed -->
		<!-- Start Header Menu -->
		<div class="bt-header-menu">
			<div class="row">
				<div class="container">
					<div class="col-md-2">
						<div class="bt-logo">
							<a href="<?php echo esc_url(home_url()); ?>">
								<?php bearstheme_logo('v2'); ?>
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
