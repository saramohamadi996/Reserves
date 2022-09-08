<?php

use Illuminate\Support\Facades\Route;

Route::group(["namespace" => "Gym\Reserve\Http\Controllers",
'middleware' => ['web', 'auth']
], function () {
    Route::post('orders/{order}/cancel', 'OrderController@cancel')->name('orders.cancel');
    Route::get('orders', 'OrderController@index')->name('orders.index');
    Route::post('orders/store', 'OrderController@store')->name('orders.store');
    Route::post('orders/wallet', 'OrderController@wallet')->name('orders.wallet');
    Route::get('orders/detail/{user}', 'OrderController@detail')->name('orders.detail');
    Route::get('orders/show/{user}', 'OrderController@show')->name('orders.show');
});
