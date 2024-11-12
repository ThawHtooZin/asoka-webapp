<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::share('shownotification', $this->shownotification());
    }

    public function shownotification()
    {
        // Your logic to get notifications goes here
        return [
            'message' => 'You have new notifications!',
            'count' => 5
        ]; // Example structure
    }
}
