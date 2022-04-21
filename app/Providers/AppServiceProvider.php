<?php

namespace App\Providers;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TwitterOAuth::class, function () {
            return new TwitterOAuth(
                config('const.api.twitter.key'),
                config('const.api.twitter.key_secret'),
                config('const.api.twitter.access_token'),
                config('const.api.twitter.access_token_secret')
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
