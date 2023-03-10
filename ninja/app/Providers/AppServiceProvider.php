<?php

namespace App\Providers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
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
        Schema::defaultStringLength(191);
        Inertia::share('flash', function () {
            return ['message' => Session::get('message'), 'messageType' => Session::get('messageType')];
        });
    }
}
