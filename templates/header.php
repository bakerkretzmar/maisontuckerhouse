<header class="banner">
  <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <?php
      $languages = pll_the_languages( ['raw' => 1] );
      foreach ($languages as $lang) {
        if ( ! $lang['current_lang'] ) {
          echo '<a id="langToggle" href="' . esc_url( $lang['url'] ) . '">' . $lang['name'] . '</a>';
        }
      }
    ?>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#tuckerNav" aria-controls="tuckerNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>">
      <img src="<?= Roots\Sage\Assets\asset_path('images/logo_wordmark-narrow-2.svg') ?>" alt="brand">
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
<?php
  if ( is_page() && has_post_thumbnail() ) {
    get_template_part('templates/header', 'page');
  }
?>
