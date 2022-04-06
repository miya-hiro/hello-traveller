<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function getWeather(Request $request)
    {
        $weather_array = \WeatherApi::getData($request->destination);

        return response()->json(
            [
                'data' => $weather_array['weather'][0]['main'],
                'icon' => $weather_array['weather'][0]['icon'],
            ]
        );

         //天気取得に必要なデータ取得URL
        // $url = "http://api.openweathermap.org/geo/1.0/direct?q=Sapporo&limit=5&appid={$appid}";
    }
}
