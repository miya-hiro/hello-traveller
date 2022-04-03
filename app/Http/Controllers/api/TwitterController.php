<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Http\Request;

class TwitterController extends Controller
{
    private $connection;

    public function __construct()
    {
        $this->connection = new TwitterOAuth(
            config('const.api.twitter.key'),
            config('const.api.twitter.key_secret'),
            config('const.api.twitter.access_token'),
            config('const.api.twitter.access_token_secret')
        );
    }

    public function getTweets(Request $request)
    {
        $destination = $request->destination;

        //指定ワード
        // $q =  $destination . ' 天気 -相互 filter:images -#相互RT exclude:retweets -#OpenWeatherMap -from:mint_tanpopo';

        $tweetWeatherList = $this->getTweetByKeywords($destination, '#イマソラ');

        $tweetFoodList = $this->getTweetByKeywords($destination, '美味しい');

        return response()->json(
            [
                'weather' => $tweetWeatherList,
                'food'    => $tweetFoodList,
            ]
        );
    }

    private function getTweetByKeywords($destination, $keyword)
    {
        $q =  $destination . $keyword . ' -相互 -手押し filter:images -#相互RT -tele exclude:retweets';

        $tweets_params = [
            'q' => $q,
            'count' => config('const.api.twitter.settings.getNum'),
            'tweet_mode' => 'extended', //ここ！(text->full_text) 画像表示が直る
        ];

        $tweetList = $this->connection->get('/search/tweets', $tweets_params)->statuses;

        foreach ($tweetList as $tweet) {
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

        return $tweetList;
    }
}
