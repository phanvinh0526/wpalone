<?php 
if( ! function_exists( 'bearsthemes_loadSingleTempShop' ) ) : 
	function bearsthemes_loadSingleTempShop()
	{
		global $bearstheme_options;
		$temp = ( isset( $bearstheme_options['tb_single_shop_template'] ) && $bearstheme_options['tb_single_shop_template'] ) 
			? $bearstheme_options['tb_single_shop_template'] 
			: 'shop';

		ob_start();
		require ABS_PATH_FR . '/templates/'. $temp .'/single/entry.php';
		return ob_get_clean();
	}
endif;
echo bearsthemes_loadSingleTempShop();
?>