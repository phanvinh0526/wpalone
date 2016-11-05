<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class() ?>>
	<?php echo do_shortcode( '[btwg_menu_off_canvas_container]' ) ?>
	<div id="bt-main"> 
		<?php bearstheme_Header(); ?>
