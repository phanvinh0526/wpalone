<?php
/**
 * Layout Name: Header 8
 * Preview Image: /assets/images/headers/header-v8.jpg
 */

# variable
$class_header = basename( __FILE__, '.php' );

if( ! function_exists( 'bearsthemes_headerMenu8' ) ) :
	function bearsthemes_headerMenu8( $echo = false )
	{
		global $bearstheme_options;

		# tb_sticky_menu
		$tb_sticky_menu = ( isset( $bearstheme_options['tb_sticky_menu'] ) && (int) $bearstheme_options['tb_sticky_menu'] == 1 ) ? 'data-sticky-menu=true' : '';

		# home_url
		$home_url = home_url();

		# logo
		ob_start(); bearstheme_logo( 'v1' ); $logo = ob_get_clean();

		# sidebar_right
		ob_start(); ( is_active_sidebar( 'bearstheme-right-sidebar-header8' ) ) ? dynamic_sidebar( 'bearstheme-right-sidebar-header8' ) : ''; 
		$sidebar_right = ob_get_clean();

		# menu
		$menu_locations = get_nav_menu_locations();
		$menu_attr = array(
			'menu_id' 			=> 'main-menu-selector',
			'menu' 				=> '',
			'theme_location' 	=> 'main_navigation',
			'container_class' 	=> 'bearsthemes-menu-style',
			'menu_class'      	=> '',
			'echo'            	=> true,
			'items_wrap'      	=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'           	=> 0,
			);
		ob_start(); ( ! empty( $menu_locations['main_navigation'] ) ) ? wp_nav_menu( $menu_attr ) : wp_page_menu(); $menu = ob_get_clean();

		ob_start();
		echo "
			<div class='menu-wrap' {$tb_sticky_menu}>
				<div class='container-fluid'>
					<div class='row'>
						<div class='col-md-3 col-sm-4 col-xs-4'>
							<div class='logo-container'>
								<a href='{$home_url}'>{$logo}</a>
							</div>
						</div>
						<div class='col-md-9 col-sm-8 col-xs-8'>
							<div class='sidebar-container'>
								{$sidebar_right}
							</div>
						</div>
					</div>
				</div>
			</div>";
		$output = ob_get_clean();

		if( $echo == true ) echo "{$output}";
		else return $output;
	}
endif;
?>
<!-- START header -->
<header id="bt_main_header">
	<div class="main-header-wrap <?php echo esc_attr( $class_header ); ?>">
		<?php
			bearsthemes_headerMenu8( true );
		?>
	</div>
</header>
<!-- END header -->
