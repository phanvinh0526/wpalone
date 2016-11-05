<?php get_header(); ?>
<?php
$bearstheme_options = $GLOBALS['bearstheme_options'];
$tb_show_page_title = isset($bearstheme_options['tb_post_show_page_title']) ? $bearstheme_options['tb_post_show_page_title'] : 1;
$tb_show_page_breadcrumb = isset($bearstheme_options['tb_post_show_page_breadcrumb']) ? $bearstheme_options['tb_post_show_page_breadcrumb'] : 1;
$tb_post_show_post_nav = (int) isset($bearstheme_options['tb_post_show_post_nav']) ?  $bearstheme_options['tb_post_show_post_nav']: 1;
bearstheme_title_bar($tb_show_page_title, $tb_show_page_breadcrumb, $tb_post_show_post_nav);

$currency = apply_filters('tb_currency', TBDonationsPageSetting::$currency);
$tb_currency = get_option('tb_currency', 'USD');
$symbol_position = get_option('symbol_position', 0);
$symbol = $currency[$tb_currency]['symbol'];
$result = apply_filters('tb_getmetadonors', get_the_ID());
$goal = get_post_meta(get_the_ID(),'tbdonations_goals',true);
$tbdonations_location = get_post_meta(get_the_ID(), 'tbdonations_location', true);
$start_date = get_the_date('Y/m/d H:s', get_the_ID());
$end_date = get_post_meta(get_the_ID(),'tbdonations_endday',true);
$days_left = round((strtotime($end_date) - strtotime($start_date))/86400);
$width = '100';
if($result['raised'] < $goal){
	$width = round($result['raised']*100/$goal, 2);
}

?>
	<div class="main-content bt-donation-article">
		<div class="row">
			<div class="container">
				<!-- Start Content -->
				<div class="col-md-9 content bt-donation">
					<?php
					while ( have_posts() ) : the_post();
						$donation_id = get_the_ID();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="bt-donation-item">
								<div class="bt-header">
								<?php if (has_post_thumbnail()) the_post_thumbnail('bearstheme_custom_blog_single_size'); ?>
									<div class="bt-header-inner">
										<ul class="bt-meta">
											<li class="bt-author"><?php echo '<i class="fa fa-user"></i>'.__('By ', 'bearsthemes').'<span>'.get_the_author().'</span>'; ?></li>
											<li class="bt-location"><?php echo '<i class="fa fa-map-marker"></i>'.__('Cause in ', 'bearsthemes').'<span>'.$tbdonations_location.'</span>'; ?></li>
										</ul>
										<h3 class="bt-title"><?php the_title(); ?></h3>
										<div class="donate-meta">
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
											<?php echo do_shortcode('[tbdonations_form donation_id='.get_the_ID().' label_btn="'.__('Donate Now', 'bearsthemes').'" ]'); ?>
										</div>
										<div class="donation-progress-bar">
											<div class="donation-bar">
												<span style="width: <?php echo esc_attr($width);?>%;"></span>
											</div>
											<div class="donation-label"><?php echo $width.'%' ?></div>
										</div>
									</div>
								</div>
								<div class="bt-content">
									<?php the_content(); ?>
								</div>
							</div>
						</article>
						<?php 
					endwhile;
					?>
					<?php 
						$donaers = $wpdb->get_results( "
							SELECT p.user_id, p.firstname, p.lastname, p.amount 
							FROM wp_tbdonations_payment as p
							INNER JOIN wp_users as u ON p.user_id = u.ID
							WHERE donations_id = $donation_id AND p.paid = 1 
							ORDER BY p.id DESC LIMIT 3" 
						);
					?>
					<div class="bt-donaers-wrap">
						<div class="bt-donaers">
							<h6 class="bt-subtitle"><?php _e('HELP THE HOMELESS PEOPLE', 'bearsthemes') ?></h6>
							<h3 class="bt-title"><?php _e('DONAERS OF THIS CAUSE', 'bearsthemes') ?></h3>
							<ul class="bt-donaers-list">
								<?php foreach($donaers as $donaer) { ?>
									<li>
										<div class="bt-thumb"><?php echo get_avatar( $donaer->user_id, 89 ); ?></div>
										<h5 class="bt-name"><?php echo $donaer->firstname.' '.$donaer->lastname; ?></h5>
										<span class="bt-meta"><?php _e('Historian', 'bearsthemes'); ?></span>
										<h6 class="bt-donated"><?php _e('Donated: $', 'bearsthemes'); echo number_format($donaer->amount); ?></h6>
									</li>
								<?php } ?>
								<li class="bt-view-all">
									<a href="#" class="bt-btn-bd-main bt-view-all">VIEW ALL DONAERS</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- End Content -->
				<!-- Start Right Sidebar -->
				<div class="col-md-3 sidebar-right">
					<?php if (is_active_sidebar('bearstheme-main-sidebar')) { dynamic_sidebar('bearstheme-main-sidebar'); } ?>
				</div>
				<!-- End Right Sidebar -->
			</div>
		</div>
	</div>
<?php get_footer(); ?>