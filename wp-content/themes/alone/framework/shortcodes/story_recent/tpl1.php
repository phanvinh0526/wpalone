<div class="col-md-6 bt-header">
	<div class="bt-header-inner">
		<?php echo $content; ?>
	</div>
</div>
<div class="col-md-6 bt-content">
	<article <?php post_class(); ?>>
		<div class="bt-story-item">
			<span class="bt-locaiton">
				<?php _e('IN ', 'bearsthemes'); echo get_post_meta(get_the_ID(),'tb_story_donate_location',true); ?>
			</span>
			<h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div class="bt-date"><?php echo '<i class="fa fa-calendar"></i>'.get_the_date('M d, Y g:i a', get_the_ID()); ?></div>
			<div class="bt-excerpt"><?php the_excerpt(); ?></div>
			<div class="bt-donation-so-far"><?php _e('Donation So Far: ', 'bearsthemes'); ?><span><?php echo '$'.get_post_meta(get_the_ID(),'tb_story_donate_so_far',true); ?></span></div>
			
		</div>
	</article>
</div>