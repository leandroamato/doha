<?php

function doha_meta_tags()
{
  global $post;

  // Get title and description
  if (is_singular()) {
    $description = mb_substr(htmlspecialchars(strip_tags($post->post_content)), 0, 300, 'utf8');
    $title = get_the_title() . ' &mdash; ' . get_bloginfo('title');
  } else if (is_category()) {
    $category_description = trim(strip_tags(category_description()));
    $title = single_cat_title('', false) . ' &mdash; ' . get_bloginfo('title');
    $description = ($category_description) ? $category_description : null;
  } else if (is_tag()) {
    $tag_description = trim(strip_tags(tag_description()));
    $title = single_tag_title('', false) . ' &mdash; ' . get_bloginfo('title');
    $description = ($tag_description) ? $tag_description : null;
  } else {
    $description = get_bloginfo("description");
    $title = get_bloginfo('title');
  }

  // Wordpress manages the title
  // echo '<title>' . $title . '</title>' . "\n";

  // Add description
  echo '<meta name="description" content="' . $description . '" />' . "\n";
  echo '<meta property="og:description" content="' . $description . '" />' . "\n";
}
add_action('wp_head', 'doha_meta_tags');
