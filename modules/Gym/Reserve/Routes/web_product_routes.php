<?php

Route::group(["namespace" => "Gym\Reserve\Http\Controllers", 'middleware' => ['web']], function ($router) {
    $router->get('/', 'ProductController@index')->name('products.index');
    $router->get('products/filter', 'ProductController@filter')->name('products.filter');
    $router->get('products/getModal', 'ProductController@getModal')->name('products.getModal');
    $router->get('ajax-autocomplete-search', 'ProductController@selectSearch')->name('products.selectSearch');
});

