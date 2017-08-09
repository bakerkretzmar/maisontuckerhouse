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
    <?php $featured_pages = get_posts([
      'post_type' => 'page',
      'numberposts' => '-1',
      'meta_key' => 'featured_page',
      'meta_value' => true,
    ]);

    if ( $featured_pages ) {
      foreach ($featured_pages as $card) {
        echo '<div class="col-md-4"><div class="card">';
        if ( has_post_thumbnail( $card->ID ) ) {
          $card_img = get_post_thumbnail_id( $card->ID );
          echo '<img class="card-img-top" src="' . get_the_post_thumbnail_url( $card->ID, 'full' ) . '" alt="' . get_post_meta( $card_img, '_wp_attachment_image_alt', true) . '">';
        }
        echo '<div class="card-block">';
        echo '<h5 class="card-title">' . get_the_title( $card->ID ) . '</h5>';
        echo '<p class="card-text">' . get_the_excerpt( $card->ID ) . '</p>';
        echo '<div class="btn btn-primary custom-buttom red"><a href="' . get_the_permalink( $card->ID ) . '">Learn More</a></div>';
        echo '</div></div></div>';
      }
    } ?>
    <div class="col-md-4">
      <div class="card">
        <img class="card-img-top" src="http://maisontuckerhouse.dev/wp-content/uploads/2017/08/andy-kerr-153378.jpg" alt="Card image cap">
        <div class="card-block">
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <div class="btn btn-primary custom-buttom red"><a href="#">Learn More</a></div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <img class="card-img-top" src="http://maisontuckerhouse.dev/wp-content/uploads/2017/08/arvin-febry-302935.jpg" alt="Card image cap">
        <div class="card-block">
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <div class="btn btn-primary custom-buttom red"><a href="#">Learn More</a></div>
        </div>
      </div>
    </div>
  </div><!-- /.content -->
</div><!-- /.wrap -->
