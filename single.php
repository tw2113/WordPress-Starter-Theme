<?php get_header(); ?>
<div class="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<?php previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'twentyten' ) . ' %title' ); ?>
				<?php next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '' ); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				    <header>
				    <h1><?php the_title(); ?></h1>
				    <?php wpst_posted_on(); ?>
				    </header>

				    <?php the_content(); ?>
				    <footer>
				    <?php wp_link_pages( array( 'before' => '' . 'Pages:', 'after' => '' ) ); ?>

				    <?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpst_author_bio_avatar_size', 60 ) ); ?>
					<h2><?php printf( 'About %s', get_the_author() ); ?></h2>
					<?php the_author_meta( 'description' ); ?>
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
					<?php printf( 'View all posts by %s &rarr;', get_the_author() ); ?>
					</a>
					<?php endif; ?>

					<?php wpst_posted_in(); ?>
					<?php edit_post_link( 'Edit', '', '' ); ?>
					<?php previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'twentyten' ) . ' %title' ); ?>
					<?php next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '' ); ?>
					</footer>
				<?php comments_template( '', true ); ?>
                </article>
<?php endwhile; // end of the loop. ?>

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>