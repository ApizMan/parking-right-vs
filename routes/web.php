<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/admin', function () {
    if (Auth::check()) {
        return redirect('/admin/dashboard');
    }
    return redirect('/admin/login');
});

Route::middleware(['auth_with_expiration'])->group(function () {
    //Admin Login Interaction
    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {
            // Protected Dashboard route - only accessible if the user is authenticated
            Route::get('/login', function () {
                return view('admin.auth.login'); // Your login view
            })->name('login');
            Route::get('/dashboard', function () {
                return (new DashboardController())->index();
            })->name('dashboard');
            Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');
            // Other protected routes
        });
});
