<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PollApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->pollsApiRepo();
    }

    /**
     * Use for poll api Rpository
     *
    **/
    public function pollsApiRepo() {
        return $this->app->bind('App\Repositories\Api\Polls\MyPollsRepositoryInterface', 'App\Repositories\Api\Polls\MyPollsRepository');
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
