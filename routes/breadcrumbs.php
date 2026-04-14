<?php

declare(strict_types=1);

use App\Enums\GameProvider as GameProviderEnum;
use App\Models\Game as GameModel;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Illuminate\Support\Facades\Route;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', '/');
});

Breadcrumbs::for('games.showcase', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Игры', route('games.showcase'));
});

Breadcrumbs::for('games', function (BreadcrumbTrail $trail, GameProviderEnum $provider) {
    $trail->parent('games.showcase');
    $trail->push($provider->label(), route('games', $provider));
});

Breadcrumbs::for('games.show', function (BreadcrumbTrail $trail, GameProviderEnum $provider, GameModel $game) {
    $trail->parent('games', $provider);
    $trail->push($game->title, route('games.show', [$game, $game->slug]));
});

Breadcrumbs::for('games.votes', function (BreadcrumbTrail $trail, GameProviderEnum $provider, GameModel $game) {
    $trail->parent('games.show', $provider, $game);
    $trail->push('Голосование', route('games.votes', [$game, $game->slug]));
});
