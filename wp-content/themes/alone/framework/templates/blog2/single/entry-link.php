<?php
$bearstheme_options = $GLOBALS['bearstheme_options'];

# thumb url
$thumbnail_url = ( has_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium-large' )[0] : '';

# link
$link_data = get_post_meta( get_the_ID(), 'tb_post_link', true );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="bears-blog-item blog-temp-blog2 blog-format-<?php echo esc_attr( basename( __FILE__, '.php' ) ); ?>">
		<div class="blog-inner">
			<?php // if (has_post_thumbnail()) the_post_thumbnail( 'bearstheme_custom_blog_single_size' ); ?>
			<div class="header-meta" style="background: url(<?php echo esc_attr( $thumbnail_url ) ?>) no-repeat center center / cover, #fafafa;">
				<div class='link-meta'>
					<a href="<?php echo esc_attr( $link_data ); ?>"><?php echo "{$link_data}"; ?></a>
				</div>
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
