<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('home'); })
    ->name('home');

Route::get('/register', [RegisterController::class, 'index'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [RegisterController::class, 'index'])->name('login');
