<aside class="st-aside">
	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Widgets')) : else : ?>
	<!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->
	<h2>Side search</h2>
	<?php get_search_form(); ?>
	<?php endif; ?>
</aside>
