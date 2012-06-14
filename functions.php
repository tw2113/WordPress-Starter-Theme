<?php
/** This entire theme is based on TwentyTen from WordPress 3.1. Edited as I saw fit ****/
add_action('after_setup_theme', 'wpst_setup');
function wpst_setup() {
    // Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories. More info at http://codex.wordpress.org/Post_Formats
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'gallery', 'quote', 'link', 'image', 'status', 'chat', 'video' ) );
	add_theme_support( 'post-thumbnails' ); // This theme uses Featured Images
	add_theme_support( 'automatic-feed-links' ); // Add default posts and comments RSS feed links to <head>

	// This theme uses wp_nav_menu() in one location. Add more as needed
	register_nav_menus( array( 'primary' => 'Primary Navigation' ) );
}
add_action('comment_form_before', 'wpst_comment_enqueue');
function wpst_comment_enqueue() {
	if(get_option( 'thread_comments' )) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/*Register and enqueue javascript/styles*/
add_action('wp_enqueue_scripts', 'wpst_load_scripts');
function wpst_load_scripts() {
	if(is_admin()) return;
	wp_enqueue_script('jquery'); //can remove once you have another script that depends on jquery. Dependency auto-loads jquery in that case.
	//wp_enqueue_script('cycle', get_stylesheet_directory_uri().'/js/jquery.cycle.all.min.js', array('jquery'));
	//wp_enqueue_script('mailcheck', get_stylesheet_directory_uri().'/js/jquery.mailcheck.min.js', array('jquery'));
}

/** Post comments/excerpts alterations. *****************************/
/** Sets the post excerpt length to 40 characters. */
function wpst_excerpt_length( $length ) { return 40; }
add_filter( 'excerpt_length', 'wpst_excerpt_length' );

/** Returns a "Continue Reading" link for excerpts. */
function wpst_continue_reading_link() {
	return '<a href="'. get_permalink() . '"> Continue reading <span class="meta-nav">&rarr;</span></a>'; }
/** Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and wpst_continue_reading_link(). */
function wpst_auto_excerpt_more( $more ) {
	return ' &hellip;' . wpst_continue_reading_link();
}
add_filter( 'excerpt_more', 'wpst_auto_excerpt_more' );
/** Adds a pretty "Continue Reading" link to custom post excerpts. */
function wpst_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= wpst_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'wpst_custom_excerpt_more' );

/** Template for comments and pingbacks. */
function wpst_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' : ?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyeleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'twentyeleven' ), ' ' ); ?></p>
	<?php
			break;
		default : ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'twentyeleven' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'twentyeleven' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( '[Edit]', 'twentyeleven' ), ' ' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyeleven' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply &darr;', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
/** END Post comments/excerpts alterations. *****************************/

/* Get wp_nav_menu() fallback, wp_page_menu(), to show home link. */
function wpst_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'wpst_page_menu_args' );
/** Remove inline styles printed when the gallery shortcode is used. */
function wpst_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'wpst_remove_gallery_css' );

/** Prints HTML with meta information for the current post—date/time and author. */
function wpst_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'twentyeleven' ), get_the_author() ),
		esc_html( get_the_author() )
	);
}
/** Prints HTML with meta information for the current post (category, tags and permalink). */
function wpst_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	} else {
		$posted_in = 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}

// browser detection via body_class
function wpst_browser_body_class($classes) {
    //WordPress global vars available.
    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

    if($is_lynx)       $classes[] = 'lynx';
    elseif($is_gecko)  $classes[] = 'firefox';
    elseif($is_opera)  $classes[] = 'opera';
    elseif($is_NS4)    $classes[] = 'ns4';
    elseif($is_safari) $classes[] = 'safari';
    elseif($is_chrome) $classes[] = 'chrome';
    elseif($is_IE)     $classes[] = 'ie';
    else               $classes[] = 'unknown';

    if($is_iphone) $classes[] = 'iphone';

    //Adds a class of singular too when appropriate
    if ( is_singular() && ! is_home() ) $classes[] = 'singular';

    return $classes;
}
add_filter('body_class','wpst_browser_body_class');

// Post numbering via post_class
function wpst_add_post_classes( $classes ) {
	global $wp_query;

	if( $wp_query->found_posts < 1 ) return $classes;
	if( $wp_query->current_post == 0 ) $classes[] = 'post-first';

	if( $wp_query->current_post % 2 ) {
		$classes[] = 'post-even';
	} else {
		$classes[] = 'post-odd';
	}
	if( $wp_query->current_post == ( $wp_query->post_count - 1 ) ) $classes[] = 'post-last';

	return $classes;
}
add_filter( 'post_class', 'wpst_add_post_classes' );

/*	Checks to see if we should blame nacin
	@return bool true if we should blame nacin, false if we shouldn't */
function maybe_blame_nacin(){
    return true;
}

//Apply do_shortcode() to widgets so that shortcodes will be executed in widgets
add_filter('widget_text', 'do_shortcode');

// REMOVE THE WORDPRESS UPDATE NOTIFICATION FOR ALL USERS EXCEPT SYSADMIN
global $user_login;
get_currentuserinfo();
if (!current_user_can('update_plugins')) { // checks to see if current user can update plugins
	add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
	add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
}

//Adds Attachment ID to Media Library admin columns
add_filter('manage_media_columns', 'posts_columns_attachment_id', 1);
add_action('manage_media_custom_column', 'posts_custom_columns_attachment_id', 1, 2);
function posts_columns_attachment_id($defaults){
    $defaults['wps_post_attachments_id'] = __('ID');
    return $defaults;
}
function posts_custom_columns_attachment_id($column_name, $id){
	if($column_name === 'wps_post_attachments_id'){
	echo $id;
    }
}

//Add Plugins link to Admin Bar
function add_wpst_admin_bar_link($wp_admin_bar) {
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;
	$wp_admin_bar->add_node( array(
	'parent' => 'site-name',
	'id' => 'ab-plugins',
	'title' => 'Plugins',
	'href' => admin_url('plugins.php')
	) );
}
add_action('admin_bar_menu', 'add_wpst_admin_bar_link', 35);

// Admin Notice on Posts Page
//add_action('admin_head-post.php', 'us2011_postspage_error_notice');
function us2011_postspage_error_notice() {
    $postspage = get_option('page_for_posts');
    if (!empty($postspage))
        add_action('admin_notices', 'us2011_postspage_print_notices');
}
function us2011_postspage_print_notices() {
    $postspage = get_option('page_for_posts');
    // show this only if we're editing the posts page
    if (!empty($postspage) && isset($_GET['action']) && $_GET['action'] == 'edit' && $_GET['post'] == $postspage)
        echo '<div class="error"><p>This page is a container for the most recent posts. It should always be empty, and you should never edit this page. To add a news item, go to <a href="post-new.php">Posts -- Add New</a>.<p></div>';
}
// function for inserting Google Analytics into the wp_footer
add_action('wp_footer', 'ga');
function ga() {
	if ( !is_user_logged_in() ) { // not for logged in users ?>

	<script type="text/javascript">
		var _gaq = _gaq || [];
	  	_gaq.push(['_setAccount', 'UA-XXXXXXXX']); // insert your Google Analytics id here
	  	_gaq.push(['_trackPageview']);
	  	_gaq.push(['_trackPageLoadTime']);
	  	(function() {
	    	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  	})();
	</script>

	<?php
	}
}

/* Automatically add first image attached to a post as the featured image if post doesn't have a featured image already */
//Borrowed from https://github.com/rachelbaker/bootstrapwp-Twitter-Bootstrap-for-WordPress
function wpst_autoset_featured_img() {
	global $post;
	$already_has_thumb = has_post_thumbnail($post->ID);
	if (!$already_has_thumb) {
		$attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
		if ($attached_image) {
			foreach ($attached_image as $attachment_id => $attachment) {
				set_post_thumbnail($post->ID, $attachment_id);
			}
		}
	}
}
add_action('the_post', 'wpst_autoset_featured_img');
add_action('save_post', 'wpst_autoset_featured_img');
add_action('draft_to_publish', 'wpst_autoset_featured_img');
add_action('new_to_publish', 'wpst_autoset_featured_img');
add_action('pending_to_publish', 'wpst_autoset_featured_img');
add_action('future_to_publish', 'wpst_autoset_featured_img');

// Includes the widgets.php file that defines all widget based functions.
require_once( get_template_directory() . '/widgets.php' );
require_once( get_template_directory() . '/inc/theme-options.php' );
require_once( get_template_directory() . '/inc/admin_appearance_mods.php' );

/* Example theme options usage:
$options = get_option('wpst_theme_options');
echo $option['twitter'];
*/
