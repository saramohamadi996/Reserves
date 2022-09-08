<?php

use Illuminate\Support\Facades\Route;

Route::group(["namespace" => "Gym\Reserve\Http\Controllers", 'middleware' => ['web', 'auth']], function () {
    Route::get('/', 'ProductController@index')->name('products.index');
    Route::get('products/filter', 'ProductController@filter')->name('products.filter');
    Route::get('products/getModal', 'ProductController@getModal')->name('products.getModal');
    Route::get('ajax-autocomplete-search', 'ProductController@selectSearch')->name('products.selectSearch');
});

