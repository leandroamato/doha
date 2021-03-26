<article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
  <a href="<?php echo esc_url(get_permalink()) ?>" rel="bookmark">

    <?php doha_post_thumbnail(); ?>

    <header class="entry-header">
      <h2 class="tit4"><?php the_title(); ?></h2>
    </header>

    <p class="content">
      <?php echo wp_strip_all_tags(get_the_excerpt(), true); ?>
    </p>

    <footer>
      <p class="meta">
        <?php the_author(); ?> &middot; <?php doha_post_date(); ?>
      </p>
      <?php doha_comments_number(); ?>

    </footer>

  </a>
</article>
