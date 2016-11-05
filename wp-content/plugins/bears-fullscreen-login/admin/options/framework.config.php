<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

/**
 * Framework page settings
 */
$settings = array(
    'header_title' => __( 'Fullscreen Login', 'bears' ),
    'menu_title'   => __( 'Fullscreen Login', 'bears' ),
    'menu_type'    => 'add_submenu_page',
    'menu_slug'    => 'bears-fullscreen-login',
    'ajax_save'    => false,
);


/**
 * sections and fields option
 * @var array
 */
$options        = array();

/*
 * General options tab and fields settings
 */
$options[]      = array(
    'name'        => 'forms',
    'title'       => __( 'Forms', 'bears' ),
    'icon'        => 'si-menu7',
        'sections' => array(
            array(
                'name'      => 'general_options',
                'title'     => __( 'General', 'bears' ),
                'icon'      => 'si-cog3',
                'fields'    => array(
                        array(
                            'type'    => 'heading',
                            'content' => __( 'General', 'bears' ),
                        ),
                        array(
                            'id'      => 'form_logo',
                            'type'    => 'upload',
                            'title'   => __( 'Form Logo', 'bears' ),
                            'help'    => __( 'Upload a site logo for the forms.', 'bears' ),
                        ),
                        array(
                            'id'      => 'form_login_link_text',
                            'type'    => 'text',
                            'title'   => __( 'Login Form Link Text', 'bears' ),
                            'help'    => __( 'Login Form Link text field for links located under the forms', 'bears' ),
                            'default' => 'SIGN IN'
                        ),
                        array(
                            'id'      => 'form_register_link_text',
                            'type'    => 'text',
                            'title'   => __( 'Register Form Link Text', 'bears' ),
                            'help'    => __( 'Register Form Link text field for links located under the forms', 'bears' ),
                            'default' => 'CREATE AN ACCOUNT'
                        ),
                         array(
                            'id'      => 'form_forgot_link_text',
                            'type'    => 'text',
                            'title'   => __( 'Forgot Form Link Text', 'bears' ),
                            'help'    => __( 'Forgot Form Link text field for links located under the forms', 'bears' ),
                            'default' => 'I FORGOT MY PASSWORD'
                        ),
                ),
            ),
            array(
                'name'      => 'login_options',
                'title'     => __( 'Login', 'bears' ),
                'icon'      => 'si-user',
                'fields'    => array(
                        array(
                            'type'    => 'heading',
                            'content' => __( 'Login', 'bears' ),
                        ),
                        array(
                            'id'      => 'login_form_title', 
                            'type'    => 'text',
                            'title'   => __( 'Title', 'bears' ),
                            'default' => 'WELCOME BACK',
                        ),
                        array(
                            'id'      => 'login_form_subtitle', 
                            'type'    => 'text',
                            'title'   => __( 'Subtitle', 'bears' ),
                            'default' => 'Already a member? Sign in with your username.',
                        ),
                        array(
                            'id'      => 'login_success_msg', 
                            'type'    => 'text',
                            'title'   => __( 'Login Success Message', 'bears' ),
                            'default' => 'Login Successful!',
                        ),
                        array(
                            'id'      => 'login_form_username_placeholder_text', 
                            'type'    => 'text',
                            'title'   => __( 'Username Placeholder Text', 'bears' ),
                            'default' => 'Username',
                        ),
                        array(
                            'id'      => 'login_form_password_placeholder_text', 
                            'type'    => 'text',
                            'title'   => __( 'Password Placeholder Text', 'bears' ),
                            'default' => 'Password',
                        ),
                        array(
                            'id'      => 'rememberme_visibility', 
                            'type'    => 'switcher',
                            'title'   => __( 'Remember Me', 'bears' ),
                            'default' => true,
                        ),
                        array(
                            'id'           => 'rememberme_placeholder_text', 
                            'type'         => 'text',
                            'title'        => __( 'Remember Me Placeholder Text', 'bears' ),
                            'default'      => 'Remember Me',
                            'dependency'   => array( 'pafl_rememberme_visibility', '==', 'true' ),
                        ),
                        array(
                            'id'      => 'login_button_text', 
                            'type'    => 'text',
                            'title'   => __( 'Login Button Text', 'bears' ),
                            'default' => 'SIGN IN',
                        ),
                        array(
                            'id'      => 'auto_popup', 
                            'type'    => 'switcher',
                            'title'   => __( 'Auto Popup', 'bears' ),
                            'default' => false,
                        ),
                        array(
                            'id'      => 'scroll_top', 
                            'type'    => 'text',
                            'title'   => __( 'Scroll Top Popup (pixel)', 'bears' ),
                            'default' => '800',
                            'dependency'   => array( 'pafl_auto_popup', '==', 'true' ),
                        ),
                ),
            ),
            array(
                'name'      => 'register_options',
                'title'     => __( 'Register', 'bears' ),
                'icon'      => 'si-pencil3',
                'fields'    => array(
                        array(
                            'type'    => 'heading',
                            'content' => __( 'Register', 'bears' ),
                        ),

                        array(
                            'id'      => 'register_form_title', 
                            'type'    => 'text',
                            'title'   => __( 'Title', 'bears' ),
                            'default' => 'CREATE AN ACCOUNT',
                        ),
                        array(
                            'id'      => 'register_form_subtitle', 
                            'type'    => 'text',
                            'title'   => __( 'Subtitle', 'bears' ),
                            'default' => 'Password will be emailed to you',
                        ),
                        array(
                            'id'      => 'register_success_msg', 
                            'type'    => 'text',
                            'title'   => __( 'Register Success Message', 'bears' ),
                            'default' => 'Registration complete.',
                        ),
                        array(
                            'id'      => 'register_form_username_placeholder_text', 
                            'type'    => 'text',
                            'title'   => __( 'Username Placeholder Text', 'bears' ),
                            'default' => 'Username',
                        ),
                        array(
                            'id'      => 'register_form_email_placeholder_text', 
                            'type'    => 'text',
                            'title'   => __( 'Email Placeholder Text', 'bears' ),
                            'default' => 'Email',
                        ),
                        array(
                            'id'      => 'allow_user_set_password', 
                            'type'    => 'switcher',
                            'title'   => __( 'Allow User To Set Password', 'bears' ),
                            'default' => true,
                        ),
                        array(
                            'id'      => 'register_form_password_placeholder_text', 
                            'type'    => 'text',
                            'title'   => __( 'Password Placeholder Text', 'bears' ),
                            'default' => 'Password',
                            'dependency'   => array( 'pafl_allow_user_set_password', '==', 'true' ),
                        ),
                        array(
                            'id'      => 'register_button_text', 
                            'type'    => 'text',
                            'title'   => __( 'Register Button Text', 'bears' ),
                            'default' => 'CREATE ACCOUNT',
                        ),

                ),
            ),
            array(
                'name'      => 'forgot_options',
                'title'     => __( 'Forgot', 'bears' ),
                'icon'      => 'si-question3',
                'fields'    => array(
                        array(
                            'type'    => 'heading',
                            'content' => __( 'Forgot', 'bears' ),
                        ),                      
                        array(
                            'id'      => 'forgot_form_title', 
                            'type'    => 'text',
                            'title'   => __( 'Title', 'bears' ),
                            'default' => 'FORGOT PASSWORD',
                        ),
                        array(
                            'id'      => 'forgot_form_subtitle', 
                            'type'    => 'text',
                            'title'   => __( 'Subtitle', 'bears' ),
                            'default' => 'Enter your username or email to reset your password.',
                        ),
                        array(
                            'id'      => 'forgot_success_msg', 
                            'type'    => 'text',
                            'title'   => __( 'Forgot Success Message', 'bears' ),
                            'default' => 'Password Reset. Please check your email.',
                        ),
                        array(
                            'id'      => 'forgot_form_username_placeholder_text', 
                            'type'    => 'text',
                            'title'   => __( 'Username/Email Placeholder Text', 'bears' ),
                            'default' => 'Username or Email',
                        ),
                        array(
                            'id'      => 'forgot_button_text', 
                            'type'    => 'text',
                            'title'   => __( 'Forgot Button Text', 'bears' ),
                            'default' => 'SEND RESET EMAIL',
                        ),
                ),
            ),
        )
);

/*
 * Redirect options tab and fields settings
 */
$options[]      = array(
    'name'        => 'redirect',
    'title'       => __( 'Redirect', 'bears' ),
    'icon'        => 'si-redo2',
    'fields'      => array(

        array(
            'id'      => 'redirect_allow_after_login_redirection_url', 
            'type'    => 'text',
            'title'   => __( 'Login Redirect URL', 'bears' ),
            'after'   => __( '<br> Enter full URL e.g. http://yoursitename.com/page', 'bears' ),
            'help'    => __( 'Set optional login redirect URL, if not set you will be redirected to current page', 'bears' ),
        ),

        array(
            'id'      => 'redirect_allow_after_logout_redirection_url', 
            'type'    => 'text',
            'title'   => __( 'Logout Redirect URL', 'bears' ),
            'after'   => __( '<br> Enter full URL e.g. http://yoursitename.com/page', 'bears' ),
            'help'    => __( 'Set optional logout redirect URL, if not set you will be redirected to home page', 'bears' ),
        ),

        array(
            'id'      => 'redirect_allow_after_registration_redirection_url', 
            'type'    => 'text',
            'title'   => __( 'Registration Redirect URL', 'bears' ),
            'after'   => __( '<br> Enter full URL e.g. http://yoursitename.com/page', 'bears' ),
            'help'    => __( 'Set optional registration redirect URL, if not set you will be redirected to the current page.', 'bears' ),
        ),
    )
);


/*
 * Email options tab and fields settings
 */
$options[]      = array(
    'name'             => 'email',
    'title'            => __( 'Email', 'bears' ),
    'icon'             => 'si-envelop2',
    'fields'           => array(

        array(
            'id'       => 'custom_email_template', 
            'type'     => 'switcher',
            'title'    => __( 'Custom Email Template', 'bears' ),
            'default'  => false,
        ),
       array(
            'id'       => 'custom_email_subject', 
            'type'     => 'text',
            'title'    => __( 'Subject', 'bears' ),
            'dependency'   => array( 'pafl_custom_email_template', '==', 'true' ),
                        
        ),
        array(
            'id'       => 'custom_email_body', 
            'type'     => 'wysiwyg',
            'title'    => __( 'Body', 'bears' ),
            'dependency'   => array( 'pafl_custom_email_template', '==', 'true' ),
            'after'     => __( 'Add custom registration email template with the following variables for use in subject or body: %username%, %password%, %loginlink%', 'bears' ),
                    
        ),
    )
);


/*
 * Captcha options tab and fields settings
 */
$options[]      = array(
    'name'        => 'captcha',
    'title'       => __( 'Captcha', 'bears' ),
    'icon'        => 'si-lock2',
    'fields'      => array(
        array(
            'id'      => 'recaptcha_public_key', 
            'type'    => 'text',
            'title'   => __( 'Site Key', 'bears' ),
            'default' => '',
        ),
        array(
            'id'      => 'recaptcha_private_key', 
            'type'    => 'text',
            'title'   => __( 'Secret Key', 'bears' ),
            'default' => '',
        ),
        array(
            'id'      => 'recaptcha_enable_on', 
            'type'    => 'checkbox',
            'title'   => __( 'Enable On', 'bears' ),
            'options' => array(
                'login'     => __( 'Login Form', 'bears' ),
                'register'  => __( 'Register Form', 'bears' ),
                'forgot'    => __( 'Forgot Form', 'bears' ),
            ),
        ),
        array(
            'id'      => 'recaptcha_theme', 
            'type'    => 'select',
            'title'   => __( 'Theme', 'bears' ),
            'options' => array(
                'light'     => __( 'Light', 'bears' ),
                'dark'      => __( 'Dark', 'bears' ),
            ),
        ),
    )
);

/*
 * Social login settings
 */
$options[]  = array(
    'name'      => 'social_login',
    'title'     => __( 'Social Login', 'bears' ),
    'icon'      => 'si-share3',
    'fields'    => array(
        array(
            'type'    => 'heading',
            'content' => __( 'Social Login', 'bears' ),
        ),
        array(
            'id'      => 'facebook_login',
            'type'    => 'switcher',
            'title'   => __( 'Facebook', 'bears' ),
            'default' => false,
        ),
        array(
            'id'      => 'twitter_login',
            'type'    => 'switcher',
            'title'   => __( 'Twitter', 'bears' ),
            'default' => false,
        ),
        array(
            'id'      => 'google_login',
            'type'    => 'switcher',
            'title'   => __( 'Google', 'bears' ),
            'default' => false,
        ),
        array(
            'id'      => 'social_show_text',
            'type'    => 'switcher',  
            'title'   => __( 'Show Text On Button', 'bears' ),
            'dependency' => array( 'pafl_facebook_login', '==', 'true','twitter_login', '==', 'true','google_login', '==', 'true' ),
            'default' => false
        ),
        array(
            'id'      => 'social_btn_style',
            'type'    => 'select',  
            'title'   => __( 'Social Button Style', 'bears' ),
            'dependency' => array( 'pafl_facebook_login', '==', 'true','twitter_login', '==', 'true','google_login', '==', 'true' ),
            'options' => array(
                'square'       => __( 'Square', 'bears' ),
                'round'        => __( 'Round', 'bears' ),
            ),
            'default' => "square"
        ),
        array(
            'id'      => 'btn_corner_size',
            'type'    => 'text',
            'title'   => __( 'Button Corner Size', 'bears' ),
            'dependency' => array( 'pafl_social_btn_style', '==', 'round' ),
            'default' => '50%'
        ),
        array(
            'id'      => 'social_column',
            'type'    => 'select',  
            'title'   => __( 'Social Columns', 'bears' ),
            'dependency' => array( 'pafl_facebook_login', '==', 'true','twitter_login', '==', 'true','google_login', '==', 'true' ),
            'options' => array(
                '1'       => __( '1 Column', 'bears' ),
                '2'        => __( '2 Columns', 'bears' ),
                '3'        => __( '3 Columns', 'bears' ),
                '4'        => __( '4 Columns', 'bears' ),
            ),
            'default' => "1"
        ),
        // Facebook Option
        array(
            'type'    => 'heading',
            'content' => __( 'Facebook Login', 'bears' ),
            'dependency' => array( 'pafl_facebook_login', '==', 'true' )
        ),
        array(
            'id'      => 'facebook_login_id',
            'type'    => 'text',
            'title'   => __( 'App ID', 'bears' ),
            'dependency' => array( 'pafl_facebook_login', '==', 'true' )
        ),
        array(
            'id'      => 'facebook_login_secret',
            'type'    => 'text',
            'title'   => __( 'App Secret', 'bears' ),
            'dependency' => array( 'pafl_facebook_login', '==', 'true' )
        ),
        array(
            'id'      => 'facebook_login_text',
            'type'    => 'text',
            'title'   => __( 'Facebook Login Button Text', 'bears' ),
            'dependency' => array( 'pafl_social_show_text', '==', 'true' ),
            'default' => 'Sign in with Facebook'
        ),
        array(
            'type' => 'notice',
            'class' => 'info',
            'dependency' => array( 'pafl_facebook_login', '==', 'true' ),
            'content' => '
                <h2>How to Generate <strong>App ID</strong> and <strong>App Secret</strong>?</h2>
                <ol>
                <li>Go to <a href="https://developers.facebook.com/" target="_blank">https://developers.facebook.com/</a> ( requires to sign in with facebook account ).</li>
                <li>Click on <strong>My Apps</strong>, then under the dropdown select <strong>Add a New App</strong>.</li>
                <li>A list of choice will popup through a modal after clicking <strong>Add a New App</strong>, select <strong>Website</strong>.</li>
                <li>It will redirect you to <strong>Quick Start for Website</strong>, just type in the <strong>name</strong> for the new App and click <strong>Create New Facebook App ID</strong>.</li>
                <li>It will prompt you with a message <strong>Create (name of the app) App?</strong>, select a <strong>Category</strong> then click <strong>Create App ID</strong>.</li>
                <li>It will redirect you to a page named <strong>Setup the Facebook SDK for JavaScript</strong>.</li>
                <li>Scroll down under <strong>Tell us about your website</strong> there is a text field which is <strong>Site URL</strong>, then type in the url of your website.</li>
                <li>After it if you will scroll down you can see a <strong>Finished!</strong> text with a check icon, then your done.</li>
                <li>Just <strong>refresh</strong> the page and you will be able to see under <strong>My Apps</strong> the new App that you created.</li>
                <li>When you click on your new App you will be able to see <strong>App ID</strong> , <strong>API Version</strong>, <strong>App Secret</strong>.</li>
                </ol>
                '
        ),
        // Twitter Option
        array(
            'type'    => 'heading',
            'content' => __( 'Twitter Login', 'bears' ),
            'dependency' => array( 'pafl_twitter_login', '==', 'true' )
        ),
        array(
            'id'      => 'twitter_login_id',
            'type'    => 'text',
            'title'   => __( 'Consumer Key (API Key)', 'bears' ),
            'dependency' => array( 'pafl_twitter_login', '==', 'true' )
        ),
        array(
            'id'      => 'twitter_login_secret',
            'type'    => 'text',
            'title'   => __( 'Consumer Secret (API Secret)', 'bears' ),
            'dependency' => array( 'pafl_twitter_login', '==', 'true' )
        ),
        array(
            'id'      => 'twitter_login_text',
            'type'    => 'text',
            'title'   => __( 'Twitter Login Button Text', 'bears' ),
            'dependency' => array( 'pafl_social_show_text', '==', 'true' ),
            'default'  => 'Sign in with Twitter'
        ),
        array(
            'type' => 'notice',
            'class' => 'info',
            'dependency' => array( 'pafl_twitter_login', '==', 'true' ),
            'content' => '
                <h2>How to Generate <strong>Consumer Key (API Key)</strong> and <strong>Consumer Secret (API Secret)</strong>?</h2>
                <h3>You must add your mobile phone to your Twitter profile before creating an application.</h3>
                <ol>
                <li>Go to <a href="https://apps.twitter.com/" target="_blank">https://apps.twitter.com/</a> ( requires to sign in with twitter account ).</li>
                <li>Click on <strong>Create New App</strong> button, then fill up the <strong>Application Details</strong> including <strong>Callback URL</strong> which is the home url.</li>
                <li>You can access your new app, then go to <strong>Keys and Access Tokens</strong> tab.</li>
                <li>Under <strong>Application Settings</strong> you can copy your <strong>Consumer Key (API Key)</strong> and <strong>Consumer Secret (API Secret)</strong>.</li>
                </ol>
                '
        ),
        // Google Option
        array(
            'type'    => 'heading',
            'content' => __( 'Google Login', 'bears' ),
            'dependency' => array( 'pafl_google_login', '==', 'true' )
        ),
        array(
            'id'      => 'google_login_id',
            'type'    => 'text',
            'title'   => __( 'Client ID', 'bears' ),
            'dependency' => array( 'pafl_google_login', '==', 'true' )
        ),
        array(
            'id'      => 'google_login_secret',
            'type'    => 'text',
            'title'   => __( 'Client Secret', 'bears' ),
            'dependency' => array( 'pafl_google_login', '==', 'true' )
        ),
        array(
            'id'      => 'google_login_text',
            'type'    => 'text',
            'title'   => __( 'Google Login Button Text', 'bears' ),
            'dependency' => array( 'pafl_social_show_text', '==', 'true' ),
            'default'  => 'Sign in with Google'
        ),
        array(
            'type' => 'notice',
            'class' => 'info',
            'dependency' => array( 'pafl_google_login', '==', 'true' ),
            'content' => '
                <h2>How to Generate <strong>Client ID</strong> and <strong>Client Secret</strong>?</h2>
                <ol>
                <li>Go to <a href="https://console.developers.google.com" target="_blank">https://console.developers.google.com</a>.</li>
                <li>Click on <strong>Create a project</strong> under the dropdown.</li>
                <li>In the Project name field, type in a name for your project then click on <strong>Create</strong> button.</li>
                <li>In the sidebar under <strong>API Manager</strong>, select <strong>Credentials</strong>, and click the OAuth consent screen tab. Choose an Email Address, specify a Product Name, and click Save.</li>
                <li>Click <strong>Create a new Client ID</strong>, a dialog box appears.</li>
                <li>In the Application type section of the dialog, select <strong>Web application</strong>.</li>
                <li>In the <strong>Authorized JavaScript origins</strong> field, enter the origin for your app. You can enter multiple origins to allow for your app to run on different protocols, domains, or subdomains. Wildcards are not allowed. ( URL of your website ).</li>
                <li>In the <strong>Authorized redirect URI</strong> field, delete the default value and add <code>' . plugin_dir_url( dirname( dirname( __FILE__ ) ) ) . 'public/lib/hybridauth/?hauth.done=Google</code> then click <strong>Save</strong>.</li>
                <li><strong style="color:red;font-weight:bold;">IMPORTANT!</strong> Enable Google+ API or your app will not work. To enable Google+ API, in the sidebar under <strong>API Manager</strong>, select <strong>Overview</strong> then click on <strong>Google APIs</strong> tab and under <strong>Social APIs</strong> click on <strong>Google+ API</strong> , then click on <strong>Enable API</strong> button.</li>
                </ol>
                '
        )
    )
);

/*
 *  Styling options tab and fields settings
 */
$options[]      = array(
    'name'        => 'styling',
    'title'       => __( 'Styling', 'bears' ),
    'icon'        => 'si-brush',
    'fields'      => array(
        array(
            'id'      => 'type_bg', 
            'type'    => 'select',
            'title'   => __( 'Type Background', 'bears' ),
            'options' => array(
                'normal'       => __( 'Normal', 'bears' ),
                'slider'       => __( 'Slider', 'bears' ),
                'video'        => __( 'Video', 'bears' ),
            ),
            'default'    => 'normal',
        ),
        array(
            'id'      => 'modal_background', 
            'type'    => 'background',
            'title'   => __( 'Background', 'bears' ),
            'dependency'   => array( 'pafl_type_bg', '==', 'normal' ),
            'default' => array(
				'image'       => '',
				'repeat'      => '',
				'position'    => '',
				'attachment'  => '',
				'color'       => '#03a9f4',
			)
        ),
        array(
            'id'      => 'modal_gallery', 
            'type'    => 'gallery',
            'title'   => __( 'Gallery Slider', 'bears' ),
            'dependency'   => array( 'pafl_type_bg', '==', 'slider' ),
        ),
        array(
            'id'      => 'slider_color', 
            'type'    => 'background',
            'title'   => __( 'Slider Background Color', 'bears' ),
            'help'    => __( 'Change color for slider', 'bears' ),
            'dependency'   => array( 'pafl_type_bg', '==', 'slider' ),
            'default' => array(
				'image'       => '',
				'repeat'      => '',
				'position'    => '',
				'attachment'  => '',
				'color'       => '#03a9f4',
			)
        ),
        array(
            'id'      => 'fadespeed', 
            'type'    => 'Text',
            'title'   => __( 'Fade speed slider (milliseconds)', 'bears' ),
            'default' => '1500',
            'dependency'   => array( 'pafl_type_bg', '==', 'slider' ),
        ),
        array(
            'id'      => 'duration',
            'type'    => 'Text',
            'title'   => __( 'Duration slider (milliseconds)', 'bears' ),
            'default' => '4000',
            'dependency'   => array( 'pafl_type_bg', '==', 'slider' ),
        ),
        array(
            'id'      => 'modal_parallax', 
            'type'    => 'switcher',
            'title'   => __( 'Background Parallax', 'bears' ),
            'dependency'   => array( 'pafl_type_bg', '==', 'normal' ),
            'default' => false,
        ),
        array(
            'id'      => 'modal_background_video', 
            'type'    => 'Text',
            'title'   => __( 'Background Video', 'bears' ),
            'default' => '',
            'dependency'   => array( 'pafl_type_bg', '==', 'video' ),
        ),		
        array(
            'id'      => 'bg_mobile_color', 
            'type'    => 'color_picker',
            'title'   => __( 'Modal Mobile Background Color', 'bears' ),
            'help'    => __( 'Change color for modal on mobile', 'bears' ),
            'rgba'    => false,
            'default' => '#03a9f4',
        ),
        array(
            'id'      => 'text_color', 
            'type'    => 'color_picker',
            'title'   => __( 'Text Color', 'bears' ),
            'help'    => __( 'Change color for content color, applies to form title, subtitle, remember me label and links under forms', 'bears' ),
            'rgba'    => false,
            'default' => '#ffffff',
        ),
        array(
            'id'      => 'msg_text_color', 
            'type'    => 'color_picker',
            'title'   => __( 'Text Message Color', 'bears' ),
            'help'    => __( 'Change color for content message', 'bears' ),
            'rgba'    => false,
            'default' => '#111111',
        ),
        array(
            'id'      => 'input_border_color',
            'type'    => 'color_picker',
            'title'   => __( 'Input Border Color', 'bears' ),
            'rgba'    => false
        ),
        array(
            'id'      => 'input_color', 
            'type'    => 'color_picker',
            'title'   => __( 'Input Color', 'bears' ),
            'help'    => __( 'Change color for input color', 'bears' ),
            'rgba'    => false,
            'default' => '#333333',
        ),
        array(
            'id'      => 'input_border_radius',
            'type'    => 'number',
            'title'   => __( 'Input Border Radius', 'bears' ),
            'after'   => ' <i class="sk-text-muted">(px)</i>',
            'default' => 1,
        ),
        array(
            'id'      => 'input_border_width',
            'type'    => 'number',
            'title'   => __( 'Input Border Width', 'bears' ),
            'after'   => ' <i class="sk-text-muted">(px)</i>',
            'default' => 0,
        ),
        array(
            'id'      => 'button_text_color', 
            'type'    => 'color_picker',
            'title'   => __( 'Button Text Color', 'bears' ),
            'rgba'    => false,
            'default' => '#ffffff',
        ),
        array(
            'id'      => 'button_background_color', 
            'type'    => 'color_picker',
            'title'   => __( 'Button Background Color', 'bears' ),
            'rgba'    => false,
            'default' => '#001017',
        ),
        array(
            'id'      => 'button_background_color_hover',
            'type'    => 'color_picker',
            'title'   => __( 'Button Background Color Hover', 'bears' ),
            'rgba'    => false,
            'default' => '#01579b',
        ),
        array(
            'id'      => 'modal_effect',
            'type'    => 'select',
            'title'   => __( 'Effect', 'bears' ),
            'options' => array(
                'hugeinc'       => __( 'Huge Inc', 'bears' ),
                'corner'        => __( 'Corner', 'bears' ),
                'slidedown'     => __( 'Slide Down', 'bears' ),
                'scale'         => __( 'Scale', 'bears' ), 
                'simplegenie'   => __( 'Simple Genie', 'bears' ),
            ),
            'default'    => 'hugeinc',
        ),
        array(
            'id'      => 'effect_duration',
            'type'    => 'Text',
            'title'   => __( 'Duration Effect (milliseconds)', 'bears' ),
            'default' => '500',
        ),
        array(
            'id'      => 'custom_css', 
            'type'    => 'textarea',
            'title'   => __( 'Custom CSS', 'bears' ),
        ),
    ),
);

SkeletFramework::instance( $settings, $options );
