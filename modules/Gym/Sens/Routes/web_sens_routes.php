<?php

use Illuminate\Support\Facades\Route;

Route::group(["namespace" => "Gym\Sens\Http\Controllers", 'middleware' => ['web', 'auth']], function ($router) {
    Route::get('services/{service}/senses/create', 'SensController@create')->name('senses.create');
    Route::post('services/{service}/senses', 'SensController@store')->name('senses.store');
    Route::get('services/{service}/senses/{sens}/edit', 'SensController@edit')->name('senses.edit');
    Route::patch('services/{service}/senses/{sens}/edit', 'SensController@update')->name('senses.update');
    Route::delete('services/{service}/senses/{sens}', 'SensController@destroy')->name('senses.destroy');
});

