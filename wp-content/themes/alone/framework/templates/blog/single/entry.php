<?php
$bearstheme_options = $GLOBALS['bearstheme_options'];
$tb_post_show_post_image = (int) isset($bearstheme_options['tb_post_show_post_image']) ? $bearstheme_options['tb_post_show_post_image'] : 1;
$tb_post_show_post_title = (int) isset($bearstheme_options['tb_post_show_post_title']) ? $bearstheme_options['tb_post_show_post_title'] : 1;
$tb_post_show_post_meta = (int) isset($bearstheme_options['tb_post_show_post_meta']) ? $bearstheme_options['tb_post_show_post_meta'] : 1;
$tb_post_show_post_desc = (int) isset($bearstheme_options['tb_post_show_post_desc']) ? $bearstheme_options['tb_post_show_post_desc'] : 1;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="bt-blog-item">
		<div class="bt-header">
		<?php if (has_post_thumbnail()) the_post_thumbnail('bearstheme_custom_blog_single_size'); ?>
			<div class="bt-header-inner">
				<div class="bt-publish">
					<span class="bt-day"><?php echo get_the_date('d'); ?></span>
					<span class="bt-month"><?php echo get_the_date('M'); ?></span>
				</div>
				<ul class="bt-meta">
					<?php if ( is_sticky() ) { ?>
						<li class="publish"><?php _e('<i class="fa fa-thumb-tack"></i> Sticky', 'bearsthemes'); ?></li>
					<?php } ?>
					<li class="bt-author"><?php echo '<i class="fa fa-user"></i>'.__('By ', 'bearsthemes').'<span>'.get_the_author().'</span>'; ?></li>
					<li class="bt-location"><?php echo '<i class="fa fa-map-marker"></i>'.__('Cause in ', 'bearsthemes').'<span>'.get_post_meta(get_the_ID(),'bt_post_donation_location',true).'</span>'; ?></li>
				</ul>
				<h3 class="bt-title"><?php the_title(); ?></h3>
			</div>
		</div>
		<div class="bt-content">
			<?php
				the_content();
				wp_link_pages(array(
					'before' => '<div class="page-links">' . __('Pages:', 'bearsthemes'),
					'after' => '</div>',
				));
			?>
		</div>
		<div class="bt-tags"><?php the_tags( __('<i class="icon icon-tag"></i> <span>TAGS:</span> ', 'bearsthemes'), ', ', '' ); ?> </div>
	</div>
</article>
