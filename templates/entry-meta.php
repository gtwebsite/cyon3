<?php if( is_single() ) { ?>
<small class="d-block text-muted">
  <time class="updated" datetime="<?= get_post_time('c', true); ?>"><?= get_the_date(); ?></time>
  <span class="byline author vcard"><?= __('By', 'cyon'); ?> <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?= get_the_author(); ?></a></span>
</small>
<?php } ?>
