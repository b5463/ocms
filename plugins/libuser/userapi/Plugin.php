<?php namespace LibUser\Userapi;

use Illuminate\Auth\AuthManager;
use Illuminate\Auth\AuthServiceProvider;
use Tymon\JWTAuth\Http\Middleware\Authenticate;
use Illuminate\Contracts\Auth\Factory;
use System\Classes\PluginBase;
use Tymon\JWTAuth\Providers\LaravelServiceProvider;

/**
 * Userapi Plugin Information File
 */
class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'Userapi',
            'description' => 'No description provided yet...',
            'author'      => 'LibUser',
            'icon'        => 'icon-leaf'
        ];
    }

    public function boot()
    {
        config([
            "jwt"    => config("libuser.userapi::jwt"),
            "auth"   => config("libuser.userapi::auth"),
            "config" => config("libuser.userapi::config")
        ]);

        $this->app->register(AuthServiceProvider::class);
        $this->app->alias("auth", AuthManager::class);
        $this->app->alias("auth", Factory::class);

        $this->app->register(LaravelServiceProvider::class);
        $this->app->alias("JWTAuth", \Tymon\JWTAuth\Facades\JWTAuth::class);
        $this->app->alias("JWTFactory", \Tymon\JWTAuth\Facades\JWTFactory::class);
        $this->app["router"]->aliasMiddleware("auth", Authenticate::class);
        $this->app->bind(\Illuminate\Contracts\Auth\Guard::class, "auth.driver");
    }

}
