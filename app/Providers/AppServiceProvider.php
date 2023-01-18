<?php

namespace App\Providers;

use App\View\Components\AlertComponent;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('package-alert', AlertComponent::class);
        // Paginator::useBootstrapFive();
        // Paginator::useBootstrapFour();
        Paginator::useBootstrap();
    }
}