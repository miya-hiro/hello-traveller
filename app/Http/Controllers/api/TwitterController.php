<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TwitterApi;
use Illuminate\Http\Request;

class TwitterController extends Controller
{
    public function getTweets(Request $request)
    {
        $destination = $request->destination;

        $tweetWeatherList = \TwitterApi::getTweets($destination, '#イマソラ');

        $tweetFoodList = \TwitterApi::getTweets($destination, '美味しい');

        if (!$tweetWeatherList || !$tweetFoodList) {

            throw new \Exception; //弾く処理を先に書く //abort でもよい
        }

        return response()->json(
            [
                'weather' => $tweetWeatherList,
                'food'    => $tweetFoodList,
            ]
        );
    }
}
