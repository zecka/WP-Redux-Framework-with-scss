<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php wp_head(); ?>
</head>
<body>
<?php global $rwss_options; ?>
<?php if(!$rwss_options['hide-header']){ ?>
	<header>
		MY HEADER
	</header>
	
<?php } // endif hide header ?>