<?php get_header(); ?>
<div class="content" role="main">
<?php
	/* Run the loop to output the post. If you want to overload this in a child theme then include a file called loop-single.php and that will be used instead. */
	get_template_part( 'loop', 'single' );
?>

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
