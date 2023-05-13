<?php

namespace App\Providers;

use App\Contracts\ServiceContract;
use App\Services\Contact\ContactToggle;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ServiceContract::class, ContactToggle::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
