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
 * Add advanced editor functionality
 */
function advanced_editor_buttons( $buttons ) {
	// $buttons[] = 'superscript';
	// $buttons[] = 'subscript';
  // $buttons[] = 'underline';
  // $buttons[] = 'indent';
  // $buttons[] = 'outdent';
	return $buttons;
}
add_filter( 'mce_buttons_2', __NAMESPACE__ . '\\advanced_editor_buttons' );

/**
 * Create custom image tagging taxonomy.
 */
function media_tag() {
  $labels = [
    'name'                       => __( 'Media Tags', 'maisontuckerhosue' ),
    'singular_name'              => __( 'Media Tag', 'maisontuckerhouse' ),
    'search_items'               => __( 'Search Media Tags', 'maisontuckerhouse' ),
    'popular_items'              => __( 'Popular Media Tags', 'maisontuckerhouse' ),
    'all_items'                  => __( 'All Media Tags', 'maisontuckerhouse' ),
    'edit_item'                  => __( 'Edit Media Tag', 'maisontuckerhouse' ),
    'view_item'                  => __( 'View Media Tag', 'maisontuckerhouse' ),
    'update_item'                => __( 'Update Media Tag', 'maisontuckerhouse' ),
    'add_new_item'               => __( 'Add New Media Tag', 'maisontuckerhouse' ),
    'new_item_name'              => __( 'New Media Tag Name', 'maisontuckerhouse' ),
    'separate_items_with_commas' => __( 'Separate media tags with commas', 'maisontuckerhouse' ),
    'add_or_remove_items'        => __( 'Add or remove media tags', 'maisontuckerhouse' ),
    'choose_from_most_used'      => __( 'Choose from the most used media tags', 'maisontuckerhouse' ),
    'not_found'                  => __( 'No media tags found.', 'maisontuckerhouse' ),
    'no_terms'                   => __( 'No media tags', 'maisontuckerhouse' ),
  ];

  $args = [
    'labels'                => $labels,
    'description'           => __( 'Tags to organize media attachments.', 'maisontuckerhouse' ),
    'public'                => false,
    'publicly_queryable'    => false,
    'hierarchical'          => false,
    'show_ui'               => true,
    'meta_box_cb'           => false,
    'show_admin_column'     => true,
  ];

  register_taxonomy( 'media_tag', 'attachment', $args );
}
add_action( 'init', __NAMESPACE__ . '\\media_tag' );

/**
 * Add featured image thumbnail to post columns in admin view.
 */
function admin_thumbnail_column( $columns ) {
  $col_sec_1 = array_splice( $columns, 0, 1 );
  $col_sec_2 = array_slice( $columns, 0, null, true );
  $col_ins = ['featured_thumb' => 'Thumbnail'];
  $cols_chunk = array_merge( $col_sec_1, $col_ins );
  $columns = array_merge( $cols_chunk, $col_sec_2 );
  // array_splice($columns, 'featured_thumb', 0, 'Thumbnail');
  // $columns['featured_thumb'] = 'Thumbnail';
  return $columns;
}
function admin_thumbnail_column_data( $column, $post_id ) {
  switch ( $column ) {
    case 'featured_thumb':
    echo '<a href="' . get_edit_post_link() . '">';
    echo the_post_thumbnail( 'thumbnail' );
    echo '</a>';
    break;
  }
}
add_filter( 'manage_posts_columns' , __NAMESPACE__ . '\\admin_thumbnail_column' );
add_action( 'manage_posts_custom_column' , __NAMESPACE__ . '\\admin_thumbnail_column_data', 10, 2 );
add_filter( 'manage_pages_columns' , __NAMESPACE__ . '\\admin_thumbnail_column' );
add_action( 'manage_pages_custom_column' , __NAMESPACE__ . '\\admin_thumbnail_column_data', 10, 2 );

/**
 * Custom button shortcode for embedding in posts and pages.
 */
function button_shortcode( $atts ) {
  $args = shortcode_atts( [
    'title' => '',
    'link' => '',
  ], $atts );
  $button_classes;
  if ( in_array( 'red', $atts ) ) {
    $button_classes .= ' red';
  }
  if ( in_array( 'outline', $atts ) ) {
    $button_classes .= ' outline';
  }
  if ( in_array( 'block', $atts ) ) {
    $button_classes .= ' block';
  }

  $button_output = '<div class="btn btn-primary custom-button';
  $button_output .= $button_classes;
  $button_output .= '"><a href="';
  $button_output .= esc_url( $args['link'] );
  $button_output .= '">';
  $button_output .= $args['title'];
  $button_output .= '</a></div>';

  if ( ( ! empty( $args['title'] ) ) && ( ! empty( $args['link'] ) ) ) {
    return $button_output;
  }
}
add_shortcode( 'button', __NAMESPACE__ . '\\button_shortcode' );
