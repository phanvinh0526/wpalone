<div class="bt-service clearfix">
	<?php echo wp_get_attachment_image( $img, 'full' ); ?>
	<div class="bt-overlay">
		<?php 
			if($icon) echo '<i class="'.esc_attr($icon).'"></i>';
			if($title) echo '<h6 class="bt-title">'.esc_html($title).'</h6>';
			if($desc) echo '<p>'.esc_html($desc).'</p>';
		?>
		<a class="bt-btn-link" href="<?php echo esc_url($btn_link); ?>"><?php echo $btn_label; ?></a>
	</div>
</div>