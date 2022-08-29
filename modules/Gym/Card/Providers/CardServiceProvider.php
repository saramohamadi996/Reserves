<?php

namespace Gym\Card\Providers;


use Illuminate\Support\ServiceProvider;

class CardServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * Introducing different parts of the module to Laravel application.
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web_cards_routes.php');
        $this->loadViewsFrom(__DIR__  .'/../Resources/Views/', 'Cards');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang");
    }
}
