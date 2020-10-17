<?php

/**
 * Enqueue the theme scripts and styles.
 */
if (!function_exists('doha_scripts_styles')) {

  function doha_scripts_styles()
  {
    // Own Scriots
    $jstime = filemtime(get_template_directory() . '/dist/js/main.min.js');
    wp_enqueue_script('doha_scripts', get_template_directory_uri() . '/dist/js/main.min.js', array('jquery'), $jstime, true);
    $csstime = filemtime(get_template_directory() . '/dist/css/main.min.css');
    wp_enqueue_style('doha_styles', get_template_directory_uri() . '/dist/css/main.min.css', array(), $csstime);
  }

  add_action('wp_enqueue_scripts', 'doha_scripts_styles');
}

/**
 * Enqueue comments reply scripts on singular pages
 */

if (!function_exists('doha_enqueue_comment_reply')) {
  function doha_enqueue_comment_reply()
  {
    if (is_singular() && comments_open() && get_option('thread_comments')) {
      wp_enqueue_script('comment-reply');
    }
  }

  add_action('wp_enqueue_scripts', 'doha_enqueue_comment_reply');
}


/**
 * Add category, tags and any other tems as classes to the body tag
 */

if (!function_exists('doha_body_class')) {

  function doha_body_class($classes)
  {
    if (is_single() || is_page()) {
      global $post;
      $taxonomies = get_object_taxonomies(get_post_type($post->ID));

      foreach ($taxonomies as $taxonomy) {
        foreach ((wp_get_post_terms($post->ID, $taxonomy)) as $term) {
          $classes[] = str_replace("post_", "", $term->taxonomy) . '-' . $term->slug;
        }
      }
    }

    return $classes;
  }

  add_filter('body_class', 'doha_body_class');
}

/**
 * Get custom logo
 */

if (!function_exists('doha_get_custom_logo')) {

  function doha_get_custom_logo()
  {
    if (function_exists('the_custom_logo')) {
      $custom_logo_id = get_theme_mod('custom_logo');
      $custom_logo = wp_get_attachment_image_src($custom_logo_id, 'full');
      return $custom_logo[0];
    } else {
      return null;
    }
  }
}

/**
 * Show logo or site name
 */

if (!function_exists('doha_get_logo')) {

  function doha_get_logo()
  {
    $h1Class = (doha_get_custom_logo()) ? 'image' : 'text';
    echo '<h1 class="site-title ' . $h1Class . '">';
    echo '<a href="' . esc_url(home_url('/')) . '" rel="home">';
    if (doha_get_custom_logo()) {
      echo '<img src="' . doha_get_custom_logo() . '" class="site-logo" alt="' . htmlspecialchars(get_bloginfo('name')) . '" />';
    } else {
      echo  get_bloginfo('name');
    }
    echo '</a>';
    echo '</h1>';
  }
}

/**
 * Get menus
 */

if (!function_exists('doha_get_menu')) {

  function doha_get_menu($menu = 'primary')
  {
    if (has_nav_menu($menu)) {

      // Add button to toggle menu for main menu
      if ($menu == 'primary') {
        echo '<button class="toggle toggle-menu btn" data-target="primary-menu" aria-controls="primary-menu" aria-expanded="false"><span class="screen-reader-text">' . _x('Menu', 'label') . '</span></button>';
      }

      // Show the menu
      wp_nav_menu(
        array(
          'theme_location' => $menu,
          'menu_class' => 'menu-items',
          'container' => 'nav',
          'container_id' => $menu . '-menu',
          'container_class' => 'menu'
        )
      );
    }
  }
}

/**
 * Custom search form
 */

if (!function_exists('doha_get_search_form')) {

  function doha_get_search_form()
  {

    echo '<button class="toggle toggle-search btn" data-target="search-form" aria-controls="search-form" aria-expanded="false"><span class="screen-reader-text">' . _x('Buscar', 'label') . '</span></button>';

    echo '<div id="search-form">';
    echo '<form role="search" method="get" action="' . home_url('/') . '" >';
    echo '<label class="screen-reader-text" for="s">' . __('Search', 'doha') . '</label>';
    echo '<input type="search" class="search-field" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __('Search&hellip;', 'doha') . '" />';
    echo '<button class="search-submit"><span class="screen-reader-text">' . __('Search', 'doha') . '</button>';
    echo '</form>';
    echo '</div>';
  }

  add_filter('get_search_form', 'wp_search_form');
}

/**
 * Get section title
 */

if (!function_exists('doha_get_section_title')) {
  function doha_get_section_title()
  {
    if (!is_singular() && !is_home()) {

      echo '<h1 class="section-title">';

      // Add section type
      if (is_category()) {
        echo __('Category: ', 'doha');
      } else if (is_tag()) {
        echo __('Tag: ', 'doha');
      } else if (is_date()) {
        echo __('Date: ', 'doha');
      } else if (is_author()) {
        echo __('Author: ', 'doha');
      }

      // Show section title
      echo rtrim(wp_title('', false), '- ');

      echo '</h1>';
    }
  }
}

/**
 * Get featured image
 */

if (!function_exists('doha_post_thumbnail')) {

  function doha_post_thumbnail()
  {

    // Don't show a thumbnail for protected posts or attachment pages
    if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
      return;
    }

    global $post;
    echo '<figure class="post-thumbnail">';
    echo (is_singular()) ? get_the_post_thumbnail() : get_the_post_thumbnail($post->ID, 'card');
    echo '</figure>';
  }
}

/**
 * Get featured image URL
 */

if (!function_exists('doha_post_thumbnail_URL')) {

  function doha_post_thumbnail_url()
  {

    // Don't show a thumbnail for protected posts or attachment pages
    if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
      return;
    }
    return get_the_post_thumbnail_url(get_the_ID(), 'full');
  }
}

/**
 * Get post author
 */

if (!function_exists('doha_post_author')) {

  function doha_post_author()
  {
    echo '<p class="author vcard">' . __('By', 'doha') . ' ';
    echo '<a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">';
    echo esc_html(get_the_author());
    echo '</a>';
    echo '</p>';
  }
}

/**
 * Get post date
 */

if (!function_exists('doha_post_date')) {

  function doha_post_date()
  {
    $time = sprintf(esc_html__('%s ago', 'doha'), human_time_diff(get_the_time('U'), current_time('timestamp')));
    echo '<time datetime="' . get_the_time('Y-m-d') . '">' . $time, '</time>';
  }
}

/**
 * Get post taxonomy terms
 */

if (!function_exists('doha_post_terms')) {

  function doha_post_terms($taxonomy = 'category')
  {
    global $post;
    $taxonomies = wp_get_post_terms($post->ID, $taxonomy);

    if ($taxonomies) {
      echo '<ul class="taxonomy ' . str_replace("post_", "", $taxonomy) . '">';
      foreach ((wp_get_post_terms($post->ID, $taxonomy)) as $term) {
        echo '<li><a href="' . esc_url(get_term_link($term)) . '">' . $term->name . '</a></li>';
      }
      echo '</ul>';
    }
  }
}

/**
 * Show comments number
 */

if (!function_exists('doha_comments_number')) {

  function doha_comments_number()
  {
    global $post;
    if (comments_open($post->ID) || get_comments_number($post->ID)) {

      $number = floatval(get_comments_number($post->ID));

      echo '<p class="comments-number">';

      echo (is_singular()) ? '<a href="' . get_comments_link($post->ID) . '">' : '<span>';

      echo $number;

      echo ' <strong>';
      echo ($number == 1) ? __('comment', 'doha') : __('comments', 'doha');
      echo '</strong>';

      echo (is_singular()) ? '</a>' : '</span>';;
      echo '</p>';
    }
  }
}

/**
 * Get a class for the widget area according to the nunmber of widgets
 */

function doha_widgets_class()
{
  $widgets = wp_get_sidebars_widgets();
  $widgetsNumber = count($widgets['widget-area']);

  // Should we use a 3, 2 or 1 column layout?
  if ($widgetsNumber % 3 == 0) {
    $widgetsClass = 'cols3';
  } else if ($widgetsNumber % 2 == 0) {
    $widgetsClass = 'cols2';
  } else {
    $widgetsClass = ($widgetsNumber > 1) ? 'cols' : 'cols1';
  }

  echo $widgetsClass;
}
