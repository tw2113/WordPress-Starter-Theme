<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header>
		<?php if ( is_front_page() ) { ?>
		<h2><?php the_title(); ?></h2>
		<?php } else { ?>
		<h1><?php the_title(); ?></h1>
		<?php } ?>
		</header><!--End Header_page-->

		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '' . 'Pages:', 'after' => '' ) ); ?>
		<?php edit_post_link( 'Edit', '', '' ); ?>
	</article>
<?php endwhile; ?>