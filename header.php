<!doctype html>
<!--[if lte IE 8]><html class="no-js ie7 lte8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="no-js ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]><html class="no-js ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE)]><html class="no-js" <?php language_attributes(); ?>><![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title>
<?php global $page, $paged;
	wp_title( '|', true, 'right' );
	// Add the blog name.
	bloginfo( 'name' );
	$site_desc = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
?>
</title>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/css/normalize.css" media="all" />
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" media="all" />
<script src="<?php echo get_template_directory_uri(); ?>/js/prefixfree.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.custom.js"></script>
<!--[if (gte IE 6)&(lte IE 8)]>
<script src="<?php echo get_template_directory_uri(); ?>/js/selectivizr.js"></script>
<![endif]--><!--Select-ivizr JS library for CSS3 selectors, DD-PNG fix for IE6-8-->

<?php wp_head(); ?>
<!--
// html5 Prefetch. Set the url to what page you want to automatically prefetch.
Moz/Chrome 13+ (with alt syntax): Supported
O/Saf/IE/: Not supported
<link rel="prefetch" href="http://www.example.com/">-->
</head>

<body <?php body_class(); ?>>
	<div id="container">
	<header id="branding" role="banner">
	<h1>
		<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
	</h1>
	<p><?php bloginfo( 'description' ); ?></p>

	<nav id="access" role="navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '' ) ); ?>
	</nav>
	</header>