<?php

namespace Roots\Sage\Widgets;

use Roots\Sage\Setup;

/**
 * Social buttons widget
 */
class Social_Icons_Widget extends \WP_Widget {

  function __construct() {
    parent::__construct(
      'social-icons',  // Base ID
      'Social Buttons',   // Name
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


/**
 * Custom button widget
 */
class Custom_Button_Widget extends \WP_Widget {

  function __construct() {
    parent::__construct(
      'custom-button',  // Base ID
      'Custom Button',   // Name
      [
        'description' => __( 'A widget to create a custom link button', 'maisontuckerhouse' ),
        'classname' => 'widget_custom-button',
      ]
    );
  }

  public function widget( $args, $instance ) {

    echo $args['before_widget'];

    echo '<div class="btn btn-primary custom-button ' . $instance['color'] . ' ' . $instance['style'] . '">';

    if ( ( ! empty( $instance['title'] ) ) && ( ! empty( $instance['link'] ) ) ) {
      echo '<a href="' . esc_url( $instance['link'] ) . '">' . $instance['title'] . '</a>';
    }

    echo '</div>';

    echo $args['after_widget'];

  }

  public function form( $instance ) {

    $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'maisontuckerhouse' );
    $link = ! empty( $instance['link'] ) ? $instance['link'] : esc_html__( '', 'maisontuckerhouse' );
    $color = ! empty( $instance['color'] ) ? $instance['color'] : esc_html__( '', 'maisontuckerhouse' );
    $style = ! empty( $instance['style'] ) ? $instance['style'] : esc_html__( '', 'maisontuckerhouse' );

    ?>
    <p>
      <label for="<?= esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'maisontuckerhouse' ); ?></label>
      <input class="widefat" id="<?= esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?= esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?= esc_attr( $title ); ?>">
    </p>
    <p>
      <label for="<?= esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_attr_e( 'Link:', 'maisontuckerhouse' ); ?></label>
      <input class="widefat" id="<?= esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?= esc_attr( $this->get_field_name( 'link' ) ); ?>" type="url" value="<?= esc_attr( $link ); ?>">
    </p>
    <p style="display: inline-block; width: 48%;">
      <label for="<?= esc_attr( $this->get_field_id( 'color' ) ); ?>"><?php esc_attr_e( 'Color:', 'maisontuckerhouse' ); ?></label>
      <br>
      <input id="<?= esc_attr( $this->get_field_id( 'color' ) ); ?>" name="<?= esc_attr( $this->get_field_name( 'color' ) ); ?>" type="radio" value="green" <?php if ($color === 'green') { echo 'checked="checked"'; } ?>>
      <label for="<?= esc_attr( $this->get_field_id( 'color' ) ); ?>"><?php esc_attr_e( 'Green', 'maisontuckerhouse' ); ?></label>
      <br>
      <input id="<?= esc_attr( $this->get_field_id( 'color' ) ); ?>" name="<?= esc_attr( $this->get_field_name( 'color' ) ); ?>" type="radio" value="red" <?php if ($color === 'red') { echo 'checked="checked"'; } ?>>
      <label for="<?= esc_attr( $this->get_field_id( 'color' ) ); ?>"><?php esc_attr_e( 'Red', 'maisontuckerhouse' ); ?></label>
    </p>
    <p style="display: inline-block; width: 48%;">
      <label for="<?= esc_attr( $this->get_field_id( 'style' ) ); ?>"><?php esc_attr_e( 'Style:', 'maisontuckerhouse' ); ?></label>
      <br>
      <input id="<?= esc_attr( $this->get_field_id( 'style' ) ); ?>" name="<?= esc_attr( $this->get_field_name( 'style' ) ); ?>" type="radio" value="fill" <?php if ($style === 'fill') { echo 'checked="checked"'; } ?>>
      <label for="<?= esc_attr( $this->get_field_id( 'style' ) ); ?>"><?php esc_attr_e( 'Fill', 'maisontuckerhouse' ); ?></label>
      <br>
      <input id="<?= esc_attr( $this->get_field_id( 'style' ) ); ?>" name="<?= esc_attr( $this->get_field_name( 'style' ) ); ?>" type="radio" value="outline" <?php if ($style === 'outline') { echo 'checked="checked"'; } ?>>
      <label for="<?= esc_attr( $this->get_field_id( 'style' ) ); ?>"><?php esc_attr_e( 'Outline', 'maisontuckerhouse' ); ?></label>
    </p>
    <?php

  }

  public function update( $new_instance, $old_instance ) {

    $instance = array();

    $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['link'] = ( !empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';
    $instance['color'] = ( !empty( $new_instance['color'] ) ) ? strip_tags( $new_instance['color'] ) : '';
    $instance['style'] = ( !empty( $new_instance['style'] ) ) ? strip_tags( $new_instance['style'] ) : '';

    return $instance;

  }

}
add_action( 'widgets_init', function() { register_widget( __NAMESPACE__ . '\\Custom_Button_Widget' ); } );
