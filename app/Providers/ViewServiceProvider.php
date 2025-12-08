<?php

namespace App\Providers;

use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        view()->composer('layouts.*', function ($view) {
            if (Auth::user()) {
                $profile = UserProfile::find(Auth::user()->id);
                $view->with('profile', $profile);
            }
        });
    }
}
