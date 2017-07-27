/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

 // Mobile Detect
 var md = new MobileDetect(window.navigator.userAgent);

(function($) {
  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages

        // matchHeight
        $('.matchHeight, ul.products').each(function() {
          $(this).find('.matchItem, .woocommerce-LoopProduct-link').matchHeight();
        });

        // jssocials
        $('.sharebuttons').jsSocials({
          shares: ['facebook','twitter','googleplus','pinterest','email'],
          shareIn: 'popup'
        });

        // flexnav
        $('.flexnav').data('breakpoint','991').flexNav({
          calcItemWidths: true
        });

        // jquery.stellar
        if ( !md.mobile() ) {
          $.stellar({
            horizontalScrolling: false,
            responsive: false,
          });
        }

        // jquery.localScroll
        var offset = 0;
        if ( !md.mobile() ) {
          offset = -70;
        }
        $('.pagetoscroll, .woocommerce-product-rating').localScroll({ offset: offset, easing:'easeInOutExpo' });

        // gmap3
        $('.gmap').each(function(){
          var elem = $(this);
          elem.gmap3({
            center: [elem.data('lat'), elem.data('lng')],
            zoom: elem.data('zoom'),
            scrollwheel: false,
            streetViewControl: false,
            navigationControl: false
          }).marker([
            {position:[elem.data('lat'), elem.data('lng')], icon: new google.maps.MarkerImage( elem.data('icon'), new google.maps.Size(64, 64), null, null, new google.maps.Size(64, 64) )}
          ]);
        });

        // Swiper
        $('.swiper-slide').each(function(){
          var elem = $(this);
          elem.find('.swiper-container').swiper({
            autoplay: 10000,
            loop: true,
            preventClicks: false,
            pagination: elem.find('.swiper-pagination'),
            paginationClickable: true,
            nextButton: elem.find('.swiper-button-next'),
            prevButton: elem.find('.swiper-button-prev'),
          });
        });

        $(window).scroll(function() {
            if ( $(window).scrollTop() > 160 ) {
                $('.banner-sticky').addClass('sticked');
            } else {
                $('.banner-sticky').removeClass('sticked');
            }
            if (jQuery(window).scrollTop() > jQuery(window).height() ) {
                jQuery('.backtotop').addClass('active');
            } else {
                jQuery('.backtotop').removeClass('active');
            }
        });
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
