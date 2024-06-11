<?php

namespace App\Providers;

use App\Libraries\Notification;
use Illuminate\Support\ServiceProvider;
use App\Libraries\UserCountry;

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
        
        $UserCountry = new UserCountry;
        $getUserCountry = $UserCountry->getUserCountry();
        config(['app.UserCountry' => $getUserCountry]);
        
    }
}
