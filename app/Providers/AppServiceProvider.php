<?php

namespace App\Providers;

use App\Services\Contracts\HasherInterface;
use App\Services\Contracts\HmacHasherInterface;
use App\Services\Contracts\PasswordHasherInterface;
use App\Services\HasherService;
use App\Services\HmacHasherService;
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
        $this->app->bind(HasherInterface::class, HasherService::class);
        $this->app->bind(HmacHasherInterface::class, HmacHasherService::class);
    }
}
