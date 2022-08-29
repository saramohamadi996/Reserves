<?php

namespace Gym\User\Providers;

use Database\Seeders\DatabaseSeeder;
use Gym\User\Database\Seeds\UsersTableSeeder;
use Gym\User\Http\Middleware\StoreUserIp;
use Gym\User\Models\User;
use Gym\User\Policies\UserPolicy;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/user_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadFactoriesFrom(__DIR__ . '/../Database/Factories');
        $this->loadViewsFrom( __DIR__ . '/../Resources/Views', 'User');
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang");
        $this->app['router']->pushMiddlewareToGroup('web', StoreUserIp::class);

        Factory::guessFactoryNamesUsing(function (string $modelName) {
            return 'Gym\User\Database\Factories\\' . class_basename($modelName) .'Factory' ;
        });

        config()->set('auth.providers.users.model', User::class);
        Gate::policy(User::class, UserPolicy::class);
        DatabaseSeeder::$seeders[] = UsersTableSeeder::class;

    }
}
