<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['uses' => 'TransactionController@index', 'as' => 'home', 'middleware' => 'auth']);

/**
 * Логинг
 */
Route::get('/login', ['uses' => 'LoginController@index', 'as' => 'login.index']);
Route::post('/login', ['uses' => 'LoginController@login', 'as' => 'login']);

Route::get('/logout', ['uses' => 'LoginController@logout', 'as' => 'logout']);

/**
 * Регистрация
 */
Route::get('/register', ['uses' => 'LoginController@register', 'as' => 'login.register']);
Route::post('/register', ['uses' => 'LoginController@registerUser', 'as' => 'login.register.user']);



/**
 * Операции
 */
Route::get('/transaction/create', ['uses' => 'TransactionController@create', 'as' => 'transaction.create', 'middleware' => 'auth']);
Route::post('/transaction/create', ['uses' => 'TransactionController@save', 'as' => 'transaction.save']);
Route::get('/transaction/edit/{id}', ['uses' => 'TransactionController@edit', 'as' => 'transaction.edit']);
Route::post('/transaction/update/{id}', ['uses' => 'TransactionController@update', 'as' => 'transaction.update']);
Route::get('/transaction/delete/{id}', ['uses' => 'TransactionController@delete', 'as' => 'transaction.delete']);
Route::post('/transaction/filter', ['uses' => 'TransactionController@filter', 'as' => 'transaction.filter']);
