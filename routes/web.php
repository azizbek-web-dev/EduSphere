<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Telegram Web App Route
Route::get('/webapp', function () {
    return view('webapp');
});
