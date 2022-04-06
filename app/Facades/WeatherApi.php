<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class WeatherApi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'weatherapi';
    }
}