<?php

Route::group(['namespace' => 'Gym\Dashboard\Http\Controllers', 'middleware' => ['web']], function ($router) {
    $router->get('/dashboard', 'DashboardController@index')->name('index');
    $router->get('staffRegisteredUsersDetail/{user}', 'DashboardController@staffRegisteredUsersDetail')->name('staffRegisteredUsersDetail');
    $router->get('cardDetail/{card}', 'DashboardController@cardDetail')->name('cardDetail');
    $router->get('walletDetail', 'DashboardController@walletDetail')->name('walletDetail');
    $router->get('service-detail/{service}', 'DashboardController@service_detail')->name('service.detail');
});
