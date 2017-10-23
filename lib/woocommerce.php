<?php

namespace Roots\Sage\Woocommerce;

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