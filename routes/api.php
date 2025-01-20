<?php

use App\Http\Controllers\Api\ParkingRightController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('parking-right')
    ->name('parking_right.')
    ->group(function () {
        Route::controller(ParkingRightController::class)->group(function () {
            Route::get('/list',  'index');
            Route::post('/store',  'store');
            Route::get('/generate-token', 'generateToken');
        });
    });
