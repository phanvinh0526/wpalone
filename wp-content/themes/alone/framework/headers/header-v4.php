<?php  
/**
 * Layout Name: Header 4
 * Preview Image: /assets/images/headers/header-v4.jpg
 */

/**
 * bearsthemes_headerTop4
 *
 * @param [true/false] $echo
 * @return [Html]
 */
if( ! function_exists( 'bearsthemes_headerTop4' ) ) :
	function bearsthemes_headerTop4( $echo = false )
	{
		# sidebar_left
		ob_start(); ( is_active_sidebar( 'bearstheme-header-top-widget') ) ? dynamic_sidebar( 'bearstheme-header-top-widget' ) : ''; $sidebar_left = ob_get_clean();
		# sidebar_right
		ob_start(); ( is_active_sidebar( 'bearstheme-header-top-widget-2') ) ? dynamic_sidebar( 'bearstheme-header-top-widget-2' ) : ''; $sidebar_right = ob_get_clean();

		ob_start();
		echo "
		<div class='header-top-wrap'>
			<div class='container'>
				<div class='row'>
					<div class='col-md-5 col-sm-5 col-xs-12 h-top-left'>" 
						. $sidebar_left . 
					"</div>
					<div class='col-md-7 col-sm-7 col-xs-12 text-right h-top-right'>"
						. $sidebar_right .
					"</div>
				</div>
			</div>
		</div>";
		$output = ob_get_clean();

		if( $echo == true ) echo "{$output}";
		else return $output;
	}
endif;

/**
 * bearsthemes_headerMenu4
 *
 * @param [true/false] $echo
 * @return [Html]
 */
if( ! function_exists( 'bearsthemes_headerMenu4' ) ) :
	function bearsthemes_headerMenu4( $echo = false )
	{
		global $bearstheme_options;

		# home_url
		$home_url = home_url();

		# tb_show_button_donate
		$tb_show_button_donate = ( isset( $bearstheme_options['tb_show_button_donate'] ) && (int) $bearstheme_options['tb_show_button_donate'] == 1 && class_exists( 'TBDonations' ) ) ? true : false;
		
		# tbdonations_form
		$tbdonations_form = ( $tb_show_button_donate == true ) ? do_shortcode('[tbdonations_form]') : '';

		# tb_sticky_menu
		$tb_sticky_menu = ( isset( $bearstheme_options['tb_sticky_menu'] ) && (int) $bearstheme_options['tb_sticky_menu'] == 1 ) ? 'data-sticky-menu=true' : '';


		# logo
		ob_start(); bearstheme_logo( 'v1' ); $logo = ob_get_clean();
		
		# sidebar_right
		ob_start(); ( is_active_sidebar( 'bearstheme-menu-right-sidebar-header4' ) ) ? dynamic_sidebar( 'bearstheme-menu-right-sidebar-header4' ) : ''; $sidebar_right = ob_get_clean();
		
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

		ob_start();
		echo "
		<div class='header-menu-wrap'>
			<div class='container'>
				<div class='row logo-sidebar-wrap'>
					<div class='col-md-6 col-sm-6 col-xs-6 l-top-left'>
						<div class='bt-logo'>
							<a href='{$home_url}'>{$logo}</a>
						</div>
					</div>
					<div class='col-md-6 col-sm-6 col-xs-6 text-right l-top-right'>{$sidebar_right}</div>
				</div>
			</div>
			<div class='menu-wrap' {$tb_sticky_menu}>
				<div class='container'>
					<div class='row'>
						<div class='col-md-12'>
							<div class='menu-container'>
								<a href='#main-menu-selector' class='btn-toggle-menu-mobi style-round'>
									<i class='ion-navicon-round'></i>
								</a>
								{$menu}
								{$tbdonations_form}
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

# variable
$class_header = basename( __FILE__, '.php' );
?>
<!-- START header -->
<header id="bt_main_header">
	<div class="main-header-wrap <?php echo esc_attr( $class_header ); ?>">
		<?php
			bearsthemes_headerTop4( true );
			bearsthemes_headerMenu4( true );
		?>
	</div>
</header>
<!-- END header -->