<?php

namespace App\Providers;

use Gym\Card\Repositories\CardRepository;
use Gym\Card\Repositories\Interfaces\CardRepositoryInterface;
use Gym\Category\Repositories\CategoryRepository;
use Gym\Category\Repositories\Interfaces\CategoryRepositoryInterface;
use Gym\PriceGroup\Repositories\Interfaces\PriceGroupRepositoryInterface;
use Gym\PriceGroup\Repositories\PriceGroupRepository;
use Gym\Reserve\Repositories\Interfaces\OrderRepository;
use Gym\Reserve\Repositories\Interfaces\orderRepositoryInterface;
use Gym\Sens\Repositories\Interfaces\SensRepositoryInterface;
use Gym\Sens\Repositories\SensRepository;
use Gym\Service\Repositories\Interfaces\ServiceRepositoryInterface;
use Gym\Service\Repositories\ServiceRepository;
use Gym\User\Repositories\Interfaces\UserRepositoryInterface;
use Gym\User\Repositories\UserRepository;
use Gym\Wallet\Repositories\Interfaces\WalletRepositoryInterface;
use Gym\Wallet\Repositories\WalletRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PriceGroupRepositoryInterface::class, PriceGroupRepository::class);
        $this->app->bind(SensRepositoryInterface::class, SensRepository::class);
        $this->app->bind(CardRepositoryInterface::class, CardRepository::class);
        $this->app->bind(WalletRepositoryInterface::class, WalletRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
    }
}
