<?php

use Illuminate\Support\Facades\Route;

// Auth
Auth::routes();

// Home
// Home Ui -> read
Route::get('/', 'UiController@home') -> name('home');
// Home Ui -> search
Route::get('/flats/search', 'UiController@flatSearch') -> name('flats.search');
// Search Ui -> searchFilters
Route::get('/flats/search/filters', 'UiController@flatSearchFilters') -> name('flats.search.filters');
// API flats -> search
Route::get('/api/flats/search', 'ApiController@flatSearch') -> name('api.flats.search');

// test
// Route::get('/test', function() {
//
//   $gateway = new Braintree\Gateway([
//     'environment' => config('services.braintree.environment'),
//     'merchantId' => config('services.braintree.merchantId'),
//     'publicKey' => config('services.braintree.publicKey'),
//     'privateKey' => config('services.braintree.privateKey')
//   ]);
//
//   $token = $gateway->ClientToken()->generate();
//
//   return view('test', compact('token'));
// });
//
// Route::post('/checkout', function (Request $request) {
//
//   $gateway = new Braintree\Gateway([
//     'environment' => config('services.braintree.environment'),
//     'merchantId' => config('services.braintree.merchantId'),
//     'publicKey' => config('services.braintree.publicKey'),
//     'privateKey' => config('services.braintree.privateKey')
//   ]);
//
//   $amount = $request->amount;
//   $nonce = $request->payment_method_nonce;
//
//   $result = $gateway->transaction()->sale([
//     'amount' => $amount,
//     'paymentMethodNonce' => $nonce,
//     'options' => [
//         'submitForSettlement' => true
//     ]
//   ]);
//
//   if ($result->success) {
//     $transaction = $result->transaction;
//     // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);
//     return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->$id);
//   } else {
//     $errorString = "";
//
//     foreach ($result->errors->deepAll() as $error) {
//         $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
//     }
//     return back()->withErrors('An error occurred with the message:' . $result->message);
//   }
//
//   return view('test', compact('data'));
//
// }) -> name ('sponsor.checkout');

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
    // dropzone img uploader
    Route::get('/dropzone','UprController@dropzone') -> name('dropzone');
    Route::post('/dropzone/store', 'UprController@dropzoneStore') -> name('dropzone.store');
    // Flats Upra -> index
    Route::get('/flats', 'UpraController@flatIndex') -> name('flats.index');
    // Flats Upra -> edit
    Route::get('/flats/{id}/edit', 'UpraController@flatEdit') -> name('flats.edit');
    Route::patch('/flats/{id}/update', 'UpraController@flatUpdate') -> name('flats.update');
    // Flats Upra -> deactivate
    Route::get('/flats/{id}/deactivate', 'UpraController@flatDeactivate') -> name('flats.deactivate');
    Route::get('/flats/{id}/activate', 'UpraController@flatActivate') -> name('flats.activate');
    // Flats Upra -> statistics
    Route::get('/flats/{id}/stats', 'UpraController@flatStats') -> name('flats.stats');
    // Flats Upra -> statistics
    Route::get('/flats/{id}/messages', 'UpraController@flatMessages') -> name('flats.messages');
    // Flats Upra -> sponsors -> create MOMENTANEO
    // Route::get('/flats/{id}/sponsor', 'UpraController@flatSponsorCreate') -> name('flats.sponsor.create');
    Route::get('/flats/sponsor', function() {

      $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
      ]);

      $token = $gateway->ClientToken()->generate();

      return view('sponsors.create', compact('token'));
    }) -> name('flats.sponsor.create');
    // Flats Upra -> sponsors -> store MOMENTANEO
    Route::post('/flats/sponsor/checkout', function (Request $request) {

      $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
      ]);

      $amount = $request->amount;
      $nonce = $request->payment_method_nonce;

      $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'options' => [
            'submitForSettlement' => true
        ]
      ]);

      if ($result->success) {
        $transaction = $result->transaction;
        // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);
        return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->$id);
      } else {
        $errorString = "";

        foreach ($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }
        return back()->withErrors('An error occurred with the message:' . $result->message);
      }

      return view('sponsors.create', compact('data'));

    }) -> name ('sponsor.checkout');
  });
// Messages
// Messages Ui -> create
Route::post('/flats/{id}/messages/store', 'UiController@messageStore') -> name('messages.store');

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
