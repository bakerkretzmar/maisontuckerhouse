<footer id="logoArea" class="container-fluid">
    <p><?= __('Thanks to our sponsors and partners:', 'maisontuckerhouse'); ?></p>
    <div class="row no-gutters">
      <?php
        $logos = get_posts([
          'post_type' => 'attachment',
          'numberposts' => '-1',
          'tax_query' => [
            [
              'taxonomy' => 'media_tag',
              'field'    => 'slug',
              'terms'    => 'sponsor_logo',
            ],
          ],
        ]);
        foreach ($logos as $logo) {
          $meta = wp_get_attachment_metadata( $logo->ID );
          $classes = 'col-sm-6 col-md-4';
          if ( ( $meta['width'] / $meta['height'] ) > 3 ) {
            $classes = 'col-sm-12 col-md-12 wide';
          } else if ( ( $meta['width'] / $meta['height'] ) > 2 ) {
            $classes = 'col-sm-12 col-md-8';
          }
          echo '<div class="logo ' . $classes . '"><a class="sponsor" href="' . esc_url( $logo->media_link ) . '" target="_blank">' . wp_get_attachment_image( $logo->ID, 'full' ) . '</a></div>';
        };
      ?>
    </div>
</footer>
