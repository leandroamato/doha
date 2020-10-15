</main><!-- main -->

<?php get_sidebar(); ?>

<footer id="footer">

  <div class="wrap">

    <?php doha_get_menu('social'); ?>

    <p class="copyright">&copy; <?php echo date('Y') . ' ' . get_bloginfo('name'); ?></p>

    <p class="powered"><?php _e('Powered by', 'doha'); ?> <a href="https://wordpress.org/">WordPress</a> &amp; <a href="https://github.com/leandroamato/doha">Doha Theme</a></p>

  </div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>



</body>

</html>
