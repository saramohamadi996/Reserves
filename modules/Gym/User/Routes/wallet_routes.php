<?php

Route::group(["namespace" => "Gym\User\Http\Controllers",
    'middleware' => ['web']
], function ($router) {
    $router->get('wallets/toggle/{wallet}/toggle', 'WalletController@toggle')->name('wallets.toggle');
    $router->get('wallets', 'WalletController@index')->name('wallets.index');
    $router->get('wallets/{wallet}/create', 'WalletController@create')->name('wallets.create');
    $router->post('wallets/{wallet}/create', 'WalletController@store')->name('wallets.store');
    $router->get('wallets/{wallet}/edit', 'WalletController@edit')->name('wallets.edit');
    $router->post('wallets/{wallet}/edit', 'WalletController@update')->name('wallets.update');
});
