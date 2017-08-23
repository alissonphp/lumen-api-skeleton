<?php

require_once __DIR__.'/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__.'/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

$app = new Laravel\Lumen\Application(
    realpath(__DIR__.'/../')
);

$app->withFacades(
    true, [
        \Laravel\Socialite\Facades\Socialite::class => 'Socialite',
        \Tymon\JWTAuth\Facades\JWTAuth::class => 'JWTAuth',
        \Tymon\JWTAuth\Facades\JWTFactory::class => 'JWTFactory',
    ]
);
$app->withEloquent();

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->configure('services');
$app->configure('jwt');
$app->configure('auth');
$app->configure('modules');



 $app->routeMiddleware([
     'jwt-auth' => Tymon\JWTAuth\Http\Middleware\Authenticate::class
 ]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);

return $app;
