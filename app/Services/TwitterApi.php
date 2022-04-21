<?php

namespace App\Services;

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterApi
{
  private $connection;

  public function __construct(TwitterOAuth $twitterOAuth)
  {
    $this->connection = $twitterOAuth;
  }

  public function getTweets(string $destination, string $keyword)
  {
    $q =  $destination . $keyword . ' -相互 -手押し filter:images -#相互RT -tele exclude:retweets';

    $tweets_params = [
      'q' => $q,
      'count' => config('const.api.twitter.settings.getNum'),
      'tweet_mode' => 'extended', //ここ！(text->full_text) 画像表示が直る
    ];

    $tweetList = $this->connection->get('/search/tweets', $tweets_params);

    //データ取得できなかった場合
    if (property_exists($tweetList, 'errors')) {

      return false;
    }

    foreach ($tweetList->statuses as $tweet) {
      $tweet->mediaUrl = '画像なし'; //初期値

      //画像urlを取得
      $mediaExist = $tweet->extended_entities->media ?? '';

      if ($mediaExist) {
        $media = $tweet->extended_entities->media;
        foreach ($media as $m) {
          if ($m->type === 'photo') {
            $tweet->mediaUrl = $m->media_url_https;
          }
        }
      }
    }

    return $tweetList->statuses;
  }
}
