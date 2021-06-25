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
          'terms'    => 'frontpage_slider',
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
  <div class="row cta">
    <div class="col-md-6 cta cta-donate">
      <h5><i class="fa fa-gift fa-lg" aria-hidden="true"></i></h5>
      <h3>Donate to Tucker House</h3>
      <!-- <h3><?php echo mth_translate([
        'en' => 'Donate to Tucker House',
        'fr' => 'Faites un don à la Maison Tucker',
      ]); ?></h3> -->
      <p>Make a tax-deductible gift today to encourage sustainable living and educate local youth for a healthier future.</p>
      <div class="btn btn-primary custom-button red">
        <a href="<?php echo (pll_current_language() === 'en') ? 'donate' : 'faire-un-don'; ?>">Donate Now</a>
      </div>

    </div>
    <div class="col-md-6 cta cta-subscribe">
      <h5><i class="fa fa-envelope-o" aria-hidden="true"></i></h5>
      <h3>Get the Latest</h3>
      <p>Want Tucker House in your inbox? Sign up for email updates to receive news,  and opportunities to get involved!</p>
      <div class="btn btn-primary custom-button green">
        <a href="<?php echo (pll_current_language() === 'en') ? 'newsletter' : 'bulletin'; ?>">Subscribe</a>
      </div>

    </div>
  </div>
</div><!-- /.wrap -->
