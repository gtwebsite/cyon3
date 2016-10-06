# CYON 3

## Vendors
* Sage 8.5.0: [https://github.com/roots/sage](https://github.com/roots/sage)
* Bootstrap 4 - Alpha 4: [https://v4-alpha.getbootstrap.com/](https://v4-alpha.getbootstrap.com/)
* Family.SCSS 1.0.8: [https://lukyvj.github.io/family.scss/](https://lukyvj.github.io/family.scss/)
* FontAwesome 4.6.3: [http://fontawesome.io/icons/](http://fontawesome.io/icons/)

## Usage
* Navigate to themes/ and open git bash
* Run `git clone https://github.com/gtwebsite/cyon3.git foldername`
* Run `npm install`
* Run `bower install`
* Change assets/manifest.json devUrl:

## Notes
* All text in PHP should be using text domain `cyon`
* Menu, widgets, and other settings should be in lib/setup.php
* All overrides, custom function, shortcodes, etc, should be in lib/extras.php and using namespace
* Remove unused css in assets/styles/main.scss, like gform and woocommerce
* Remove unused scripts in bower.json and its reference in assets/scripts/main.js, like stellar, swiper, jssocials, and localScroll.

## Available Shortcodes
* Fontawesome icon: `[fa icon="" link=""]`

## Plugins Required
* Bootstrap 3 Shortcodes
* Soil [https://github.com/roots/soil](https://github.com/roots/soil)

## Plugins Recommended
* Duplicate Post
* Image Widget
* Regenerate Thumbnails
* Advanced Custom Fields
* Widget CSS Classes
* Widget Visibility Without Jetpack
* Black Studio TinyMCE Widget
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