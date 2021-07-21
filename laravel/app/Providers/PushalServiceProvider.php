<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PushalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\App\Service\Pushall::class,function () {
            return new \App\Service\Pushall(config('pushall.pushall.api.key'),config('pushall.pushall.api.id'));
        });
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
