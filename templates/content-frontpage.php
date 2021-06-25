<?php use function Roots\Sage\Wrapper\template_path; ?>

<div class="wrap container-fluid" role="document">
    <div class="slider row">
        <?php
            $slides = get_posts([
                'post_type' => 'attachment',
                'numberposts' => '-1',
                'tax_query' => [
                    [
                        'taxonomy' => 'media_tag',
                        'field' => 'slug',
                        'terms' => 'frontpage_slider',
                    ],
                ],
            ]);

            if ($slides) {
                echo '<div id="siemaHome">';

                foreach ($slides as $slide) {
                    echo '<div><figure class="slide">';
                    echo '<div class="slide-image">' . wp_get_attachment_image($slide->ID, 'full', false, ['class' => 'tw_w-full']) . '</div>';

                    $description = '';

                    if ($slide->post_excerpt) {
                        $description = apply_filters('the_content', $slide->post_excerpt);
                    }

                    echo '<figcaption><h1><a href="' . esc_url($slide->media_link) . '">' . apply_filters('the_title', $slide->post_title) . '</a></h1>' . $description . '</figcaption>';
                    echo '</figure></div>';
                }

                echo "</div>";
            }
        ?>
    </div>

<div class="main container">
    <main class="main">
      <?php include template_path(); ?>
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
      <h3><?php echo mth_trans('Donate to Tucker House'); ?></h3>
      <p><?php echo mth_trans('Make a tax-deductible gift today to encourage sustainable living and educate local youth for a healthier future.'); ?></p>
      <div class="btn btn-primary custom-button red">
        <a href="<?php echo mth_trans(['en' => 'donate', 'fr' => 'faire-un-don']); ?>">
          <?php echo mth_trans('Donate Now'); ?>
        </a>
      </div>

    </div>
    <div class="col-md-6 cta cta-subscribe">
      <h5><i class="fa fa-envelope-o" aria-hidden="true"></i></h5>
      <h3><?php echo mth_trans('Want Tucker House in your Inbox?'); ?></h3>
      <p><?php echo mth_trans('Want Tucker House in your Inbox? Subscribe to receive email updates, latest news, and learn how you can get involved! At Tucker House opportunities are endless!'); ?></p>
      <div class="btn btn-primary custom-button green">
        <a href="<?php echo mth_trans(['en' => 'newsletter', 'fr' => 'bulletin']); ?>">
          <?php echo mth_trans('Subscribe'); ?>
        </a>
      </div>

    </div>
  </div>
</div><!-- /.wrap -->
