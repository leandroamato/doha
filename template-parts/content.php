<article id="post-<?php the_ID(); ?>" <?php post_class('full'); ?>>

  <header class="entry-header">

    <div class="wrap">

      <?php
      // Meta: taxonomies
      if ('post' === get_post_type()) {
        // Post categories
        doha_post_terms();

        // Post tags
        doha_post_terms('post_tag');
      }
      ?>

      <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

      <div class="entry-meta">
        <?php
        // Post author
        echo get_avatar(get_the_author_meta('ID'), 32);
        doha_post_author();

        // Meta: Post date with a "time ago" format
        doha_post_date();

        // Comments
        doha_comments_number();
        ?>
      </div>

    </div>

  </header>

  <?php doha_post_thumbnail(); ?>

  <div class="entry-content">

    <?php
    wp_link_pages(
      array(
        'before' => '<div class="page-links top"><span class="label">' . __('Pages', 'doha') . '</span>',
        'after'  => '</div>',
      )
    );

    the_content(
      sprintf(
        wp_kses(
          /* translators: %s: Name of current post. Only visible to screen readers */
          __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'doha'),
          array(
            'span' => array(
              'class' => array(),
            ),
          )
        ),
        wp_kses_post(get_the_title())
      )
    );

    wp_link_pages(
      array(
        'before' => '<div class="page-links bottom"><span class="label">' . __('Pages', 'doha') . '</span>',
        'after'  => '</div>',
      )
    );
    ?>
  </div>

</article><!-- #post-<?php the_ID(); ?> -->
