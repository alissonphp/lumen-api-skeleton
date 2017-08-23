<?php

namespace App\Providers;

use Appzcoder\LumenRoutesList\RoutesCommandServiceProvider;
use Illuminate\Support\ServiceProvider;

class CommandsServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->register(RoutesCommandServiceProvider::class);
    }

}