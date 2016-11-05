<?php
/* Define THEME */
if (!defined('URI_PATH')) define('URI_PATH', get_template_directory_uri());
if (!defined('ABS_PATH')) define('ABS_PATH', get_template_directory());
if (!defined('URI_PATH_FR')) define('URI_PATH_FR', URI_PATH.'/framework');
if (!defined('ABS_PATH_FR')) define('ABS_PATH_FR', ABS_PATH.'/framework');
if (!defined('URI_PATH_ADMIN')) define('URI_PATH_ADMIN', URI_PATH_FR.'/admin');
if (!defined('ABS_PATH_ADMIN')) define('ABS_PATH_ADMIN', ABS_PATH_FR.'/admin');

/* Frameword functions */
require_once ABS_PATH_FR . '/functions.php';

/* Theme Options */
// require_once (ABS_PATH_ADMIN.'/options.php');
if( function_exists( 'bcore_redux_setup' ) ) { bcore_redux_setup( ABS_PATH.'/redux-options/options.php' ); }

function bearstheme_removeDemoModeLink() { // Be sure to rename this function to something more unique
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
}
add_action('init', 'bearstheme_removeDemoModeLink');

require_once (ABS_PATH_ADMIN.'/index.php');

/* Template Functions */
require_once ABS_PATH_FR . '/template-functions.php';

/* Template Functions */
require_once ABS_PATH_FR . '/templates/post-favorite.php';
require_once ABS_PATH_FR . '/templates/post-functions.php';

/* Function for Framework */
require_once ABS_PATH_FR . '/includes.php';

/* Register Sidebar */
if (!function_exists('bearstheme_RegisterSidebar')) {
	function bearstheme_RegisterSidebar(){
		global $bearstheme_options;
		register_sidebar(array(
			'name' => __('Main Sidebar', 'bearsthemes'),
			'id' => 'bearstheme-main-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Blog Left Sidebar', 'bearsthemes'),
			'id' => 'bearstheme-left-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Blog Right Sidebar', 'bearsthemes'),
			'id' => 'bearstheme-right-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebars(2, array(
			'name' => __('Header Top Widget %d', 'bearsthemes'),
			'id' => 'bearstheme-header-top-widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '<div style="clear:both;"></div></div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebars(2, array(
			'name' => __('Header 2 Top Widget %d', 'bearsthemes'),
			'id' => 'bearstheme-header2-top-widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '<div style="clear:both;"></div></div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Menu Right Sidebar', 'bearsthemes'),
			'id' => 'bearstheme-menu-right-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		));
		register_sidebar(array(
			'name' => __('Menu 2 Right Sidebar', 'bearsthemes'),
			'id' => 'bearstheme-menu2-right-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		));
		register_sidebar(array(
			'name' => __('Menu 4 Right Sidebar', 'bearsthemes'),
			'id' => 'bearstheme-menu-right-sidebar-header4',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		));
		register_sidebar(array(
			'name' => __('Menu 5 Center Sidebar', 'bearsthemes'),
			'id' => 'bearstheme-menu-center-sidebar-header5',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		));
		register_sidebar(array(
			'name' => __('Header 6 Sidebar Area 1', 'bearsthemes'),
			'id' => 'bearstheme-header6-area1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		));
		register_sidebar(array(
			'name' => __('Header 6 Sidebar Area 2', 'bearsthemes'),
			'id' => 'bearstheme-header6-area2',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		));
		register_sidebar(array(
			'name' => __('Header 6 Sidebar Area 3', 'bearsthemes'),
			'id' => 'bearstheme-header6-area3',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		));
		register_sidebar(array(
			'name' => __('Header 7 Sidebar Right', 'bearsthemes'),
			'id' => 'bearstheme-right-sidebar-header7',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		));
		register_sidebar(array(
			'name' => __('Header 8 Sidebar Right', 'bearsthemes'),
			'id' => 'bearstheme-right-sidebar-header8',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		));
		register_sidebar(array(
			'name' => __('Menu Canvas Sidebar', 'bearsthemes'),
			'id' => 'bearstheme-menu-canvas-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebars(6, array(
			'name' => __('Custom Sidebar %d', 'bearsthemes'),
			'id' => 'bearstheme-custom-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '<div style="clear:both;"></div></div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebars(4, array(
			'name' => __('Footer Top Widget %d', 'bearsthemes'),
			'id' => 'bearstheme-footer-top-widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '<div style="clear:both;"></div></div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Footer Bottom Widget', 'bearsthemes'),
			'id' => 'bearstheme-footer-bottom-widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		if (class_exists ( 'Woocommerce' )) {
			register_sidebar(array(
				'name' => __('Shop Single Right Sidebar', 'bearsthemes'),
				'id' => 'bearstheme-shop-single-right-sidebar',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="wg-title">',
				'after_title' => '</h4>',
			));
		}
	}
}
add_action( 'widgets_init', 'bearstheme_RegisterSidebar' );

/* Register Default Fonts */
function bearstheme_fonts_url() {
    $font_url = '';
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'bearsthemes' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Montserrat|Arimo:400,700&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
    }
    return $font_url;
}

/* Enqueue Script */
function bearstheme_enqueue_scripts() {
	global $bearstheme_options;
	$preset_color = (isset($bearstheme_options['preset_color'])&&$bearstheme_options['preset_color'])?$bearstheme_options['preset_color']: 'default';
	
	wp_enqueue_style( 'bearstheme-fonts', bearstheme_fonts_url(), array(), '1.0.0' );
	wp_enqueue_style( 'bootstrap.min', URI_PATH.'/assets/css/bootstrap.min.css', false );
	wp_enqueue_style( 'flexslider', URI_PATH . "/assets/vendors/flexslider/flexslider.css",array(),"");
	wp_enqueue_style( 'owl-carousel', URI_PATH . "/assets/vendors/owl-carousel/owl.carousel.css",array(),"");
	wp_enqueue_style( 'jquery.fancybox', URI_PATH . "/assets/vendors/FancyBox/jquery.fancybox.css",array(),"");
	wp_enqueue_style( 'font-awesome', URI_PATH.'/assets/css/font-awesome.min.css', array(), '4.1.0');
	wp_enqueue_style( 'simple-line-icons', URI_PATH.'/assets/css/simple-line-icons.css', array(), '1.0');
	wp_enqueue_style( 'flaticon', URI_PATH.'/assets/css/flaticon.css', array(), '1.0');
	wp_enqueue_style( 'tb.core.min', URI_PATH.'/assets/css/core.min.css', false );
	wp_enqueue_style( 'style', URI_PATH.'/style.css', false );	
	wp_enqueue_style( 'bears_preset', URI_PATH.'/assets/css/presets/'.$preset_color.'.css', false );
	wp_enqueue_script( 'parallax', URI_PATH.'/assets/js/parallax.js', array('jquery'), '', true  );
	wp_enqueue_script( 'waypoints', URI_PATH.'/assets/js/waypoints.min.js', array('jquery'), '', true  );
	wp_enqueue_script( 'counterup', URI_PATH.'/assets/js/jquery.counterup.min.js', array('jquery', 'waypoints'), '', true  );

	wp_enqueue_script( 'bootstrap.min', URI_PATH.'/assets/js/bootstrap.min.js', array('jquery'), '', true  );
	wp_enqueue_script( 'menu', URI_PATH.'/assets/js/menu.js', array('jquery'), '', true  );
	wp_enqueue_script( 'datepicker.min', URI_PATH.'/assets/js/datepicker.min.js', array('jquery'), '', true  );
	wp_enqueue_script( 'jquery.flexslider-min', URI_PATH.'/assets/vendors/flexslider/jquery.flexslider-min.js', array('jquery'), '', true  );
	wp_enqueue_script( 'owl-carousel-min', URI_PATH.'/assets/vendors/owl-carousel/owl.carousel.min.js', array('jquery'), '', true  );
	wp_enqueue_script( 'jquery.fancybox', URI_PATH.'/assets/vendors/FancyBox/jquery.fancybox.js', array('jquery') );
	wp_enqueue_script( 'circle-progress', URI_PATH.'/assets/vendors/circle-progress/circle-progress.js', array('jquery') );
	

	wp_enqueue_script( 'SmoothScroll', URI_PATH.'/assets/js/SmoothScroll.js', array('jquery'), '', true  );

	wp_enqueue_script( 'main', URI_PATH.'/assets/js/main.js', array('jquery'), '', true  );
	if(isset($bearstheme_options["style_selector"])&&$bearstheme_options["style_selector"]) {
		wp_enqueue_script( 'box-style', URI_PATH.'/assets/js/box-style.js', array('jquery'), '', true  );
	}

	// wp_localize_script - main
	wp_localize_script( 'main', 'main_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	if( class_exists( 'Charitable' ) ) :
		wp_enqueue_script( 'accounting' );
		wp_enqueue_script( 'charitable-script' );
	endif;
}
add_action( 'wp_enqueue_scripts', 'bearstheme_enqueue_scripts' );

/* Init Functions */
function bearstheme_init() {
	global $bearstheme_options;
	/* Less */
	if(isset($bearstheme_options['less_design']) && $bearstheme_options['less_design']){
		require_once ABS_PATH_FR.'/presets.php';
	}


}
add_action( 'init', 'bearstheme_init' );

/* Widgets */
require_once ABS_PATH_FR.'/widgets/abstract-widget.php';
require_once ABS_PATH_FR.'/widgets/widgets.php';

/* Woo commerce function */
if (class_exists('Woocommerce')) {
    require_once ABS_PATH . '/woocommerce/wc-template-function.php';
    require_once ABS_PATH . '/woocommerce/wc-template-hooks.php';
}
/* Filter body class */
add_filter( 'body_class', 'bearstheme_class_names' );
function bearstheme_class_names( $classes ) {
	global $post,$bearstheme_options;
	$body_layout = (isset($bearstheme_options["body_layout"])&&$bearstheme_options["body_layout"])?$bearstheme_options["body_layout"]:'wide';
	if($post){
        $tb_layout = get_post_meta($post->ID, 'tb_layout', true)?get_post_meta($post->ID, 'tb_layout', true):'global';
        $body_layout = $tb_layout=='global'?$body_layout:$tb_layout;
    }
	$classes[] = $body_layout;
	// return the $classes array
	return $classes;
}
add_filter('rest_url','bearstheme_rest_url', 10, 4);
function bearstheme_rest_url($url, $path, $blog_id, $scheme){
	return ''; 
}

/**
 * bearsthemes_FontFlaticonLib
 * 
 */
if( ! function_exists( 'bearsthemes_FontFlaticonLib' ) ) :
	function bearsthemes_FontFlaticonLib( $scripts )
	{	
		array_push( $scripts, array(
			'group' => 'flaticon',
			'type' => 'css',
			'handle' => 'environment',
			'src' => URI_PATH . '/assets/fonts/flaticon/environment/font/flaticon.css',
			// 'include' => 0,
			) );

		return $scripts;
	}
endif;
add_filter( 'tbbs_register_scripts', 'bearsthemes_FontFlaticonLib' );
