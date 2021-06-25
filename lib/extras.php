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

function email_signup() {
  $form = '<!--Begin CTCT Sign-Up Form-->
  <!-- EFD 1.0.0 [Wed Aug 23 17:05:00 EDT 2017] -->
  <div class="ctct-embed-signup">
    <h6 id="success_message" class="u-hide" style="display: none; text-align: center;">Thanks for signing up!</h6>
    <form class="ctct-custom-form Form" action="https://visitor2.constantcontact.com/api/signup" method="POST" name="embedded_signup" data-id="embedded_signup:form">
      <h3>' . mth_trans('Sign up for Tucker House and Country Fun email newsletters!') . '</h3>
      <p>' . mth_trans('We thank you for your interest in the great work of Tucker House. Get to know us, come out for a visit, or volunteer!') . '</p>
      <p>' . mth_trans('We send you newsletters and occasional updates on special events, activities, and programs like Country Fun Nature Camp. You can also opt out at any time.') . '</p>

      <!-- The following code must be included to ensure your sign-up form works properly. -->
      <input name="ca" type="hidden" value="481e8452-0d46-480d-80ad-afd1cbf7bb76" data-id="ca:input" />
      <input name="source" type="hidden" value="EFD" data-id="source:input" />
      <input name="required" type="hidden" value="list,email" data-id="required:input" />
      <input name="url" type="hidden" value="" data-id="url:input" />

      <div class="form-group row" data-id="Email Address:p">
        <label class="ctct-form-required col-sm-3 col-form-label" for="ctctEmail" data-id="Email Address:label" data-name="email">' . mth_trans(['en' => 'Email Address', 'fr' => 'Adresse courriel']) . '<span class="text-danger">*</span></label>
        <div class="col-sm-9">
          <input class="form-control" id="ctctEmail" maxlength="80" name="email" type="text" value="" data-id="Email Address:input" />
        </div>
      </div>

      <div class="form-group row" data-id="First Name:p">
        <label class="col-sm-3 col-form-label" for="ctctFirstName" data-id="First Name:label" data-name="first_name">' . mth_trans(['en' => 'First Name', 'fr' => 'Prénom']) . '</label>
        <div class="col-sm-9">
          <input class="form-control" id="ctctFirstName" maxlength="50" name="first_name" type="text" value="" data-id="First Name:input" />
        </div>
      </div>

      <div class="form-group row" data-id="Last Name:p">
        <label class="col-sm-3 col-form-label" for="ctctLastName" data-id="Last Name:label" data-name="last_name">' . mth_trans(['en' => 'Last Name', 'fr' => 'Nom de famille']) . '</label>
        <div class="col-sm-9">
          <input class="form-control" id="ctctLastName" maxlength="50" name="last_name" type="text" value="" data-id="Last Name:input" />
        </div>
      </div>

      <div class="form-group row" data-id="Lists:p">
        <label class="ctct-form-required col-sm-3" data-id="Lists:label" data-name="list">Email Lists<span class="text-danger">*</span></label>
        <div class="col-sm-9">
          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" name="list_0" type="checkbox" value="27" data-id="Lists:input" /><span data-id="Lists:span">' . mth_trans(['en' => 'Country Fun Nature Camp Updates', 'fr' => 'Mise à jour Country Fun Nature Camp']) . '</span>
            </label>
          </div>
        </div>
        <div class="col-sm-9 offset-sm-3">
          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" name="list_1" type="checkbox" value="1" data-id="Lists:input" /><span data-id="Lists:span">' . mth_trans(['en' => 'Tucker House Tidbits', 'fr' => 'E-Tidbits Maison Tucker']) . '</span>
            </label>
          </div>
        </div>
      </div>

      <button class="Button ctct-button Button--block Button-secondary btn btn-primary custom-button block" type="submit" data-enabled="enabled">' . mth_trans(['en' => 'Sign Up!', 'fr' => 'Abonnez-vous!']) . '</button>

      <p class="ctct-form-footer">' . mth_trans([
        'en' => 'By submitting this form, you are granting Maison Tucker House (PO Box 4425 Station E, Ottawa, ON, K1S 5B4), permission to email you. You may unsubscribe via the link found at the bottom of every email. (See our <a href="http://www.constantcontact.com/legal/privacy-statement" target="_blank" rel="noopener">Email Privacy Policy</a> for details.) Emails are serviced by Constant Contact.',
        'fr' => 'En remplissant ce formulaire, vous donnez accès à la Maison Tucker House (PO Box 4425 Station E, Ottawa, ON, K1S 5B4), de vous envoyer des courriels. Vous pouvez vous désabonner grâce au lien inclus à la fin de chaque courriel. (Consultez notre <a href="http://www.constantcontact.com/legal/privacy-statement" target="_blank" rel="noopener">politique de confidentialité</a> des courriels pour plus de détails.) Les courriels sont gérés par Constant Contact.',
        ]) . '</p>
    </form>
  </div>
  <script type="text/javascript">
    var localizedErrMap = {};
    localizedErrMap[\'required\'] = \'This field is required.\';
    localizedErrMap[\'ca\'] = \'An unexpected error occurred while attempting to send email.\';
    localizedErrMap[\'email\'] = \'Please enter your email address in name@email.com format.\';
    localizedErrMap[\'list\'] = \'Please select at least one email list.\';
    localizedErrMap[\'generic\'] = \'This field is invalid.\';
    localizedErrMap[\'shared\'] = \'Sorry, we could not complete your sign-up. Please contact us to resolve this.\';
    var postURL = \'https://visitor2.constantcontact.com/api/signup\';
  </script>
  <script src="https://static.ctctcdn.com/h/contacts-embedded-signup-assets/1.0.2/js/signup-form.js"></script>
  <!--End CTCT Sign-Up Form-->';
  return $form;
}
add_shortcode( 'signupform', __NAMESPACE__ . '\\email_signup' );
