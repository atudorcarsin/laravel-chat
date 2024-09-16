<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render();
})->middleware(['auth']);

Route::get('/login', function () {
    return Inertia::render('Auth/Login', []);
})->name('login');
