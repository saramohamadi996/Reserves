<?php

use Illuminate\Support\Facades\Route;


Route::group(["namespace" => "Gym\Reserve\Http\Controllers",
    'middleware' => ['web']
], function ($router) {
    $router->post('orders/{order}/cancel', 'OrderController@cancel')->name('orders.cancel');
    $router->get('orders', 'OrderController@index')->name('orders.index');
    $router->post('orders/store', 'OrderController@store')->name('orders.store');
    $router->post('orders/wallet', 'OrderController@wallet')->name('orders.wallet');
    $router->get('orders/detail/{user}', 'OrderController@detail')->name('orders.detail');
    $router->get('orders/show/{user}', 'OrderController@show')->name('orders.show');
});
