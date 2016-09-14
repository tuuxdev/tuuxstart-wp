<?php get_header(); ?>
<main class="st-main" role="main">
	<?php if (have_posts()) : ?>
	<header class="search-head">
		<h1>Search Results For "<?php echo esc_html( get_search_query( false ) ); ?>"</h1>
	</header>
	<?php while (have_posts()) : the_post(); ?>
	<article <?php post_class( 'search-item' ); ?> id="post-
		<?php the_ID(); ?>">
		<header>
			<h2>
				<a href="<?php the_permalink() ?>">
					<?php the_title(); ?>
				</a>
			</h2>
			<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
		</header>
		<div class="excerpt">
			<?php the_excerpt(); ?>
		</div>
	</article>
	<?php endwhile; ?>
	<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>
	<?php else : ?>
	<header class="search-head">
		<h1>No posts found for "<?php echo esc_html( get_search_query( false ) ); ?>"</h1>
	</header>
	<?php endif; ?>
	<?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>
