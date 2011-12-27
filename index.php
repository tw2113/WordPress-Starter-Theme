<?php get_header(); ?>
<div class="content" role="main">
	<?php /* Run the loop to output the posts. If you want to overload this in a child theme then include a file called loop-index.php and that will be used instead. */
		 get_template_part( 'loop', 'index' );
	?>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>