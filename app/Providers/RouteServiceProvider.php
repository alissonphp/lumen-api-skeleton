<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    protected $modules;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {

        $this->modules = config('modules.modules');

        $this->app->group([
            'namespace' => 'App\Modules',
            'prefix' => 'v1'
        ], function ($app) {

            while (list(, $module) = each($this->modules)) {

                if (file_exists(__DIR__ . '/../Modules/' . $module . '/routes.php')) {

                    $this->app->group([
                        'namespace' => $module . '\Controllers',
                        'prefix' => strtolower($module)
                    ], function ($app) use ($module) {

                        require __DIR__ . '/../Modules/' . $module . '/routes.php';

                    });

                    Log::info('Registering dynamic reading of the module routes :: ' . $module);

                }
            }

        });


    }
}
