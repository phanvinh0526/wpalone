<?php

	$theme_options = apply_filters( 'bcore_theme_options_filter', 'bearstheme_options');

    // All extensions placed within the extensions directory will be auto-loaded for your Redux instance.
    Redux::setExtensions( $theme_options, dirname( __FILE__ ) . '/extensions/' );

    // Any custom extension configs should be placed within the configs folder.
    if ( file_exists( dirname( __FILE__ ) . '/configs/' ) ) {
        $files = glob( dirname( __FILE__ ) . '/configs/*.php' );
        if ( ! empty( $files ) ) {
            foreach ( $files as $file ) {
                include $file;
            }
        }
    }