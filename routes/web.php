<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('filament.admin.pages.dashboard');
});

Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])->name('socialite.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])->name('socialite.callback');
Route::get('/auth/create-password', [SocialiteController::class, 'create_password'])->name('create-password');
Route::post('/auth/create-password/update', [SocialiteController::class, 'create_password_update'])->name('create-password.update');
Route::get('/auth/create-password/skip', [SocialiteController::class, 'create_password_skip'])->name('create-password.skip');
