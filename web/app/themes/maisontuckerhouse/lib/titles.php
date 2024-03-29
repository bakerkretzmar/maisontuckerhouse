<?php

namespace Roots\Sage\Titles;

/**
 * Page titles
 */
function title() {
  if (is_home()) {// Returns true for the "Posts Page", e.g. Blog–EN
    if (get_option('page_for_posts', true)) {
      return get_the_title(get_option('page_for_posts', true));
    } else {
      return __('Latest Posts', 'maisontuckerhouse');
    }
  } elseif (is_archive()) {
    return get_the_archive_title();
  } elseif (is_search()) {
    return sprintf(__('Search Results for “%s”', 'maisontuckerhouse'), get_search_query());
  } elseif (is_404()) {
    return __('Not Found', 'maisontuckerhouse');
  // } elseif (is_front_page()) {
  //   return __('Front Page!', 'maisontuckerhouse');
  } else {
    return get_the_title();
  }
}
