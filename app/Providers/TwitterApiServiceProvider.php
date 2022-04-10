<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TwitterApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('twitterapi', 'App\Services\TwitterApi');
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
