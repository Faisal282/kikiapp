<?php

Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/store', 'StoreController@index')->middleware('user');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
   Route::get('/', 'AdminController@index'); 
   Route::get('/motor', 'StoreController@index');
   Route::get('/motor/tambah', 'StoreController@create'); //create
   Route::post('/motor/tambah', 'StoreController@store'); //store
   Route::get('/motor/detail/{id}', 'StoreController@show'); //show
   Route::get('/motor/edit/{id}', 'StoreController@edit'); // edit
   Route::put('/motor/edit/{id}', 'StoreController@update'); // update
});

Route::get('/verify/{token}/{id}', 'Auth\RegisterController@verify_register');

// Route::get('/home', 'HomeController@index')->name('home');
