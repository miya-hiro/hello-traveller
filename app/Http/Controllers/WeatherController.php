<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    private $getTweetNum;

    public function __construct()
    {
        $this->getTweetNum = 10;
    }

    public function index(Type $var = null)
    {
        return view('weather.index');
    }

    public function ajax(Request $request)
    {
        $destination = $request->destination;

        /**
         * ここから天気
         */
        $lat = config('const.' . $destination . '.lat');
        $lon = config('const.' . $destination . '.lon');

        $appid = config('weather.api_key');

        $url = "http://api.openweathermap.org/data/2.5/weather/?lat={$lat}&lon={$lon}&appid={$appid}";

        //天気取得に必要なデータ取得URL
        // $url = "http://api.openweathermap.org/geo/1.0/direct?q=Sapporo&limit=5&appid={$appid}";

        $weather_json = file_get_contents($url);
        $weather_array = json_decode($weather_json, true);

        $weather = [];
        $weather['weather'] = $weather_array['weather'][0]['main'];
        $weather['icon'] = $weather_array['weather'][0]['icon'];



        /**
         * ここからツイッター取得
         */
        // $connection = new TwitterOAuth(config('twitter.api_key'), config('twitter.api_key_secret'), config('twitter.access_token'), config('twitter.access_token_secret'));

        //指定ワード
        // $q =  $destination . ' 天気 -相互 filter:images -#相互RT exclude:retweets -#OpenWeatherMap -from:mint_tanpopo';

        $tweetWeatherList = $this->getTweetByKeywords($destination, '#イマソラ');

        $tweetFoodList = $this->getTweetByKeywords($destination, '美味しい');

        return response()->json(
            [
                'weather' => $weather,
                'tweetWeatherList' => $tweetWeatherList,
                'tweetFoodList' => $tweetFoodList,
            ]
        );
    }

    public function getTweetByKeywords($destination, $keyword)
    {
        $connection = new TwitterOAuth(config('twitter.api_key'), config('twitter.api_key_secret'), config('twitter.access_token'), config('twitter.access_token_secret'));

        $q =  $destination . $keyword . ' -相互 filter:images -#相互RT exclude:retweets';
        // dd($q);

        $tweets_params = [
            'q' => $q,
            'count' => $this->getTweetNum,
            'tweet_mode' => 'extended', //ここ！(text->full_text) 画像表示が直る
        ];
        // dd($tweets_params);
        $tweetList = $connection->get('/search/tweets', $tweets_params)->statuses;
        // dd($tweetList);
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
