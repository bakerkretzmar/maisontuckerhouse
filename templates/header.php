<header class="banner">
  <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#tuckerNav" aria-controls="tuckerNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>">
      <img src="/wp-content/themes/maisontuckerhouse/dist/images/logo_wordmark-narrow.svg" alt="brand">
    </a>

    <div class="collapse navbar-collapse" id="tuckerNav">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'navbar-nav']);
      endif;
      ?>
    </div>
  </nav>
</header>
