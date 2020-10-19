<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Flat;
use App\User;
use App\Message;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
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
        Gate::define('upra-manage-flats', function(User $user, Flat $flat) {
          return $user -> id === $flat -> user -> id;
        });

        // registro il Gate 'upra-manage-user'
        Gate::define('upra-manage-requests', function(User $user, Message $message) {
          return $user -> id === $flat -> user_id;
        });

    }
}
