<article <?php post_class($rtl_class); ?>>
	<div class="bt-thumb">
		<?php
			do_action('woocommerce_template_loop_product_link_open');
			if($show_sale_flash) do_action('woocommerce_show_product_loop_sale_flash');
			do_action('woocommerce_template_loop_product_thumbnail');
			if($show_price) do_action('woocommerce_template_loop_price');
			do_action('woocommerce_template_loop_product_link_close');
		?>
	</div>
	<div class="bt-content">
		<?php
			do_action('woocommerce_template_loop_product_link_open');
			if($show_title) do_action('woocommerce_template_loop_product_title');
			do_action('woocommerce_template_loop_product_link_close');
			if($show_rating) do_action('woocommerce_template_loop_rating');
			if($show_excerpt) echo '<div class="description">'.bearstheme_custom_excerpt($excerpt_lenght, $excerpt_more).'</div>';
			if($show_add_to_cart) do_action('woocommerce_template_loop_add_to_cart');
		?>
	</div>
</article>