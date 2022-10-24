<article <?php post_class(); ?>>
  <?= get_the_post_thumbnail( '', 'thumbnail', ['class' => 'th-list-thumbnail'] ); ?>
  <header class="th-list">
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <!-- <?= get_the_post_thumbnail( '', 'thumbnail', ['class' => 'th-list-thumbnail'] ); ?> -->
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
</article>
