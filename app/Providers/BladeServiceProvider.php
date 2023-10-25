<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::if('ifAdmin', function () {
            return auth()->check() && auth()->user()->isAdmin();
        });

        Blade::if('ifUser', function () {
            return auth()->check() && auth()->user()->isUser();
        });

        Blade::if('ifViewer', function () {
            return auth()->check() && auth()->user()->isViewer();
        });
    }
}
