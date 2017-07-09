<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/
  add_theme_support('soil-clean-up');
  add_theme_support('soil-disable-asset-versioning');
  add_theme_support('soil-disable-trackbacks');
  add_theme_support('soil-nav-walker');
  add_theme_support('soil-nice-search');
  //add_theme_support('soil-js-to-footer');
  //add_theme_support('soil-jquery-cdn');
  add_theme_support('soil-relative-urls');

  add_theme_support('woocommerce');
  add_theme_support( 'wc-product-gallery-zoom' );
  add_theme_support( 'wc-product-gallery-lightbox' );
  add_theme_support( 'wc-product-gallery-slider' );

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('cyon', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'cyon'),
    'footer_navigation' => __('Footer Navigation', 'cyon')
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

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
    'name'          => __('Primary', 'cyon'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'cyon'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget matchItem %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
  ]);

  register_sidebar([
    'name'          => __('Header Extra', 'cyon'),
    'id'            => 'sidebar-header',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');


/**
 * Theme Option if ACF Pro exists
 */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-general-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
  // add_action('acf/init', __NAMESPACE__ . '\\custom_acf_init');
}
function custom_acf_init() {
  if( get_field('google_map_key','option') ) {
      acf_update_setting('google_api_key', get_field('google_map_key','option'));
  }
}

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
    is_singular('product'),
    is_page_template('template-fullwidth.php'),
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets() {
  wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, null);
  // wp_enqueue_style('customizer/css', get_bloginfo('stylesheet_directory').'/customizer-css.php', false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  if( get_field('google_map_key','option') ) {
    //wp_enqueue_script('gmap3', 'https://maps.googleapis.com/maps/api/js?key=' . get_field('google_map_key','option'), ['jquery'], null, true);
  }
  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);

function assets_admin() {
  wp_enqueue_script('sage/admin_js', Assets\asset_path('scripts/admin.js'), ['jquery'], null, true);
}
// add_action('admin_enqueue_scripts', __NAMESPACE__ . '\\assets_admin', 100);
