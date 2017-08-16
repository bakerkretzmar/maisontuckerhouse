<?php use Roots\Sage\Wrapper; ?>
<div class="wrap container-fluid" role="document">
  <div class="slider row">
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

    if ( $slides ) {
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
      echo "</div>";
    } ?>
  </div>
  <div class="main container">
    <main class="main">
      <?php include Wrapper\template_path(); ?>
    </main>
  </div>
  <div class="row cards">
    <?php $cards = get_posts([
      'post_type' => 'attachment',
      'numberposts' => '3',
      'tax_query' => [
        [
          'taxonomy' => 'media_tag',
          'field'    => 'slug',
          'terms'    => 'frontpage_card',
        ],
      ],
    ]);

    if ( $cards ) {
      foreach ($cards as $card) {
        echo '<div class="col-md-4"><div class="card">';
        echo '<img class="card-img-top" src="' . wp_get_attachment_image_src( $card->ID, 'full' )[0] . '" alt="' . apply_filters( 'the_title', $card->post_title ) . '">';
        echo '<div class="card-block">';
        echo '<h5 class="card-title">' . apply_filters( 'the_title', $card->post_title ) . '</h5>';
        echo apply_filters( 'the_content', $card->post_excerpt );
        echo '<div class="btn btn-primary custom-buttom red"><a href="' . esc_url( $card->media_link ) . '">More</a></div>';
        echo '</div></div></div>';
      }
    } ?>
  </div>
</div><!-- /.wrap -->
