<?php
header('Content-Type: text/css; charset=utf-8');
header('Cache-control: no-cache, must-revalidate');

$absolute_path = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $absolute_path[0] . 'wp-load.php';
require_once($wp_load);

function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
  $return = '';
  $mod = get_theme_mod($mod_name);
  if ( ! empty( $mod ) ) {
     $return = sprintf('%s { %s:%s; }'."\r\n",
        $selector,
        $style,
        $prefix.$mod.$postfix
     );
     if ( $echo ) {
        echo $return;
     }
  }
  return $return;
}

echo '@import url(\'https://fonts.googleapis.com/css?family='. get_theme_mod('google_font_setting') . '\');'."\r\n\r\n";

generate_css('body', 'color', 'general_color');
generate_css('body', 'font-family', 'google_font_setting');
generate_css('.body a:not(.btn)', 'color', 'general_a_color');
