<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />

  <?php if (is_search()) { ?>
    <meta name="robots" content="noindex, nofollow" />
    <?php } ?>

      <title>
        <?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' Archive - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
      </title>

      <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/font-awesome.min.css">
      <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
      <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/custom.css">
      <link rel="shortcut icon" href="/favicon.png">
      <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

      <?php if ( is_singular() ) wp_enqueue_script('comment-reply'); ?>

        <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <!--[if gte IE 6 ]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->

  <header>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
          <P>
            <?php bloginfo('description'); ?>
          </P>
        </div>
        <div class="col-md-8">
          <?php wp_nav_menu(array('menu' => 'main-nav', 'container' => false )); ?>
        </div>
      </div>
    </div>
  </header>