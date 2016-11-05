<?php
$bearstheme_options = $GLOBALS['bearstheme_options'];

# audio
$video_data = get_post_meta( get_the_ID(), 'tb_post_video_vimeo', true );
$video_type = get_post_meta( get_the_ID(), 'tb_post_video_source', true );
$video_height = get_post_meta( get_the_ID(), 'tb_post_video_height', true );

# audio Html
$video_html = bearsthemes_renderVideo( $video_data, $video_type );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="bears-blog-item blog-temp-blog2 blog-format-<?php echo esc_attr( basename( __FILE__, '.php' ) ); ?>">
		<div class="blog-inner">
			<div class="video-meta">
				<?php echo "{$video_html}"; ?>
			</div>
			<div class="info-meta">
				<div class="extra-meta">
					<div class="post-date">
						<!-- <i class="fa fa-list"></i>  -->
						<?php echo __( 'Created Date: ', 'bearsthemes' ) . get_the_date( 'F d, Y' ) ?>
					</div>
					<div class="post-author">
						<!-- <i class="fa fa-user"></i>  -->
						<?php echo __( 'Author: ', 'bearsthemes' ) .   get_the_author() ?>
					</div>
					<div class="post-cate">
						<!-- <i class="fa fa-folder"></i>  -->
					 	<?php echo __( 'Category: ', 'bearsthemes' ) .  get_the_category_list( ', ' ); ?>
					</div>
					<div class="post-count-comment">
						<!-- <i class="fa fa-comment"></i>  -->
						<?php echo __( 'Comment(s): ', 'bearsthemes' ) .  wp_count_comments( get_the_ID() )->total_comments; ?>
					</div>
				</div>
				<h3 class="title-meta"><?php the_title(); ?></h3>
				<div class="content-meta">
					<?php
						the_content();
						wp_link_pages(array(
							'before' => '<div class="page-links">' . __('Pages:', 'bearsthemes'),
							'after' => '</div>',
						));
					?>
				</div>
			</div>
		</div>
	</div>
</article>
