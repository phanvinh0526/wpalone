<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $bearstheme_options;
$temp_single_shop = ( isset( $bearstheme_options['tb_single_shop_template'] ) && $bearstheme_options['tb_single_shop_template'] ) 
	? $bearstheme_options['tb_single_shop_template'] 
	: 'shop';
get_header( 'shop' ); ?>
	<?php require('title-bar-shop.php'); ?>
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_output_content_wrapper' );
	?>
	<div class="row">
		<div class="container">
			<div class="col-md-9">
				<div class="bt-product-item">
					<?php while ( have_posts() ) : the_post(); ?>
						
						<?php wc_get_template_part( 'content', 'single-product' ); ?>
							
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>
			<div class="col-md-3 sidebar-right temp-<?php echo esc_attr( $temp_single_shop ); ?>">
				<?php if (is_active_sidebar('bearstheme-shop-single-right-sidebar')) dynamic_sidebar('bearstheme-shop-single-right-sidebar'); ?>
			</div>
		</div>
	</div>
	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_output_content_wrapper_end' );
	?>

<?php get_footer( 'shop' ); ?>
