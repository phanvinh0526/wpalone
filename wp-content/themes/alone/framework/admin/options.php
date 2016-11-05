<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }
	
	/* Add Stylesheet And Script Backend */
	function bearstheme_custom_admin_scripts(){
		wp_enqueue_script( 'action', URI_PATH_ADMIN.'/assets/js/action.js', array('jquery'), '', true  );
		wp_enqueue_style( 'style_admin', URI_PATH_ADMIN.'/assets/css/style_admin.css', false );
	}
	add_action( 'admin_enqueue_scripts', 'bearstheme_custom_admin_scripts');

    // This is your option name where all the Redux data is stored.
    $opt_name = "bearstheme_options";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    // $args = array(
    //     // TYPICAL -> Change these values as you need/desire
    //     'opt_name'             => $opt_name,
    //     // This is where your data is stored in the database and also becomes your global variable name.
    //     'display_name'         => $theme->get( 'Name' ),
    //     // Name that appears at the top of your panel
    //     'display_version'      => $theme->get( 'Version' ),
    //     // Version that appears at the top of your panel
    //     'menu_type'            => 'menu',
    //     //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    //     'allow_sub_menu'       => true,
    //     // Show the sections below the admin menu item or not
    //     'menu_title'           => __( 'Theme Options', 'bearsthemes' ),
    //     'page_title'           => __( 'Theme Options', 'bearsthemes' ),
    //     // You will need to generate a Google API key to use this feature.
    //     // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    //     'google_api_key'       => '',
    //     // Set it you want google fonts to update weekly. A google_api_key value is required.
    //     'google_update_weekly' => false,
    //     // Must be defined to add google fonts to the typography module
    //     'async_typography'     => true,
    //     // Use a asynchronous font on the front end or font string
    //     //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    //     'admin_bar'            => true,
    //     // Show the panel pages on the admin bar
    //     'admin_bar_icon'       => 'dashicons-portfolio',
    //     // Choose an icon for the admin bar menu
    //     'admin_bar_priority'   => 50,
    //     // Choose an priority for the admin bar menu
    //     'global_variable'      => '',
    //     // Set a different name for your global variable other than the opt_name
    //     'dev_mode'             => false,
    //     // Show the time the page took to load, etc
    //     'update_notice'        => true,
    //     // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    //     'customizer'           => true,
    //     // Enable basic customizer support
    //     //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //     //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

    //     // OPTIONAL -> Give you extra features
    //     'page_priority'        => null,
    //     // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    //     'page_parent'          => 'themes.php',
    //     // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    //     'page_permissions'     => 'manage_options',
    //     // Permissions needed to access the options panel.
    //     'menu_icon'            => '',
    //     // Specify a custom URL to an icon
    //     'last_tab'             => '',
    //     // Force your panel to always open to a specific tab (by id)
    //     'page_icon'            => 'icon-themes',
    //     // Icon displayed in the admin panel next to your menu_title
    //     'page_slug'            => '',
    //     // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    //     'save_defaults'        => true,
    //     // On load save the defaults to DB before user clicks save or not
    //     'default_show'         => false,
    //     // If true, shows the default value next to each field that is not the default value.
    //     'default_mark'         => '',
    //     // What to print by the field's title if the value shown is default. Suggested: *
    //     'show_import_export'   => true,
    //     // Shows the Import/Export panel when not used as a field.

    //     // CAREFUL -> These options are for advanced use only
    //     'transient_time'       => 60 * MINUTE_IN_SECONDS,
    //     'output'               => true,
    //     // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    //     'output_tag'           => true,
    //     // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    //     // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    //     // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    //     'database'             => '',
    //     // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    //     'use_cdn'              => true,
    //     // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    //     // HINTS
    //     'hints'                => array(
    //         'icon'          => 'el el-question-sign',
    //         'icon_position' => 'right',
    //         'icon_color'    => 'lightgray',
    //         'icon_size'     => 'normal',
    //         'tip_style'     => array(
    //             'color'   => 'red',
    //             'shadow'  => true,
    //             'rounded' => false,
    //             'style'   => '',
    //         ),
    //         'tip_position'  => array(
    //             'my' => 'top left',
    //             'at' => 'bottom right',
    //         ),
    //         'tip_effect'    => array(
    //             'show' => array(
    //                 'effect'   => 'slide',
    //                 'duration' => '500',
    //                 'event'    => 'mouseover',
    //             ),
    //             'hide' => array(
    //                 'effect'   => 'slide',
    //                 'duration' => '500',
    //                 'event'    => 'click mouseleave',
    //             ),
    //         ),
    //     ),
    // );

    $args = array(
        'opt_name' => $opt_name,
        'dev_mode' => FALSE,
        'use_cdn' => TRUE,
        'display_name' => $theme->get( 'Name' ),
        'display_version' => $theme->get( 'Version' ),
        'page_slug' => 'bears_options',
        'page_title' => __( 'Theme Options', 'bearsthemes' ),
        'update_notice' => FALSE,
        'admin_bar' => TRUE,
        'menu_type' => 'submenu',
        'menu_title' => __( 'Theme Options', 'bearsthemes' ),
        'allow_sub_menu' => TRUE,
        'page_parent' => 'themes.php',
        // 'page_parent_post_type' => 'your_post_type',
        'customizer' => TRUE,
        'default_mark' => '*',
        'hints' => array(
            'icon' => 'el el-adjust-alt',
            'icon_position' => 'right',
            'icon_color' => 'lightgray',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'database' => 'options',
        'transient_time' => '3600',
        'network_sites' => TRUE,
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    /*$args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => __( 'Documentation', 'bearsthemes' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => __( 'Support', 'bearsthemes' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => __( 'Extensions', 'bearsthemes' ),
    );*/

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    /*$args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );*/

    // Panel Intro text -> before the form
    /*if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'bearsthemes' ), $v );
    } else {
        $args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'bearsthemes' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'bearsthemes' );
	*/
    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'bearsthemes' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'bearsthemes' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'bearsthemes' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'bearsthemes' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'bearsthemes' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    // -> START Import Content
	Redux::setSection( $opt_name, array(
		'title'  => __( 'Import Content', 'bearsthemes' ),
		'desc'   => __( 'Here you can import all sample data in this site. You should backup full this site to keep safe. You can use it to restore on this site.', 'bearsthemes' ),
		'icon'   => 'el el-briefcase',
		'fields' => array(
			array (
				'id'            => 'tb_import',
				'type'          => 'js_button',
				'title'         => 'Import Sample Data',
				'subtitle'      => '<a class="button-secondary" id="bears_import" href="javascript:void(0);">Import</a><p class="import-message"></p>',
			)
			
		)
	) );
	
	// -> START General
	Redux::setSection( $opt_name, array(
		'title'  => __( 'General', 'bearsthemes' ),
		'desc'   => __( '', 'bearsthemes' ),
		'icon'   => 'el-icon-cogs',
		'fields' => array(
			array(
				'id'       => 'less_design',
				'type'     => 'switch',
				'title'    => __( 'Less Design', 'bearsthemes' ),
				'subtitle' => __( 'Use the less design features.', 'bearsthemes' ),
				'default'  => false,
			),
			array(
                'id'       => 'body_layout',
                'type'     => 'button_set',
                'title'    => __( 'Layout', 'bearsthemes' ),
                'subtitle' => __( 'Body layout with wide or boxed.', 'bearsthemes' ),
                'options'  => array(
                    'wide' => 'Wide',
                    'boxed' => 'Boxed'
                ),
                'default'  => 'wide'
            ),
			array(
				'id'       => 'body_background',
				'type'     => 'background',
				'title'    => __('Body Background', 'bearsthemes'),
				'subtitle' => __('Body background with image, color, etc.', 'bearsthemes'),
				'output'      => array('body'),
				'default'  => array(
					'background-color' => '#ffffff',
				)
			),
			array(
				'id'       => 'style_selector',
				'type'     => 'switch',
				'title'    => __( 'Style Selector', 'bearsthemes' ),
				'subtitle' => __( 'Enable style selector.', 'bearsthemes' ),
				'default'  => false,
			),
		)
	) );
	
	// -> START Color
	Redux::setSection( $opt_name, array(
        'title'  => __( 'Color', 'bearsthemes' ),
        'id'     => 'color',
        'desc'   => __( '', 'bearsthemes' ),
        'icon'   => 'el el-brush',
		'fields' => array(
			array(
				'id'       => 'preset_color',
				'type'     => 'select',
				'title'    => __('Preset Color', 'bearsthemes'),
				'subtitle' => __('', 'bearsthemes'),
				'options'  => array(
					'default' => 'Default',
					'preset1' => 'Preset 1',
					'preset2' => 'Preset 2',
					'preset3' => 'Preset 3',
					'preset4' => 'Preset 4',
					'preset5' => 'Preset 5'
				),
				'default'  => 'default',
			),
			array(
				'id'       => 'main_color',
				'type'     => 'color',
				'title'    => __('Main Color', 'bearsthemes'),
				'subtitle' => __('Controls several items, ex: link hovers, highlights, and more. (default: #ec1c33).', 'bearsthemes'),
				'default'  => '#ec1c33',
				'validate' => 'color',
				'required' => array('preset_color','=','default')
			),
			array(
				'id'       => 'secondary_color',
				'type'     => 'color',
				'title'    => __('Secondary Color', 'bearsthemes'),
				'subtitle' => __('Controls several items, ex: link hovers, highlights, and more. (default: #29af8a).', 'bearsthemes'),
				'default'  => '#29af8a',
				'validate' => 'color',
				'required' => array('preset_color','=','default')
			),
			array(
				'id'       => 'main_color_preset1',
				'type'     => 'color',
				'title'    => __('Main Color', 'bearsthemes'),
				'subtitle' => __('Controls several items, ex: link hovers, highlights, and more. (default: #ff8c00).', 'bearsthemes'),
				'default'  => '#ff8c00',
				'validate' => 'color',
				'required' => array('preset_color','=','preset1')
			),
			array(
				'id'       => 'secondary_color_preset1',
				'type'     => 'color',
				'title'    => __('Secondary Color', 'bearsthemes'),
				'subtitle' => __('Controls several items, ex: link hovers, highlights, and more. (default: #556b2f).', 'bearsthemes'),
				'default'  => '#556b2f',
				'validate' => 'color',
				'required' => array('preset_color','=','preset1')
			),
			array(
				'id'       => 'main_color_preset2',
				'type'     => 'color',
				'title'    => __('Main Color', 'bearsthemes'),
				'subtitle' => __('Controls several items, ex: link hovers, highlights, and more. (default: #8b4513).', 'bearsthemes'),
				'default'  => '#8b4513',
				'validate' => 'color',
				'required' => array('preset_color','=','preset2')
			),
			array(
				'id'       => 'secondary_color_preset2',
				'type'     => 'color',
				'title'    => __('Secondary Color', 'bearsthemes'),
				'subtitle' => __('Controls several items, ex: link hovers, highlights, and more. (default: #b8860b).', 'bearsthemes'),
				'default'  => '#b8860b',
				'validate' => 'color',
				'required' => array('preset_color','=','preset2')
			),
			array(
				'id'       => 'main_color_preset3',
				'type'     => 'color',
				'title'    => __('Main Color', 'bearsthemes'),
				'subtitle' => __('Controls several items, ex: link hovers, highlights, and more. (default: #dd3333).', 'bearsthemes'),
				'default'  => '#dd3333',
				'validate' => 'color',
				'required' => array('preset_color','=','preset3')
			),
			array(
				'id'       => 'secondary_color_preset3',
				'type'     => 'color',
				'title'    => __('Secondary Color', 'bearsthemes'),
				'subtitle' => __('Controls several items, ex: link hovers, highlights, and more. (default: #e07e33).', 'bearsthemes'),
				'default'  => '#e07e33',
				'validate' => 'color',
				'required' => array('preset_color','=','preset3')
			),
			array(
				'id'       => 'main_color_preset4',
				'type'     => 'color',
				'title'    => __('Main Color', 'bearsthemes'),
				'subtitle' => __('Controls several items, ex: link hovers, highlights, and more. (default: #b77a10).', 'bearsthemes'),
				'default'  => '#b77a10',
				'validate' => 'color',
				'required' => array('preset_color','=','preset4')
			),
			array(
				'id'       => 'secondary_color_preset4',
				'type'     => 'color',
				'title'    => __('Secondary Color', 'bearsthemes'),
				'subtitle' => __('Controls several items, ex: link hovers, highlights, and more. (default: #3a98af).', 'bearsthemes'),
				'default'  => '#3a98af',
				'validate' => 'color',
				'required' => array('preset_color','=','preset4')
			),
			array(
				'id'       => 'main_color_preset5',
				'type'     => 'color',
				'title'    => __('Main Color', 'bearsthemes'),
				'subtitle' => __('Controls several items, ex: link hovers, highlights, and more. (default: #01b289).', 'bearsthemes'),
				'default'  => '#01b289',
				'validate' => 'color',
				'required' => array('preset_color','=','preset5')
			),
			array(
				'id'       => 'secondary_color_preset5',
				'type'     => 'color',
				'title'    => __('Secondary Color', 'bearsthemes'),
				'subtitle' => __('Controls several items, ex: link hovers, highlights, and more. (default: #c4be52).', 'bearsthemes'),
				'default'  => '#c4be52',
				'validate' => 'color',
				'required' => array('preset_color','=','preset5')
			),
		)
    ) );
	
	// -> START Typography
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Typography', 'bearsthemes' ),
        'id'     => 'typography',
        'desc'   => __( '', 'bearsthemes' ),
		'icon'   => 'el el-font',
        'fields' => array(
            array(
				'id'          => 'body_font',
				'type'        => 'typography', 
				'title'       => __('Body Font Options', 'bearsthemes'),
				'google'      => true, 
				'font-backup' => true,
				'letter-spacing' => true,
				'output'      => array('body'),
				'units'       =>'px',
				'subtitle'    => __('Typography option with each property can be called individually.', 'bearsthemes'),
				'default'     => array(
					'color'       => '#555555', 
					'font-style'  => '400', 
					'font-family' => 'Arimo', 
					'google'      => true,
					'font-size'   => '15px', 
					'line-height' => '28px',
					'letter-spacing' => '0.48px'
				),
			),
			array(
				'id'          => 'h1_font',
				'type'        => 'typography', 
				'title'       => __('H1 Font Options', 'bearsthemes'),
				'google'      => true, 
				'font-backup' => true,
				'letter-spacing' => true,
				'output'      => array('body h1, .bt-font-size-1'),
				'units'       =>'px',
				'subtitle'    => __('Typography option with each property can be called individually.', 'bearsthemes'),
				'default'     => array(
					'color'       => '#282828', 
					'font-style'  => '700', 
					'font-family' => 'Montserrat', 
					'google'      => true,
					'font-size'   => '42px', 
					'line-height' => '60px',
					'letter-spacing' => '0.16px'
				),
			),
			array(
				'id'          => 'h2_font',
				'type'        => 'typography', 
				'title'       => __('H2 Font Options', 'bearsthemes'),
				'google'      => true, 
				'font-backup' => true,
				'letter-spacing' => true,
				'output'      => array('body h2, .bt-font-size-2'),
				'units'       =>'px',
				'subtitle'    => __('Typography option with each property can be called individually.', 'bearsthemes'),
				'default'     => array(
					'color'       => '#282828', 
					'font-style'  => '700', 
					'font-family' => 'Montserrat', 
					'google'      => true,
					'font-size'   => '36px', 
					'line-height' => '42px',
					'letter-spacing' => '0.16px'
				),
			),
			array(
				'id'          => 'tb_h3_font',
				'type'        => 'typography', 
				'title'       => __('H3 Font Options', 'bearsthemes'),
				'google'      => true, 
				'font-backup' => true,
				'letter-spacing' => true,
				'output'      => array('body h3, .bt-font-size-3'),
				'units'       =>'px',
				'subtitle'    => __('Typography option with each property can be called individually.', 'bearsthemes'),
				'default'     => array(
					'color'       => '#282828', 
					'font-style'  => '700', 
					'font-family' => 'Montserrat', 
					'google'      => true,
					'font-size'   => '24px', 
					'line-height' => '36px',
					'letter-spacing' => '0.16px'
				),
			),
			array(
				'id'          => 'h4_font',
				'type'        => 'typography', 
				'title'       => __('H4 Font Options', 'bearsthemes'),
				'google'      => true, 
				'font-backup' => true,
				'letter-spacing' => true,
				'output'      => array('body h4, .bt-font-size-4'),
				'units'       =>'px',
				'subtitle'    => __('Typography option with each property can be called individually.', 'bearsthemes'),
				'default'     => array(
					'color'       => '#282828', 
					'font-style'  => '700', 
					'font-family' => 'Montserrat', 
					'google'      => true,
					'font-size'   => '18px', 
					'line-height' => '24px',
					'letter-spacing' => '0.16px'
				),
			),
			array(
				'id'          => 'h5_font',
				'type'        => 'typography', 
				'title'       => __('H5 Font Options', 'bearsthemes'),
				'google'      => true, 
				'font-backup' => true,
				'letter-spacing' => true,
				'output'      => array('body h5, .bt-font-size-5'),
				'units'       =>'px',
				'subtitle'    => __('Typography option with each property can be called individually.', 'bearsthemes'),
				'default'     => array(
					'color'       => '#282828', 
					'font-style'  => '700', 
					'font-family' => 'Montserrat', 
					'google'      => true,
					'font-size'   => '16px', 
					'line-height' => '18px',
					'letter-spacing' => '0.16px'
				),
			),
			array(
				'id'          => 'h6_font',
				'type'        => 'typography', 
				'title'       => __('H6 Font Options', 'bearsthemes'),
				'google'      => true, 
				'font-backup' => true,
				'letter-spacing' => true,
				'output'      => array('body h6, .bt-font-size-6'),
				'units'       =>'px',
				'subtitle'    => __('Typography option with each property can be called individually.', 'bearsthemes'),
				'default'     => array(
					'color'       => '#282828', 
					'font-style'  => '700', 
					'font-family' => 'Montserrat', 
					'google'      => true,
					'font-size'   => '14px', 
					'line-height' => '16px',
					'letter-spacing' => '0.16px'
				),
			),
			
        )
    ) );
	
	// -> START Logo
	Redux::setSection( $opt_name, array(
        'title'  => __( 'Logo', 'bearsthemes' ),
        'id'     => 'logo',
        'desc'   => __( '', 'bearsthemes' ),
        'icon'   => 'el el-icon-viadeo',
		'fields' => array(
			array(
				'id'       => 'tb_logo_image_hv1',
				'type'     => 'media',
				'url'      => true,
				'title'    => __('Logo Image Heder 1', 'bearsthemes'),
				'subtitle' => __('Select an image file for your logo.', 'bearsthemes'),
				'default'  => array(
					'url'	=> URI_PATH.'/assets/images/logo-dark.png'
				),
			),
			array(
				'id'       => 'tb_logo_image_hv2',
				'type'     => 'media',
				'url'      => true,
				'title'    => __('Logo Image Heder 2', 'bearsthemes'),
				'subtitle' => __('Select an image file for your logo.', 'bearsthemes'),
				'default'  => array(
					'url'	=> URI_PATH.'/assets/images/logo-white.png'
				),
			),
			
		)
    ) );
	
	// -> START Header
	Redux::setSection( $opt_name, array(
        'title'  => __( 'Header', 'bearsthemes' ),
        'id'     => 'header',
        'desc'   => __( '', 'bearsthemes' ),
        'icon'   => 'el el-icon-file-edit',
		'fields' => array(
			array( 
				'id'       => 'tb_header_layout',
				'type'     => 'image_select',
				'title'    => __('Header Layout', 'bearsthemes'),
				'subtitle' => __('Select header layout in your site.', 'bearsthemes'),
				'options'  => array(
					'header-v1'	=> array(
							'alt'   => 'Header V1',
							'img'   => URI_PATH.'/assets/images/headers/header-v1.jpg'
						),
					'header-v2'	=> array(
							'alt'   => 'Header V2',
							'img'   => URI_PATH.'/assets/images/headers/header-v2.jpg'
						),
					'header-v3'	=> array(
							'alt'   => 'Header V3',
							'img'   => URI_PATH.'/assets/images/headers/header-v3.jpg'
						),
				),
				'default' => 'header-v1'
			),
		)
    ) );
	
	// -> START Footer
	Redux::setSection( $opt_name, array(
        'title'  => __( 'Footer', 'bearsthemes' ),
        'id'     => 'footer',
        'desc'   => __( '', 'bearsthemes' ),
        'icon'   => 'el el-icon-file-edit',
		'fields' => array(
			array(
				'id' => 'tb_footer_top_margin',
				'title' => __('Footer Top Margin', 'bearsthemes'),
				'subtitle' => __('Please, Enter margin.', 'bearsthemes'),
				'type' => 'spacing',
				'mode' => 'margin',
				'units' => array('px'),
				'output' => array('.bt-footer .bt-footer-top'),
				'default' => array(
					'margin-top'     => '0px', 
					'margin-right'   => '0px', 
					'margin-bottom'  => '0px', 
					'margin-left'    => '0px',
					'units'          => 'px', 
				)
			),
			array(
				'id' => 'tb_footer_top_padding',
				'title' => __('Footer Top Padding', 'bearsthemes'),
				'subtitle' => __('Please, Enter padding.', 'bearsthemes'),
				'type' => 'spacing',
				'units' => array('px'),
				'output' => array('.bt-footer .bt-footer-top'),
				'default' => array(
					'padding-top'     => '120px', 
					'padding-right'   => '0px', 
					'padding-bottom'  => '90px', 
					'padding-left'    => '0px',
					'units'          => 'px', 
				)
			),
			array(
				'id'       => 'tb_footer_top_backgroud',
				'type'     => 'background',
				'title'    => __('Footer Top Background', 'bearsthemes'),
				'subtitle' => __('background with image, color, etc.', 'bearsthemes'),
				'output'    => array('.bt-footer .bt-footer-top'), 
				'default'  => array(
					'background-color' => '#222222',
					'background-repeat' => 'no-repeat',
					'background-position' => 'center center',
					'background-size' => 'cover',
					'background-image' => URI_PATH.'/assets/images/bg-footer.jpg',
				)
			),
			array(
				'id' => 'tb_footer_bottom_padding',
				'title' => __('Footer Bottom Padding', 'bearsthemes'),
				'subtitle' => __('Please, Enter padding.', 'bearsthemes'),
				'type' => 'spacing',
				'units' => array('px'),
				'output' => array('.bt-footer .bt-footer-bottom'),
				'default' => array(
					'padding-top'     => '30px', 
					'padding-right'   => '0px', 
					'padding-bottom'  => '30px', 
					'padding-left'    => '0px',
					'units'          => 'px', 
				)
			),
			array(
				'id'       => 'tb_footer_bottom_backgroud',
				'type'     => 'background',
				'title'    => __('Footer Bottom Background', 'bearsthemes'),
				'subtitle' => __('background with image, color, etc.', 'bearsthemes'),
				'output'    => array('.bt-footer .bt-footer-bottom'), 
				'default'  => array(
					'background-color' => '#0d0d0d',
				)
			),
		)
    ) );
	
	// -> START Main Menu
	Redux::setSection( $opt_name, array(
        'title'  => __( 'Main Menu', 'bearsthemes' ),
        'id'     => 'main_menu',
        'desc'   => __( '', 'bearsthemes' ),
        'icon'   => 'el el-icon-list',
		'fields' => array(
			
		)
    ) );
	
	// -> START Main Menu 1
	Redux::setSection( $opt_name, array(
        'title'  => __( 'Main Menu 1', 'bearsthemes' ),
        'id'     => 'main_menu1',
        'desc'   => __( '', 'bearsthemes' ),
        'subsection' => true,
		'fields' => array(
			array(
				'id'          => 'menu_first_level',
				'type'        => 'typography', 
				'title'       => __('First Level Font Options', 'bearsthemes'),
				'google'      => true, 
				'font-backup' => true,
				'letter-spacing' => true,
				'output'      => array('.bt-header-v1 .bt-menu-list > ul > li > a, .bt-header-v2 .bt-menu-list > ul > li > a'),
				'units'       =>'px',
				'subtitle'    => __('Typography option with each property can be called individually.', 'bearsthemes'),
				'default'     => array(
					'color'       => '#292929', 
					'font-style'  => '400', 
					'font-family' => 'Montserrat', 
					'google'      => true,
					'font-size'   => '13px', 
					'line-height' => '105px',
					'letter-spacing' => '0.16px'
				),
			),
			array(
				'id'          => 'menu_sub_level',
				'type'        => 'typography', 
				'title'       => __('Sub Level Font Options', 'bearsthemes'),
				'google'      => true, 
				'font-backup' => true,
				'letter-spacing' => true,
				'output'      => array('.bt-header-v1 .bt-menu-list > ul > li.menu-item-has-children > ul > li > a, .bt-header-v2 .bt-menu-list > ul > li.menu-item-has-children > ul > li > a'),
				'units'       =>'px',
				'subtitle'    => __('Typography option with each property can be called individually.', 'bearsthemes'),
				'default'     => array(
					'color'       => '#ffffff', 
					'font-style'  => '400', 
					'font-family' => 'Montserrat', 
					'google'      => true,
					'font-size'   => '13px', 
					'line-height' => '28px',
					'letter-spacing' => '0.16px'
				),
			),
			
		)
    ) );
	
	// -> START Main Menu 2
	Redux::setSection( $opt_name, array(
        'title'  => __( 'Main Menu 2', 'bearsthemes' ),
        'id'     => 'main_menu2',
        'desc'   => __( '', 'bearsthemes' ),
		'subsection' => true,
		'fields' => array(
			array(
				'id'          => 'menu2_first_level',
				'type'        => 'typography', 
				'title'       => __('First Level Font Options', 'bearsthemes'),
				'google'      => true, 
				'font-backup' => true,
				'letter-spacing' => true,
				'output'      => array('.bt-header-v3 .bt-menu-list > ul > li > a'),
				'units'       =>'px',
				'subtitle'    => __('Typography option with each property can be called individually.', 'bearsthemes'),
				'default'     => array(
					'color'       => '#555555', 
					'font-style'  => '400', 
					'font-family' => 'Ubuntu', 
					'google'      => true,
					'font-size'   => '13px', 
					'line-height' => '105px',
					'letter-spacing' => '0.64px'
				),
			),
			array(
				'id'          => 'menu2_sub_level',
				'type'        => 'typography', 
				'title'       => __('Sub Level Font Options', 'bearsthemes'),
				'google'      => true, 
				'font-backup' => true,
				'letter-spacing' => true,
				'output'      => array('.bt-header-v3 .bt-menu-list > ul > li.menu-item-has-children > ul > li > a'),
				'units'       =>'px',
				'subtitle'    => __('Typography option with each property can be called individually.', 'bearsthemes'),
				'default'     => array(
					'color'       => '#ffffff', 
					'font-style'  => '400', 
					'font-family' => 'Arimo', 
					'google'      => true,
					'font-size'   => '13px', 
					'line-height' => '28px',
					'letter-spacing' => '0.48px'
				),
			),
			
		)
    ) );
	
	// -> START Title Bar
	Redux::setSection( $opt_name, array(
        'title'  => __( 'Title Bar', 'bearsthemes' ),
        'id'     => 'title_bar',
        'desc'   => __( '', 'bearsthemes' ),
        'icon'   => 'el el-icon-file-edit',
		'fields' => array(
			array(
				'id'             => 'title_bar_margin',
				'type'           => 'spacing',
				'output'         => array('.bt-title-bar-wrap, .bt-page-title-shop'),
				'mode'           => 'margin',
				'units'          => array('em', 'px'),
				'title'    => __('Margin', 'bearsthemes'),
				'subtitle' => __('Please, Enter margin of title bar.', 'bearsthemes'),
				'default'            => array(
					'margin-top'     => '0px', 
					'margin-right'   => '0px', 
					'margin-bottom'  => '120px', 
					'margin-left'    => '0px',
					'units'          => 'px', 
				)
			),
			array(
				'id'             => 'title_bar_padding',
				'type'           => 'spacing',
				'output'         => array('.bt-title-bar-wrap .bt-title-bar, .bt-page-title-shop'),
				'mode'           => 'padding',
				'units'          => array('em', 'px'),
				'title'    => __('Padding', 'bearsthemes'),
				'subtitle' => __('Please, Enter padding of title bar.', 'bearsthemes'),
				'default'            => array(
					'padding-top'     => '75px', 
					'padding-right'   => '0px', 
					'padding-bottom'  => '75px', 
					'padding-left'    => '0px',
					'units'          => 'px', 
				)
			),
			array(
				'id'       => 'tb_title_bar_bg',
				'type'     => 'background',
				'title'    => __('Background', 'bearsthemes'),
				'subtitle' => __('background with image, color, etc.', 'bearsthemes'),
				'output'    => array('.bt-title-bar-wrap, .bt-page-title-shop'), 
				'default'  => array(
					'background-color' => '#222222',
					'background-repeat' => 'no-repeat',
					'background-position' => 'center center',
					'background-size' => 'cover',
					'background-image' => URI_PATH.'/assets/images/bg-titlebar.jpg',
				)
			),
			
			array(
				'id'       => 'title_bar_heading_color',
				'type'     => 'color',
				'title'    => __('Title Bar Heading Color', 'bearsthemes'),
				'subtitle' => __('Controls the headings color of title bar. (default: #ffffff).', 'bearsthemes'),
				'output'    => array('.bt-title-bar-wrap .bt-title-bar h2, .bt-title-bar-wrap .bt-title-bar h6, .woocommerce .bt-page-title-shop h2'),
				'default'  => '#ffffff',
				'validate' => 'color',
			),
			array(
				'id'       => 'title_bar_link_color',
				'type'     => 'link_color',
				'title'    => __('Title Bar Link Color', 'bearsthemes'),
				'subtitle' => __('Controls the links color of title bar. (default: #ffffff).', 'bearsthemes'),
				'output'    => array('.bt-title-bar-wrap .bt-title-bar .bt-path a, .woocommerce .bt-page-title-shop a'),
				'default'  => array(
					'regular'  => '#ffffff',
					'hover'    => '#000000',
					'active'   => '#000000',
					'visited'  => '#000000',
				)
			),
			array(
				'id'       => 'title_bar_text_color',
				'type'     => 'color',
				'title'    => __('Title Bar Text Color', 'bearsthemes'),
				'subtitle' => __('Controls the text color of title bar. (default: #ffffff).', 'bearsthemes'),
				'output'    => array('.bt-title-bar-wrap .bt-title-bar , .woocommerce .bt-page-title-shop nav'),
				'default'  => '#ffffff',
				'validate' => 'color',
			),
			array(
				'id'       => 'title_bar_subtext',
				'type'     => 'text',
				'title'    => __('Sub Text', 'bearsthemes'),
				'subtitle' => __('Please, Enter sub text of title bar.', 'bearsthemes'),
				'default'  => ''
			),
			array(
				'id'       => 'page_breadcrumb_delimiter',
				'type'     => 'text',
				'title'    => __('Delimiter', 'bearsthemes'),
				'subtitle' => __('Please, Enter Delimiter of page breadcrumb in title bar.', 'bearsthemes'),
				'default'  => '/'
			)
		)
		
    ) );
	
	// -> START Blog Post
	Redux::setSection( $opt_name, array(
        'title'  => __( 'Blog Post', 'bearsthemes' ),
        'id'     => 'blog_post',
        'desc'   => __( '', 'bearsthemes' ),
		'fields' => array(
			array( 
				'id'       => 'tb_blog_layout',
				'type'     => 'image_select',
				'title'    => __('Select Layout', 'bearsthemes'),
				'subtitle' => __('Select layout of blog.', 'bearsthemes'),
				'options'  => array(
					'2cl'	=> array(
								'alt'   => '2cl',
								'img'   => URI_PATH_ADMIN.'/assets/images/2cl.png'
							),
					'2cr'	=> array(
								'alt'   => '2cr',
								'img'   => URI_PATH_ADMIN.'/assets/images/2cr.png'
							)
				),
				'default' => '2cr'
			),
			array(
				'id'       => 'tb_blog_left_sidebar_col',
				'type'     => 'text',
				'title'    => __('Sidebar Left Column', 'bearsthemes'),
				'subtitle' => __('Please, Enter class bootstrap and extra class. Ex: col-xs-12 col-sm-6 col-md-3 col-lg-3 el-class.', 'bearsthemes'),
				'default'  => 'col-xs-12 col-sm-12 col-md-3 col-lg-3',
				'required' => array('tb_blog_layout','=', '2cl')
			),
			array(
				'id'       => 'tb_blog_content_col',
				'type'     => 'text',
				'title'    => __('Content Column', 'bearsthemes'),
				'subtitle' => __('Please, Enter class bootstrap and extra class. Ex: col-xs-12 col-sm-6 col-md-3 col-lg-3 el-class.', 'bearsthemes'),
				'default'  => 'col-xs-12 col-sm-12 col-md-9 col-lg-9'
			),
			array(
				'id'       => 'tb_blog_right_siedebar_col',
				'type'     => 'text',
				'title'    => __('Sidebar Right Column', 'bearsthemes'),
				'subtitle' => __('Please, Enter class bootstrap and extra class. Ex: col-xs-12 col-sm-6 col-md-3 col-lg-3 el-class.', 'bearsthemes'),
				'default'  => 'col-xs-12 col-sm-12 col-md-3 col-lg-3',
				'required' => array('tb_blog_layout','=', '2cr')
			),
			array(
				'id'       => 'tb_blog_post_readmore_text',
				'type'     => 'text',
				'title'    => __( 'Read More Text', 'bearsthemes' ),
				'subtitle' => __( 'Enter text of label button read more in blog.', 'bearsthemes' ),
				'default'  => 'VIEW DETAIL',
			),
		)
		
    ) );
	Redux::setSection( $opt_name, array(
        'title'  => __( 'Single Post', 'bearsthemes' ),
        'id'     => 'single_post',
        'desc'   => __( '', 'bearsthemes' ),
		'subsection' => true,
		'fields' => array(
			array( 
				'id'       => 'tb_post_layout',
				'type'     => 'image_select',
				'title'    => __('Select Layout', 'bearsthemes'),
				'subtitle' => __('Select layout of single blog.', 'bearsthemes'),
				'options'  => array(
					'2cl'	=> array(
								'alt'   => '2cl',
								'img'   => URI_PATH_ADMIN.'/assets/images/2cl.png'
							),
					'2cr'	=> array(
								'alt'   => '2cr',
								'img'   => URI_PATH_ADMIN.'/assets/images/2cr.png'
							)
				),
				'default' => '2cr'
			),
			array(
				'id'       => 'tb_post_left_sidebar_col',
				'type'     => 'text',
				'title'    => __('Left Sidebar Column', 'bearsthemes'),
				'subtitle' => __('Please, Enter class bootstrap and extra class. Ex: col-xs-12 col-sm-6 col-md-3 col-lg-3 el-class.', 'bearsthemes'),
				'default'  => 'col-xs-12 col-sm-12 col-md-3 col-lg-3',
				'required' => array('tb_post_layout','=', '2cl')
			),
			array(
				'id'       => 'tb_post_content_col',
				'type'     => 'text',
				'title'    => __('Content Column', 'bearsthemes'),
				'subtitle' => __('Please, Enter class bootstrap and extra class. Ex: col-xs-12 col-sm-6 col-md-3 col-lg-3 el-class.', 'bearsthemes'),
				'default'  => 'col-xs-12 col-sm-8 col-md-9 col-lg-9',
			),
			array(
				'id'       => 'tb_post_right_siedebar_col',
				'type'     => 'text',
				'title'    => __('Right Sidebar Column', 'bearsthemes'),
				'subtitle' => __('Please, Enter class bootstrap and extra class. Ex: col-xs-12 col-sm-6 col-md-3 col-lg-3 el-class.', 'bearsthemes'),
				'default'  => 'col-xs-12 col-sm-12 col-md-3 col-lg-3',
				'required' => array('tb_blog_layout','=', '2cr')
			),
			array( 
				'id'       => 'tb_post_show_post_nav',
				'type'     => 'switch',
				'title'    => __( 'Show Navigation', 'bearsthemes' ),
				'subtitle' => __( 'Show or not post navigation on your single blog.', 'bearsthemes' ),
				'default'  => true,
			),
			array(
				'id'       => 'tb_post_show_post_author',
				'type'     => 'switch',
				'title'    => __( 'Show Author', 'bearsthemes' ),
				'subtitle' => __( 'Show or not post author on your single blog.', 'bearsthemes' ),
				'default'  => true,
			),
			array(
				'id'       => 'tb_post_show_post_comment',
				'type'     => 'switch',
				'title'    => __( 'Show Comment', 'bearsthemes' ),
				'subtitle' => __( 'Show or not post comment on your single blog.', 'bearsthemes' ),
				'default'  => true,
			),
		)
		
    ) );
	
	// -> START Page
	Redux::setSection( $opt_name, array(
        'title'  => __( 'Page', 'bearsthemes' ),
        'id'     => 'page',
        'desc'   => __( '', 'bearsthemes' ),
        'icon'   => 'el el-pencil',
		'fields' => array(
			array(
				'id'       => 'page_comment',
				'type'     => 'switch',
				'title'    => __( 'Show Page Comment', 'bearsthemes' ),
				'subtitle' => __( 'Show or not page comment on your page.', 'bearsthemes' ),
				'default'  => true,
			)
		)
		
    ) );
	
	// -> START Custom CSS
	Redux::setSection( $opt_name, array(
        'title'  => __( 'Custom CSS', 'bearsthemes' ),
        'id'     => 'custom_css',
        'desc'   => __( '', 'bearsthemes' ),
        'icon'   => 'el el-icon-css',
		'fields' => array(
			array(
				'id'       => 'custom_css_code',
				'type'     => 'ace_editor',
				'title'    => __('Custom CSS Code', 'bearsthemes'),
				'subtitle' => __('Quickly add some CSS to your theme by adding it to this block..', 'bearsthemes'),
				'mode'     => 'css',
				'theme'    => 'monokai',
				'default'  => ''
			)
		)
    ) );
	
	

    /*if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'bearsthemes' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }*/
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'bearsthemes' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'bearsthemes' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }

