<?php

namespace App\Providers;

use App\Models\Developer;
use App\Models\Game;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        $this->app->bind(ClientInterface::class, function (): ClientInterface {
            return new Client(['timeout' => 5.0, 'connect_timeout' => 3.0]);
        });

        Relation::morphMap([
            'developer' => Developer::class,
            'game' => Game::class,
        ]);
    }
}
