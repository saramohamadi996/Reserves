<?php

use Illuminate\Support\Facades\Route;

Route::group(["namespace" => "Gym\PriceGroup\Http\Controllers",
    'middleware' => ['web', 'auth']
], function ($router) {
    Route::get('price_groups', 'PriceGroupController@index')->name('price_groups.index');
    Route::get('price_groups/toggle/{price_group}/toggle', 'PriceGroupController@toggle')
        ->name('price_groups.toggle');
    Route::get('price_groups/create', 'PriceGroupController@create')->name('price_groups.create');
    Route::post('price_groups/create', 'PriceGroupController@store')->name('price_groups.store');
    Route::get('price_groups/{price_group}/edit', 'PriceGroupController@edit')
        ->name('price_groups.edit');
    Route::post('price_groups/{price_group}/edit', 'PriceGroupController@update')
        ->name('price_groups.update');
    Route::delete('price_groups/{price_group}/destroy', 'PriceGroupController@destroy')
        ->name('price_groups.destroy');
});
