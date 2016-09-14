<?php get_header(); ?>
<main class="st-main" role="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<article <?php post_class('st-single'); ?> id="post-<?php the_ID(); ?>">
		<header>
			<h1>
				<?php the_title(); ?>
			</h1>
			<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
			<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
		</header>
		<div class="content">
			<?php the_content(); ?>
		</div>
		<nav>
			<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
		</nav>
	</article>
	<?php comments_template(); ?>
	<?php endwhile; endif; ?>
	<?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>
