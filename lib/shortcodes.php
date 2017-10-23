<?php

namespace Roots\Sage\Shortcodes;

/**
 * FontAwesome
 */
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

/**
 * Gmap3
 */
function map_func( $atts ) {
  $atts = shortcode_atts( array(
    'lat'       => '',
    'lng'       => '',
    'zoom'      => '16',
    'height'    => '600px',
    'icon'      => get_bloginfo('stylesheet_directory') . '/dist/images/pin.png',
    'xclass'    => ''
  ), $atts );
  $html = '<div class="gmap '.$atts['xclass'].'" data-lat="'.$atts['lat'].'" data-lng="'.$atts['lng'].'" data-zoom="'.$atts['zoom'].'" data-icon="'.$atts['icon'].'" style="height: '.$atts['height'].'"></div>';
  return $html;
}
add_shortcode( 'map', __NAMESPACE__ . '\\map_func' );


/**
 * Instagram
 */
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
		$feed = get_instagram_feeds( $a['token'], $a['limit'] );

		if( is_array( $feed ) ) {
			$result .= '<ul class="instagram-feed list-unstyled row-sm">';
			foreach ( $feed as $f ) {
				$result .= '<li class="col-3"><a href="'.$f['url'].'" data-fancybox="instagram-fancybox"><img src="'.$f['url'].'" /></a></li>';
			}
			$result .= '</ul>';
		}else{
      $result .= '<div class="alert alert-danger" role="alert">' . __('Error connecting...','cyon') . '</div>';
    }
    return $result;
}
add_shortcode( 'instagram', __NAMESPACE__ . '\\instagram_func' );


/**
 * Twitter
 */
function twitter_search_func( $atts ) {
  $a = shortcode_atts( array(
      'consumer_key' => '',
      'consumer_secret' => '',
      'access_token' => '',
      'access_token_secret' => '',
      'search' => '',
      'limit' => '4',
  ), $atts );
  $twitter = new \Twitter( $a['consumer_key'], $a['consumer_secret'], $a['access_token'], $a['access_token_secret'] );

  try {
    $results = $twitter->search( array( 'q' => $a['search'], 'count' => $a['limit'], 'lang' => 'en', 'result_type' => 'popular' ) );
  } catch (TwitterException $e) {
    echo $e->getMessage();
  }

  $result = '';
  if( $results ) {
    $result .= '<div class="tweet-list row row-sm row-centered matchHeight">';
    foreach ($results as $feed) {
      $retweet_count = '';
      if( $feed->retweet_count > 0 ) {
        $retweet_count = ' ' . $feed->retweet_count;
      }
      $favorite_count = '';
      if( $feed->favorite_count > 0 ) {
        $favorite_count = ' ' . $feed->favorite_count;
      }
      $result .= '
      <div class="col-sm-6 col-lg-3">
        <div class="card card-tweet">
          <div class="card-block">
            <div class="matchItem">
              <div class="clearfix mb-2">
                <a href="https://twitter.com/' . $feed->user->screen_name . '" target="_blank" class="card-link"><i class="fa fa-twitter"></i></a>
                <a class="card-tweet-head" href="https://twitter.com/' . $feed->user->screen_name . '" target="_blank">
                  <img src="' . $feed->user->profile_image_url_https . '" alt="" />
                  <h6 class="mb-0">' . $feed->user->name . '</h6>
                  <div class="meta">@' . $feed->user->screen_name . '</div>
                </a>
              </div>
              <p>' . make_clickable($feed->text) . '</p>
            </div>
            <div class="card-tweet-foot d-flex mt-2">
              <a href="https://twitter.com/' . $feed->user->screen_name . '/status/' . $feed->id . '" title="' . __('Reply','cyon') . '" data-toggle="tooltip" target="blank"><i class="fa fa-reply"></i></a>
              <a href="https://twitter.com/intent/retweet?tweet_id=' . $feed->id . '" title="' . __('Retweet','cyon') . '" data-toggle="tooltip" target="blank" class="ml-2"><i class="fa fa-retweet"></i>'.$retweet_count.'</a>
              <a href="https://twitter.com/' . $feed->user->screen_name . '/status/' . $feed->id . '" title="' . __('Like','cyon') . '" data-toggle="tooltip" target="blank" class="ml-2"><i class="fa fa-heart-o"></i>'.$favorite_count.'</a>
              <a href="https://twitter.com/' . $feed->user->screen_name . '/status/' . $feed->id . '" title="' . __('Info','cyon') . '" data-toggle="tooltip" target="blank" class="ml-auto"><i class="fa fa-info-circle"></i></a>
            </div>
          </div>
        </div>
      </div>';
    }
    $result .= '</div>';
  }
  return $result;
}
add_shortcode( 'twitter_search', __NAMESPACE__ . '\\twitter_search_func' );