<?php

namespace Roots\Sage\Customizer;

use Roots\Sage\Assets;

/**
 * Add postMessage support
 */
function customize_register($wp_customize) {
  require_once dirname(__FILE__) . '/customizer/select/google-font-dropdown-custom-control.php';

  $wp_customize->get_setting('blogname')->transport = 'postMessage';

  $wp_customize->add_panel( 'colors', array(
    'title' => __( 'Colors', 'cyon' ),
    'priority' => 10,
  ) );

  $wp_customize->add_section( 'colors_general', array(
    'title' => __( 'General', 'cyon' ),
    'panel' => 'colors',
    'priority' => 10,
  ) );

  $wp_customize->add_setting('general_color', array(
    'default'     => '#000000',
    'transport'         => 'postMessage',
  ));
  $wp_customize->add_control( new \WP_Customize_Color_Control(
    $wp_customize,
    'cyon_general_color',
    array(
      'label'   => __( 'General Color', 'cyon' ),
      'section'     => 'colors_general',
      'settings'     => 'general_color',
      'type'    => 'color',
      )
  ));

  $wp_customize->add_setting('general_a_color', array(
    'default'     => '#000000',
    'transport'         => 'postMessage',
  ));
  $wp_customize->add_control( new \WP_Customize_Color_Control(
    $wp_customize,
    'cyon_general_a_color',
    array(
      'label'   => __( 'Link Color', 'cyon' ),
      'section'     => 'colors_general',
      'settings'     => 'general_a_color',
      'type'    => 'color',
      )
  ));

  $wp_customize->add_setting( 'google_font_setting', array(
      'default'        => '',
      'transport'         => 'postMessage',
  ) );
  $wp_customize->add_control( new \Google_Font_Dropdown_Custom_Control(
    $wp_customize,
    'google_font_setting_general',
    array(
        'label'   => 'Google Font Setting',
        'section' => 'colors_general',
        'settings'   => 'google_font_setting',
        'priority' => 12
      )
  ));

}
add_action('customize_register', __NAMESPACE__ . '\\customize_register');

/**
 * Customizer JS
 */
function customize_preview_js() {
  wp_enqueue_script('sage/customizer', Assets\asset_path('scripts/customizer.js'), [ 'jquery', 'customize-preview'], null, true);
}
add_action('customize_preview_init', __NAMESPACE__ . '\\customize_preview_js');
