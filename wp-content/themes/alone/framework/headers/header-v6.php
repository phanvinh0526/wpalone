<?php
/**
 * Layout Name: Header 6
 * Preview Image: /assets/images/headers/header-v6.jpg
 */

# variable
$class_header = basename( __FILE__, '.php' );

if( ! function_exists( 'bearsthemes_headerTop6' ) ) :
	function bearsthemes_headerTop6( $echo ) 
	{
		global $bearstheme_options;

		# tb_show_button_donate
		$tb_show_button_donate = ( isset( $bearstheme_options['tb_show_button_donate'] ) && (int) $bearstheme_options['tb_show_button_donate'] == 1 && class_exists( 'TBDonations' ) ) ? true : false;

		# tbdonations_form
		$tbdonations_form = ( $tb_show_button_donate == true ) ? do_shortcode('[tbdonations_form]') : '';

		# logo
		ob_start(); bearstheme_logo( 'v2' ); $logo = ob_get_clean();

		# sidebar_header6_area1
		ob_start(); ( is_active_sidebar( 'bearstheme-header6-area1') ) ? dynamic_sidebar( 'bearstheme-header6-area1' ) : ''; $sidebar_area1 = ob_get_clean();
		
		# sidebar_header6_area2
		ob_start(); ( is_active_sidebar( 'bearstheme-header6-area2') ) ? dynamic_sidebar( 'bearstheme-header6-area2' ) : ''; $sidebar_area2 = ob_get_clean();

		ob_start();
		echo "
		<div class='header-top-wrap'>
			<div class='container'>
				<div class='row'>
					<div class='col-md-3 col-sm-12 col-xs-12 area-top-left'>
						{$logo}
					</div>
					<div class='col-md-9 col-sm-12 col-xs-12 area-top-right'>
						<div class='row'>
							<div class='col-md-12'>
								<div class='header-top-wrap-area1'>
									{$sidebar_area1}
									{$tbdonations_form}
								</div>
							</div>
							<div class='col-md-12'>
								<div class='header-top-wrap-area2'>
									{$sidebar_area2}
								</div>
							</div>
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

if( ! function_exists( 'bearsthemes_headerMenu6' ) ) :
	function bearsthemes_headerMenu6( $echo ) 
	{
		global $bearstheme_options;

		# home_url
		$home_url = home_url();

		# tb_sticky_menu
		$tb_sticky_menu = ( isset( $bearstheme_options['tb_sticky_menu'] ) && (int) $bearstheme_options['tb_sticky_menu'] == 1 ) ? 'data-sticky-menu=true' : '';

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

		# menu
		ob_start(); ( ! empty( $menu_locations['main_navigation'] ) ) ? wp_nav_menu( $menu_attr ) : wp_page_menu(); $menu = ob_get_clean();

		# sidebar_header6_area3
		ob_start(); ( is_active_sidebar( 'bearstheme-header6-area3') ) ? dynamic_sidebar( 'bearstheme-header6-area3' ) : ''; $sidebar_area3 = ob_get_clean();

		ob_start();
		echo "
		<div class='header-menu-wrap'>
			<div class='menu-wrap' {$tb_sticky_menu}>
					<div class='container'>
						<div class='row'>
							<div class='col-md-12'>
								<div class='menu-container'>
									<a href='#main-menu-selector' class='btn-toggle-menu-mobi style-round'>
										<i class='ion-navicon-round'></i>
									</a>
									{$menu}
									<div class='menu-sidebar-wrap'>
										{$sidebar_area3}
									</div>
								</div>
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
			bearsthemes_headerTop6( true );
			bearsthemes_headerMenu6( true );
		?>
	</div>
</header>
<!-- END header -->