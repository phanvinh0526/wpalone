<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://bearsthemes.com/
 * @since      1.0.0
 *
 * @package    Bears_Fullscreen_Login
 * @subpackage Bears_Fullscreen_Login/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Bears_Fullscreen_Login
 * @subpackage Bears_Fullscreen_Login/public
 * @author     BearsThemes <bearsthemes@gmail.com>
 */
class Bears_Fullscreen_Login_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of the plugin.
	 * @param      string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		$pafl_sk     = new Skelet( "pafl" );
		$modal_class = $pafl_sk->get( 'modal_effect' );

		wp_enqueue_style( 'pafl-' . $modal_class, plugin_dir_url( __FILE__ ) . 'css/effects/' . $modal_class . '.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bears-fullscreen-login-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'background.cycle.min', plugin_dir_url( __FILE__ ) . 'js/background.cycle.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bears-fullscreen-login-public.js', array( 'jquery' ), $this->version, false );
		$pafl_sk = new Skelet( 'pafl' );
		$auto_popup = $pafl_sk->get( 'auto_popup' );
		$scroll_top = $pafl_sk->get( 'scroll_top' );
		$user_ID = get_current_user_id();	
		
		$modal_gallery        = $pafl_sk->get( 'modal_gallery' );
		$fadespeed        = $pafl_sk->get( 'fadespeed' );
		$duration        = $pafl_sk->get( 'duration' );
		$modal_gallery = explode(',',$modal_gallery);
		$images = array();
		if ( ! empty( $modal_gallery ) ){
			foreach($modal_gallery as $k=>$img):
				$images[] = wp_get_attachment_url($img);
			endforeach;
		}

		//attribute that will be passed on javascript
		wp_localize_script( $this->plugin_name, 'PAFL', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'auto_popup' => $auto_popup,
			'scroll_top' => $scroll_top,
			'user_id' => $user_ID,
			'images' => $images,
			'fadespeed' => $fadespeed,
			'duration' => $duration,
		) );
	}

	/**
	 *  Register all shortcodes
	 *
	 * @since  1.0.0
	 */
	public function register_shortcodes() {
		add_shortcode( 'login_link', array( $this, 'pafl_login_link' ) );
		add_shortcode( 'register_link', array( $this, 'pafl_register_link' ) );
	}

	/**
	 * Login link shortcode
	 *
	 * @param Array $atts
	 *
	 * @return string html login link
	 */
	function pafl_login_link( $atts ) {

		$atts = shortcode_atts(
			array(
				'login_text'  => __( 'Login', 'bears-fullscreen-login' ),
				'logout_text' => __( 'Logout', 'bears-fullscreen-login' )
			), $atts, 'pafl_login_link'
		);

		if ( is_user_logged_in() ) {
			return '<a href="' . wp_logout_url() . '" class="pafl-logout-link">' . $atts['logout_text'] . '</a>';
		} else {
			return '<a href="#" onclick="return false" data-form="login"  class="pafl-trigger-overlay pafl-login-link" >' . $atts['login_text'] . '</a>';
		}
	}

	/**
	 * Register link shortcode
	 *
	 * @param Array $atts
	 *
	 * @return string html register link
	 */
	public function pafl_register_link( $atts ) {
		$atts = shortcode_atts(
			array(
				'register_text' => __( 'Create an Account', 'bears-fullscreen-login' )
			), $atts, 'pafl_register_link'
		);

		if ( ! is_user_logged_in() ) {
			return '<a href="#" onclick="return false" data-form="register"  class="pafl-trigger-overlay pafl-register-link">' . $atts['register_text'] . '</a>';
		}

		return '';
	}


	/**
	 * Add login/logout & register link
	 *
	 * @param Array $atts
	 *
	 * @return string html login/logout
	 */
	public function add_link_shortcode( $atts ) {
		$atts = shortcode_atts(
			array(
				'login_text'    => 'Login',
				'logout_text'   => 'Logout',
				'register'      => false,
				'register_text' => 'Create an Accout'
			), $atts, 'pafl_link'
		);

		if ( $atts['register'] && ! is_user_logged_in() ) {
			echo "<a href='#' onclick='return false' data-form='login'  class='pafl-trigger-overlay'>" . sprintf(  __( '%s', 'bears-fullscreen-login' ) , $atts['login_text'] ) . "</a><br>";
			echo "<a href='#' onclick='return false' data-form='register'  class='pafl-trigger-overlay'>" . sprintf( __( '%s', 'bears-fullscreen-login' ) , $atts['register_text'] ) . "</a>";
		} else {
			if ( is_user_logged_in() ) {
				$pafl_sk               = new Skelet( 'pafl' );
				$after_logout_redirect = $this->filter_redirect_url( $pafl_sk->get( 'redirect_allow_after_logout_redirection_url' ) );

				//check if after logout redirect url is present
				if ( ! empty( $after_logout_redirect ) ) {
					$logout_url = wp_logout_url( $after_logout_redirect );
				} else {
					$logout_url = wp_logout_url();
				}

				echo "<a href='" . esc_url( $logout_url ) . "' >" . sprintf( __( '%s', 'bears-fullscreen-login' ), $atts['logout_text'] ) . "</a>";

			} else {
				echo "<a href='#' onclick='return false'  data-form='login'  class='pafl-trigger-overlay'>" . sprintf( __( '%s', 'bears-fullscreen-login' ), $atts['login_text'] ) . "</a>";
			}
		}
	}


	/**
	 * Add modal inline styles in header
	 *
	 * @return callback custom css
	 *
	 */
	public function modal_styles() {

		$pafl_sk                       = new Skelet( "pafl" );
		$custom_css                    = $this->filtered_string( $pafl_sk->get( 'custom_css' ) );
		$modal_class                   = $this->filtered_string( $pafl_sk->get( 'modal_effect' ) );
		$modal_background              = $this->filtered_background( $pafl_sk->get( 'modal_background' ) );
		$modal_text                    = $this->filtered_string( $pafl_sk->get( 'text_color' ) );
		$msg_text_color                    = $this->filtered_string( $pafl_sk->get( 'msg_text_color' ) );
		$input_border_radius           = $this->filtered_string( $pafl_sk->get( 'input_border_radius' ) );
		$input_color            = $this->filtered_string( $pafl_sk->get( 'input_color' ) );
		$input_border_color            = $this->filtered_string( $pafl_sk->get( 'input_border_color' ) );
		$input_border_width            = $this->filtered_string( $pafl_sk->get( 'input_border_width' ) );
		$button_text_color             = $this->filtered_string( $pafl_sk->get( 'button_text_color' ) );
		$button_background_color       = $this->filtered_string( $pafl_sk->get( 'button_background_color' ) );
		$effect_duration       = $this->filtered_string( $pafl_sk->get( 'effect_duration' ) );
		$slider_color = $this->filtered_background( $pafl_sk->get( 'slider_color' ) );
		$bg_mobile_color = $this->filtered_string( $pafl_sk->get( 'bg_mobile_color' ) );
		$button_background_color_hover = $this->filtered_string( $pafl_sk->get( 'button_background_color_hover' ) );
		$social_show_text = $pafl_sk->get( 'social_show_text' );
		$social_btn_style = $pafl_sk->get( 'social_btn_style' );
		$social_column = $pafl_sk->get( 'social_column' );
		if ( ! empty( $effect_duration ) ) {
			$custom_css .= ".pafl-modal-wrap{ animation-duration: " . $effect_duration . "ms !important;-webkit-animation-duration: " .$effect_duration. "ms !important; }";
		}
		if ( ! empty( $modal_background ) ) {
			$custom_css .= ".pafl-overlay{ background: " . $modal_background . "; }";
		}
		if ( ! empty( $bg_mobile_color ) && wp_is_mobile() ) {
			$custom_css .= "div.pafl-overlay,div.pafl-overlay[data-type=\"video\"] ,
div.pafl-overlay[data-type=\"slider\"] { background: " . $bg_mobile_color . " !important; }";
		}
		if ( ! empty( $slider_color ) ) {
			$custom_css .= "#pafl-slider{ background: " . $slider_color . "; }";
		}
		if ( $social_show_text == false ) {
			$custom_css .= ".pafl-overlay .pafl-social-login:before {margin-right: 0;}";
		}
		if ( ! empty( $modal_text ) ) {
			$custom_css .= ".pafl-overlay *:not(input){ color: " . $modal_text . "; }";
		}
		if ( ! empty( $msg_text_color ) ) {
			$custom_css .= ".pafl-overlay .pafl-message-result{ color: " . $msg_text_color . "; }";
		}
		$custom_css .= "#pafl-form .pafl-input { color: " . $input_color . "; }";

		if ( ! empty( $input_border_color ) ) {
			// if border width is equal to 0 or less then will hide border
			if ( intval( $input_border_width ) >= 1 ) {
				$custom_css .= "#pafl-form .pafl-input { border-color: " . $input_border_color . "; }";
				$custom_css .= "#pafl-form .pafl-form-links a { border-color: " . $modal_text . "; color: " . $modal_text . "; }";
				$custom_css .= "#pafl-form #pafl-rememberme + label span { border-color: " . $input_border_color . "; }";
			} else {
				$custom_css .= "#pafl-form .pafl-input { border: 0; }";
				$custom_css .= "#pafl-form .pafl-form-links a { border-color: " . $modal_text . "; color: " . $modal_text . "; }";
				$custom_css .= "#pafl-form #pafl-rememberme + label span { border: 0; }";
			}
		}

		if ( ! empty( $input_border_radius ) ) {
			$custom_css .= "#pafl-form .pafl-input { border-radius: " . $input_border_radius . "px; -webkit-border-radius: " . $input_border_radius . "px; }";
			$custom_css .= "#pafl-form .pafl-submit { border-radius: " . $input_border_radius . "px; -webkit-border-radius: " . $input_border_radius . "px; }";
			$custom_css .= ".pafl-overlay .pafl-message { border-radius: " . $input_border_radius . "px; -webkit-border-radius: " . $input_border_radius . "px; }";
			$custom_css .= "#pafl-form .pafl-allow-login { border-radius: " . $input_border_radius . "px; -webkit-border-radius: " . $input_border_radius . "px; }";
			$custom_css .= "#pafl-form .pafl-forgot-left { border-radius: " . $input_border_radius . "px; -webkit-border-radius: " . $input_border_radius . "px; }";
			$custom_css .= "#pafl-form .pafl-forgot-right { border-radius: " . $input_border_radius . "px; -webkit-border-radius: " . $input_border_radius . "px; }";
			$custom_css .= "#pafl-form .pafl-create-account { border-radius: " . $input_border_radius . "px; -webkit-border-radius: " . $input_border_radius . "px; }";
		}
		if ( ! empty( $input_border_width ) ) {

			if ( intval( $input_border_width ) >= 1 ) {
				$custom_css .= "#pafl-form .pafl-input { border-style: solid; border-width: " . $input_border_width . "px; }";
				$custom_css .= "#pafl-form #pafl-rememberme + label span { border-style: solid; border-width: " . $input_border_width . "px; }";
			}

		}

		if ( ! empty( $button_background_color ) ) {
			$custom_css .= "#pafl-form .pafl-submit { background-color: " . $button_background_color . ";}";
		}

		if ( ! empty( $button_background_color_hover ) ) {
			$custom_css .= "#pafl-form .pafl-submit:hover { background-color: " . $button_background_color_hover . ";}";
		}

		if ( ! empty( $button_text_color ) ) {
			$custom_css .= "#pafl-form .pafl-submit { color: " . $button_text_color . "; }";
		}

		wp_add_inline_style( 'pafl-' . $modal_class, wp_kses( $custom_css, array( '\"', '\"' ) ) );

	}

	/**
	 * Append modal html to footer in all pages
	 */
	public function append_to_footer() {
		global $post;

		$pafl_sk     = new Skelet( "pafl" );
		$modal_class = $pafl_sk->get( 'modal_effect' );
		$public_key  = $pafl_sk->get( 'recaptcha_public_key' );
		$private_key = $pafl_sk->get( 'recaptcha_private_key' );
		$modal_background_video        = $this->filtered_string( $pafl_sk->get( 'modal_background_video' ) );
		$type_bg              		   = $this->filtered_string( $pafl_sk->get( 'type_bg' ) );
		$modal_parallax                = $pafl_sk->get( 'modal_parallax' );
		$social_show_text = $pafl_sk->get( 'social_show_text' );
		$social_btn_style = $pafl_sk->get( 'social_btn_style' );
		$social_column = $pafl_sk->get( 'social_column' );

		//check if recaptcha was enabled on the options
		if ( $this->is_captcha_enabled() ) {

			//create the Captcha object
			$captcha = new PAFL_Captcha();
			$captcha->setPublicKey( $public_key );
			$captcha->setPrivateKey( $private_key );
			$captcha->setTheme( $pafl_sk->get( 'recaptcha_theme' ) );

			//use to check on which page the captcha is enabled
			$recaptcha_status = $pafl_sk->get( 'recaptcha_enable_on' );
		}
		if($modal_parallax) $modal_class .= ' modal_parallax';
		if ( ! empty( $modal_background_video ) && $type_bg == 'video' && !wp_is_mobile() ) { ?>
			<video id="modal_background_video" autoplay controls loop muted>
				<source src="<?php echo $modal_background_video;?>" type="video/webm">
			</video>
		<?php }
		if ( $type_bg == 'slider' && !wp_is_mobile()) { ?>
			<div id="pafl-slider">
			</div>
		<?php }
		echo "<div data-type='".$type_bg."' class=\"pafl-overlay pafl-overlay-" . $modal_class . "\">\n";
		echo "<svg width='120px' height='120px' xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\" preserveAspectRatio=\"xMidYMid\" style=\"display:none\"class=\"pafl-loader\"><rect x=\"0\" y=\"0\" width=\"100\" height=\"100\" fill=\"none\" class=\"bk\"></rect><rect  x='46.5' y='40' width='7' height='20' rx='5' ry='5' fill='" . esc_attr( esc_attr( $this->filtered_string( $pafl_sk->get( 'text_color' ) ) ) ) . "' transform='rotate(0 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0s' repeatCount='indefinite'/></rect><rect  x='46.5' y='40' width='7' height='20' rx='5' ry='5' fill='" . esc_attr( esc_attr( $this->filtered_string( $pafl_sk->get( 'text_color' ) ) ) ) . "' transform='rotate(30 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.08333333333333333s' repeatCount='indefinite'/></rect><rect  x='46.5' y='40' width='7' height='20' rx='5' ry='5' fill='" . esc_attr( esc_attr( $this->filtered_string( $pafl_sk->get( 'text_color' ) ) ) ) . "' transform='rotate(60 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.16666666666666666s' repeatCount='indefinite'/></rect><rect  x='46.5' y='40' width='7' height='20' rx='5' ry='5' fill='" . esc_attr( esc_attr( $this->filtered_string( $pafl_sk->get( 'text_color' ) ) ) ) . "' transform='rotate(90 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.25s' repeatCount='indefinite'/></rect><rect  x='46.5' y='40' width='7' height='20' rx='5' ry='5' fill='" . esc_attr( esc_attr( $this->filtered_string( $pafl_sk->get( 'text_color' ) ) ) ) . "' transform='rotate(120 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.3333333333333333s' repeatCount='indefinite'/></rect><rect  x='46.5' y='40' width='7' height='20' rx='5' ry='5' fill='" . esc_attr( esc_attr( $this->filtered_string( $pafl_sk->get( 'text_color' ) ) ) ) . "' transform='rotate(150 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.4166666666666667s' repeatCount='indefinite'/></rect><rect  x='46.5' y='40' width='7' height='20' rx='5' ry='5' fill='" . esc_attr( esc_attr( $this->filtered_string( $pafl_sk->get( 'text_color' ) ) ) ) . "' transform='rotate(180 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.5s' repeatCount='indefinite'/></rect><rect  x='46.5' y='40' width='7' height='20' rx='5' ry='5' fill='" . esc_attr( esc_attr( $this->filtered_string( $pafl_sk->get( 'text_color' ) ) ) ) . "' transform='rotate(210 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.5833333333333334s' repeatCount='indefinite'/></rect><rect  x='46.5' y='40' width='7' height='20' rx='5' ry='5' fill='" . esc_attr( esc_attr( $this->filtered_string( $pafl_sk->get( 'text_color' ) ) ) ) . "' transform='rotate(240 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.6666666666666666s' repeatCount='indefinite'/></rect><rect  x='46.5' y='40' width='7' height='20' rx='5' ry='5' fill='" . esc_attr( esc_attr( $this->filtered_string( $pafl_sk->get( 'text_color' ) ) ) ) . "' transform='rotate(270 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.75s' repeatCount='indefinite'/></rect><rect  x='46.5' y='40' width='7' height='20' rx='5' ry='5' fill='" . esc_attr( esc_attr( $this->filtered_string( $pafl_sk->get( 'text_color' ) ) ) ) . "' transform='rotate(300 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.8333333333333334s' repeatCount='indefinite'/></rect><rect  x='46.5' y='40' width='7' height='20' rx='5' ry='5' fill='" . esc_attr( esc_attr( $this->filtered_string( $pafl_sk->get( 'text_color' ) ) ) ) . "' transform='rotate(330 50 50) translate(0 -30)'>  <animate attributeName='opacity' from='1' to='0' dur='1s' begin='0.9166666666666666s' repeatCount='indefinite'/></rect></svg>";
		echo "<svg xmlns=\"http://www.w3.org/2000/svg\" enable-background=\"new 0 0 100 100\" version=\"1.1\" viewBox=\"0 0 100 100\" xml:space=\"preserve\" class=\"pafl-overlay-close\" ><polygon fill=\"" . esc_attr( $this->filtered_string( $pafl_sk->get( 'text_color' ) ) ) . "\" points=\"77.6 21.1 49.6 49.2 21.5 21.1 19.6 23 47.6 51.1 19.6 79.2 21.5 81.1 49.6 53 77.6 81.1 79.6 79.2 51.5 51.1 79.6 23 \"/></svg>";
		echo "<nav>\n";
		echo "<ul>\n";
		echo "<li>\n";
		// Form Logo
		$form_logo = $this->filtered_string( $pafl_sk->get( 'form_logo' ) );

		if ( ! empty( $form_logo ) ) {
			echo "<img class=\"pafl-form-logo\" src='" . esc_attr( $form_logo ) . "'/>";
		}
		
		do_action( 'pafl_before_modal_title' ); ?>

		<?php if ( ! is_user_logged_in() ) { ?>
			<div class="pafl-section-container">

			<?php // Login Form ?>
			<div id="pafl-login" class="pafl-modal-wrap pafl-modal-content" data-response="false">

				<h2 class="pafl-title"><?php echo esc_html( $pafl_sk->get( 'login_form_title' ) ); ?></h2>

				<p class="pafl-subtitle"><?php echo esc_html( $pafl_sk->get( 'login_form_subtitle' ) ); ?></p>
				<div class="pafl-message-result"><span class="pafl-message-content"></span><span class="pafl-btn-close">x</span></div>
				<?php do_action( 'pafl_before_modal_login' ); ?>

				<form action="login" method="post" id="pafl-form" class="pafl-form-login">

					<?php do_action( 'pafl_inside_modal_login_first' ); ?>

					<input type="text" name="log" id="login_user" class="pafl-input"
					       placeholder="<?php echo esc_attr( $pafl_sk->get( 'login_form_username_placeholder_text' ) ); ?>"
					       value="<?php echo( isset( $user_login ) ? esc_attr( $user_login ) : '' ); ?>" size="20"/>

					<input type="password" name="pwd" id="login_pass" class="pafl-input"
					       placeholder="<?php echo esc_attr( $pafl_sk->get( 'login_form_password_placeholder_text' ) ); ?>" value=""
					       size="20"/>

					<?php do_action( 'pafl_login_form' ); ?>
					<?php $show_rememberme = $pafl_sk->get( 'rememberme_visibility' ); ?>

					<?php if ( $show_rememberme ): ?>
						<input name="rememberme" type="checkbox"
						       placeholder="<?php echo esc_attr( $pafl_sk->get( 'rememberme_placeholder_text' ) ); ?>"
						       id="pafl-rememberme" value="forever"/>
						<label class="pafl-rememberme-label" for="pafl-rememberme"><span></span></label>
						<p><?php echo esc_html( $pafl_sk->get( 'rememberme_placeholder_text' ) ); ?></p>
					<?php endif; ?>

					<?php
					//check if recaptcha is enabled and public key and private key are present
					if ( isset( $recaptcha_status ) && isset( $captcha ) && $this->is_captcha_field( 'login' ) && ! empty( $public_key ) && ! empty( $private_key ) ): ?>
						<?php echo $captcha->html( 'loginCaptcha' ); ?>
					<?php endif; ?>

					<?php do_action( 'pafl_inside_modal_login_submit' ); ?>

					<input type="submit" name="pafl-submit" id="pafl-login" class="pafl-login-button pafl-submit"
					       value="<?php echo esc_attr( $pafl_sk->get( 'login_button_text' ) ); ?>"/>
					<?php 
					//set the query arg for the url
					$pafl_query_arg = array(
						'action' => 'pafl_social_login',
						'nonce'  => wp_create_nonce( 'social_nonce' )
					); ?>
					<div class="pafl-social-wrap">
					<?php

					//check if facebook login is enabled and will show facebook login
					if ( $this->filtered_string( $pafl_sk->get( 'facebook_login' ) ) ): ?>
						<?php
						//will set social provider to connect to
						$pafl_query_arg['provider'] = 'facebook'; ?>
						<a id="pafl-fb-login" class="pafl-social-login pafl-fb-login pafl-login-button pafl-social-link pafl-<?php echo $social_btn_style; ?> pafl-col<?php echo $social_column; ?>" href="<?php echo esc_url( add_query_arg( $pafl_query_arg, get_the_permalink( $post->ID ) ) ); ?>"><?php echo esc_html( $social_show_text == true ? $pafl_sk->get( 'facebook_login_text' ) : '' ); ?></a>
					<?php endif; ?>

					<?php
					//check if twitter login is enabled and will show twitter login
					if ( $this->filtered_string( $pafl_sk->get( 'twitter_login' ) ) ): ?>
						<?php
						//will set social provider to connect to
						$pafl_query_arg['provider'] = 'twitter'; ?>
						<a id="pafl-twitter-login" class="pafl-social-login pafl-twitter-login pafl-login-button pafl-social-link pafl-<?php echo $social_btn_style; ?> pafl-col<?php echo $social_column; ?>" href="<?php echo esc_url( add_query_arg( $pafl_query_arg, get_the_permalink( $post->ID ) ) ); ?>"><?php echo esc_html( $social_show_text == true ? $pafl_sk->get( 'twitter_login_text' ) : '' ); ?></a>
					<?php endif; ?>
					<?php
					//check if facebook login is enabled and will show facebook login
					if ( $this->filtered_string( $pafl_sk->get( 'google_login' ) ) ): ?>
						<?php
						//will set social provider to connect to
						$pafl_query_arg['provider'] = 'google'; ?>
						<a id="pafl-google-login" class="pafl-social-login pafl-google-login pafl-login-button pafl-social-link pafl-<?php echo $social_btn_style; ?> pafl-col<?php echo $social_column; ?>" href="<?php echo esc_url( add_query_arg( $pafl_query_arg, get_the_permalink( $post->ID ) ) ); ?>"><?php echo esc_html( $social_show_text == true ? $pafl_sk->get( 'google_login_text' ) : '' ); ?></a>
					<?php endif; ?>
					</div>
					<input type="hidden" name="login" value="true"/>

					<?php wp_nonce_field( 'ajax-form-nonce', 'security' ); ?>

					<p class="pafl-form-links">
						<?php $label_forgot = $pafl_sk->get( 'form_forgot_link_text' ); ?>
						<?php if ( empty( $label_forgot ) ) {
							$label_forgot = __( "Forgot password?", 'bears-fullscreen-login' );
						}
						?>
						<?php $label_register = $pafl_sk->get( 'form_register_link_text' ); ?>
						<?php if ( empty( $label_register ) ) {
							$label_register = __( "Register", 'bears-fullscreen-login' );
						}
						?>
						<a href="#" data-form="forgot" class="pafl-forgot-left <?php echo get_option( 'users_can_register' ) ? '' : esc_attr( 'pafl-full-width' ); ?>"><?php echo esc_html( $label_forgot ); ?></a>
						<?php if ( get_option( 'users_can_register' ) ): ?>
							<a href="#" data-form="register" class="pafl-create-account"> <?php echo esc_html( $label_register ); ?></a>
						<?php endif; ?>
					</p><!--[END .form-links]-->

					<?php do_action( 'pafl_inside_modal_login_last' ); ?>

				</form>
				<!--[END #loginform]-->
			</div><!--[END #pafl-login]-->
			<?php // Registration form ?>
			<?php if ( get_option( 'users_can_register' ) ): ?>

				<div id="pafl-register" class="pafl-modal-wrap pafl-modal-content" style="display:none;" data-response="false">

					<h2 class="pafl-title"><?php echo esc_html( $pafl_sk->get( 'register_form_title' ) ); ?></h2>

					<p class="pafl-subtitle"><?php echo esc_html( $pafl_sk->get( 'register_form_subtitle' ) ); ?></p>
					<div class="pafl-message-result"><span class="pafl-message-content"></span><span class="pafl-btn-close">x</span></div>

					<?php do_action( 'pafl_before_modal_register' ); ?>

					<form action="register" method="post" id="pafl-form" class="pafl-form-register">

						<?php do_action( 'pafl_inside_modal_register_first' ); ?>

						<input type="text" name="user_login" id="reg_user" class="pafl-input"
						       placeholder="<?php echo esc_attr( $pafl_sk->get( 'register_form_username_placeholder_text' ) ); ?>"
						       value="<?php echo( isset( $user_login ) ? esc_attr( stripslashes( $user_login ) ) : '' ); ?>"
						       size="20"/>

						<input type="text" name="user_email" id="reg_email" class="pafl-input"
						       placeholder="<?php echo esc_attr( $pafl_sk->get( 'register_form_email_placeholder_text' ) ); ?>"
						       value="<?php echo( isset( $user_email ) ? esc_attr( stripslashes( $user_email ) ) : '' ); ?>"
						       size="20"/>

						<?php
						$allow_user_set_password = $pafl_sk->get( 'allow_user_set_password' );
						if ( $allow_user_set_password ):?>
							<input type="password" name="reg_password" id="reg_password" class="pafl-input"
							       placeholder="<?php echo esc_attr( $pafl_sk->get( 'register_form_password_placeholder_text' ) ); ?>"/>
						<?php endif; ?>
						<?php do_action( 'pafl_register_form' ); ?>
						<?php
						if ( isset( $recaptcha_status ) && isset( $captcha ) && $this->is_captcha_field( 'register' ) && ! empty( $public_key ) && ! empty( $private_key ) ):?>
							<?php echo $captcha->html( 'registerCaptcha' ); ?>
						<?php endif; ?>

						<?php do_action( 'pafl_inside_modal_register_submit' ); ?>

						<input type="submit" name="pafl-submit" id="pafl-register"
						       class="pafl-register-button pafl-submit"
						       value="<?php echo esc_attr( $pafl_sk->get( 'register_button_text' ) ); ?>"/>
						<input type="hidden" name="register" value="true"/>

						<?php wp_nonce_field( 'ajax-form-nonce', 'security' ); ?>

						<p class="pafl-form-links">
							<?php $label_login = $pafl_sk->get( 'form_login_link_text' ); ?>
							<?php if ( empty( $label_login ) ) {
								$label_login = __( "Login", 'bears-fullscreen-login' );
							}
							?>
							<?php $label_forgot = $pafl_sk->get( 'form_forgot_link_text' ); ?>
							<?php if ( empty( $label_forgot ) ) {
								$label_forgot = __( "Forgot password?", 'bears-fullscreen-login' );
							}
							?>
							<a href="#" data-form="login" class='pafl-allow-login'><?php echo esc_html( $label_login ); ?></a>
							<a href="#" data-form="forgot" class='pafl-forgot-right'><?php echo esc_html( $label_forgot ); ?></a>
						</p><!--[END .form-links]-->

						<?php do_action( 'pafl_inside_modal_register_last' ); ?>

					</form>
				</div><!--[END #pafl-register]-->
			<?php endif; ?>
			<?php // Forgotten Password ?>
			<div id="pafl-forgot" class="pafl-modal-wrap pafl-modal-content" style="display:none;" data-response="false">

				<h2 class="pafl-title"><?php echo esc_html( $pafl_sk->get( 'forgot_form_title' ) ); ?></h2>

				<p class="pafl-subtitle"><?php echo esc_html( $pafl_sk->get( 'forgot_form_subtitle' ) ); ?></p>
				<div class="pafl-message-result"><span class="pafl-message-content"></span><span class="pafl-btn-close">x</span></div>


				<?php do_action( 'pafl_before_modal_forgotten' ); ?>

				<form action="forgotten" method="post" id="pafl-form" class="pafl-form-forgotten">

					<?php do_action( 'pafl_inside_modal_forgotton_first' ); ?>

					<input type="text" name="forgot_login" id="forgot_login" class="pafl-input"
					       placeholder="<?php echo esc_attr( $pafl_sk->get( 'forgot_form_username_placeholder_text' ) ); ?>"
					       value="<?php echo( isset( $user_login ) ? esc_attr( stripslashes( $user_login ) ) : '' ); ?>"
					       size="20"/>

					<?php do_action( 'pafl_login_form', 'resetpass' ); ?>
					<?php
					if ( isset( $recaptcha_status ) && isset( $captcha ) && $this->is_captcha_field( 'forgot' ) && ! empty( $public_key ) && ! empty( $private_key ) ):?>
						<?php echo $captcha->html( 'forgotCaptcha' ); ?>
					<?php endif; ?>
					<?php do_action( 'pafl_inside_modal_forgotten_submit' ); ?>

					<input type="submit" name="pafl-submit" id="pafl-forgot" class="pafl-forgotte-button pafl-submit"
					       value="<?php echo esc_attr( $pafl_sk->get( 'forgot_button_text' ) ); ?>">
					<input type="hidden" name="forgotten" value="true"/>

					<?php wp_nonce_field( 'ajax-form-nonce', 'security' ); ?>

					<p class="pafl-form-links">
						<?php $label_login = $pafl_sk->get( 'form_login_link_text' ); ?>
						<?php if ( empty( $label_login ) ) {
							$label_login = __( "Login", 'bears-fullscreen-login' );
						}
						?>
						<a href="#" data-form="login" class="pafl-allow-login pafl-full-width"><?php echo esc_html( $label_login ); ?></a>
					</p><!--[END .form-links]-->

					<?php do_action( 'pafl_inside_modal_forgotten_last' ); ?>

				</form>
			</div><!--[END #forgotten]-->

		<?php } else { ?>
			<div id="already-logged-in" class="pafl-modal-wrap">
				<?php echo __( "You're already logged in.", "bears-fullscreen-login" ); ?>
			</div>
		<?php } ?>

		</div><!--[END .pafl-section-container]-->

		<?php do_action( 'pafl_after_modal_form' ); ?>

		<?php
		echo "</li>\n";
		echo "</ul>\n";
		echo "</nav>\n";
		echo "</div>\n";
	}

	/**
	 * Hybrid_Auth Instance of the Class with Configuration.
	 *
	 * @return Hybrid_Auth
	 */
	public function hybrid_auth() {
		$pafl_sk = new Skelet( 'pafl' );
		$config  = array(
			"base_url"  => plugin_dir_url( dirname( __FILE__ ) ) . "public/lib/hybridauth/",
			"providers" => array(
				"Facebook" => array(
					"enabled"        => true,
					"keys"           => array(
						"id"     => $pafl_sk->get( 'facebook_login_id' ),
						"secret" => $pafl_sk->get( 'facebook_login_secret' )
					),
					"scope"          => "email, public_profile",
					"trustForwarded" => is_ssl()
				),
				"Twitter"  => array(
					"enabled" => true,
					"keys"    => array(
						"key"    => $pafl_sk->get( 'twitter_login_id' ),
	                    "secret" => $pafl_sk->get( 'twitter_login_secret' )
					)
				),
				"Google"   => array(
					"enabled" => true,
					"keys"    => array(
						"id"     => $pafl_sk->get( 'google_login_id' ),
	                    "secret" => $pafl_sk->get( 'google_login_secret' )
					),
				),
			)
		);

		return new Hybrid_Auth( $config );
	}

	public function logout_action_hook() {
		if ( isset( $_SESSION['pafl_provider'] ) ) {
			$hybridauth = $this->hybrid_auth();
			$adapter    = $hybridauth->authenticate( $_SESSION['pafl_provider'] );
			$adapter->logout();
		}
	}

	/**
	 * Social login functionality that utilizes Hybrid_Auth Class
	 * this has been attached to the wordpress init hook
	 */
	public function pafl_social_login() {

		if ( session_id() === '' ) {
			session_start(); // will start session
		}

		if ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] === 'pafl_social_login' ) {

			//check if the nonce is valid
			if ( ! wp_verify_nonce( $_REQUEST['nonce'], 'social_nonce' ) ) {
				die();
			}

			//check if user is already loggedin
			if ( is_user_logged_in() ) {
				echo '<p id="pafl-message-window" class="pafl-message pafl-error" style="display:none;">' . __( 'You are already logged in', 'bears-fullscreen-login' ) . ' <span class="pafl-social-close">&times;</span></p>';

				return;
			}

			$pafl_sk                   = new Skelet( 'pafl' );
			$login_success_msg                    = $this->filtered_string( $pafl_sk->get( 'login_success_msg' ) );
			$register_success_msg                   = $this->filtered_string( $pafl_sk->get( 'register_success_msg' ) );
			$forgot_success_msg                   = $this->filtered_string( $pafl_sk->get( 'forgot_success_msg' ) );
			$data                      = array(); //init the data
			$data['provider']          = ucfirst( $_REQUEST['provider'] );
			$data['nonce']             = $_REQUEST['nonce'];
			$_SESSION['pafl_provider'] = $data['provider'];

			//Hybridauth Instance
			$hybridauth = $this->hybrid_auth();

			try {
				$adapter     = $hybridauth->authenticate( $data['provider'] );
				$pafl_social = $adapter->getUserProfile();
			} catch ( Exception $e ) {
				echo '<p id="pafl-message-window" class="pafl-message pafl-error" style="display:none;">' . sprintf( esc_html__( '%s', 'bears-fullscreen-login' ), $e->getMessage() ) . ' <span class="pafl-social-close">&times;</span></p>';

				return;
			}
			//print_r($pafl_social);die

			//after successfully authenticated the user and get the user profile
			if ( isset( $pafl_social ) ) {
				//information from adapter
				$data['first_name']  = $pafl_social->firstName;
				$data['last_name']   = $pafl_social->lastName;
				$data['email']       = $pafl_social->email;
				$data['username']    = $pafl_social->identifier;
				$data['user_url']    = $pafl_social->webSiteURL;
				$data['description'] = $pafl_social->description;
				$data['avatar']      = $pafl_social->photoURL;
				$data['password']    = wp_generate_password( 10, true, true );

				//username is taken from the hybridauth identifier which is unique for each user and provider
				if ( ! username_exists( $data['username'] ) ) {
					//if successful will return a user id
					$user_id = wp_create_user( $data['username'], $data['password'], $data['email'] );

					//check if there is an error when creating user
					if ( ! is_wp_error( $user_id ) ) {
						$creds                  = array();
						$creds['user_login']    = $data['username'];
						$creds['user_password'] = $data['password'];
						$login                  = wp_signon( $creds, is_ssl() );

						//update user info
						$update_user_info = wp_update_user( array(
							'ID'           => $user_id,
							'first_name'   => $data['first_name'],
							'last_name'    => $data['last_name'],
							'display_name' => $data['first_name'],
							'nickname'     => $data['first_name'],
							'user_url'     => $data['user_url'],
							'description'  => $data['description']
						) );

						//will add meta for profile photo link
						add_user_meta( $user_id, 'pafl_social_profile', $data['avatar'] );

						//check if there is an error when updating the user info and will output error and end execution
						if ( is_wp_error( $update_user_info ) ) {
							echo '<p id="pafl-message-window" class="pafl-message pafl-error" style="display:none;">' . sprintf( esc_html__( '%s', 'bears-fullscreen-login' ), $update_user_info->get_error_message() ) . ' <span class="pafl-social-close">&times;</span></p>';

							return;
						}

						//check if there is a problem logging in
						if ( ! is_wp_error( $login ) ) {
							$after_login_redirect = $this->filter_redirect_url( $pafl_sk->get( 'redirect_allow_after_login_redirection_url' ) );

							echo '<p id="pafl-message-window" class="pafl-message pafl-success" data-redirect="' . esc_url( $after_login_redirect ) . '" style="display:none;">' . $login_success_msg . '</p>';

							return;

						} else {
							//if unable to login
							echo '<p id="pafl-message-window" class="pafl-message pafl-error" style="display:none;">' . sprintf( esc_html__( '%s', 'bears-fullscreen-login' ), $login->get_error_message() ) . ' <span class="pafl-social-close">&times;</span></p>';

							return;
						}

					} else {
						//if unable to create the user
						echo '<p id="pafl-message-window" class="pafl-message pafl-error" style="display:none;">' . sprintf( esc_html__( '%s', 'bears-fullscreen-login' ), $user_id->get_error_message() ) . ' <span class="pafl-social-close">&times;</span></p>';

						return;
					}
				} else {
					//if username and email already exist and we will login the user
					//will only use the username since twitter will not return email
					$user = get_user_by( 'login', $data['username'] );

					//check if the profile pic has been changed and will update
					update_user_meta( $user->data->ID, 'pafl_social_profile', $data['avatar'], get_user_meta( $user->data->ID, 'social_profile', true ) );

					//will generate a new password on each login
					$data['password'] = wp_generate_password( 10, true, true );

					wp_set_password( $data['password'], $user->data->ID );
					if ( $user ) {
						$creds                  = array();
						$creds['user_login']    = $user->data->user_login;
						$creds['user_password'] = $data['password'];
						$login                  = wp_signon( $creds, is_ssl() );

						//check if there is a problem logging in
						if ( ! is_wp_error( $login ) ) {
							$after_login_redirect = $this->filter_redirect_url( $pafl_sk->get( 'redirect_allow_after_login_redirection_url' ) );

							echo '<p id="pafl-message-window" class="pafl-message pafl-success" data-redirect="' . esc_url( $after_login_redirect ) . '" style="display:none;">' . $login_success_msg . '</p>';

							return;

						} else {

							echo '<p id="pafl-message-window" class="pafl-message pafl-error" style="display:none;">' . sprintf( esc_html__( '%s', 'bears-fullscreen-login' ), $login->get_error_message() ) . ' <span class="pafl-social-close">&times;</span></p>';

							return;
						}
					}
				}
			}
		}
	}


	/**
	 * The main Ajax function
	 *
	 * @return string json
	 */
	public function ajax_login() {

		if ( is_user_logged_in() ) {
			echo json_encode( array(
				'loggedin' => false,
				'message'  => __( 'You are already logged in', 'bears-fullscreen-login' ),
			) );
			die();
		}
		// Check our nonce and make sure it's correct.
		check_ajax_referer( 'ajax-form-nonce', 'security' );

		// Get our form data.
		$data = array();

		// Skelet Object
		$pafl_sk = new Skelet( 'pafl' );
		$login_success_msg = $this->filtered_string( $pafl_sk->get( 'login_success_msg' ) );
		$register_success_msg                   = $this->filtered_string( $pafl_sk->get( 'register_success_msg' ) );
		$forgot_success_msg                   = $this->filtered_string( $pafl_sk->get( 'forgot_success_msg' ) );

		//Check if there is a g-recaptcha-response sent via GET and check if it is set to false
		if ( isset( $_REQUEST['g-recaptcha-response'] ) && $_REQUEST['g-recaptcha-response'] !== 'false' ) {
			$g_recaptcha_response = true;
		} else {
			$g_recaptcha_response = false;
		}

		// Check if Captcha is enabled and g-recaptcha-response is set
		if ( $this->is_captcha_enabled() ) {
			// Captcha Response Param
			$captcha_response = $_REQUEST['g-recaptcha-response'];
			$secret_key       = $pafl_sk->get( 'recaptcha_private_key' );

			// Captcha Object
			$captcha = new PAFL_Captcha();
			$captcha->setPrivateKey( $secret_key );
			$captcha->setRemoteIp( $_SERVER['REMOTE_ADDR'] );
		}

		// Validate Captcha through Google and get a Response Object
		if ( isset( $captcha_response ) && isset( $captcha ) ) {
			$response = $captcha->check( $captcha_response );
		}


		// Check that we are submitting the login form
		if ( isset( $_REQUEST['login'] ) ) {

			$data['user_login']    = sanitize_user( $_REQUEST['username'] );
			$data['user_password'] = sanitize_text_field( $_REQUEST['password'] );
			$data['remember']      = ( sanitize_text_field( $_REQUEST['rememberme'] ) == 'TRUE' ) ? true : false;


			//validate if captcha is enabled and login credentials are correct and will provide feedback
			if ( $this->is_captcha_enabled() && $this->is_captcha_field( 'login' ) ) {

				if ( isset( $response ) && $response->isValid() ) {
					//only check user when captcha is valid if captcha is enabled
					$user_login = wp_signon( $data, is_ssl() );

					$after_login_redirect = $this->filter_redirect_url( $pafl_sk->get( 'redirect_allow_after_login_redirection_url' ) );

					if ( is_wp_error( $user_login ) ) {

						echo json_encode( array(
							'loggedin'             => false,
							'message'              => __( 'Wrong Username or Password!', 'bears-fullscreen-login' ),
							'validation'           => false,
							'g_recaptcha_response' => isset( $g_recaptcha_response ) ? $g_recaptcha_response : ''
						) );

					} else {

						echo json_encode( array(
							'loggedin'             => true,
							'message'              => $login_success_msg,
							'redirect'             => esc_url( $after_login_redirect ),
							'validation'           => true,
							'g_recaptcha_response' => isset( $g_recaptcha_response ) ? $g_recaptcha_response : ''
						) );

					}

				} else {

					echo json_encode( array(
						'loggedin'             => false,
						'message'              => __( 'Please verify that your not a robot', 'bears-fullscreen-login' ),
						'validation'           => false,
						'g_recaptcha_response' => isset( $g_recaptcha_response ) ? $g_recaptcha_response : ''
					) );

				}

				// If captcha is disabled
			} else {
				$user_login = wp_signon( $data, is_ssl() );

				if ( is_wp_error( $user_login ) ) {

					echo json_encode( array(
						'loggedin'             => false,
						'message'              => __( 'Wrong Username or Password!', 'bears-fullscreen-login' ),
						'validation'           => true, // set to true if captcha is disabled
						'g_recaptcha_response' => isset( $g_recaptcha_response ) ? $g_recaptcha_response : ''
					) );

				} else {

					$after_login_redirect = $this->filter_redirect_url( $pafl_sk->get( 'redirect_allow_after_login_redirection_url' ) );
					echo json_encode( array(
						'loggedin'             => true,
						'message'              => $login_success_msg,
						'redirect'             => esc_url( $after_login_redirect ),
						'validation'           => true, // set to true if captcha is disabled
						'g_recaptcha_response' => isset( $g_recaptcha_response ) ? $g_recaptcha_response : ''
					) );

				}

			}

		} // Check if we are submitting the register form
		elseif ( isset( $_REQUEST['register'] ) ) {
			$user_data = array(
				'user_login' => sanitize_user( $_REQUEST['username'] ),
				'user_email' => $_REQUEST['email'],
			);

			$allow_user_set_password = $pafl_sk->get( 'allow_user_set_password' );

			if ( $this->is_captcha_enabled() && $this->is_captcha_field( 'register' ) ) {

				if ( isset( $response ) && $response->isValid() ) {

					$user_register = $this->register_new_user( $user_data['user_login'], $user_data['user_email'] );

					// Check if there were any issues with creating the new user
					if ( is_wp_error( $user_register ) ) {
						echo json_encode( array(
							'registerd'            => false,
							'message'              => $user_register->get_error_message(),
							'validation'           => false,
							'g_recaptcha_response' => isset( $g_recaptcha_response ) ? $g_recaptcha_response : ''
						) );
					} else {
						if ( isset( $allow_user_set_password ) && $allow_user_set_password ) {
							$success_message = $register_success_msg;
						} else {
							$success_message = __( 'Registration complete. Check your email.', 'bears-fullscreen-login' );
						}

						$after_register_redirect = $this->filter_redirect_url( $pafl_sk->get( 'redirect_allow_after_registration_redirection_url' ) );
						echo json_encode( array(
							'registerd'            => true,
							'redirect'             => esc_url( $after_register_redirect ),
							'message'              => $success_message,
							'validation'           => true,
							'g_recaptcha_response' => isset( $g_recaptcha_response ) ? $g_recaptcha_response : ''
						) );
					}

				} else {
					echo json_encode( array(
						'registerd'            => false,
						'message'              => __( 'Please verify that your not a robot', 'bears-fullscreen-login' ),
						'validation'           => false,
						'g_recaptcha_response' => isset( $g_recaptcha_response ) ? $g_recaptcha_response : ''
					) );
				}

			} // If captcha is disabled
			else {
				$user_register = $this->register_new_user( $user_data['user_login'], $user_data['user_email'] );

				// Check if there were any issues with creating the new user
				if ( is_wp_error( $user_register ) ) {
					echo json_encode( array(
						'registerd'            => false,
						'message'              => $user_register->get_error_message(),
						'validation'           => true, // set to true if captcha is disabled,
						'g_recaptcha_response' => isset( $g_recaptcha_response ) ? $g_recaptcha_response : ''
					) );
				} else {
					if ( isset( $allow_user_set_password ) && $allow_user_set_password ) {
						$success_message = $register_success_msg;
					} else {
						$success_message = __( 'Registration complete. Check your email.', 'bears-fullscreen-login' );
					}

					$after_register_redirect = $this->filter_redirect_url( $pafl_sk->get( 'redirect_allow_after_registration_redirection_url' ) );
					echo json_encode( array(
						'registerd'            => true,
						'redirect'             => esc_url( $after_register_redirect ),
						'message'              => $success_message,
						'validation'           => true, // set to true if captcha is disabled
						'g_recaptcha_response' => isset( $g_recaptcha_response ) ? $g_recaptcha_response : ''
					) );
				}
			}


		} // Check if we are submitting the forgotten pwd form
		elseif ( isset( $_REQUEST['forgotten'] ) ) {

			// Check if we are sending an email or username and sanitize it appropriately
			if ( is_email( $_REQUEST['username'] ) ) {
				$username = sanitize_email( $_REQUEST['username'] );
			} else {
				$username = sanitize_user( $_REQUEST['username'] );
			}

			// Send our information
			if ( $this->is_captcha_enabled() && $this->is_captcha_field( 'forgot' ) ) {

				if ( isset( $response ) && $response->isValid() ) {
					$user_forgotten = $this->retrieve_password( $username );

					// Check if there were any errors when requesting a new password
					if ( is_wp_error( $user_forgotten ) ) {
						echo json_encode( array(
							'reset'                => false,
							'message'              => $user_forgotten->get_error_message(),
							'validation'           => false,
							'g_recaptcha_response' => isset( $g_recaptcha_response ) ? $g_recaptcha_response : ''
						) );
					} else {
						echo json_encode( array(
							'reset'                => true,
							'message'              => $forgot_success_msg ,
							'validation'           => true,
							'g_recaptcha_response' => isset( $g_recaptcha_response ) ? $g_recaptcha_response : ''
						) );
					}
				} else {
					echo json_encode( array(
						'reset'                => false,
						'message'              => __( 'Please verify that your not a robot', 'bears-fullscreen-login' ),
						'validation'           => false,
						'g_recaptcha_response' => isset( $g_recaptcha_response ) ? $g_recaptcha_response : ''
					) );
				}

			} else {
				$user_forgotten = $this->retrieve_password( $username );
				// Check if there were any errors when requesting a new password
				if ( is_wp_error( $user_forgotten ) ) {
					echo json_encode( array(
						'reset'                => false,
						'message'              => $user_forgotten->get_error_message(),
						'validation'           => true,
						'g_recaptcha_response' => isset( $g_recaptcha_response ) ? $g_recaptcha_response : ''
					) );
				} else {
					echo json_encode( array(
						'reset'                => true,
						'message'              => $forgot_success_msg ,
						'validation'           => true,
						'g_recaptcha_response' => isset( $g_recaptcha_response ) ? $g_recaptcha_response : ''
					) );
				}
			}

		}

		die();
	}

	public function social_avatar( $avatar, $id_or_email ) {
		$user = false;

		if ( is_int( $id_or_email ) ) {
			$user = get_user_by( 'id', $id_or_email );

		} elseif ( is_object( $id_or_email ) ) {

			if ( $id_or_email->user_id ) {
				$user = get_user_by( 'id', $id_or_email->user_id );
			}

		} else {
			$user = get_user_by( 'email', $id_or_email );
		}

		if ( $user && is_object( $user ) && get_user_meta( $id_or_email, 'pafl_social_profile', true ) ) {
			$img_src = get_user_meta( $id_or_email, 'pafl_social_profile', true );
			$avatar  = sprintf( '<img alt="social avatar" src="%s" class="avatar avatar-64 photo" height="64" width="64">', $img_src );
		}

		return $avatar;
	}

	public function google_meta_data() {
		$pafl_sk      = new Skelet( 'pafl' );
		$google_login = $this->filtered_string( $pafl_sk->get( 'google_login' ) );
		$client_id    = $this->filtered_string( $pafl_sk->get( 'google_login_id' ) );


		if ( $google_login ) {
			printf( '<meta name="google-signin-client_id" content="%s">', $client_id );
		}
	}

	/**
	 * Filter the url set by the user
	 *
	 * @param $url
	 *
	 * @return string
	 */
	public function filter_redirect_url( $url ) {
		if ( filter_var( $url, FILTER_VALIDATE_URL ) ) {
			$url_redirect = $url;
		} else {
			$url_redirect = home_url();
		}

		return $url_redirect;
	}

	/**
	 * Sanitize user entered information
	 *
	 * @param  String $user_login
	 * @param  String $user_email
	 *
	 * @return string/int $errors or $user_id
	 */
	public function register_new_user( $user_login, $user_email ) {

		$sk                   = new Skelet( "pafl" );
		$errors               = new WP_Error();
		$sanitized_user_login = sanitize_user( $user_login );
		$user_email           = apply_filters( 'user_registration_email', $user_email );

		// Check the username was sanitized
		if ( $sanitized_user_login == '' ) {
			$errors->add( 'empty_username', __( 'Please enter a username.', 'bears-fullscreen-login' ) );
		} elseif ( ! validate_username( $user_login ) ) {
			$errors->add( 'invalid_username', __( 'This username is invalid because it uses illegal characters. Please enter a valid username.', 'bears-fullscreen-login' ) );
			$sanitized_user_login = '';
		} elseif ( username_exists( $sanitized_user_login ) ) {
			$errors->add( 'username_exists', __( 'This username is already registered. Please choose another one.', 'bears-fullscreen-login' ) );
		}

		// Check the email address
		if ( empty( $user_email ) ) {
			$errors->add( 'empty_email', __( 'Please type your email address.', 'bears-fullscreen-login' ) );
		} elseif ( ! is_email( $user_email ) ) {
			$errors->add( 'invalid_email', __( 'The email address isn\'t correct.', 'bears-fullscreen-login' ) );
			$user_email = '';
		} elseif ( email_exists( $user_email ) ) {
			$errors->add( 'email_exists', __( 'This email is already registered, please choose another one.', 'bears-fullscreen-login' ) );
		}
		/**
		 * password Validation if the User Defined Password Is Allowed
		 */
		$allow_user_set_password = $sk->get( 'allow_user_set_password' );

		if ( $allow_user_set_password ) {
			if ( empty( $_REQUEST['password'] ) ) {
				$errors->add( 'empty_password', __( 'Please type your password.', 'bears-fullscreen-login' ) );
			} elseif ( strlen( $_REQUEST['password'] ) < 6 ) {
				$errors->add( 'minlength_password', __( 'Password must be 6 character long.', 'bears-fullscreen-login' ) );
			}
		}

		$errors = apply_filters( 'registration_errors', $errors, $sanitized_user_login, $user_email );

		if ( $errors->get_error_code() ) {
			return $errors;
		}

		$user_pass = ( $allow_user_set_password ) ? $_REQUEST['password'] : wp_generate_password( 12, false );
		$user_id   = wp_create_user( $sanitized_user_login, $user_pass, $user_email );

		if ( ! $user_id ) {
			$errors->add( 'registerfail', __( 'Couldn\'t register you... please contact the site administrator', 'bears-fullscreen-login' ) );

			return $errors;
		}

		update_user_option( $user_id, 'default_password_nag', true, true ); // Set up the Password change

		if ( $allow_user_set_password ) {
			$data['user_login']    = $user_login;
			$data['user_password'] = $user_pass;
			$user_login            = wp_signon( $data, false );
		}

		$user = get_userdata( $user_id );
		// The blogname option is escaped with esc_html on the way into the database in sanitize_option
		// we want to reverse this for the plain text arena of emails.
		$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );

		$message = sprintf( __( 'New user registration on your site %s:', 'bears-fullscreen-login' ), $blogname ) . "\r\n\r\n";
		$message .= sprintf( __( 'Username: %s', 'bears-fullscreen-login' ), $user->user_login ) . "\r\n\r\n";
		$message .= sprintf( __( 'Email: %s', 'bears-fullscreen-login' ), $user->user_email ) . "\r\n";

		@wp_mail( get_option( 'admin_email' ), sprintf( __( '[%s] New User Registration', 'bears-fullscreen-login' ), $blogname ), $message );

		if ( empty( $user_pass ) ) {
			return;
		}

		$message = sprintf( __( 'Username: %s', 'bears-fullscreen-login' ), $user->user_login ) . "\r\n";
		$message .= sprintf( __( 'Password: %s', 'bears-fullscreen-login' ), $user_pass ) . "\r\n";
		$message .= wp_login_url() . "\r\n";


		$email_detail = array(
			'subject' => sprintf( __( '[%s] Your username and password', 'bears-fullscreen-login' ), $blogname ),
			'body'    => $message,
		);


		//Custom Email
		$custom_email_body    = $this->filtered_string( $sk->get( 'custom_email_body' ) );
		$custom_email_subject = $this->filtered_string( $sk->get( 'custom_email_subject' ) );

		$pattern                = array( '#\%username\%#', '#\%password\%#', '#\%loginlink\%#' );
		$replacement            = array( $user->user_login, $user_pass, wp_login_url() );
		$subject                = trim( $custom_email_subject );
		$body                   = trim( $custom_email_body );
		$enable_custom_template = $sk->get( 'custom_email_template' );

		if ( $enable_custom_template ) {
			if ( ! empty( $subject ) ) {
				$email_detail['subject'] = @preg_replace( $pattern, $replacement, $subject );
			}

			if ( ! empty( $body ) ) {
				$email_detail['body'] = @html_entity_decode( @preg_replace( $pattern, $replacement, $body ) );
			}

			$headers = array( 'Content-Type: text/html; charset=UTF-8' );
		}
		@wp_mail( $user->user_email, $email_detail['subject'], $email_detail['body'], $headers );

		//@todo
		//wp_new_user_notification( $user_id, $user_pass );

		return $user_id;
	}


	/**
	 * Setup password retrieve function
	 *
	 * @param  Array $user_data
	 *
	 * @return string/bool $errors or bool
	 */
	public function  retrieve_password( $user_data ) {
		global $wpdb, $current_site;

		$errors = new WP_Error();

		if ( empty( $user_data ) ) {
			$errors->add( 'empty_username', __( 'Please enter a username or e-mail address.', 'bears-fullscreen-login' ) );
		} else {
			if ( strpos( $user_data, '@' ) ) {
				$user_data = get_user_by( 'email', trim( $user_data ) );
				if ( empty( $user_data ) ) {
					$errors->add( 'invalid_email', __( 'There is no user registered with that email address.', 'bears-fullscreen-login' ) );
				}
			} else {
				$login     = trim( $user_data );
				$user_data = get_user_by( 'login', $login );
			}
		}

		do_action( 'lostpassword_post' );

		if ( $errors->get_error_code() ) {
			return $errors;
		}

		if ( ! $user_data ) {
			$errors->add( 'invalidcombo', __( 'Invalid username or e-mail.', 'bears-fullscreen-login' ) );

			return $errors;
		}

		// redefining user_login ensures we return the right case in the email
		$user_login = $user_data->user_login;
		$user_email = $user_data->user_email;

		do_action( 'retreive_password', $user_login );  // Misspelled and deprecated
		do_action( 'retrieve_password', $user_login );

		$allow = apply_filters( 'allow_password_reset', true, $user_data->ID );

		if ( ! $allow ) {
			return new WP_Error( 'no_password_reset', __( 'Password reset is not allowed for this user', 'bears-fullscreen-login' ) );
		} else {
			if ( is_wp_error( $allow ) ) {
				return $allow;
			}
		}

		$key = wp_generate_password( 20, false );

		do_action( 'retrieve_password_key', $user_login, $key );

		require_once ABSPATH . 'wp-includes/class-phpass.php';
		$wp_hasher = new PasswordHash( 8, true );

		$hashed = $wp_hasher->HashPassword( $key );

		// Now insert the new md5 key into the db
		$wpdb->update( $wpdb->users, array( 'user_activation_key' => $hashed ), array( 'user_login' => $user_login ) );

		$message = __( 'Someone requested that the password be reset for the following account:', 'bears-fullscreen-login' ) . "\r\n\r\n";
		$message .= network_home_url( '/' ) . "\r\n\r\n";
		$message .= sprintf( __( 'Username: %s', 'bears-fullscreen-login' ), $user_login ) . "\r\n\r\n";
		$message .= __( 'If this was a mistake, just ignore this email and nothing will happen.', 'bears-fullscreen-login' ) . "\r\n\r\n";
		$message .= __( 'To reset your password, visit the following address:', 'bears-fullscreen-login' ) . "\r\n\r\n";
		$message .= '<' . network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . ">\r\n";

		if ( is_multisite() ) {
			$blogname = $GLOBALS['current_site']->site_name;
		} else {
			// The blogname option is escaped with esc_html on the way into the database in sanitize_option
			// we want to reverse this for the plain text arena of emails.
			$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
		}

		$title   = sprintf( __( '[%s] Password Reset', 'bears-fullscreen-login' ), $blogname );
		$title   = apply_filters( 'retrieve_password_title', $title );
		$message = apply_filters( 'retrieve_password_message', $message, $key );

		if ( $message && ! wp_mail( $user_email, $title, $message ) ) {
			$errors->add( 'noemail', __( 'The e-mail could not be sent. Possible reason: your host may have disabled the mail() function.', 'bears-fullscreen-login' ) );

			return $errors;

			wp_die();
		}

		return true;
	}

	/**
	 * Load custom scripts for captcha
	 */
	public function captcha_scripts() {
		if ( $this->is_captcha_enabled() && ! is_user_logged_in() ) {
			// Get Skelet object for Captcha
			$pafl_sk     = new Skelet( 'pafl' );
			$public_key  = $pafl_sk->get( 'recaptcha_public_key' );
			$private_key = $pafl_sk->get( 'recaptcha_private_key' );
			$theme       = $pafl_sk->get( 'recaptcha_theme' );

			// Set the Captcha Object
			$captcha = new PAFL_Captcha();
			$captcha->setPublicKey( $public_key );
			$captcha->setPrivateKey( $private_key );
			$captcha->setTheme( $theme );
			$captcha->setID( array( 'login', 'register', 'forgot' ) );
			$captcha->load_scripts();
		}

	}

	/**
	 * Load Google Captcha scripts
	 */
	public function captcha_google_scripts() {
		if ( $this->is_captcha_enabled() && ! is_user_logged_in() ) {
			echo '<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>';
		}

	}

	/**
	 * Check if captcha is enabled
	 *
	 * @return bool
	 */
	public function is_captcha_enabled() {
		$pafl_sk              = new Skelet( 'pafl' );
		$recaptcha_enabled_on = $pafl_sk->get( 'recaptcha_enable_on' );
		if ( is_array( $recaptcha_enabled_on ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Check whether a $field that is being passed is in the array of fields that are activated.
	 *
	 * @param $field
	 *
	 * @return bool
	 */
	public function is_captcha_field( $field ) {
		$pafl_sk         = new Skelet( 'pafl' );
		$recaptcha_array = $pafl_sk->get( 'recaptcha_enable_on' );

		if ( $this->is_captcha_enabled() && in_array( $field, $recaptcha_array ) ) {
			return true;
		} else {
			return false;
		}

	}

	/**
	 * Filter function to fixed Array to string conversion notice
	 *
	 * @param  string $string
	 *
	 * @param string  $default
	 *
	 * @return string
	 */
	public function filtered_string( $string, $default = "" ) {
		if ( is_string( $string ) && strtolower( $string ) === 'array' ) {
			empty( $default ) ? $string = "" : $string = $default;
		} elseif ( is_array( $string ) ) {
			empty( $default ) ? $string = "" : $string = $default;
		}

		return $string;
	}

	/**
	 * Filter function to fixed Array to string conversion notice
	 *
	 * @param  string $string
	 *
	 * @param string  $default
	 *
	 * @return string
	 */
	public function filtered_background( $val )  {
		$string = "";
		if ( is_array( $val ) ) {
			empty( $val['image'] ) ?  $string = "" : $string = 'url('.$val['image'].')';empty( $val['repeat'] ) ?  $string .= "" : $string .= ' '.$val['repeat'];
			empty( $val['position'] ) ?  $string .= "" : $string .= ' '.$val['position'];
			empty( $val['attachment'] ) ?  $string .= "" : $string .= ' '.$val['attachment'];
			empty( $val['color'] ) ?  $string .= "" : $string .= ' '.$val['color'];
		}

		return $string;
	}

	/**
	 * Validate Captcha
	 *
	 * @return \PAFL_Response
	 * @throws \PAFL_Exception
	 */
	public function validate_captcha( $post ) {
		$pafl_sk    = new Skelet( 'pafl' );
		$secret_key = $pafl_sk->get( 'recaptcha_private_key' );

		$captcha = new PAFL_Captcha();
		$captcha->setPrivateKey( $secret_key );
		$captcha->setRemoteIp( $_SERVER['REMOTE_ADDR'] );

		$response = $captcha->check( $post );
		if ( $response->isValid() ) {
			return true;
		} else {
			return false;
		}

	}

	/**
	 * Filter modal link label
	 *
	 * @param $items
	 *
	 * @return mixed
	 */
	public function pafl_filter_frontend_modal_link_label( $items ) {
		foreach ( $items as $i => $item ) {
			if ( '#pafl_modal_login' === $item->url ) {
				$item_parts = explode( ' // ', $item->title );
				if ( is_user_logged_in() ) {
					$items[ $i ]->title = array_pop( $item_parts );
				} else {
					$items[ $i ]->title = array_shift( $item_parts );
				}
			}
		}

		return $items;
	}

	/**
	 * Filter modal attribute
	 *
	 * @param $atts
	 * @param $item
	 * @param $args
	 *
	 * @return mixed
	 */
	public function pafl_filter_frontend_modal_link_atts( $atts, $item, $args ) {

		$pafl_sk = new Skelet( 'pafl' );

		// Only apply when URL is #pafl_modal_login/#pafl_modal_register
		if ( '#pafl_modal_login' === $atts['href'] ) {
			// Check if we have an over riding logout redirection set. Other wise, default to the home page.
			$logout_url = $pafl_sk->get( 'redirect_allow_after_logout_redirection_url' );

			if ( isset( $logout_url ) && $logout_url == '' ) {
				$logout_url = home_url();
			}

			// Is the user logged in? If so, serve them the logout button, else we'll show the login button.
			if ( is_user_logged_in() ) {
				$atts['href']  = wp_logout_url( $logout_url );
				$atts['title'] = null;
				if ( $pafl_sk->get( 'facebook_login' ) ) {
					$atts['data-facebook'] = 'true';
				}

			} else {
				$atts['href']      = '#';
				$atts['data-form'] = 'login';
				$atts['onclick']   = 'false';
				$atts['class']     = 'pafl-trigger-overlay';
			}
		} else {
			if ( '#pafl_modal_register' === $atts['href'] ) {
				$atts['href']      = '#';
				$atts['data-form'] = 'register';
				$atts['onclick']   = 'false';
				$atts['class']     = 'pafl-trigger-overlay';
			}
		}

		return $atts;
	}

	/**
	 * Filter modal register link and hide when logged in
	 *
	 * @param $items
	 *
	 * @return mixed
	 */
	public function pafl_filter_frontend_modal_link_register_hide( $items ) {
		foreach ( $items as $i => $item ) {
			if ( '#pafl_modal_register' === $item->url ) {
				if ( is_user_logged_in() ) {
					unset( $items[ $i ] );
				}
			}
		}

		return $items;
	}
}

