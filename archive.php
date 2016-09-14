<?php get_header(); ?>

<main class="st-main" role="main">
	<?php if (have_posts()) : ?>
	<header class="archive-head">
		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		<?php /* If this is a category archive */ if (is_category()) { ?>
		<h1>Archive for the &#8216;
			<?php single_cat_title(); ?>&#8217; Category</h1>
		<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h1>Posts Tagged &#8216;
			<?php single_tag_title(); ?>&#8217;</h1>
		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h1>Archive for
			<?php the_time('F jS, Y'); ?>
		</h1>
		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h1>Archive for
			<?php the_time('F, Y'); ?>
		</h1>
		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h1>Archive for
			<?php the_time('Y'); ?>
		</h1>
		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h1>Author Archive</h1>
		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h1>Blog Archives</h1>
		<?php } ?>
	</header>

	<?php while (have_posts()) : the_post(); ?>
	<article <?php post_class( 'archive-item' ); ?> id="post-
		<?php the_ID(); ?>">
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
		<h1>Nothing found</h1>
	</header>
</main>
<?php endif; ?>

<?php get_footer(); ?>
