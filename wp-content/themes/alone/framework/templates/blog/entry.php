<?php
$bearstheme_options = $GLOBALS['bearstheme_options'];
$tb_blog_post_readmore_text = (int) isset($bearstheme_options['tb_blog_post_readmore_text']) ? $bearstheme_options['tb_blog_post_readmore_text'] : 'VIEW DETAIL';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="bt-blog-item">
		<div class="bt-blog-item-inner">
		<?php if (has_post_thumbnail()) the_post_thumbnail('bearstheme_custom_blog_single_size'); ?>
			<div class="bt-content">
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
				<h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<div class="bt-excerpt"><?php the_excerpt(); ?></div>
				<a class="bt-btn-main" href="<?php the_permalink(); ?>"><?php  echo $tb_blog_post_readmore_text; ?></a>
			</div>
			
		</div>
	</div>
</article>
