<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;

use Illuminate\Http\Request;

class TweetController extends Controller
{
    private $api_key;
    private $api_key_secret;
    private $access_token;
    private $access_token_secret;



    public function index(Type $var = null)
    {
        $connection = new TwitterOAuth(config('twitter.api_key'),config('twitter.api_key_secret'), config('twitter.access_token'), config('twitter.access_token_secret'));
        $tweets_params = ['screen_name' => 'mchian3' ,'count' => '20'];
        $tweets = $connection->get('statuses/user_timeline', $tweets_params);

        return view('home',compact('tweets'));
    }
}
