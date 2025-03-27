<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('product-management', function(User $user) {
            $authUserPermission = $user->permissions()
                ->where('permission_name', 'product-management')
                ->first();

            if (!$authUserPermission) {
                return false;
            }

            return true;
        });

        Gate::define('category-management', function(User $user) {
            $authUserPermission = $user->permissions()
                ->where('permission_name', 'category-management')
                ->first();

            if (!$authUserPermission) {
                return false;
            }

            return true;
        });

        Gate::define('brand-management', function(User $user) {
            $authUserPermission = $user->permissions()
                ->where('permission_name', 'brand-management')
                ->first();

            if (!$authUserPermission) {
                return false;
            }

            return true;
        });

        Gate::define('is-admin', function(User $user) {
            return $user->is_admin;
        });
    }
}
