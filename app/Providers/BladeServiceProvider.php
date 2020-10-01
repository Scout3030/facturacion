<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::if('admin', function () {
            if (auth()->check()) {
                return auth()->user()->isAdmin();
            }
            return false;
        });

        \Blade::if('operator', function () {
            if (auth()->check()) {
                return auth()->user()->isOperator();
            }
            return false;
        });

        \Blade::if('adminoroperator', function () {
            if (auth()->check()) {
                return auth()->user()->isOperator() || auth()->user()->isAdmin();
            }
            return false;
        });

        \Blade::if('customer', function () {
            if (auth()->check()) {
                return auth()->user()->isCustomer();
            }
            return false;
        });
    }
}
