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
 * Image tags
 */
// function image_tags() {
//   register_taxonomy_for_object_type( 'post_tag', 'attachment' );
// }
// add_action( 'init' , __NAMESPACE__ . '\\image_tags' );


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
    'show_admin_column'     => true,
  ];

  register_taxonomy( 'media_tag', 'attachment', $args );
}
add_action( 'init', __NAMESPACE__ . '\\media_tag' );
