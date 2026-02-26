<?php

use Illuminate\Support\Facades\Route;

// Import All Controllers
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ParcelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DriverPortalController;
use App\Http\Controllers\PublicTrackingController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CustomerDashboardController;

/*
|--------------------------------------------------------------------------
| 1. Public Facing Routes (No Auth Required)
|--------------------------------------------------------------------------
*/


Route::get('/', function () { return view('home'); })->name('home');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/services', function () { return view('services'); })->name('services'); // Added Service Route
Route::get('/privacy-policy', function () { return view('legal.privacy'); })->name('privacy');
Route::get('/terms-and-conditions', function () { return view('legal.terms'); })->name('terms');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Public Tracking System (SRS 3.5)
Route::get('/track', [PublicTrackingController::class, 'index'])->name('tracking.index');
Route::get('/track/{tracking_code}', [PublicTrackingController::class, 'track'])->name('tracking.show');

// Driver Portal (Token Based - SRS 2.3: No Login Required)
Route::get('/portal/{token}', [DriverPortalController::class, 'showPortal'])->name('driver.portal');
Route::post('/portal/{token}/update/{parcel}', [DriverPortalController::class, 'updateStatus'])->name('driver.portal.update');


/*
|--------------------------------------------------------------------------
| 2. Authentication & Traffic Cop (Redirection)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    
    // The "Traffic Cop": Decides which dashboard to send the user to
    Route::get('/dashboard', function () {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if ($user->isAdmin() || $user->isStaff()) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->isCustomer()) {
            return redirect()->route('customer.dashboard');
        }

        return redirect()->route('home');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | 3. Admin & Staff Routes (Role Protected)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin,staff'])->prefix('admin')->name('admin.')->group(function () {
        
        // Admin Dashboard Overview
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
        Route::post('/parcels/bulk-action', [AdminController::class, 'bulkAction'])->name('parcels.bulk_action');

        // Parcel Management
        Route::get('/parcels', [AdminController::class, 'indexParcels'])->name('parcels.index');
        Route::get('/parcels/create', [AdminController::class, 'createParcel'])->name('parcels.create'); // Specific first
        Route::post('/parcels/store', [AdminController::class, 'storeParcel'])->name('parcels.store');
        Route::get('/parcels/{parcel}', [AdminController::class, 'showParcel'])->name('parcels.show'); // Wildcard last
        Route::post('/parcels/{parcel}/status', [AdminController::class, 'updateStatus'])->name('parcels.update_status');

        // Driver Management
        Route::get('/drivers', [AdminController::class, 'indexDrivers'])->name('drivers.index');
        Route::get('/drivers/create', [AdminController::class, 'createDriver'])->name('drivers.create');
        Route::post('/drivers/store', [AdminController::class, 'storeDriver'])->name('drivers.store');

        // Driver Assignment (Logic handled by ParcelController)
        Route::get('/parcels/{parcel}/assign', [AdminController::class, 'showAssignForm'])->name('parcels.assign');
        Route::post('/parcels/{parcel}/assign', [ParcelController::class, 'assignDriver'])->name('parcels.process_assignment');
    });

    /*
    |--------------------------------------------------------------------------
    | 4. Customer Routes (Role Protected)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:customer'])->prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
        Route::get('/parcel/create', [CustomerDashboardController::class, 'create'])->name('parcels.create');
        Route::post('/parcel/store', [CustomerDashboardController::class, 'store'])->name('parcels.store');
    });

    /*
    |--------------------------------------------------------------------------
    | 5. User Profile (Shared)
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';