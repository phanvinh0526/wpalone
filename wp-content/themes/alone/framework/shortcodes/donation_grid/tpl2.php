<article <?php post_class($class_columns); ?>>
	<div class="donation-item">
		<?php if (has_post_thumbnail()) { ?>
			<div class="donation-thumbnail">
				<?php
				$attachment_full_image = '';
				$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
				$attachment_full_image = $attachment_image[0];
				if ($crop_image == 1) {
					$image_resize = mr_image_resize($attachment_image[0], $width_image, $height_image, true, false);
					echo '<img class="cropped" src="' . esc_url($image_resize) . '" alt="">';
				} else {
					echo get_the_post_thumbnail(get_the_ID());
				}
				?>
				<div class="donation-overlay">
					<?php if($show_progress_bar) { ?>
						<div class="donation-progress-bar">
							<div class="donation-bar">
								<span style="width: <?php echo esc_attr($width);?>%;"></span>
							</div>
							<div class="donation-label"><?php echo $width.'%' ?></div>
						</div>
					<?php } ?>
					<?php if($show_donation_money) { ?>
						<div class="donation-money">
							<?php
							if($symbol_position != 1) {
								$raised_item = $symbol.number_format($result['raised']);
								$goal_item = $symbol.number_format($goal);
							} else {
								$raised_item = number_format($result['raised']).$symbol;	
								$goal_item = number_format($goal).$symbol;
							}
							echo '<span class="raised">'.$raised_item.'</span>'.__(' Raised of ', 'bearsthemes').'<span class="goal">'.$goal_item.'</span>'.__(' Goal', 'bearsthemes');
							?>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
		<div class="donation-content">
			<?php if($show_title) { ?>
				<h3 class="donation-title bt-text-ellipsis">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
			<?php } ?>
			<?php if($show_meta) { ?>
				<ul class="donate-meta">
					<li class="bt-author"><?php echo '<i class="fa fa-user"></i>'.__('By ', 'bearsthemes').'<span>'.get_the_author().'</span>'; ?></li>
					<li class="bt-location"><?php echo '<i class="fa fa-map-marker"></i>'.__('Cause in ', 'bearsthemes').'<span>'.get_post_meta(get_the_ID(), 'tbdonations_location', true).'</span>'; ?></li>
				</ul>
			<?php } ?>
			<a class="donate-now-btn" href="<?php the_permalink(); ?>"><i class="fa fa-heart"></i> <?php echo '<span>'.$view_detail_text.'</span>'; ?></a>
		</div>
	</div>
</article>