<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<?php next_posts_link( '&larr; Older posts' ); ?>
		<?php previous_posts_link( 'Newer posts &rarr;' ); ?>
<?php endif; ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
		<article role="article">
		<h1>Not Found</h1>
		<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
		<?php get_search_form(); ?>
		</article>
<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php /* How to display posts in the Gallery category. */ ?>

	<?php if ( ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) || in_category( _x( 'gallery', 'gallery category slug', 'twentyten' ) ) ) : ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
		    <header>
			<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<div class="datemeta"><?php the_date(); ?></div>
			<?php twentyten_posted_on(); ?>
			</header>

		<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
		<?php else : ?>
		<?php
			$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
			if ( $images ) :
			$total_images = count( $images );
			$image = array_shift( $images );
			$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
		?>
		<a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>

		<p><?php printf( 'This gallery contains <a %1$s>%2$s photos</a>.', 'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"', number_format_i18n( $total_images ) ); ?></p>
		<?php endif; ?>
		<?php the_excerpt(); ?>
		<?php endif; ?>
			<footer>
			<?php if ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) : ?>
    		<a href="<?php echo get_post_format_link( 'gallery' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'twentyten' ); ?>">More Galleries</a> |

		    <?php elseif ( in_category( _x( 'gallery', 'gallery category slug', 'twentyten' ) ) ) : ?>
		    <a href="<?php echo get_term_link( _x( 'gallery', 'gallery category slug', 'twentyten' ), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'twentyten' ); ?>">More Galleries</a> |
			<?php endif; ?>
		    <?php comments_popup_link( 'Leave a comment', '1 Comment', '% Comments' ); ?>
		<?php edit_post_link( 'Edit', '|', '' ); ?>
			</footer>
		</article>
<?php /* How to display posts of the Aside format. The asides category is the old way. */ ?>
    <?php elseif ( ( function_exists( 'get_post_format' ) && 'aside' == get_post_format( $post->ID ) ) || in_category( _x( 'asides', 'asides category slug', 'twentyten' ) )  ) : ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

	    <?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
			<?php the_excerpt(); ?>
		<?php else : ?>
			<?php the_content( 'Continue reading &rarr;' ); ?>
		<?php endif; ?>
			<footer>
			    <time="<?php echo get_the_date('Y-m-d'); ?>" pubdate><?php the_date(); ?></time>
				<?php twentyten_posted_on(); ?>
				|
				<?php comments_popup_link( 'Leave a comment', '1 Comment', '% Comments' ); ?>
				<?php edit_post_link( 'Edit', '| ', '' ); ?>
			</footer>
		</article>
<?php /* How to display all other posts. */ ?>

	<?php else : ?>
		<article role="article" <?php post_class(); ?>>
			<header>
			<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<time="<?php echo get_the_date('Y-m-d'); ?>" pubdate><?php the_date(); ?></time>
			<?php twentyten_posted_on(); ?>
			</header>
	<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
			<?php the_excerpt(); ?>
	<?php else : ?>
			<?php the_content( 'Continue reading &rarr;' ); ?>
			<?php wp_link_pages( array( 'before' => '' . 'Pages:', 'after' => '' ) ); ?>
	<?php endif; ?>
				<footer>
				<?php if ( count( get_the_category() ) ) : ?>
					<?php printf( 'Posted in %2$s', 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?> |
				<?php endif; ?>
				<?php
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ):
				?>
					<?php printf( 'Tagged %2$s', 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?> |
				<?php endif; ?>
				<?php comments_popup_link( 'Leave a comment', '1 Comment', '% Comments' ); ?>
				<?php edit_post_link( 'Edit', '| ', '' ); ?>

				<?php comments_template( '', true ); ?>
				</footer>
		</article>

	<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<?php next_posts_link( '&larr; Older posts' ); ?>
				<?php previous_posts_link( 'Newer posts &rarr;' ); ?>
<?php endif; ?>
