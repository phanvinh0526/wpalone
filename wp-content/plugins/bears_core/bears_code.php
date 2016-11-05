<?php
/*
 * Plugin Name: Bears Core
 * Plugin URI: http://bearsthemes.com
 * Description: This is a plugin required for wordpress theme from Bearsthemes 
 * Version: 1.1
 * Author: Bearsthemes
 * Author URI: http://bearsthemes.com
 * License: GPLv2 or later
 * Text Domain: bearsthemes
 */

define( 'BCORE_DIR', plugin_dir_path(__FILE__) );
define( 'BCORE_URI', plugin_dir_url(__FILE__) );
define( 'BCORE_INCLUDES', BCORE_DIR . "_inc/" );
define( 'BCORE_ADMIN', BCORE_DIR . "admin/" );
define( 'BCORE_CSS', BCORE_URI . "assets/css/" );
define( 'BCORE_JS', BCORE_URI . "assets/js/" );
define( 'BCORE_IMAGES', BCORE_URI . "assets/images/" );

/* Autoupdate */
require_once BCORE_INCLUDES . 'plugin-update-checker-3.1/plugin-update-checker.php';
$BCoreUpdateChecker = PucFactory::buildUpdateChecker( 'http://theme.bearsthemes.com/autoupdate/plugins/bears_core/update-info.json', __FILE__ );

/* include functions.php */
require BCORE_INCLUDES . 'functions.php';

/* include Redux Options */
require BCORE_DIR . 'admin/admin-init.php';

/* use class bears_core */
new bears_core;

/* class bears_core */
class bears_core
{
	function __construct()
	{
		add_action( 'init', array( $this, 'bcore_init' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_bears_core_style' ) );
	}

	function bcore_init()
	{
		
	}
	
	function load_bears_core_style() {
        wp_register_style( 'bears_core_admin_css', BCORE_URI . '/assets/css/bears_core.admin.css', false, '1.0.0' );
        wp_enqueue_style( 'bears_core_admin_css' );

        wp_register_script( 'bears_core_admin_js', BCORE_URI . '/assets/js/jquery.bears_core.admin.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'bears_core_admin_js' );
		wp_localize_script( 'bears_core_admin_js', 'bcore_object', array( 'ajax_url' => admin_url('admin-ajax.php') ) );
	}

}