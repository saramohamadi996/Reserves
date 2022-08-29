<?php
Route::group(["namespace" => "Gym\PriceGroup\Http\Controllers",
    'middleware' => ['web', 'auth']
], function ($router) {
    $router->get('price_groups', 'PriceGroupController@index')->name('price_groups.index');
    $router->get('price_groups/toggle/{price_group}/toggle', 'PriceGroupController@toggle')->name('price_groups.toggle');
    $router->get('price_groups/create', 'PriceGroupController@create')->name('price_groups.create');
    $router->post('price_groups/create', 'PriceGroupController@store')->name('price_groups.store');
    $router->get('price_groups/{price_group}/edit', 'PriceGroupController@edit')->name('price_groups.edit');
    $router->post('price_groups/{price_group}/edit', 'PriceGroupController@update')->name('price_groups.update');
    $router->delete('price_groups/{price_group}/destroy', 'PriceGroupController@destroy')->name('price_groups.destroy');
});
