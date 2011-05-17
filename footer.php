<footer role="contentinfo">
			<small>&copy;<?php echo date('Y'); ?> <a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></small>
</footer>
</div><!--End Container-->
<?php 
if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if(!is_admin()) {
	wp_deregister_script('jquery');
	wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"), false, '1.6');
	wp_enqueue_script('jquery');
	}
?>
<?php wp_footer(); ?>
<!--[if lt IE 7 ]>
<script src="<?php bloginfo('template_url'); ?>/js/DD_belatedPNG_0.0.8a.js"></script>
	<script>
		DD_belatedPNG.fix('ENTER SELECTORS HERE');
	</script>
<![endif]-->

<!-- asynchronous google analytics: mathiasbynens.be/notes/async-analytics-snippet 
       change the UA-XXXXX-X to be your site's ID -->
  <script>
   var _gaq = [['_setAccount', 'UA-XXXXX-X'], ['_trackPageview']];
   (function(d, t) {
    var g = d.createElement(t),
        s = d.getElementsByTagName(t)[0];
    g.async = true;
    g.src = ('https:' == location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g, s);
   })(document, 'script');
  </script>
</body>
</html>
