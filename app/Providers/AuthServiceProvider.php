<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Flat;
use App\User;
use App\Message;

use App\Policies\FlatPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // Flat::class => FlatPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // registro il Gate 'upra-manage-user'
        Gate::define('upra-manage-flats', function(User $user) {
          $id = $user -> id;
          $flat = Flat::where('user_id', $id)
                      -> firstOr(function() {
                        return false;
                      });
          return $flat;
        });

        // registro il Gate 'upra-manage-messages'
        Gate::define('upra-manage-messages', function(User $user, Message $message) {
          return $user -> id === $flat -> user -> id
              && $flat -> id === $message -> flat -> id;
        });

    }
}
