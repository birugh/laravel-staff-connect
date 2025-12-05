<?php

namespace App\Providers;

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
            $karyawans = \App\Models\User::where('role', 'karyawan')->get();
            $view->with('karyawans', $karyawans);
        });
    }
}
