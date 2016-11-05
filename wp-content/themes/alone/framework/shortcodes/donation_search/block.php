<?php
/**
 * Donation Search - layout Blog
 *
 */

/* define variable */
$_id 		= sprintf( 'bears-element-%s', $atts['element_id'] );
$_class 	= sprintf( 'donation-search-form layout-%s %s', basename( __FILE__, '.php' ), $atts['extra_class'] );
?>
<div id="<?php echo esc_attr( $_id ); ?>" class='<?php echo esc_attr( $_class ); ?>'>
	<div class='search-form-inner'>
		<?php echo do_shortcode( $content ); ?>
		<form method='GET' action='' class='bt-elem-form'>
			<div class='field-group'>
				<input type="text" name="donate_location" value="" placeholder="<?php _e( 'Type location', 'bearsthemes' ) ?>" />
			</div>
			<div class='field-group'>
				<div class="select-ui">
					<select name="donate_category">
						<option value=''><?php _e( 'Select category', 'bearsthemes' ) ?></option>
					</select>
				</div>
			</div>
			<div class='field-group text-center'>
				<button type="submit" class="btn-submit"><?php _e( 'Search Now', 'bearsthemes' ) ?></button>
			</div>
		</form>
	</div>
</div>
