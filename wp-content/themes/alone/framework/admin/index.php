<?php
require_once(ABS_PATH_ADMIN .'/TGM-Plugin-Activation-2.6.1/plugin-options.php');

/**
 * alone_wbc_importer_description
 *
 */
if( ! function_exists( 'lemon_wbc_importer_description' ) ) {
	function lemon_wbc_importer_description()
	{
		$output = "";

		/* validate server import */
		$validate_phpinfo_import = array(
			'memory_limit' 			=> array( 'val' => 128, 'type' => 'M' ),
			'post_max_size'	 		=> array( 'val' => 128, 'type' => 'M' ),
			'upload_max_filesize' 	=> array( 'val' => 128, 'type' => 'M' ),
			'max_execution_time' 	=> array( 'val' => 180, 'type' => '' ),
			'max_input_time' 		=> array( 'val' => 180, 'type' => '' ),
		);
		$output .= ( function_exists( 'bcore_VerifyImportSampleData' ) ) 
			? bcore_verifyImportSampleData( $validate_phpinfo_import ) 
			: "";

		/* backup database */
		$output .= ( function_exists( 'bcore_VerifyImportSampleData' ) ) 
			? bcore_backupDatabase( __DIR__ . '/backup-database', get_template_directory_uri() . '/framework/admin/backup-database' ) 
			: "";	

		return "<div class='bcore-block-accordion-wrap'>{$output}</div>";
	}
	add_filter('wbc_importer_description', 'lemon_wbc_importer_description' );
}
