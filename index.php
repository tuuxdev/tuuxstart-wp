<?php get_header(); ?>
<main id="home" class="site-main" role="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<article class="home-element" id="post-<?php the_ID(); ?>">
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
	<header>
		<h2>Nothing found</h2>
	</header>
	<?php endif; ?>
	<?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>
