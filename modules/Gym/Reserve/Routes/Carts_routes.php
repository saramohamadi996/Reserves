<?php

use Illuminate\Support\Facades\Route;

Route::group(["namespace" => "Gym\Reserve\Http\Controllers",
    'middleware' => ['web', 'auth']
], function () {
    Route::get('carts/{user}/show', 'CartController@show')->name('carts.show');
    Route::post('carts/cart', 'CartController@cart')->name('carts.cart');
    Route::delete('carts/{cart}', 'CartController@destroy')->name('carts.destroy');
});
