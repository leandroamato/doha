<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <?php
  if (function_exists('wp_body_open')) {
    wp_body_open();
  } else {
    do_action('wp_body_open');
  }
  ?>

  <div id="container">

    <a class="skip-link screen-reader-text" href="#primary"><?php _e('Skip to content', 'doha'); ?></a>

    <header id="header">
      <div class="wrap">
        <?php doha_get_logo(); ?>
        <?php doha_get_search_form(); ?>
        <?php doha_get_menu('primary'); ?>
      </div>
    </header>

    <main>
