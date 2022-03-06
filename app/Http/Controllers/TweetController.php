<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;

use Illuminate\Http\Request;

class TweetController extends Controller
{
    private $getTweetNum;

    public function __construct()
    {
        $this->getTweetNum = 5;
    }

    public function index(Type $var = null)
    {
        $connection = new TwitterOAuth(config('twitter.api_key'), config('twitter.api_key_secret'), config('twitter.access_token'), config('twitter.access_token_secret'));
        // $tweets_params = ['screen_name' => 'mchian3' ,'count' => '20'];

        $tweets_params = [
            'q' => '天気 filter:images',
            'result_type' => 'recent',
            'count' => $this->getTweetNum
        ];

        $tweets = $connection->get('/search/tweets', $tweets_params);

        $tweetList = [];
        $i = 0;
        foreach ($tweets as $tweet) {
            foreach ($tweet as $t) {
                $mediaExist = $t->extended_entities ?? '';
                if ($mediaExist) {
                    $media = $t->extended_entities->media;
                    foreach ($media as $m) {
                        $t->mediaUrl = $m->media_url_https;
                    }
                }

                $tweetList[] = $t;
            }
        }
        $tweetList = array_slice($tweetList, 0, $this->getTweetNum);
        // dd($tweetList);

        return view('weather.weather', compact('tweetList'));
    }

    public function ajax(Request $request)
    {//dd($request->destination);
        $connection = new TwitterOAuth(config('twitter.api_key'), config('twitter.api_key_secret'), config('twitter.access_token'), config('twitter.access_token_secret'));

        $tweets_params = [
            'q' => $request->destination . '天気 filter:images',
            // 'result_type' => 'recent',
            'count' => $this->getTweetNum
        ];

        $tweets = $connection->get('/search/tweets', $tweets_params);

        $tweetList = [];
        $i = 0;
        foreach ($tweets as $tweet) {
            foreach ($tweet as $t) {
                $mediaExist = $t->extended_entities ?? '';
                if ($mediaExist) {
                    $media = $t->extended_entities->media;
                    foreach ($media as $m) {
                        $t->mediaUrl = $m->media_url_https;
                    }
                }

                $tweetList[] = $t;
            }
        }
        $tweetList = array_slice($tweetList, 0, $this->getTweetNum);
        // dd($tweetList);

        return response()->json(
            [
                'tweetList' => $tweetList,
            ]
        );
    }
}
