<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * Shortcode for email signup form, [signup]
 */
function email_signup() {
  $form = '<form id="ctct_signup" action="https://visitor2.constantcontact.com/api/signup" method="post">
    <input type="hidden" name="ca" value="eacc12e1-dd11-4208-b83a-b89129bed3dd">
    <div class="input-group">
      <span class="input-group-addon" id="firstNameLabel">First name:</span>
      <input name="first_name" type="text" class="form-control" placeholder="Jane" aria-describedby="firstNameLabel" maxlength="50" required>
    </div>
    <div class="input-group">
      <span class="input-group-addon" id="lastNameLabel">Last name:</span>
      <input name="last_name" type="text" class="form-control" placeholder="Doe" aria-describedby="lastNameLabel" maxlength="50" required>
    </div>
    <div class="input-group">
      <span class="input-group-addon" id="emailLabel">Email:</span>
      <input name="email" type="email" class="form-control" placeholder="you@yourdomain.com" aria-describedby="emailLabel" maxlength="80" required>
    </div>
    <input type="hidden" name="list_0" value="1">
    <input type="hidden" name="list_1" value="27">
    <input type="hidden" name="list_2" value="46">
    <input class="btn btn-outline-primary" type="submit" value="Subscribe">
  </form>';
  return $form;
}
add_shortcode( 'signup', __NAMESPACE__ . '\\email_signup' );

/**
 * Responsive embeds!
 */
function responsive_embeds($content) {
	$content = preg_replace( "/<object/Si", '<div class="embed-container"><object', $content );
	$content = preg_replace( "/<\/object>/Si", '</object></div>', $content );

	$content = preg_replace( "/<iframe.+?src=\"(.+?)\"/Si", '<div class="embed-container"><iframe src="\1" frameborder="0" allowfullscreen>', $content );
	$content = preg_replace( "/<\/iframe>/Si", '</iframe></div>', $content );
	return $content;
}
add_filter( 'the_content', __NAMESPACE__ . '\\responsive_embeds' );

/**
 * Don't automatically wrap <img> in <p></p>
 */
function img_unautop($pee) {
    $pee = preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '$1', $pee);
    return $pee;
}
add_filter( 'the_content', __NAMESPACE__ . '\\img_unautop', 30 );

/**
 * Social icons widget
 */
class Social_Icons_Widget extends \WP_Widget {

  function __construct() {
    parent::__construct(
      'social-icons',  // Base ID
      'Social Icons',   // Name
      [
        'description' => __( 'A widget to display social icon buttons', 'maisontuckerhouse' ),
        'classname' => 'widget_social-icons',
      ]
    );
  }

  public function widget( $args, $instance ) {

    echo $args['before_widget'];

    echo '<div class="social">';

    if ( ! empty( $instance['facebook'] ) ) {
      echo '<a href="' . esc_url( $instance['facebook'] ) . '"><i class="fa fa-facebook fa-lg"></i></a>';
    }

    if ( ! empty( $instance['twitter'] ) ) {
      echo '<a href="' . esc_url( $instance['twitter'] ) . '"><i class="fa fa-twitter fa-lg"></i></a>';
    }

    if ( ! empty( $instance['instagram'] ) ) {
      echo '<a href="' . esc_url( $instance['instagram'] ) . '"><i class="fa fa-instagram fa-lg"></i></a>';
    }

    echo '</div>';

    echo $args['after_widget'];

  }

  public function form( $instance ) {

    $facebook = ! empty( $instance['facebook'] ) ? $instance['facebook'] : esc_html__( '', 'maisontuckerhouse' );
    $twitter = ! empty( $instance['twitter'] ) ? $instance['twitter'] : esc_html__( '', 'maisontuckerhouse' );
    $instagram = ! empty( $instance['instagram'] ) ? $instance['instagram'] : esc_html__( '', 'maisontuckerhouse' );

    ?>
    <p>
      <label for="<?= esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php esc_attr_e( 'Facebook:', 'maisontuckerhouse' ); ?></label>
      <input class="widefat" id="<?= esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?= esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text" value="<?= esc_attr( $facebook ); ?>">
    </p>
    <p>
      <label for="<?= esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php esc_attr_e( 'Twitter:', 'maisontuckerhouse' ); ?></label>
      <input class="widefat" id="<?= esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?= esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text" value="<?= esc_attr( $twitter ); ?>">
    </p>
    <p>
      <label for="<?= esc_attr( $this->get_field_id( 'instagram' ) ); ?>"><?php esc_attr_e( 'Instagram:', 'maisontuckerhouse' ); ?></label>
      <input class="widefat" id="<?= esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?= esc_attr( $this->get_field_name( 'instagram' ) ); ?>" type="text" value="<?= esc_attr( $instagram ); ?>">
    </p>
    <?php

  }

  public function update( $new_instance, $old_instance ) {

    $instance = array();

    $instance['facebook'] = ( !empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
    $instance['twitter'] = ( !empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
    $instance['instagram'] = ( !empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';

    return $instance;

  }

}
add_action( 'widgets_init', function() { register_widget( __NAMESPACE__ . '\\Social_Icons_Widget' ); } );



// Galleries!?

// Remove built-in shortcode
remove_shortcode( 'gallery', 'gallery_shortcode' );

// Replace with custom shortcode
function shortcode_gallery($attr) {
  $post = get_post();

  static $instance = 0;
  $instance++;

  if (!empty($attr['ids'])) {
    if (empty($attr['orderby'])) {
      $attr['orderby'] = 'post__in';
    }
    $attr['include'] = $attr['ids'];
  }

  $output = apply_filters('post_gallery', '', $attr);

  if ($output != '') {
    return $output;
  }

  if (isset($attr['orderby'])) {
    $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
    if (!$attr['orderby']) {
      unset($attr['orderby']);
    }
  }

  extract(shortcode_atts(array(
    'order' => 'ASC',
    'orderby' => 'menu_order ID',
    'id' => $post->ID,
    'itemtag' => '',
    'icontag' => '',
    'captiontag' => '',
    'columns' => 3,
    'size' => 'thumbnail',
    'include' => '',
    'link' => '',
    'exclude' => ''
  ), $attr));

  $id = intval($id);

  if ($order === 'RAND') {
    $orderby = 'none';
  }

  if (!empty($include)) {
    $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

    $attachments = array();
    foreach ($_attachments as $key => $val) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  } elseif (!empty($exclude)) {
    $attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
  } else {
    $attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
  }

  if (empty($attachments)) {
    return '';
  }

  if (is_feed()) {
    $output = "\n";
    foreach ($attachments as $att_id => $attachment) {
      $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
    }
    return $output;
  }

  //Bootstrap Output Begins Here
  //Bootstrap needs a unique carousel id to work properly. Because I'm only using one gallery per post and showing them on an archive page, this uses the $post->ID to allow for multiple galleries on the same page.

  $output .= '<div id="carousel-' . $post->ID . '" class="carousel slide" data-ride="carousel">';
  $output .= '<!-- Indicators -->';
  $output .= '<ol class="carousel-indicators">';

  //Automatically generate the correct number of slide indicators and set the first one to have be class="active".
  $indicatorcount = 0;
  foreach ($attachments as $id => $attachment) {
    if ($indicatorcount == 1) {
      $output .= '<li data-target="#carousel-' . $post->ID . '" data-slide-to="' . $indicatorcount . '" class="active"></li>';
    } else {
      $output .= '<li data-target="#carousel-' . $post->ID . '" data-slide-to="' . $indicatorcount . '"></li>';
    }
    $indicatorcount++;
  }

  $output .= '</ol>';
  $output .= '<!-- Wrapper for slides -->';
  $output .= '<div class="carousel-inner" role="listbox">';
  $i = 0;

  //Begin counting slides to set the first one as the active class
  $slidecount = 1;
  foreach ($attachments as $id => $attachment) {
    $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

    if ($slidecount == 1) {
      $output .= '<div class="carousel-item active">';
    } else {
      $output .= '<div class="carousel-item">';
    }

    $image_src_url = wp_get_attachment_image_src($id, $size);
    $output .= '<img class="d-block img-fluid" src="' . $image_src_url[0] . '">';
    $output .= '    </div>';

    // if (trim($attachment->post_excerpt)) {
    //   $output .= '<div class="caption hidden">' . wptexturize($attachment->post_excerpt) . '</div>';
    // }
    $slidecount++;
  }

  $output .= '</div>';
  $output .= '<!-- Controls -->';
  $output .= '<a class="carousel-control-prev" href="#carousel-' . $post->ID . '" role="button" data-slide="prev">';
  $output .= '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
  $output .= '<span class="sr-only">Previous</span>';
  $output .= '</a>';
  $output .= '<a class="carousel-control-next" href="#carousel-' . $post->ID . '" role="button" data-slide="next">';
  $output .= '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
  $output .= '<span class="sr-only">Next</span>';
  $output .= '</a>';
  $output .= '</div>';
  // $output .= '</div>';
  // $output .= '</div>';

  return $output;
}
add_shortcode( 'gallery', __NAMESPACE__ . '\\shortcode_gallery' );
