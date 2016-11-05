<?php
/*
Template Name: Demo Template
*/
?>
<?php get_header('demo'); ?>
	<div class="main-content">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>
			
		<?php endwhile; // end of the loop. ?>
	</div>
<?php get_footer('demo'); ?>