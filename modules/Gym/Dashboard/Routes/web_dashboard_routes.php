<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Gym\Dashboard\Http\Controllers', 'middleware' => ['web', 'auth']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('index');
    Route::get('staffRegisteredUsersDetail/{user}', 'DashboardController@staffRegisteredUsersDetail')
        ->name('staffRegisteredUsersDetail');
    Route::get('cardDetail/{card}', 'DashboardController@cardDetail')->name('cardDetail');
    Route::get('walletDetail', 'DashboardController@walletDetail')->name('walletDetail');
    Route::get('service-detail/{service}', 'DashboardController@service_detail')->name('service.detail');
});
