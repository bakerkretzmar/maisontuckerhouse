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


// /**
//  * Add featured image thumbnail to post columns in admin view.
//  */
// function add_thumbnail_columns( $columns ) {
//   $columns = array(
//     'cb' => '<input type="checkbox" />',
//     'featured_thumb' => 'Thumbnail',
//     'title' => 'Title',
//     'author' => 'Author',
//     'categories' => 'Categories',
//     'tags' => 'Tags',
//     'comments' => '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>',
//     'date' => 'Date'
//   );
//   return $columns;
// }
//
// function add_thumbnail_columns_data( $column, $post_id ) {
//   switch ( $column ) {
//     case 'featured_thumb':
//     echo '<a href="' . get_edit_post_link() . '">';
//     echo the_post_thumbnail( 'thumbnail' );
//     echo '</a>';
//     break;
//   }
// }
//
// if ( function_exists( 'add_theme_support' ) ) {
//   add_filter( 'manage_posts_columns' , __NAMESPACE__ . '\\add_thumbnail_columns' );
//   add_action( 'manage_posts_custom_column' , __NAMESPACE__ . '\\add_thumbnail_columns_data', 10, 2 );
//   add_filter( 'manage_pages_columns' , __NAMESPACE__ . '\\add_thumbnail_columns' );
//   add_action( 'manage_pages_custom_column' , __NAMESPACE__ . '\\add_thumbnail_columns_data', 10, 2 );
// }
