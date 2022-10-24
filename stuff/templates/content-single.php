<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <?= get_the_post_thumbnail( '', 'full', ['class' => 'th-post-thumbnail'] ); ?>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'maisontuckerhouse'), 'after' => '</p></nav>']); ?>
    </footer>
  </article>
<?php endwhile; ?>
