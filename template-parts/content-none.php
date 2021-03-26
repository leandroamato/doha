<section class="no-results">

  <header class="page-header">
    <h1 class="page-title"><?php esc_html_e('Nothing Found', 'doha'); ?></h1>
  </header>

  <div class="page-content">
    <?php if (is_search()) : ?>
      <p>
        <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'doha'); ?>
      </p>
    <?php else : ?>
      <p>
        <?php esc_html_e('Sorry, it seems the page you were trying to access has been moved or deleted from this website.', 'doha') ?>
      </p>
    <?php endif; ?>

  </div>

  <footer>
    <p>
      <a class="btn" href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Go back home', 'doha'); ?></a>
    </p>
  </footer>

</section>
