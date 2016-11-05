<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://bearsthemes.com/
 * @since      1.0.0
 *
 * @package    Bears_Fullscreen_Login
 * @subpackage Bears_Fullscreen_Login/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Bears_Fullscreen_Login
 * @subpackage Bears_Fullscreen_Login/includes
 * @author     BearsThemes <bearsthemes@gmail.com>
 */

class Bears_Fullscreen_Login {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Bears_Fullscreen_Login_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'bears-fullscreen-login';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Bears_Fullscreen_Login_Loader. Orchestrates the hooks of the plugin.
	 * - Bears_Fullscreen_Login_i18n. Defines internationalization functionality.
	 * - Bears_Fullscreen_Login_Admin. Defines all hooks for the admin area.
	 * - Bears_Fullscreen_Login_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bears-fullscreen-login-loader.php';

		/**
		 * The Helpers responsible for defining all functions in both
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/bears-fullscreen-login-helpers.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bears-fullscreen-login-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-bears-fullscreen-login-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-bears-fullscreen-login-public.php';

		/**
		 * Load Recaptcha
		 */
		if ( ! class_exists( 'PAFL_Captcha' ) ){
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/lib/recaptcha/Captcha.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/lib/recaptcha/Exception.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/lib/recaptcha/Response.php';
		}

		if ( ! class_exists( 'Hybrid_Auth' ) ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/lib/hybridauth/Hybrid/Auth.php';
		}

		$this->loader = new Bears_Fullscreen_Login_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Bears_Fullscreen_Login_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Bears_Fullscreen_Login_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Bears_Fullscreen_Login_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_init', 		    $plugin_admin, 'register_wp_menu_links' );
		

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Bears_Fullscreen_Login_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		// Register Shortcode
		$this->loader->add_action( 'init'			   , $plugin_public, 'register_shortcodes', 10, 2 );
		
		// Custom styles 
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'modal_styles');

		// Add overlay html to footer
		$this->loader->add_action( 'wp_footer' , $plugin_public, 'append_to_footer', 10, 2 );

		// Run Ajax on the login
		$this->loader->add_action( 'wp_ajax_nopriv_ajaxlogin'  ,  $plugin_public, 'ajax_login', 10 );
		$this->loader->add_action( 'wp_ajax_ajaxlogin'         ,  $plugin_public, 'ajax_login', 10 );

		// Run Ajax on the login
		$this->loader->add_action( 'wp_ajax_nopriv_ajaxSocialLogin'  ,  $plugin_public, 'ajax_social_login', 10 );
		$this->loader->add_action( 'wp_ajax_ajaxSocialLogin'         ,  $plugin_public, 'ajax_social_login', 10 );

		// Load Captcha scripts
		$this->loader->add_action( 'wp_head', $plugin_public, 'captcha_scripts' );

		//Google Meta data
		$this->loader->add_action( 'wp_head', $plugin_public, 'google_meta_data' );

		// Load Google Captcha scripts
		$this->loader->add_action( 'wp_footer', $plugin_public, 'captcha_google_scripts' );

		// Display right label for login/logout WP_Menu
		$this->loader->add_filter( 'wp_nav_menu_objects', $plugin_public, 'pafl_filter_frontend_modal_link_label', 10, 1 );

		// Filter Menu attributes
		$this->loader->add_filter( 'nav_menu_link_attributes', $plugin_public, 'pafl_filter_frontend_modal_link_atts', 10, 3 );

		// Hide Register from Menu when user is logged in
		$this->loader->add_filter( 'wp_nav_menu_objects', $plugin_public, 'pafl_filter_frontend_modal_link_register_hide', 10, 1 );

		//Avatar for social profile
		$this->loader->add_filter( 'get_avatar', $plugin_public, 'social_avatar', 1, 2 );

		//Social login
		$this->loader->add_action( 'wp_footer', $plugin_public, 'pafl_social_login' );

		//logout hook to logout all session from social login if there is
		$this->loader->add_action( 'wp_logout', $plugin_public, 'logout_action_hook' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Bears_Fullscreen_Login_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
