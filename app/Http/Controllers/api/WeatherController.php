<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function getWeather(Request $request)
    {
        $destination = $request->destination;

        $lat = config('const.positions.' . $destination . '.lat');
        $lon = config('const.positions.' . $destination . '.lon');

        $appid = config('const.api.weather.key');

        $url = "http://api.openweathermap.org/data/2.5/weather/?lat={$lat}&lon={$lon}&appid={$appid}";

        //天気取得に必要なデータ取得URL
        // $url = "http://api.openweathermap.org/geo/1.0/direct?q=Sapporo&limit=5&appid={$appid}";

        $weather_json = file_get_contents($url);
        $weather_array = json_decode($weather_json, true);

        return response()->json(
            [
                'data' => $weather_array['weather'][0]['main'],
                'icon' => $weather_array['weather'][0]['icon'],
            ]
        );
    }
}
