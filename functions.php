<?php
/*  =========================================================================
    RSS LINK <head>
    ========================================================================== */
	
	automatic_feed_links();
	
/*  =========================================================================
    CLEAN UP <head>
    ========================================================================== */
	
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');

/*  =========================================================================
    WIDGET ZONE
    ========================================================================== */

    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }

/* ==========================================================================
   MENU
   ========================================================================== */

	register_nav_menus(
		array(
		'main_nav' => 'main-nav'
		)
	);

/* ==========================================================================
    FEATURE IMAGE
    ========================================================================== */

	if ( function_exists( 'add_theme_support' ) )
	add_theme_support( 'post-thumbnails' );

/* ==========================================================================
   CUSTOM BODY CLASSES
   ========================================================================== */

	add_filter('body_class','add_category_to_single');
	function add_category_to_single($classes) {
		$post_name_prefix = 'postname-';
		$page_name_prefix = 'pagename-';
		$single_term_prefix = 'category-';
		$single_parent_prefix = 'category-';
		$category_parent_prefix = 'category-';
		$term_parent_prefix = 'parent-term-';
		$site_prefix = 'site-';
		
		global $wp_query;
		if ( is_single() ) {
			$wp_query->post = $wp_query->posts[0];
			setup_postdata($wp_query->post);
			$classes[] = $post_name_prefix . $wp_query->post->post_name;
	
			$taxonomies = array_filter( get_post_taxonomies($wp_query->post->ID), "is_taxonomy_hierarchical" );	
			foreach ( $taxonomies as $taxonomy ) {
				$tax_name = ( $taxonomy != 'category') ? $taxonomy . '-' : '';
				$terms = get_the_terms($wp_query->post->ID, $taxonomy);
				if ( $terms ) {
					foreach( $terms as $term ) {
						if ( !empty($term->slug ) )
							$classes[] = $single_term_prefix . $tax_name . sanitize_html_class($term->slug, $term->term_id);
						while ( $term->parent ) {
							$term = &get_term( (int) $term->parent, $taxonomy );
							if ( !empty( $term->slug ) )
								$classes[] = $single_parent_prefix . $tax_name . sanitize_html_class($term->slug, $term->term_id);
						}
					}
				}
			}
		} elseif ( is_archive() ) {
			if ( is_category() ) {
				$cat = $wp_query->get_queried_object();
				while ( $cat->parent ) {
					$cat = &get_category( (int) $cat->parent);
					if ( !empty( $cat->slug ) )
						$classes[] = $category_parent_prefix . sanitize_html_class($cat->slug, $cat->cat_ID);
				}
			} elseif ( is_tax() ) {
				$term = $wp_query->get_queried_object();
				while ( $term->parent ) {
					$term = &get_term( (int) $term->parent, $term->taxonomy );
					if ( !empty( $term->slug ) )
						$classes[] = $term_parent_prefix . sanitize_html_class($term->slug, $term->term_id);
				}
			}
		} elseif ( is_page() ) {
			$wp_query->post = $wp_query->posts[0];
			setup_postdata($wp_query->post);
			$classes[] = $page_name_prefix . $wp_query->post->post_name;
		}
		
		if ( is_multisite() ) {
			global $blog_id;
			$classes[] = $site_prefix . $blog_id;
		}
		
		return $classes;
	}

/* ==========================================================================
   SINGLE BY CATEGORY
   ========================================================================== */

	add_filter('single_template', create_function('$t', 'foreach( (array) get_the_category() as $cat ) { if ( file_exists(TEMPLATEPATH . "/single-{$cat->term_id}.php") ) return TEMPLATEPATH . "/single-{$cat->term_id}.php"; elseif ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") ) return TEMPLATEPATH . "/single-{$cat->slug}.php"; } return $t;' ));
			
/* ==========================================================================
   LOGIN PAGE LOGO
   ========================================================================== */

	function my_login_logo() { ?>
  <style type="text/css">
    body.login div#login h1 {
      background-color: #fff;
      padding: 10px;
    }
    
    body.login div#login h1 a {
      background: url(<?php bloginfo('template_url');
      ?>/images/mian-logo.svg) center center no-repeat;
      background-size: auto 100%;
      margin: 0 auto !important;
      width: 100%;
    }
    
    body.login div#login form#loginform p.submit input#wp-submit {
      font-family: sans-serif;
      display: block;
      font-size: 1em;
      line-height: 1em;
      text-transform: uppercase;
      color: #fff;
      padding: 3px 10px;
      border: none;
      font-weight: normal;
      cursor: pointer;
      text-decoration: none!important;
      background-color: #CC2730;
      box-shadow: none!important;
      -webkit-box-shadow: none!important;
      -moz-box-shadow: none!important;
      text-shadow: none!important;
      transition: all .3s ease-in-out;
    }
    
    body.login div#login form#loginform p.submit input#wp-submit:hover {
      background-color: #333;
    }
  </style>
  <?php }
	add_action( 'login_enqueue_scripts', 'my_login_logo' ); 

/* ==========================================================================
   FACEBOOK META TAGS
   ========================================================================== */
	
	function fb_opengraph() {
		global $post;
	 
		if(is_single()) {
			if(has_post_thumbnail($post->ID)) {
				$img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'medium');
				$img_src = $img_src[0];//Solo si la imagen queda Array
			} else {
				$img_src = get_stylesheet_directory_uri() . '/images/no-thumbnail.jpg';
			}
			if($excerpt = $post->post_excerpt) {
				$excerpt = strip_tags($post->post_excerpt);
				$excerpt = str_replace("", "'", $excerpt);
			} else {
				$excerpt = get_bloginfo('description');
			}
			?>

    <meta property="og:title" content="<?php echo the_title(); ?>" />
    <meta property="og:description" content="<?php echo $excerpt; ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="<?php echo the_permalink(); ?>" />
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>" />
    <meta property="og:image" content="<?php echo $img_src; ?>" />

    <?php
		} else {
			return;
		}
	}
	add_action('wp_head', 'fb_opengraph', 5);
?>