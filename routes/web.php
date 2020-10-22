<?php

use Illuminate\Support\Facades\Route;

// Auth
Auth::routes();

// Home
// Home Ui -> read
Route::get('/', 'UiController@home') -> name('home');
// API flats -> search
Route::get('/api/flats/search', 'ApiController@flatSearch') -> name('api.flats.search');

// Flats
// Route::group([
//   'middleware' => 'auth',
//   'prefix' => 'dashboard'
//   ],
//   function () {
//     Route::resource('flats', 'FlatController');
//   });

// test
Route::get('/test', 'UiController@requestStore') -> name('adv.test');

// Flats
// Flats Ui -> show
Route::get('/flats/{id}/show', 'UiController@flatShow') -> name('flats.show');

Route::group([
    'middleware' => 'auth',
    'prefix' => 'dashboard'
  ],
  function() {
    // Flats Upr -> create
    Route::get('/flats/create', 'UprController@flatCreate') -> name('flats.create');
    Route::post('/flats/store', 'UprController@flatStore') -> name('flats.store');
    // Flats Upra -> index
    Route::get('/flats', 'UpraController@flatIndex') -> name('flats.index');
    // Flats Upra -> edit
    Route::get('/flats/{id}/edit', 'UpraController@flatEdit') -> name('flats.edit');
    Route::post('/flats/{id}/update', 'UpraController@flatUpdate') -> name('flats.update');
    // Flats Upra -> deactivate
    Route::get('/flats/{id}/deactivate', 'UpraController@flatDeactivate') -> name('flats.deactivate');
    Route::get('/flats/{id}/activate', 'UpraController@flatActivate') -> name('flats.activate');
    // Flats Upra -> statistics
    Route::get('/flats/{id}/statistics', 'UpraController@flatStatistics') -> name('flats.statistics');
    // Flats Upra -> sponsors -> create
    Route::get('/flats/{id}/sponsor', 'UpraController@flatSponsorCreate') -> name('flats.sponsor.create');
  });

// Messages
// Messages Ui -> create
Route::get('/messages/create', 'UiController@messageCreate') -> name('messages.create');
Route::post('/messages/store', 'UiController@messageStore') -> name('messages.store');

Route::group([
    'middleware' => 'auth',
    'prefix' => 'dashboard'
  ],
  function() {
    // Messages Upra -> index
    Route::get('/messages', 'UpraController@messageIndex') -> name('messages.index');
    // Requests Upra -> show
    Route::get('/messages/{id}/show', 'UpraController@messageShow') -> name('messages.show');
  });


// UPRA functions
Route::get('/upra', 'UpraController@index') -> name('upra');
