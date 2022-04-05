<?php

namespace Leolopez\Loginsv;

use \Illuminate\Support\ServiceProvider;
use Leolopez\Loginsv\Oauth\LoginSvAuth;

class LoginSvServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //Loading routes
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        // Creating the factory
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'loginsv',
            function ($app) use ($socialite) {
                $config = $app['config']['services.loginsv'];
                return $socialite->buildProvider(LoginSvAuth::class, $config);
            }
        );

        // Publishin assets
        $this->publishes([
            __DIR__.'/config/loginsv.php' => config_path('loginsv.php'),
            __DIR__.'/Http/Controllers/LoginSvController.php' => base_path().'/app/Http/Controllers/LoginSvController.php',
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Setting the url for configuration file
        $this->mergeConfigFrom(
            __DIR__.'/config/loginsv.php',
            'loginsv'
        );

        // Registering the Login SV Provider Facade
        $this->app->singleton('loginsv', function ($app) {
            return new LoginSv($app['config']['loginsv']);
        });

        // Registering the Login SV Controller Facade
        $this->app->singleton('loginsvauth', function ($app) {
            return new LoginSvController();
        });
    }
}
