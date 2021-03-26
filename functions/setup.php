<?php

/**
 * Theme setup
 */
if (!function_exists('doha_setup')) {

  function doha_setup()
  {
    /**
     * Localization
     */

    load_theme_textdomain('doha', get_template_directory() . '/languages');

    /**
     * Output valid HTML5 in Wordpress defaults
     */
    add_theme_support(
      'html5',
      array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
      )
    );

    /**
     * Let Wordpress manage the title
     */
    add_theme_support('title-tag');

    /**
     * Add Feed links to the theme
     */
    add_theme_support('automatic-feed-links');

    /**
     * Register Menus
     */
    register_nav_menus(
      array(
        'primary' => __('Primary menu', 'doha'),
        'social' => __('Social', 'doha'),
      )
    );

    /**
     * Add support for post featured images
     */
    add_theme_support('post-thumbnails');

    /**
     * Custom image size for post cards
     */
    add_image_size('card', 600, 300, true);

    /**
     * Set the content width in pixels, based on the theme's design and stylesheet.
     */
    function custom_theme_content_width()
    {
      $GLOBALS['content_width'] = apply_filters('custom_theme_content_width', 1080);
    }
    add_action('after_setup_theme', 'custom_theme_content_width', 0);

    /**
     * Responsive embeds
     */
    add_theme_support('responsive-embeds');

    /**
     * Short Excerpts
     */
    add_filter('excerpt_length', function ($length) {
      return 20;
    });

    /**
     * Add support for a custom logo
     */
    add_theme_support('custom-logo', array(
      'height'      => 250,
      'width'       => 250,
      'flex-width'  => true,
      'flex-height' => true,
    ));
  }

  /**
   * Register widget area.
   */
  function doha_widgets_init()
  {
    register_sidebar(
      array(
        'name'          => esc_html__('Widgets', 'doha'),
        'id'            => 'widget-area',
        'description'   => esc_html__('Add widgets here.', 'doha'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
      )
    );
  }
  add_action('widgets_init', 'doha_widgets_init');
}

add_action('after_setup_theme', 'doha_setup');
