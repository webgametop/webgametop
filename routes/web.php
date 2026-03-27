<?php

use Illuminate\Support\Facades\Route;

Route::group([], function () {
    require_once __DIR__ . '/web.users.php';
});

Route::get('/', function () {

    return view('welcome');

});
