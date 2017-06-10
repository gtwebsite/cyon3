(function($) {
  // Site title
  wp.customize('blogname', function(value) {
    value.bind(function(to) {
      $('.navbar-brand').text(to);
    });
  });

  wp.customize('general_color', function(value) {
    value.bind(function(to) {
      $('body').css( 'color', to);
    });
  });

  wp.customize('general_a_color', function(value) {
    value.bind(function(to) {
      $('.body a:not(.btn)').css( 'color', to);
    });
  });

  wp.customize('google_font_setting', function(value) {
    value.bind(function(to) {
      $('body').css( 'font-family', to);
      $('head').append('<link href="https://fonts.googleapis.com/css?family='+ to +'" rel="stylesheet" />');
    });
  });

})(jQuery);
