# Rest API Lumen Skeleton

Basic structure for creating REST APIs using Lumen Framework and extra packages

### System requirements

- PHP >= 5.6.4
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Mongo DB drive
- PHPUnit
- Redis Drive

### Installation


```sh
$ git clone https://github.com/alissonphp/lumen-api-skeleton
$ cd lumen-api-skeleton/
```
IMPORTANT: configure .env (copy .env.example) at the root of the application with the development variables: connections with MySQL and MongoDB, APP Ids of the authentication services (google, facebook).
```sh
$ composer install
$ php artisan jwt:secret
$ php artisan migrate
$ php artisan db:seed
$ php -S localhost:8000 -t public
```

Development server running in: http://localhost:8000

### Packages Used

- Lumen Micro Framework [https://lumen.laravel.com/docs/5.4/]
- Socialite [https://github.com/laravel/socialite]
- JWT Auth [https://github.com/tymondesigns/jwt-auth/]
- Laravel MongoDB [https://github.com/jenssegers/laravel-mongodb]
- Predis [https://github.com/nrk/predis]

### Modularization

The application is architected in Modules. Each module has defined responsibility and
  Layers. The standard model of a module follows the following structure:
 
 ```
 app
 └───Modules
 │   │   Controllers
 │   │   Events
 │   │   Listeners
 │   │   Middlewares
 │   │   Models
 │   │   Supports
 │   │   Tests
 │   │   routes.php
 ```
 
To enable / disable the functionality of a module simply inform the Namespace in the array of the config / modules.php file
Important to verify interoperability between modules before deactivating it.
 
### Routes

Routes are defined in the routes.php files within the root directory of each module.
The RouteServiceProvider is responsible for loading the routes of each module defined in config / modules.php. No need to instantiate new calls.

### Endpoints composition

- Model : localhost:8000 + api version + module namespace + action + parameters, 
for example: http://localhost:8000/v1/oauth/login/google or http://localhost:8000/v1/oauth/login/google/callback

### Tests
There are two types of tests: Integration and Unit. The default directory where the cases should be is /Tests within the module under development.
For integration tests use the "test + type + Test" naming standard, for example: LoginIntegrationTest (test: Login, type: Integration).

Run the tests using the command referencing the testsuite as 'unit' or 'integration':

```sh
$ phpunit --testsuite integration
$ phpunit --testsuite unit
```

### Contributions

The purpose of this repository is to create a fast model for implementing REST APIs using the Lumen Framework. We still have enough to get close to an "ideal" model: rules for accessing endpoints, improving standards, writing tests, translations, etc.

#### Fork, enjoy and join us in this project! Send yours pull requests, share to your friends.
