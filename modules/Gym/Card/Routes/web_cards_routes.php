<?php

use Illuminate\Support\Facades\Route;

Route::group(["namespace" => "Gym\Card\Http\Controllers",
    'middleware' => ['web']
], function () {
    Route::get('cards', 'CardController@index')->name('cards.index');
    Route::get('cards/toggle/{card}/toggle', 'CardController@toggle')->name('cards.toggle');
    Route::get('cards/create', 'CardController@create')->name('cards.create');
    Route::post('cards/create', 'CardController@store')->name('cards.store');
    Route::get('cards/{card}/edit', 'CardController@edit')->name('cards.edit');
    Route::post('cards/{card}/edit', 'CardController@update')->name('cards.update');
    Route::delete('cards/{card}/destroy', 'CardController@destroy')->name('cards.destroy');
});

