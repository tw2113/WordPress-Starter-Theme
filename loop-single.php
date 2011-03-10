<?php
/**
 * The loop that displays a single post.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<?php previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'twentyten' ) . ' %title' ); ?>
				<?php next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '' ); ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				    <header>
				    <h1><?php the_title(); ?></h1>
				    <?php twentyten_posted_on(); ?>
				    </header>
				
				    <?php the_content(); ?>
				    <footer>
				    <?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
				    
				    <?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?>
					<h2><?php printf( esc_attr__( 'About %s', 'twentyten' ), get_the_author() ); ?></h2>
					<?php the_author_meta( 'description' ); ?>
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
					<?php printf( __( 'View all posts by %s &rarr;', 'twentyten' ), get_the_author() ); ?>
					</a>
					<?php endif; ?>

					<?php twentyten_posted_in(); ?>
					<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
					<?php previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'twentyten' ) . ' %title' ); ?>
					<?php next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '' ); ?>
					</footer>
				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>
