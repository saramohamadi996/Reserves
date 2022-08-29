<?php

namespace Gym\Category\Providers;

use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * Introducing different parts of the module to Laravel application.
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web_categories_routes.php');
        $this->loadViewsFrom(__DIR__  .'/../Resources/Views/', 'Categories');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang");
    }
}
