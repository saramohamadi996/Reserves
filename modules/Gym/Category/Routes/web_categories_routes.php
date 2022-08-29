<?php

Route::group(["namespace" => "Gym\Category\Http\Controllers",
    'middleware' => ['web']
], function ($router) {
    $router->get('categories', 'CategoryController@index')->name('categories.index');
    $router->get('toggle/{category}/toggle', 'CategoryController@toggle')->name('categories.toggle');
    $router->get('categories/create', 'CategoryController@create')->name('categories.create');
    $router->post('categories/create', 'CategoryController@store')->name('categories.store');
    $router->get('categories/{category}/edit', 'CategoryController@edit')->name('categories.edit');
    $router->post('categories/{category}/edit', 'CategoryController@update')->name('categories.update');
    $router->delete('categories/{category}/destroy', 'CategoryController@destroy')->name('categories.destroy');

    $router->patch('categories/{category}/accept', 'CategoryController@accept')->name('categories.accept');
    $router->patch('categories/{category}/reject', 'CategoryController@reject')->name('categories.reject');
});

