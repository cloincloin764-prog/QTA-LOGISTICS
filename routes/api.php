<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParcelController;
use App\Http\Controllers\Api\TrackingController;
use App\Http\Controllers\DriverParcelController;
use App\Http\Controllers\AdminParcelController;
use App\Http\Controllers\PublicTrackingController;
use App\Http\Controllers\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', 'admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/parcels', [AdminParcelController::class, 'index']);
        Route::post('/parcels/{parcel}/assign-driver', [AdminParcelController::class, 'assignDriver']);
        Route::get('/admin/dashboard/stats', [AdminDashboardController::class, 'stats']);
    });

/*
|--------------------------------------------------------------------------
| DRIVER ROUTES (TOKEN BASED — NO LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('driver.token')
    ->prefix('driver')
    ->group(function () {
        Route::get('/parcels', [DriverParcelController::class, 'index']);
        Route::get('/parcels/{parcel}', [DriverParcelController::class, 'show']);
        Route::post('/parcels/{parcel}/status', [DriverParcelController::class, 'updateStatus']);
        Route::get('/driver/dashboard', [DriverParcelController::class, 'dashboard']);
    });

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/track/{tracking_code}', [PublicTrackingController::class, 'track']);
Route::get('/track/{trackingCode}', [TrackingController::class, 'track']);
