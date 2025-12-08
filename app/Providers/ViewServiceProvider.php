<?php

namespace App\Providers;

use App\Models\Message;
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
            if (Auth::check()) {
                $profile = Auth::user()->profile;
                $unreadCount = Message::where('is_read', 0)
                    ->where('receiver_id', Auth::id())
                    ->count();

                $view->with([
                    'profile'     => $profile,
                    'unreadCount' => $unreadCount,
                ]);
            }
        });
    }
}
