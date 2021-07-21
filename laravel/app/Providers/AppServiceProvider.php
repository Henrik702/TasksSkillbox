<?php

namespace App\Providers;

use App\Models\Name;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Service\Pushall;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Collection::macro('toUpper',function () {
            return $this->map(function ($item) {
                    return \Illuminate\Support\Str::upper($item);
            });
        });


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('loaut.about', function ($view){
            $view->with('namesCloud', \App\Models\Name::has('tasks')->get());
        });


    }
}
