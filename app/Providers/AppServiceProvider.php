<?php

namespace App\Providers;

use App\Services\Contracts\DataHasherInterface;
use App\Services\Contracts\PasswordHasherInterface;
use App\Services\DataHasherService;
use App\Services\PasswordHasherService;
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
        $this->app->bind(PasswordHasherInterface::class, PasswordHasherService::class);
        $this->app->bind(DataHasherInterface::class, DataHasherService::class);
    }
}
