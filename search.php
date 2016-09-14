<?php get_header(); ?>
<main id="search" class="site-main" role="main">
	<?php if (have_posts()) : ?>
	<h1>Search Results For "<?php echo esc_html( get_search_query( false ) ); ?>"</h1>
	<?php while (have_posts()) : the_post(); ?>
	<article class="search-element" id="post-<?php the_ID(); ?>">
		<header>
			<h2>
				<a href="<?php the_permalink() ?>">
					<?php the_title(); ?>
				</a>
			</h2>
			<div>
				<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
			</div>
		</header>
		<div class="excerpt">
			<?php the_excerpt(); ?>
		</div>
	</article>
	<?php endwhile; ?>
	<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>
	<?php else : ?>
	<h1>No posts found for "<?php echo esc_html( get_search_query( false ) ); ?>"</h1>
	<?php endif; ?>
	<?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>
