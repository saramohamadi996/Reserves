<?php

use Illuminate\Support\Facades\Route;

Route::group(["namespace" => "Gym\User\Http\Controllers",
    'middleware' => ['web']
], function () {
    Route::get('wallets/toggle/{wallet}/toggle', 'WalletController@toggle')->name('wallets.toggle');
    Route::get('wallets', 'WalletController@index')->name('wallets.index');
    Route::get('wallets/{wallet}/create', 'WalletController@create')->name('wallets.create');
    Route::post('wallets/{wallet}/create', 'WalletController@store')->name('wallets.store');
    Route::get('wallets/{wallet}/edit', 'WalletController@edit')->name('wallets.edit');
    Route::post('wallets/{wallet}/edit', 'WalletController@update')->name('wallets.update');
});
