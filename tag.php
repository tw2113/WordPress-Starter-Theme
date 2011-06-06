<?php get_header(); ?>
<div class="content" role="main">
	<h1><?php printf( 'Tag Archives: %s', '' . single_tag_title( '', false ) . '' ); ?></h1>

<?php
    /* Run the loop for the tag archive to output the posts. If you want to overload this in a child theme then include a file called loop-tag.php and that will be used instead. */
    get_template_part( 'loop', 'tag' );
?>

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
