<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Remove custom @role directive registration to avoid conflicts with Spatie Permission package
        // Spatie Permission package automatically registers @role, @hasrole, @can, etc. directives
    }
}
