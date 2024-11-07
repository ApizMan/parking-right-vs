<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    }
    return redirect('/auth/login');
});

// Login Interaction
Route::prefix('auth')
    ->name('auth.')
    ->group(function () {
        Route::get('/login', function () {
            if (Auth::check()) {
                return redirect('/home');
            }
            return view('auth.login'); // Your login view
        })->name('login');
    });
