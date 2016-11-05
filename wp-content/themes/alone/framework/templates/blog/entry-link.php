<?php
$bearstheme_options = $GLOBALS['bearstheme_options'];
$tb_blog_show_post_image = (int) isset($bearstheme_options['tb_blog_show_post_image']) ? $bearstheme_options['tb_blog_show_post_image'] : 1;
$tb_blog_show_post_title = (int) isset($bearstheme_options['tb_blog_show_post_title']) ? $bearstheme_options['tb_blog_show_post_title'] : 1;
$tb_blog_show_post_meta = (int) isset($bearstheme_options['tb_blog_show_post_meta']) ? $bearstheme_options['tb_blog_show_post_meta'] : 1;
$tb_blog_show_post_excerpt = (int) isset($bearstheme_options['tb_blog_show_post_excerpt']) ? $bearstheme_options['tb_blog_show_post_excerpt'] : 1;
$tb_blog_post_readmore_text = (int) isset($bearstheme_options['tb_blog_post_readmore_text']) ? $bearstheme_options['tb_blog_post_readmore_text'] : 1;
$link = get_post_meta(get_the_ID(), 'tb_post_link', true);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="ro-blog-sub-article">
		<?php if ( has_post_thumbnail() && $tb_blog_show_post_image ) { ?>
			<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('full'); ?></a>
		<?php } ?>
		<?php if($link && !is_home()){ ?>
			<div class="wp-post-media"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html( $link ); ?></a></div>
		<?php } ?>
		<?php if ( $tb_blog_show_post_title ) { ?>
			<h5><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
		<?php } ?>
		<?php if ( $tb_blog_show_post_meta ) { ?>
			<div class="ro-blog-meta">
				<?php if ( is_sticky() ) { ?>
					<span class="publish"><?php _e('<i class="fa fa-thumb-tack"></i> Sticky', 'bearsthemes'); ?></span>
				<?php } ?>
				<span class="publish"><?php _e('<i class="fa fa-clock-o"></i> ', 'bearsthemes'); echo get_the_date(); ?></span>
				<span class="author"><?php _e('<i class="fa fa-user"></i> ', 'bearsthemes'); echo get_the_author(); ?></span>
				<span class="categories"><?php the_terms(get_the_ID(), 'category', __('<i class="fa fa-folder-open"></i> ', 'bearsthemes') , ', ' ); ?></span>
				<span class="tags"><?php the_tags( __('<i class="fa fa-tags"></i> ', 'bearsthemes'), ', ', '' ); ?> </span>
			</div>
		<?php } ?>
		<?php if ( $tb_blog_show_post_excerpt ) { ?> 
			<div class="ro-sub-content clearfix"><?php the_excerpt(); ?></div>
		<?php } ?>
		<?php if ( $tb_blog_post_readmore_text ) { ?>
			<a class="ro-btn ro-btn-2" href="<?php the_permalink() ?>"><?php echo esc_html( $tb_blog_post_readmore_text ); ?></a>
		<?php } ?>
	</div>
</article>
