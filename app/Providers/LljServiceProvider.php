<?php

namespace App\Providers;

use App\Acc\Llj;
use Illuminate\Support\ServiceProvider;

class LljServiceProvider extends ServiceProvider
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
        $this->app->singleton('llj', function () {
            return new Llj();
        });
    }
}
