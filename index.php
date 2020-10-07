<?php
get_header();

if (have_posts()) :

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

  the_posts_navigation();

else :

  get_template_part('template-parts/content', 'none');

endif;

get_footer();
