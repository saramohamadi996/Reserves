<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Gym\User\Http\Controllers',
    'middleware' => ['web', 'auth']
], function () {
    Route::get('users', 'UserController@index')->name('users.index');
    Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
    Route::post('users/{user}/edit', 'UserController@update')->name('users.update');
    Route::delete('users/{user}/destroy', 'UserController@destroy')->name('users.destroy');
    Route::get('users/search', 'UserController@search')->name('users.search');

    Route::get('/user_register', 'Auth\UserRegisterController@showRegistrationForm')->name('user_register');
    Route::post('/user_register', 'Auth\UserRegisterController@create')->name('user_register');
});
Route::group([
    'namespace' => 'Gym\User\Http\Controllers',
    'middleware' => ['web']], function () {
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'Auth\RegisterController@register')->name('register');
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    Route::any('/logout', 'Auth\LoginController@logout')->name('logout');

});

