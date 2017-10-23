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
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'cyon') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');


/**
 * Content and uploading files
 */
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
  global $wp_version;
  if ( $wp_version == '4.7' || ( (float) $wp_version < 4.7 ) ) {
     return $data;
  }
  $filetype = wp_check_filetype( $filename, $mimes );
  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];
}, 10, 4 );

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', __NAMESPACE__ . '\\cc_mime_types');


add_filter( 'acf_the_content', __NAMESPACE__ . '\\remove_empty_p', 999, 1 );
add_filter( 'widget_text', __NAMESPACE__ . '\\remove_empty_p', 999, 1 );
function remove_empty_p( $content ){
  // clean up p tags around block elements
  $content = preg_replace( array(
    '#<p>\s*<(div|aside|section|article|header|footer)#',
    '#</(div|aside|section|article|header|footer)>\s*</p>#',
    '#</(div|aside|section|article|header|footer)>\s*<br ?/?>#',
    '#<(div|aside|section|article|header|footer)(.*?)>\s*</p>#',
    '#<p>\s*</(div|aside|section|article|header|footer)#',
  ), array(
    '<$1',
    '</$1>',
    '</$1>',
    '<$1$2>',
    '</$1',
  ), $content );
  return preg_replace('#<p>(\s|&nbsp;)*+(<br\s*/*>)*(\s|&nbsp;)*</p>#i', '', $content);
}
add_filter( 'widget_text', 'do_shortcode', 11);


/****** End Common ******/


