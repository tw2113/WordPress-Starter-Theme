<?php
/**
 * The loop that displays an attachment.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <?php if ( ! empty( $post->post_parent ) ) : ?>
        <p><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php esc_attr( printf( 'Return to %s', get_the_title( $post->post_parent ) ) ); ?>" rel="gallery">
            <?php /* translators: %s - title of parent post */
                printf( '<span>&larr;</span> %s', get_the_title( $post->post_parent ) );
            ?>
        </a></p>
    <?php endif; ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<h2><?php the_title(); ?></h2>
		    <?php printf( 'By %2$s', 'meta-prep meta-prep-author',
		            sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
		                get_author_posts_url( get_the_author_meta( 'ID' ) ),
		                	sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
		                	    get_the_author()
		            )
		          );
		    ?>
		    <span>|</span>
		    <?php printf( 'Published %2$s', 'meta-prep meta-prep-entry-date',
		            sprintf( '<abbr title="%1$s">%2$s</abbr>',
		                esc_attr( get_the_time() ),
		                    get_the_date()
		            )
		          );
		    if ( wp_attachment_is_image() ) {
		        echo ' | ';
		        $metadata = wp_get_attachment_metadata();
		        printf( 'Full size is %s pixels',
		            sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
		                wp_get_attachment_url(),
		                esc_attr( 'Link to full-size image' ),
		                    $metadata['width'],
		                    $metadata['height']
					)
				);
			} ?>
			<?php edit_post_link( 'Edit', '', '' ); ?>
			<?php if ( wp_attachment_is_image() ) :
			    $attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
			foreach ( $attachments as $k => $attachment ) {
			    if ( $attachment->ID == $post->ID ) break;
			}
	        $k++;
	        // If there is more than 1 image attachment in a gallery
        	if ( count( $attachments ) > 1 ) {
        	    if ( isset( $attachments[ $k ] ) )
        	    // get the URL of the next image attachment
        	    $next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
        	    else
        	    // or get the URL of the first image attachment
        	    $next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
        	} else {
        	    // or, if there's only 1 image attachment, get the URL of the image
        	    $next_attachment_url = wp_get_attachment_url();
        	}
            ?>
			<p><a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment">
			<?php
			    $attachment_width  = apply_filters( 'twentyten_attachment_size', 900 );
				$attachment_height = apply_filters( 'twentyten_attachment_height', 900 );
				echo wp_get_attachment_image( $post->ID, array( $attachment_width, $attachment_height ) ); // filterable image width with, essentially, no limit for image height.
			?>
			</a></p>

			<?php previous_image_link( false ); ?>
			<?php next_image_link( false ); ?>
<?php else : ?>
			<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
    <?php endif; ?>
        <?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?>
        <?php the_content( 'Continue reading &rarr;' ); ?>
        <?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
        <?php twentyten_posted_in(); ?>
		<?php edit_post_link( 'Edit', ' ', '' ); ?>
		<?php comments_template(); ?>
    </div>
<?php endwhile; // end of the loop. ?>
