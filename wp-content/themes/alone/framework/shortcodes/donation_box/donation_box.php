<?php
function bearsthemes_donation_box_func($atts) {
    extract(shortcode_atts(array(
		'img' 			=> '',
		'subtitle' 		=> '',
		'title' 		=> '',
        'btn_label' 	=> 'DONATE NOW',
        'btn_link' 		=> '#',
        'el_class' 		=> ''
    ), $atts));

    $class = array();
	$class[] = 'bt-donation-wrap';
	$class[] = $el_class;
    ob_start();
    ?>
		<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
			<div class="bt-donation clearfix">
				<?php echo wp_get_attachment_image( $img, 'full' ); ?>
				<div class="bt-overlay">
					<?php 
						if($subtitle) echo '<h6 class="bt-subtitle">'.esc_html($subtitle).'</h6>';
						if($title) echo '<h3 class="bt-title">'.esc_html($title).'</h3>';
					?>
				</div>
				<a class="bt-btn-link" href="<?php echo esc_url($btn_link); ?>"><?php echo $btn_label; ?></a>
			</div>
		</div>
		
    <?php
    return ob_get_clean();
}
if(function_exists('bcore_shortcode')) { bcore_shortcode('donation_box', 'bearsthemes_donation_box_func');}
