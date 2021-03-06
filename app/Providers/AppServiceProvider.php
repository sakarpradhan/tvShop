<?php

namespace App\Providers;

use App\Helper\UserHelper;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('admin', function() {
            return UserHelper::isUserAdmin();
        });

        Gate::define('customer', function() {
            return !UserHelper::isUserAdmin();
        });

//        Gate::define('admin', function(User $user) {
//            return $user->admin == 1;
//        });
//
//        Gate::define('customer', function(User $user) {
//            return $user->admin == 0;
//        });
    }
}
