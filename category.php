<?php get_header(); ?>
<div class="content" role="main">
    <h1><?php printf( 'Category Archives: %s', '' . single_cat_title( '', false ) . '' ); ?></h1>
        <?php
            $category_description = category_description();
			if ( ! empty( $category_description ) )	echo '' . $category_description . '';
			
			/* Run the loop for the category page to output the posts. If you want to overload this in a child theme then include a file called loop-category.php and that will be used instead. */
			get_template_part( 'loop', 'category' );
		?>

<?php get_sidebar(); ?>
</div><!--End Content-->
<?php get_footer(); ?>
