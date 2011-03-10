<?php get_header(); ?>
<div class="content" role="main">
<?php if ( have_posts() ) the_post(); ?>

		<h1>
			<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: %s', 'twentyten' ), get_the_date() ); ?>
			<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: %s', 'twentyten' ), get_the_date('F Y') ); ?>
			<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: %s', 'twentyten' ), get_the_date('Y') ); ?>
			<?php else : ?>
				<?php _e( 'Blog Archives', 'twentyten' ); ?>
			<?php endif; ?>
		</h1>

<?php
	/* Since we called the_post() above, we need to
	 * rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	rewind_posts();
	get_template_part( 'loop', 'archive' );
?>

<?php get_sidebar(); ?>
</div><!--End content-->
<?php get_footer(); ?>
