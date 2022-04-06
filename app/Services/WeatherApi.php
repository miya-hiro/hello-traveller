<?php

namespace App\Services;

class WeatherApi
{
  public function getData($destination): array
  {
    $lat = config('const.positions.' . $destination . '.lat');
    $lon = config('const.positions.' . $destination . '.lon');
    $appid = config('const.api.weather.key');

    $url = "http://api.openweathermap.org/data/2.5/weather/?lat={$lat}&lon={$lon}&appid={$appid}";

    $weather_json = file_get_contents($url);

    return json_decode($weather_json, true);
  }
}
