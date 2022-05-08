<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Cartalyst\Stripe\Stripe;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {       
        Paginator::useBootstrap();
        Blade::if('host', function () {
            return auth()->check() && auth()->user()->hasRole('host');          
        });
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->hasRole(['super','admin']);          
        });
        Blade::if('user', function () {
            return auth()->check() && auth()->user()->hasRole('user');          
        });

    }
}
