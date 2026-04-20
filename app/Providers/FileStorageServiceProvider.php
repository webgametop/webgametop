<?php

namespace App\Providers;

use App\Services\FileStorages\FileStorage;
use App\Services\FileStorages\LocalStorage;
use Illuminate\Support\ServiceProvider;

class FileStorageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(FileStorage::class, function () {
            $concrete = match (config('filesystems.storage_driver')) { // @todo
                default => LocalStorage::class,
            };

            return $this->app->make($concrete);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
