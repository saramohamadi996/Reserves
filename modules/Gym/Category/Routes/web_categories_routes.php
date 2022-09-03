<?php

use Illuminate\Support\Facades\Route;

Route::group(["namespace" => "Gym\Category\Http\Controllers",
    'middleware' => ['web']
], function () {
    Route::get('categories', 'CategoryController@index')->name('categories.index');
    Route::get('toggle/{category}/toggle', 'CategoryController@toggle')->name('categories.toggle');
    Route::get('categories/create', 'CategoryController@create')->name('categories.create');
    Route::post('categories/create', 'CategoryController@store')->name('categories.store');
    Route::get('categories/{category}/edit', 'CategoryController@edit')->name('categories.edit');
    Route::post('categories/{category}/edit', 'CategoryController@update')->name('categories.update');
    Route::delete('categories/{category}/destroy', 'CategoryController@destroy')->name('categories.destroy');
});

