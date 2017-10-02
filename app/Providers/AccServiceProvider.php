<?php

namespace App\Providers;

use App\Acc\Acc;
use Illuminate\Support\ServiceProvider;

class AccServiceProvider extends ServiceProvider
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
        $this->app->bind('acc', function () {
            return new Acc();
        });
    }
}
