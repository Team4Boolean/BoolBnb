<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      // braintree setup for examples
      $braintree = new \Braintree\Gateway([
        'environment' => 'sandbox',
        'merchantId'  => 'use_your_merchant_id',
        'publicKey'   => 'use_your_public_key',
        'privateKey'  => 'use_your_private_key'
      ]);
      config(['braintree' => $braintree]);
    }
}
