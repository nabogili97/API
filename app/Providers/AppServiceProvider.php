<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'App\Services\YahooShopping\IYahooService',
            'App\Services\YahooShopping\YahooService'
        );

        $this->app->singleton(
            'App\Services\Rakunten\IRakuntenService',
            'App\Services\Rakunten\RakuntenService'
        );

        $this->app->singleton(
            'App\Services\Amazon\IAmazonService',
            'App\Services\Amazon\AmazonService'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
