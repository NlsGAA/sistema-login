<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});


Route::post('/register', [App\Http\Controllers\UserController::class, 'store'])->name('register-user');

Route::post('/authenticate', [App\Http\Controllers\UserController::class, 'authenticate'])->name('authenticate');


Route::middleware('can:is-admin')->group(function () {
    Route::get('/permissions', [App\Http\Controllers\UserController::class, 'index'])
        ->name('index');
    
    Route::post('/toggle/permissions', [App\Http\Controllers\UserController::class, 'togglePermissions'])
        ->name('toggle-permissions');

    Route::delete('/delete-user/{id}', [App\Http\Controllers\UserController::class, 'delete'])
        ->name('delete-user');
});


Route::get('/product-management', function () {
    return view('product-management');
})->middleware('can:product-management');

Route::get('/category-management', function () {
    return view('category-management');
})->middleware('can:category-management');

Route::get('/brand-management', function () {
    return view('brand-management');
})->middleware('can:brand-management');