<?php

namespace Gym\User\Providers;

use Database\Seeders\DatabaseSeeder;
use Gym\User\Database\Seeds\UsersTableSeeder;
use Gym\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/user_routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/wallet_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadFactoriesFrom(__DIR__ . '/../Database/Factories');
        $this->loadViewsFrom( __DIR__ . '/../Resources/Views', 'User');
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang");
        Factory::guessFactoryNamesUsing(function (string $modelName) {
            return 'Gym\User\Database\Factories\\' . class_basename($modelName) .'Factory' ;
        });
        config()->set('auth.providers.users.model', User::class);
        DatabaseSeeder::$seeders[] = UsersTableSeeder::class;
    }
}
