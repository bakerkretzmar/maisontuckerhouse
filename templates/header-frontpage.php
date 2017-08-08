<?php $slides = get_posts([
  'post_type' => 'attachment',
  'numberposts' => '-1',
  'tax_query' => [
    [
      'taxonomy' => 'media_tag',
      'field'    => 'slug',
      'terms'    => 'home_slider',
    ],
  ],
]);
echo '<div id="siemaHome">';
foreach ($slides as $slide) {
  echo '<div><figure class="slide">';
  echo '<div class="slide-image">' . wp_get_attachment_image( $slide->ID, 'full' ) . '</div>';
  $description;
  if ( $slide->post_excerpt ) {
    $description = apply_filters( 'the_content', $slide->post_excerpt);
  }
  echo '<figcaption><h1><a href="' . esc_url( $slide->media_link ) . '">' . apply_filters( 'the_title', $slide->post_title ) . '</a></h1>' . $description . '</figcaption>';
  echo '</figure></div>';
};
echo "</div>"; ?>
