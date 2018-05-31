# CYON 3

## Vendors
* Sage 8.5.2: [https://github.com/roots/sage](https://github.com/roots/sage)
* Bootstrap 4.1: [https://getbootstrap.com/](https://getbootstrap.com/)
* FontAwesome 5: [http://fontawesome.io/icons/](http://fontawesome.io/icons/)
* Gmap3 7.2: [http://gmap3.net/](http://gmap3.net/)
* TGM Plugin Activation [http://tgmpluginactivation.com/](http://tgmpluginactivation.com/)
* Twitter Php [https://github.com/dg/twitter-php](https://github.com/dg/twitter-php)

## Usage
* Navigate to themes/ and open git bash
* Run `git clone https://github.com/gtwebsite/cyon3.git foldername`
* Run `npm install`
* Run `bower install`
* Run `composer install`
* Update assets/manifest.json devUrl:

## Notes
* All text in PHP should be using text domain `cyon`
* Menu, widgets, and other settings should be in lib/setup.php
* All overrides, custom function, shortcodes, etc, should be in lib/extras.php and using namespace
* Remove unused css in assets/styles/main.scss, like gform and woocommerce
* Remove unused scripts in bower.json and its reference in assets/scripts/main.js, like stellar, swiper, jssocials, and localScroll.

## Available Shortcodes
* Fontawesome 5 icon: `[fa icon="" link=""]`
* Gmap3: `[map lat="" lng="" zoom="" height="" icon=""]` - create ACF field global `google_map_key` and [enter api key](https://developers.google.com/maps/documentation/javascript/get-api-key)
* Instagram: `[instagram token="" limit=""]` - get [token here](http://instagram.pixelunion.net/)
* Twitter Search: `[twitter_search consumer_key="" consumer_secret="" access_token="" access_token_secret="" search="" limit=""]`

## Plugins Required
* Bootstrap 3 Shortcodes
* Soil [https://github.com/roots/soil](https://github.com/roots/soil)

## Plugins Recommended
* Duplicate Post
* Regenerate Thumbnails
* Advanced Custom Fields
* Widget CSS Classes
* Widget Visibility Without Jetpack
* Better Search Replace

## Plugins Supported
* Woocommerce
* Yith Woocommerce Advanced Reviews - required for Woocommerce
* Gravity Form

## Gravity Form field classnames

Make sure to enable HTML 5 and disable styles in settings.

* nolabel
* nosublabel
* gclear
* ghalf
* gthird
* gfourth
* gfloat
* radio-inline
* single-check
