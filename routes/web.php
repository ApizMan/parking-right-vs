<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\DashboardController as UserDashboardController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        // Redirect logged-in users to their appropriate dashboard based on their role
        if (Auth::user()->role === 'admin') {
            return redirect('admin/dashboard');
        }
        return redirect('auth/dashboard');
    }
    return redirect('/auth/login');
});

Route::middleware(['user_with_expiration'])->group(function () {
    // User Login Interaction
    Route::prefix('auth')
        ->name('auth.')
        ->group(function () {
            Route::get('/login', function () {
                return view('auth.login'); // Your login view
            })->name('login');
            Route::get('/dashboard', function () {
                return (new UserDashboardController())->index();
            })->name('dashboard');
            Route::get('/logout-user', [UserDashboardController::class, 'logout'])->name('logout_user');
        });
});

Route::get('/admin', function () {
    if (Auth::check()) {
        // Redirect logged-in admin users to the admin dashboard
        if (Auth::user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }
        return redirect('/auth/dashboard'); // Redirect non-admin users to user dashboard
    }
    return redirect('/admin/login');
});

Route::middleware(['admin_with_expiration'])->group(function () {
    // Admin Login Interaction
    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/login', function () {
                return view('admin.auth.login'); // Admin login view
            })->name('login');
            Route::get('/dashboard', function () {
                return (new DashboardController())->index();
            })->name('dashboard');
            Route::get('/logout-admin', [DashboardController::class, 'logout'])->name('logout_admin');
            // Other protected routes
        });
});
