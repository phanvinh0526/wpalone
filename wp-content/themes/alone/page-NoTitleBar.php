<?php
/*
Template Name: No Title Bar Template
*/
?>
<?php get_header(); ?>
<?php
$bearstheme_options = $GLOBALS['bearstheme_options'];
$tb_show_page_comment = (int) isset($bearstheme_options['page_comment']) ?  $bearstheme_options['page_comment']: 1;
?>
	<div class="main-content">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>
			
			<?php if($tb_show_page_comment){ ?>
				<div class="container">
					<?php if ( comments_open() || get_comments_number() ) comments_template(); ?>
				</div>
			<?php } ?>
			
		<?php endwhile; // end of the loop. ?>
	</div>
<?php get_footer(); ?>