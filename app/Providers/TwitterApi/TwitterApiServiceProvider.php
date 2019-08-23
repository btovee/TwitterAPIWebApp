<?php

namespace App\Providers\TwitterApi;

use App\Services\TwitterApi\TwitterApi;
use Illuminate\Support\ServiceProvider;

class TwitterApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Services\TwitterApi\TwitterApi', function ($app) {
            return new TwitterApi();
        });
    }
}
