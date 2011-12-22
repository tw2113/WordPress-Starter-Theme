<?php get_header(); ?>
<div class="content" role="main">
<?php if ( have_posts() ) the_post(); ?>

		<h1>
			<?php if ( is_day() ) : ?>
				<?php printf( 'Daily Archives: %s', get_the_date() ); ?>
			<?php elseif ( is_month() ) : ?>
				<?php printf( 'Monthly Archives: %s', get_the_date('F Y') ); ?>
			<?php elseif ( is_year() ) : ?>
				<?php printf( 'Yearly Archives: %s', get_the_date('Y') ); ?>
			<?php else : ?>
				<?php echo 'Blog Archives'; ?>
			<?php endif; ?>
		</h1>

<?php
	/* Since we called the_post() above, we need to rewind the loop back to the beginning that way we can run the loop properly, in full. */
	rewind_posts();
	get_template_part( 'loop', 'archive' );
?>

<?php get_sidebar(); ?>
</div><!--End content-->
<?php get_footer(); ?>
