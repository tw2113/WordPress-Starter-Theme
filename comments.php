<?php if ( post_password_required() ) : ?>
				<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'twentyten' ); ?></p>
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
			<!-- STARKERS NOTE: The following h3 id is left intact so that comments can be referenced on the page -->
			<h3 id="comments-title"><?php
			printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'twentyten' ),
			number_format_i18n( get_comments_number() ), '' . get_the_title() . '' );
			?></h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<?php previous_comments_link( __( '&larr; Older Comments', 'twentyten' ) ); ?>
				<?php next_comments_link( __( 'Newer Comments &rarr;', 'twentyten' ) ); ?>
<?php endif; // check for comment navigation ?>

			<ol>
				<?php wp_list_comments( array( 'callback' => 'twentyten_comment' ) ); ?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<?php previous_comments_link( __( '&larr; Older Comments', 'twentyten' ) ); ?>
				<?php next_comments_link( __( 'Newer Comments &rarr;', 'twentyten' ) ); ?>
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p><?php _e( 'Comments are closed.', 'twentyten' ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php comment_form(
	array(
	    'comment_notes_after' => '',
		'fields' => array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<br/><input id="author" name="author" type="text" placeholder="Your name please" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required /></p>',
		'email' => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<br/><input id="email" name="email" type="email" placeholder="Your email please" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" required /></p>',
		'url' => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' . '<br/><input id="url" name="url" type="url" placeholder="Do you have a website you\' like to include?" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
		),
		'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br/><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="What would you like to say?"></textarea></p>'
	)
); ?>
