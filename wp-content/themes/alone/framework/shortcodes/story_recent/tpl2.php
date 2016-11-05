<div class="col-md-7 bt-header">
	<div class="bt-header-inner">
		<?php echo $content; ?>
	</div>
</div>
<div class="col-md-5 bt-content">
	<article <?php post_class(); ?>>
		<div class="bt-story-item">
			<span class="bt-locaiton">
				<?php _e('IN ', 'bearsthemes'); echo get_post_meta(get_the_ID(),'tb_story_donate_location',true); ?>
			</span>
			<h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div class="bt-donation-so-far"><?php _e('Donation So Far: ', 'bearsthemes'); ?><span><?php echo '$'.get_post_meta(get_the_ID(),'tb_story_donate_so_far',true); ?></span></div>
			<div class="bt-excerpt"><?php echo bearstheme_custom_excerpt(34, '.'); ?></div>
			<a class="bt-btn-bd-main bt-view-all" href="<?php echo esc_url($view_all_link); ?>"><?php echo $view_all_text; ?></a>
		</div>
	</article>
</div>