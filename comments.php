<?php
if (post_password_required()) {
  return;
}
?>

<div id="comments" class="comments-area">

  <?php
  if (have_comments()) :
  ?>
    <header class="comments-title">
      <?php
      $number = floatval(get_comments_number());

      echo '<h2>' . $number . ' ';
      echo ($number == 1) ? __('comment', 'doha') : __('comments', 'doha');
      echo '</h2>';

      if (comments_open()) {
        echo '<a href="#respond"class="btn">' . __('Leave a reply', 'doha') . '</a>';
      }
      ?>
    </header>

    <?php the_comments_navigation(); ?>

    <ol class="comment-list">
      <?php
      wp_list_comments(
        array(
          'style'      => 'ol',
          'short_ping' => true,
          'format' => 'html5'
        )
      );
      ?>
    </ol><!-- .comment-list -->

    <?php
    the_comments_navigation();

    // If comments are closed...
    if (!comments_open()) :
    ?>
      <p class="no-comments"><?php esc_html_e('Comments are closed.', 'doha'); ?></p>
  <?php
    endif;

  endif;

  // Show the comment form
  comment_form();
  ?>

</div><!-- #comments -->
