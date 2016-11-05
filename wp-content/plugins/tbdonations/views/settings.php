<?php
$using_account = get_option('using_account');
$sandbox_account = get_option('sandbox_account');
$live_account = get_option('live_account');
$paypal_return = get_option('paypal_return');
$include_bootstrap = get_option('include_bootstrap');
$include_fontanwesome = get_option('include_fontanwesome');
$tb_currency = get_option('tb_currency', 'USD');
$symbol_position = get_option('symbol_position', 0);
?>
<div class="settings_wrap">
	<h2><?php _e('Settings','tbdonations'); ?></h2>
	<form method="POST" action="options.php">
		<?php settings_fields( 'tb-plugin-settings-tbdonations' ); ?>
		<?php do_settings_sections( 'tb-plugin-settings-tbdonations' ); ?>
		<table class="wp-list-table widefat">
			<tr>
				<td><?php _e('PayPal Mode','tbdonations'); ?><td>
				<td>
					<select name="using_account">
						<option <?php selected($using_account,'sandbox');?> value="sandbox"><?php _e('Sandbox','tbdonations'); ?></option>
						<option <?php selected($using_account,'live');?> value="live"><?php _e('Live','tbdonations'); ?></option>
					</select>
				<td>
			</tr>
			<tr>
				<td><?php _e('Sandbox account','tbdonations'); ?><td>
				<td>
					<input type="text" name="sandbox_account" value="<?php echo esc_attr($sandbox_account);?>"/>
				<td>
			</tr>
			<tr>
				<td><?php _e('Live account','tbdonations'); ?><td>
				<td>
					<input type="text" name="live_account" value="<?php echo esc_attr($live_account);?>"/>
				<td>
			</tr>
			<tr>
				<td><?php _e('PayPal Return','tbdonations'); ?><td>
				<td>
					<?php wp_dropdown_pages( array('show_option_none'=> 'Please Select','name'=>'paypal_return', 'selected'=> $paypal_return) );?>
				<td>
			</tr>			
			<tr>
				<td><?php _e('Include Bootstrap','tbdonations'); ?><td>
				<td>
					<select name="include_bootstrap">
						<option <?php selected($include_bootstrap, 0);?> value="0"><?php _e('No, Thanks','tbdonations'); ?></option>
						<option <?php selected($include_bootstrap, 1);?> value="1"><?php _e('Yes, Please','tbdonations'); ?></option>
					</select>
				<td>
			</tr>		
			<tr>
				<td><?php _e('Include Font Anwesome','tbdonations'); ?><td>
				<td>
					<select name="include_fontanwesome">
						<option <?php selected($include_fontanwesome, 0);?> value="0"><?php _e('No, Thanks','tbdonations'); ?></option>
						<option <?php selected($include_fontanwesome, 1);?> value="1"><?php _e('Yes, Please','tbdonations'); ?></option>
					</select>
				<td>
			</tr>			
			<tr>
				<td><?php _e('Currency','tbdonations'); ?><td>
				<td>
					<select name="tb_currency">
						<?php						
						$currency = apply_filters('tb_currency', self::$currency);
						foreach($currency as $k => $v): ?>
							<option <?php selected($tb_currency, $k);?> value="<?php echo esc_attr($k);?>"><?php echo $v["title"];?></option>
						<?php endforeach;?>
					</select>
				<td>
			</tr>			
			<tr>
				<td><?php _e('Symbol Currency Position','tbdonations'); ?><td>
				<td>
					<select name="symbol_position">
						<option <?php selected($symbol_position, 0);?> value="0"><?php _e('Left','tbdonations'); ?></option>
						<option <?php selected($symbol_position, 1);?> value="1"><?php _e('Right','tbdonations'); ?></option>
					</select>
				<td>
			</tr>
			<tr>
				<td colspan="2">
				<?php submit_button(); ?>
				<td>
			</tr>
		</table>
	</form>
</div>