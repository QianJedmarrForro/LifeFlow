<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate; // Added this
use App\Models\User; // Added this

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Standardize string length for database migrations. 
         */
        Schema::defaultStringLength(191);

        /**
         * ROLE DEFINITIONS
         * These allow us to check if a user is an admin or a regular user 
         * anywhere in the app using Gate::allows('admin-only')
         */

        // Check if the logged-in user is an admin
        Gate::define('admin-only', function (User $user) {
            return $user->role === 'admin';
        });

        // Check if the logged-in user is a regular user
        Gate::define('user-only', function (User $user) {
            return $user->role === 'user';
        });
    }
}