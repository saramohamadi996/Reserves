<?php

namespace Gym\Reserve\Providers;

use Illuminate\Support\ServiceProvider;

class ReserveServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * Introducing different parts of the module to Laravel application.
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web_product_routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/Carts_routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web_order_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Reserve');
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang");
    }
}
