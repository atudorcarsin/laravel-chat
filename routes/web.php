<?php

use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Chat\ChatInviteController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect(route('dashboard'));
});

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('chats', ChatController::class)
    ->only(['index', 'store', 'show'])
    ->middleware(['auth', 'verified']);

Route::resource('chatinvites', ChatInviteController::class)
    ->only(['store', 'destroy', 'index'])
    ->middleware(['auth', 'verified']);

Route::resource('messages', MessageController::class)
    ->only(['store'])
    ->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
