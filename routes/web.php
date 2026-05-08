<?php

use Illuminate\Support\Facades\Route;

Route::group([], function () {
    require __DIR__ . '/web.users.php';
    require __DIR__ . '/web.games.php';
    require __DIR__ . '/web.developers.php';
    require __DIR__ . '/web.comments.php';
});

Route::get('/', function () {
    return view('web.index');
});
