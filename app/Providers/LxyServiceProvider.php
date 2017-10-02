<?php

namespace App\Providers;

use App\Acc\Lxy;
use Illuminate\Support\ServiceProvider;

class LxyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(['lxy'=>'lxysalias'], function () {
            return new Lxy(app('llj'));
        });
    }
}
