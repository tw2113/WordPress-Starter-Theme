<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js ie6 lte8 lte7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="no-js ie7 lte8 lte7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="no-js ie8 lte8" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE)]><html class="no-js" <?php language_attributes(); ?>><![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title( '|', true, 'right' ); ?></title><!--filtered in functions.php -->

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="profile" href="http://microformats.org/profile/hcard" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<script src="<?php bloginfo('template_url'); ?>/js/modernizr.custom.js"></script>
<!--[if (gte IE 6)&(lte IE 8)]>
	<script type="text/javascript" src="<?php bloginfo( 'template_url'); ?>/js/selectivizr.js"></script>
	<![endif]--><!--Select-ivizr JS library for CSS3 selectors, DD-PNG fix for IE6-8-->

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<!--Extra Stylesheets go below-->

<?php 
	if(!is_admin()) {
	wp_deregister_script('jquery');
	wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"), false); //Gets put in wp_footer
	wp_enqueue_script('jquery');
	}
?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="container">
	<header role="banner">
	<h1>
		<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
	</h1>
	<p><?php bloginfo( 'description' ); ?></p>

	<nav id="access" role="navigation">
		<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
	</nav>
	</header>
