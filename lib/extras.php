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


/****** Start Common ******/
// FontAwesome shortcode [fa icon="" link="" xclass=""]
function fa_func( $atts ) {
  $atts = shortcode_atts( array(
    'icon'    => '',
    'link'    => '',
    'xclass'  => ''
  ), $atts );
  $html = '';
  if( $atts['link'] ) {
    $html .= '<a href="'.$atts['link'].'" target="_blank" class="social-link">';
  }
  $html .= '<i class="fa fa-'.$atts['icon'].' '.$atts['xclass'].'"></i>';
  if( $atts['link'] ) {
    $html .= '</a>';
  }
  return $html;
}
add_shortcode( 'fa', __NAMESPACE__ . '\\fa_func' );

// Content and uploading files
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

/****** End Common ******/



/****** Start Gform ******/
if ( class_exists( 'GFCommon' ) ) {

  // Scripts move to footer
  add_filter('gform_init_scripts_footer', '__return_true');

  // Activate credit card
  add_filter( 'gform_enable_credit_card_field', '__return_true', 11 );

  // Replace submit button
  add_filter( 'gform_submit_button', __NAMESPACE__ . '\\form_submit_button', 10, 2 );
  function form_submit_button( $button, $form ) {
    if( !is_admin() ){
      return '<button class="btn btn-primary" id="gform_submit_button_'.$form['id'].'">'.$form['button']['text'].'</button>';
    }
  }

  // Replace error message
  add_filter( 'gform_validation_message', __NAMESPACE__ . '\\change_message', 10, 2 );
  function change_message( $message, $form ) {
    if( !is_admin() ){
      return '<div class="validation_error alert alert-danger">' . __( 'There was a problem with your submission.', 'gravityforms' ) . ' ' . __( 'Errors have been highlighted below.', 'gravityforms' ) . '</div>';
    }
  }

}
/****** End Gform ******/


/****** Start Woocommerce ******/
if ( function_exists ( 'WC' ) ) {

  // Remove styles
  add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

  // Columns on product list
  add_filter('loop_shop_columns', function(){ return 3; }, 99);

  // Products per page
  add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 15;' ), 20 );

  // Detail page wrapper
  add_action( 'woocommerce_before_single_product_summary', __NAMESPACE__ . '\\woo_custom_detail_wrapper_start', 5 );
  function woo_custom_detail_wrapper_start(){
    echo '<div class="woo-detail-wrapper row">';
  }
  add_action('woocommerce_after_single_product_summary', __NAMESPACE__ . '\\woo_custom_detail_wrapper_end', 5);
  function woo_custom_detail_wrapper_end(){
    echo '</div>';
  }

  // Reorder detail page
  remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
  add_action('woocommerce_after_single_product_summary', 'woocommerce_show_product_images', 2 );
  remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
  add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 15 );
  remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

  // Share icons
  add_action('woocommerce_single_product_summary', __NAMESPACE__ . '\\woocommerce_template_single_share', 99 );
  function woocommerce_template_single_share(){
    echo '<div class="socialshare"><h5>Share this product:</h5><div class="sharebuttons"></div></div>';
  }

  // Change gallery thumb columns
  add_filter ( 'woocommerce_product_thumbnails_columns', function(){ return 4; }, 99 );

  // Change related columns
  add_filter( 'woocommerce_output_related_products_args', __NAMESPACE__ . '\\woo_related_products_args', 99 );
  function woo_related_products_args( $args ){
    $args['posts_per_page'] = 4;
    $args['columns'] = 4;
    return $args;
  }

}
/****** End Woocommerce ******/

/****** Start Instagram ******/
function get_instagram_feeds($access_token, $count) {
  // Get token here: http://instagram.pixelunion.net/
  $url = 'https://api.instagram.com/v1/users/self/media/recent/?count=' . $count . '&access_token=' . $access_token;
  try {
    $curl_connection = curl_init($url);
    curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
    $ig_response = json_decode(curl_exec($curl_connection), true);
    curl_close($curl_connection);
    $index = 0;
    foreach ( $ig_response["data"] as $ig_data ) {
      if ( $ig_data["type"] == "video" ) {
        $url         = $ig_data["videos"]["standard_resolution"]["url"];
        $video_cover = $ig_data["images"]["standard_resolution"]["url"];
      } else {
        $url         = $ig_data["images"]["standard_resolution"]["url"];
        $video_cover = null;
      }
      $ig_result[$index] = array(
        'message'      => null,
        'created_time' => date('Y/m/d H:i:s', $ig_data["created_time"]),
        'type'         => $ig_data["type"],
        'url'          => $url,
        'video_cover'  => $video_cover,
        'link'         => $ig_data["link"]
      );
      $index++;
    }
    return $ig_result;
  } catch (Exception $e) {
    return $e->getMessage();
  }
}


function instagram_func( $atts ) {
    $a = shortcode_atts( array(
        'token' => '',
        'limit' => '12',
    ), $atts );
		$result = '';
		$feed = __NAMESPACE__ . '\\' . get_instagram_feeds( $a['token'], $a['limit'] );

		if( $feed ) {
			$result .= '<ul class="instagram-feed list-unstyled row">';
			foreach ( $feed as $f ) {
				$result .= '<li class="col-md-3 col-sm-4 col-xs-6"><a href="'.$f['url'].'" class="fancybox" rel="instagram[]"><img src="'.$f['url'].'" /></a></li>';
			}
			$result .= '</ul>';
		}
    return $result;
}
add_shortcode( 'instagram', __NAMESPACE__ . '\\instagram_func' );

/****** End Instagram ******/
