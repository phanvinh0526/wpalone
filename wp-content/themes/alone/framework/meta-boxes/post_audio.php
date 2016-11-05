<div class='tb_metabox'>
	<?php
	$this->select( 'post_audio_type', 'Audio Type', array( 'soundcloud' => 'Soundcloud', ), '', '' );
	$this->textarea( 'post_audio_data', 'Audio Data', __( 'Please enter code iFrame Soundcloud', 'bearsthemes' ) );
	?>
</div>