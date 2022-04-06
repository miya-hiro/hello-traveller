<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class WeatherApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('weatherapi', 'App\Services\WeatherApi');
        // $this->app->singleton('weatherapi', function () {
        //     return new WeatherApi();
        // });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
