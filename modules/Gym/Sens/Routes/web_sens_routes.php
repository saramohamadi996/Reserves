<?php

Route::group(["namespace" => "Gym\Sens\Http\Controllers", 'middleware' => ['web', 'auth']], function ($router) {
//    Route::get('/', [SensController::class,'show'])->name('senses.show');
//    Route::get('/showServices', [SensController::class,'showServices'])->name('senses.showServices');
//    Route::get('/getModal', [SensController::class,'getModal'])->name('senses.getModal');

    $router->get('services/{service}/senses/create', 'SensController@create')->name('senses.create');
    $router->post('services/{service}/senses', 'SensController@store')->name('senses.store');
    $router->get('services/{service}/senses/{sens}/edit', 'SensController@edit')->name('senses.edit');
    $router->patch('services/{service}/senses/{sens}/edit', 'SensController@update')->name('senses.update');
    $router->delete('services/{service}/senses/{sens}', 'SensController@destroy')->name('senses.destroy');
});

