<?php
$bearstheme_options = $GLOBALS['bearstheme_options'];

# gallery
$gallery_ids = explode( ',', get_post_meta( get_the_ID(), 'bt_post_gallery', true ) );
if( has_post_thumbnail( get_the_ID() ) ) array_push( $gallery_ids, get_post_thumbnail_id( get_the_ID() ) );

# gallery Html
$gallery_html = bearsthemes_renderCarouselByAttachmentId( $gallery_ids, 'full' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="bears-blog-item blog-temp-blog2 blog-format-<?php echo esc_attr( basename( __FILE__, '.php' ) ); ?>">
		<div class="blog-inner">
			<?php // if (has_post_thumbnail()) the_post_thumbnail( 'bearstheme_custom_blog_single_size' ); ?>
			<div class="gallery-meta">
				<?php echo "{$gallery_html}"; ?>
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
