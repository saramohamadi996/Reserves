<?php

namespace Gym\Wallet\Providers;

use Illuminate\Support\ServiceProvider;

class WalletServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/wallet_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
//        $this->loadViewsFrom( __DIR__ . '/../Resources/Views', 'Wallet');
        $this->loadViewsFrom(__DIR__ . "/../Resources/Views", 'Wallet');
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang");
    }
}
