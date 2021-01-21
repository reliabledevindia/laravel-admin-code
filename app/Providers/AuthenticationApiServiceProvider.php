<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AuthenticationApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerApiRepo();
        $this->loginApiRepo();
    }

    /**
     * Use for Register Api Rpository
     *
    **/
    public function registerApiRepo() {
        return $this->app->bind('App\Repositories\Api\Register\RegisterRepositoryInterface', 'App\Repositories\Api\Register\RegisterRepository');
    }

    /**
     * Use for Login Api Rpository
     *
    **/
    public function loginApiRepo() {
        return $this->app->bind('App\Repositories\Api\Login\LoginRepositoryInterface', 'App\Repositories\Api\Login\LoginRepository');
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
