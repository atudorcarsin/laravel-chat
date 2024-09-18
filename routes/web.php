<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render();
})->middleware(['auth']);

Route::post('/login', function () {
    return "user submitted form";
});

Route::get('/login', function () {
    return Inertia::render('Auth/Login', []);
})->name('login');
