<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Classes\Exchange;

class ExchangeServiceProvider extends ServiceProvider
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
        $this->app->singleton('App\Classes\Exchange', function(){
            return new Exchange;
        });
    }
}
