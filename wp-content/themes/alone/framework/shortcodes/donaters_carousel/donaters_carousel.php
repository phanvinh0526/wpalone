<?php
function bearstheme_donaters_carousel_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'el_class' => '',
    ), $atts));
			
    $class = array();
    $class[] = 'bt-donaters-carousel';
    $class[] = $el_class;
	
	global $wpdb;
	
	$donaers = $wpdb->get_results( "
		SELECT p.user_id, p.firstname, p.lastname, p.amount 
		FROM wp_tbdonations_payment as p
		INNER JOIN wp_users as u ON p.user_id = u.ID
		WHERE p.paid = 1 
		ORDER BY p.id DESC LIMIT 5" 
	);
	
    ob_start();
    ?>
	<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
		<div class="owl-carousel">
			<?php foreach($donaers as $donaer) { ?>
				<div class="bt-donater-item">
					<div class="bt-thumb"><?php echo get_avatar( $donaer->user_id, 89 ); ?></div>
					<h5 class="bt-name"><?php echo $donaer->firstname.' '.$donaer->lastname; ?></h5>
					<span class="bt-meta"><?php _e('Historian', 'bearsthemes'); ?></span>
					<h6 class="bt-donated"><?php _e('Donated: $', 'bearsthemes'); echo number_format($donaer->amount); ?></h6>
				</div>
			<?php } ?>
		</div>
	</div>
    <?php
    return ob_get_clean();
}

if(function_exists('bcore_shortcode')) { bcore_shortcode('donaters_carousel', 'bearstheme_donaters_carousel_func'); }
