<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServiceController;

// Home page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard — redirect based on role
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->isProvider()) {
            return redirect()->route('provider.dashboard');
        }
        return redirect()->route('customer.dashboard');
    })->name('dashboard');
});

// Provider routes
Route::middleware(['auth', 'provider'])->prefix('provider')->name('provider.')->group(function () {
    Route::get('/dashboard', [ProviderController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile/create', [ProviderController::class, 'createProfile'])->name('profile.create');
    Route::post('/profile', [ProviderController::class, 'storeProfile'])->name('profile.store');
    Route::get('/profile/edit', [ProviderController::class, 'editProfile'])->name('profile.edit');
Route::put('/profile', [ProviderController::class, 'updateProfile'])->name('profile.update');
    // Services
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');

    // Availability
    Route::get('/availability', [ProviderController::class, 'availability'])->name('availability');
    Route::post('/availability', [ProviderController::class, 'storeAvailability'])->name('availability.store');

    // Bookings
    Route::get('/bookings', [ProviderController::class, 'bookings'])->name('bookings');
    Route::post('/bookings/{id}/confirm', [BookingController::class, 'confirm'])->name('bookings.confirm');
    Route::post('/bookings/{id}/reject', [BookingController::class, 'reject'])->name('bookings.reject');
});

// Customer routes
Route::middleware(['auth', 'customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
    Route::get('/providers', [CustomerController::class, 'providers'])->name('providers');
    Route::get('/providers/{id}', [CustomerController::class, 'showProvider'])->name('providers.show');
    Route::get('/providers/{id}/book', [CustomerController::class, 'book'])->name('book');
    Route::post('/providers/{id}/book', [CustomerController::class, 'storeBooking'])->name('book.store');
    Route::get('/bookings', [CustomerController::class, 'bookings'])->name('bookings');
    Route::post('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::get('/profile/edit', [CustomerController::class, 'editProfile'])->name('profile.edit');
    Route::patch('/profile/update', [CustomerController::class, 'updateProfile'])->name('profile.update');

});

require __DIR__.'/auth.php';