<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function getWeather(Request $request)
    {
        $weather_array = \WeatherApi::getData($request->destination);
        // dd($weather_array);
        if (isset($weather_array['weather'])) {
            // dd('exist');
            return response()->json(
                [
                    'data' => $weather_array['weather'][0]['main'],
                    'icon' => $weather_array['weather'][0]['icon'],
                ]
            );
        } else {
            throw new \Exception;
        }
    }
}
