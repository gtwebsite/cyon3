<section class="page-section">
  <div class="container">
    <?php the_content(); ?>
    <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'cyon'), 'after' => '</p></nav>']); ?>
  </div>
</section>
<?php comments_template('/templates/comments.php'); ?>