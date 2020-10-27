<?php
get_header();

if (have_posts()) :

  // Section title
  doha_get_section_title();

  // The loop
  $contentClass = (is_singular()) ? 'singular' : 'grid';
  echo '<div class="content ' . $contentClass . '">';

  while (have_posts()) :
    the_post();

    if (is_singular()) :

      // If is singular, show the content type template
      get_template_part('template-parts/content', get_post_type());

      // If comments are open or there is at least 1 comment, show comments template
      if (comments_open() || get_comments_number()) :
        comments_template();
      endif;

    else :
      // Else, show a card version of the post
      get_template_part('template-parts/content', 'card');
    endif;

  endwhile;

  echo '</div>';

  // Wordpress traditional navigation:
  // the_posts_navigation();

  // Custom navigation with page numbers:
  doha_posts_navigation();

else :

  get_template_part('template-parts/content', 'none');

endif;

get_footer();
