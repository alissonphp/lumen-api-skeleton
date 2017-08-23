<?php

namespace App\Providers;

use Illuminate\Redis\RedisServiceProvider;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Mongodb\MongodbServiceProvider;
use Laravel\Socialite\SocialiteServiceProvider;
use Tymon\JWTAuth\Providers\LumenServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(LumenServiceProvider::class);
        $this->app->register(MongodbServiceProvider::class);
        $this->app->register(SocialiteServiceProvider::class);
        $this->app->register(RedisServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(CommandsServiceProvider::class);
    }
}
