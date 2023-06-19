<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('login');
})->name('home');

Route::get('/register', function () {
    return view('register');
});

Route::middleware(['auth', 'loadSections'])->group(function () {
    Route::get('welcome', function () {
        return view('welcome');
    })->name('welcome');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['web'])->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::get('/csrf-token', function() {
    return csrf_token();
});
