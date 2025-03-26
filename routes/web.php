<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});


Route::post('/register', [App\Http\Controllers\UserController::class, 'store'])->name('register-user');

Route::get('/permissions', [App\Http\Controllers\UserController::class, 'index'])->name('index');