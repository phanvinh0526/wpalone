<?php
/**
 * Plugin Name:       Bears Fullscreen Login
 * Plugin URI:        http://bearsthemes.com/
 * Version:           1.1
 * Author:            BearsThemes
 * Author URI:        http://bearsthemes.com/
 * Text Domain:       bears-fullscreen-login
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
define( 'BEARS_FULLSCREEN_LOGIN_PATH', plugin_dir_path( __FILE__ ) );


/* Autoupdate */
require_once BEARS_FULLSCREEN_LOGIN_PATH . 'admin/plugin-update-checker-3.1/plugin-update-checker.php';
$BCoreUpdateChecker = PucFactory::buildUpdateChecker( 'http://theme.bearsthemes.com/autoupdate/plugins/bears-fullscreen-login/update-info.json', __FILE__ );

/**
 * Skelet Config Path
 */
$skelet_paths[] = array(
    'prefix'      => 'pafl',
    'dir'         => wp_normalize_path(  plugin_dir_path( __FILE__ ).'/admin/' ),
    'uri'         => plugin_dir_url( __FILE__ ).'/admin/skelet',
);

/**
 * Load Skelet Framework
 */
if( ! class_exists( 'Skelet_LoadConfig' ) ){
	include_once dirname( __FILE__ ) . '/admin/skelet/skelet.php';
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bears-fullscreen-login-activator.php
 */
function activate_bears_fullscreen_login() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bears-fullscreen-login-activator.php';
	Bears_Fullscreen_Login_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bears-fullscreen-login-deactivator.php
 */
function deactivate_bears_fullscreen_login() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bears-fullscreen-login-deactivator.php';
	Bears_Fullscreen_Login_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bears_fullscreen_login' );
register_deactivation_hook( __FILE__, 'deactivate_bears_fullscreen_login' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bears-fullscreen-login.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_bears_fullscreen_login() {

	$plugin = new Bears_Fullscreen_Login();
	$plugin->run();

}
run_bears_fullscreen_login();