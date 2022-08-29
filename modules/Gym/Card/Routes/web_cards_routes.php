<?php

Route::group(["namespace" => "Gym\Card\Http\Controllers",
    'middleware' => ['web']
], function ($router) {
    $router->get('cards', 'CardController@index')->name('cards.index');
    $router->get('cards/toggle/{card}/toggle', 'CardController@toggle')->name('cards.toggle');
    $router->get('cards/create', 'CardController@create')->name('cards.create');
    $router->post('cards/create', 'CardController@store')->name('cards.store');
    $router->get('cards/{card}/edit', 'CardController@edit')->name('cards.edit');
    $router->post('cards/{card}/edit', 'CardController@update')->name('cards.update');
    $router->delete('cards/{card}/destroy', 'CardController@destroy')->name('cards.destroy');
});

