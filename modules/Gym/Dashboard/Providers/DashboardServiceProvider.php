<?php

namespace Gym\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web_dashboard_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Dashboard');
    }
}
