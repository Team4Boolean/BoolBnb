<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

// Guest functions

Route::get('/', 'GuestController@homepage') -> name('home');
Route::get('/flats', 'GuestController@list') -> name('flats');
Route::get('/flat/{id}/show', 'GuestController@show') -> name('show-flat');

// UPR functions
// Show flats
// Creazione flat
Route::get('/flat/create', 'UprController@create') -> name('create-flat');
Route::post('/flat/create', 'UprController@store') -> name('store-flat');

// UPRA functions
Route::get('/upra', 'UpraController@index') -> name('upra');
