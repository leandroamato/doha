<?php if (is_active_sidebar('widget-area')) : ?>
  <div id="sidebar" class="widget-area" role="complementary">
    <div class="wrap <?php doha_widgets_class(); ?>">
      <?php dynamic_sidebar('widget-area'); ?>
    </div>
  </div>
<?php endif; ?>
