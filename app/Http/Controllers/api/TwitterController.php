<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TwitterApi;
use Illuminate\Http\Request;

class TwitterController extends Controller
{
    // private $twitterApi;

    public function __construct(TwitterApi $twitterApi)
    {
        // $this->twitterApi = $twitterApi;
    }

    public function getTweets(Request $request)
    {
        $destination = $request->destination;

        $tweetWeatherList = \TwitterApi::getTweets($destination, '#イマソラ');

        $tweetFoodList = \TwitterApi::getTweets($destination, '美味しい');

        if ($tweetWeatherList && $tweetFoodList) {

            return response()->json(
                [
                    'weather' => $tweetWeatherList,
                    'food'    => $tweetFoodList,
                ]
            );
        } else {

            throw new \Exception;
        }
    }
}
