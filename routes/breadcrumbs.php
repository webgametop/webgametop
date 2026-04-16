<?php

declare(strict_types=1);

use App\Enums\GameProvider as GameProviderEnum;
use App\Models\Developer as DeveloperModel;
use App\Models\Game as GameModel;
use App\Models\User as UserModel;
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

Breadcrumbs::for('developers.showcase', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Разработчики', route('developers.showcase'));
});

Breadcrumbs::for('developers', function (BreadcrumbTrail $trail, GameProviderEnum $provider) {
    $trail->parent('developers.showcase');
    $trail->push($provider->label(), route('developers', $provider));
});

Breadcrumbs::for('developers.show', function (BreadcrumbTrail $trail, GameProviderEnum $provider, DeveloperModel $developer) {
    $trail->parent('developers', $provider);
    $trail->push($developer->name, route('developers.show', [$developer, $developer->slug]));
});

Breadcrumbs::for('users', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Пользователи', route('users'));
});

Breadcrumbs::for('users.show', function (BreadcrumbTrail $trail, UserModel $user) {
    $trail->parent('users');
    $trail->push($user->nickname, route('users.show', [$user, $user->username]));
});

Breadcrumbs::for('users.edit.account', function (BreadcrumbTrail $trail, UserModel $user) {
    $trail->parent('users.show', $user);
    $trail->push('Редактировать', route('users.edit.account', [$user, $user->username]));
});
