<?php get_header(); ?>
<div class="content" role="main">
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<article role="article" <?php post_class(); ?>>
			<header>
			<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<time="<?php echo get_the_date('Y-m-d'); ?>" pubdate><?php the_date(); ?></time>
			<?php wpst_posted_on(); ?>
			</header>

			<?php the_content(); ?>

		</article>
		<?php endwhile; endif; ?>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
