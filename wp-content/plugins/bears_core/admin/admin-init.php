<?php
/** 
 * bcore_redux_setup
 *
 * @param string $options_file
 */
function bcore_redux_setup( $options_file = '' ) 
{
    // Load the embedded Redux Framework
    if ( file_exists( dirname( __FILE__ ).'/redux-framework/framework.php' ) ) {
        require_once dirname(__FILE__).'/redux-framework/framework.php';
    }
    
    if ( file_exists( $options_file ) ) require_once $options_file;

    // Load Redux extensions
    if ( file_exists( dirname( __FILE__ ) . '/redux-extensions/extensions-init.php' ) ) {
        require_once dirname( __FILE__ ) . '/redux-extensions/extensions-init.php';
    }
}