<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Bears Class
 * A helper class for general options pages and routing
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
 class Bears{

		function __construct(){
			if(is_admin()){
			 	//add_action( 'admin_header', array("Bears","load_header") );
			 	add_action( 'admin_footer', array("Bears","load_footer") );

			}
		}

		public static function load_header(){
				wp_enqueue_style( 'bears', plugin_dir_url(__FILE__ )."assets/css/bears.css" );
				wp_enqueue_script( 'bears', plugin_dir_url(__FILE__ )."assets/js/bears.js"  , array(), '1.0.0', true );
		} 

		public static function load_footer(){
				wp_enqueue_style( 'bears', plugin_dir_url(__FILE__ )."assets/css/bears.css" );
				wp_enqueue_script( 'bears', plugin_dir_url(__FILE__ )."assets/js/bears.js"  , array(), '1.0.0', true );
		} 		

 		public static function route($page = ''){
 			   if($page == "bears-help"){
 			   		 include_once wp_normalize_path(plugin_dir_path(__FILE__ ) .'/template/help.php');
 			   }else if($page == "bears-product"){
 			   		 include_once wp_normalize_path(plugin_dir_path(__FILE__ ) .'/template/products.php');
 			   }
 		}

 }


?>