<article <?php post_class(); ?>>
	<div class="bt-post-item">
		<div class="bt-header">
			<div class="bt-publish">
				<span class="bt-day"><?php echo get_the_date('d'); ?></span>
				<span class="bt-month"><?php echo get_the_date('M'); ?></span>
			</div>
			<a href="<?php the_permalink(); ?>"><?php if (has_post_thumbnail()) the_post_thumbnail('bearstheme_custom_blog_archive_size'); ?></a>
			<?php if($show_title) { ?>
				<h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php } ?>
		</div>
		<div class="bt-content">
			<?php if($show_meta) { ?>
				<ul class="bt-meta">
					<li class="bt-author"><?php echo '<i class="fa fa-user"></i>'.__('By ', 'bearsthemes').'<span>'.get_the_author().'</span>'; ?></li>
					<li class="bt-location"><?php echo '<i class="fa fa-map-marker"></i>'.__('Cause in ', 'bearsthemes').'<span>'.get_post_meta(get_the_ID(),'bt_post_donation_location',true).'</span>'; ?></li>
				</ul>
			<?php } ?>
			<?php if($show_excerpt) { ?>
				<div class="bt-excerpt"><?php echo bearstheme_custom_excerpt($excerpt_lenght, $excerpt_more); ?></div>
			<?php } ?>
		</div>
	</div>
</article>