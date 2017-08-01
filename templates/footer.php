<?php if ( get_field('sponsors_footer') ) { get_template_part('templates/footer', 'sponsors'); } ?>
<footer class="content-info container-fluid">
  <div class="container">
    <div class="row widgets">
      <aside class="sidebar sidebar-footer-l">
        <?php dynamic_sidebar('sidebar-footer-l'); ?>
      </aside>
      <aside class="sidebar sidebar-footer-m">
        <?php dynamic_sidebar('sidebar-footer-m'); ?>
      </aside>
      <aside class="sidebar sidebar-footer-r">
        <?php dynamic_sidebar('sidebar-footer-r'); ?>
      </aside>
    </div>
  </div>
</footer>
<div class="colophon container-fluid">
  <div class="container">
    <div class="row credits">
      <p>© 2017 <?= __('Tucker House Renewal Centre', 'maisontuckerhouse'); ?></p>
      <p><?= __('Powered by ', 'maisontuckerhouse'); ?><a href="<?= esc_url('https://wordpress.org/'); ?>">WordPress</a> | <?= __('Theme by ', 'maisontuckerhouse'); ?><a href="<?= esc_url('https://bakerkretzmar.ca/'); ?>">Jacob Baker-Kretzmar</a></p>
    </div>
  </div>
</div>
