<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/
  add_theme_support('soil-clean-up'); // Cleaner markup
  add_theme_support('soil-disable-asset-versioning'); // Disable asset versioning
  add_theme_support('soil-disable-trackbacks'); // Disable trackbacks and pingbacks
  // add_theme_support('soil-google-analytics', 'UA-XXXXX-Y'); // Google Analytics
  add_theme_support('soil-jquery-cdn'); // Load jQuery from the CDN
  add_theme_support('soil-js-to-footer'); // Force all WordPress JS to footer
  add_theme_support('soil-nav-walker'); // Clean navigation menus
  add_theme_support('soil-nice-search'); // Pretty search URLs
  add_theme_support('soil-relative-urls'); // Use relative URLs

  // Make theme available for translation, load language files locally
  load_theme_textdomain('maisontuckerhouse', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'maisontuckerhouse')
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Enable gallery post format
  // http://codex.wordpress.org/Post_Formats
  // add_theme_support('post-formats', ['gallery']);

  // Enable pae excerpts
  // https://codex.wordpress.org/Function_Reference/add_post_type_support
  add_post_type_support( 'page', 'excerpt' );

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'maisontuckerhouse'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Secondary', 'maisontuckerhouse'),
    'id'            => 'sidebar-secondary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer 1', 'maisontuckerhouse'),
    'id'            => 'sidebar-footer-l',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer 2', 'maisontuckerhouse'),
    'id'            => 'sidebar-footer-m',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer 3', 'maisontuckerhouse'),
    'id'            => 'sidebar-footer-r',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
  ]);

  return apply_filters('maisontuckerhouse/display_sidebar', $display);
}

/**
 * Register theme documentation admin page
 */
function tuckerhouse_docs() {
	add_menu_page( __('Theme Documentation', 'maisontuckerhouse'), __('Theme Docs', 'maisontuckerhouse'), 'read', 'tuckerhouse-docs', __NAMESPACE__ . '\\tuckerhouse_docs_render', 'dashicons-info', 85 );
}
function tuckerhouse_docs_render() {
  echo '<html><head><style>';
  include get_template_directory() . '/docs.css';
  echo '</style></head><body>';
  include get_template_directory() . '/docs.html';
  echo '</body></html>';
}
add_action( 'admin_menu', __NAMESPACE__ . '\\tuckerhouse_docs' );

/**
 * Remove comments menu
 */
function hide_comments() {
  remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', __NAMESPACE__ . '\\hide_comments' );

/**
 * Admin styles
 */
function admin_styles() {
  echo '<style>
    table.fixed { table-layout: auto; }
    img.attachment-thumbnail.size-thumbnail.wp-post-image { display: block; }
    td.featured_thumb.column-featured_thumb { width: 150px; }
    td.featured_thumb.column-featured_thumb > a { display: block; }
  </style>';
}
add_action('admin_head', __NAMESPACE__ . '\\admin_styles');

/**
 * Allow editors to manage menus and widgets
 */
function editor_edits( $caps ) {
	/* check if the user has the edit_pages capability */
	if ( ! empty( $caps[ 'edit_pages' ] ) ) {
		/* give the user the edit theme options capability */
		$caps[ 'edit_theme_options' ] = true;
	}
	return $caps;
}
add_filter( 'user_has_cap', __NAMESPACE__ . '\\editor_edits' );

/**
 * Theme assets
 */
function assets() {
  wp_enqueue_style('maisontuckerhouse/css', Assets\asset_path('styles/main.css'), false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_enqueue_script('maisontuckerhouse/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);
