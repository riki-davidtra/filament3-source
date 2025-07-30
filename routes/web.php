<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('filament.admin.pages.dashboard');
});

Route::get('/auth/redirect/{provider}', [\App\Http\Controllers\AuthController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/callback/{provider}', [\App\Http\Controllers\AuthController::class, 'callback'])->name('auth.callback');
Route::get('/auth/create-password', [\App\Http\Controllers\AuthController::class, 'create_password'])->name('auth.create-password');
Route::post('/auth/create-password/update', [\App\Http\Controllers\AuthController::class, 'create_password_update'])->name('auth.create-password.update');
Route::get('/auth/create-password/skip', [\App\Http\Controllers\AuthController::class, 'create_password_skip'])->name('auth.create-password.skip');
