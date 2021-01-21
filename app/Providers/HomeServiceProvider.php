<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HomeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->homeRepo();
    }

    /**
     * Use for Home Functionality data
     *
     */
    public function homeRepo() {
        return $this->app->bind('App\Repositories\Home\HomeRepositoryInterface', 'App\Repositories\Home\HomeRepository');
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
