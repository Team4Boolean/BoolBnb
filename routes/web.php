<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
}) -> name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// UPRA functions
Route::get('/upra', 'LoggedController@index') -> name('upra');

// Creazione flat
Route::get('/flat/create', 'LoggedController@create') -> name('create-flat');
Route::post('/flat/create', 'LoggedController@store') -> name('store-flat');
