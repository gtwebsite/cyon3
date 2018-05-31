<?php

add_shortcode( 'facebook_posts', 'facebook_posts_func' );
function facebook_posts_func( $atts ){
  $html = '';

  $fb = new Facebook\Facebook([
    'app_id' => '145896749585084',
    'app_secret' => 'c43e8bf50056e5fbbd319ba8ea1db39a',
    'default_graph_version' => 'v2.12',
    ]);

  try {
    //116300985894230
    //100025429879284
    //550491352
    //10155133418026353
    //244f924d9e9d71b752866a104b867a21
    $response = $fb->get('me?fields=id,name', 'EAACEdEose0cBAPhFkCWb6WcRW5lGkNS68NC6MYZBp4ymluj1nTYxWuRW1dalPWXFZC5w7gtQSgP56I0ZCtT0hKZAxNamz3wPCMkui1gw0hA8YZAIayQgIvQYOnhYgWTjZACzPjYq8dY5ZB3C1bt8xuscb6ZCrhZAGIr2ZC1y3WEjUzo4IZCRyaGgnEZBeTP2NNGcGroZD');
    $graphEdge = $response->getGraphEdge();
    var_dump( $graphEdge );

  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    $html .= 'Graph returned an error: ' . $e->getMessage();
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    $html .= 'Graph returned an error: ' . $e->getMessage();
  }

  return $html;
}