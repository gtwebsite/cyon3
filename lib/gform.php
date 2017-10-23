<?php

namespace Roots\Sage\Gform;

if ( class_exists( 'GFCommon' ) ) {
  
  // Activate credit card
  add_filter( 'gform_enable_credit_card_field', '__return_true', 11 );

  // Replace error message
  add_filter( 'gform_validation_message', __NAMESPACE__ . '\\change_message', 10, 2 );
  function change_message( $message, $form ) {
    if( !is_admin() ){
      return '<div class="validation_error alert alert-danger">' . __( 'There was a problem with your submission.', 'gravityforms' ) . ' ' . __( 'Errors have been highlighted below.', 'gravityforms' ) . '</div>';
    }
  }

  // Replace spinner
  /*
  add_filter( 'gform_ajax_spinner_url', __NAMESPACE__ . '\\custom_spinner_image', 10, 2 );
  function custom_spinner_image( $image_src, $form ){
    return get_bloginfo('stylesheet_directory') . '/dist/images/loader-default.gif';
  }
  */

}