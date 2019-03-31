<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'store', 'middleware' => 'guest'], function () {
    Route::get('/', 'StoreController@index')->name('home'); // index
    Route::get('/tambah', 'StoreController@create'); //create
    Route::post('/tambah', 'StoreController@store'); //store
    Route::get('/detail/{id}', 'StoreController@show'); //show
    Route::get('/edit/{id}', 'StoreController@edit'); // edit
    Route::put('/edit/{id}', 'StoreController@update'); // update
});

Route::get('/verify/{token}/{id}', 'Auth\RegisterController@verify_register');

// Route::get('/home', 'HomeController@index')->name('home');
