<?php

namespace Gym\Service\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * Introducing different parts of the module to Laravel application.
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web_services_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Service');
    }
}
