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
