<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\WaitlistController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('restaurants', App\Http\Controllers\RestaurantController::class);
    Route::resource('restaurants.tables', App\Http\Controllers\TableController::class);
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminDashboardController::class, '__invoke'])->name('admin.dashboard');
    Route::put('/admin/booking/approve/{id}', [App\Http\Controllers\AdminDashboardController::class, 'approve'])->name('admin.approve');
    Route::put('/admin/booking/reject/{id}', [App\Http\Controllers\AdminDashboardController::class, 'reject'])->name('admin.reject');
    Route::put('/admin/booking/dispute/{id}', [App\Http\Controllers\AdminDashboardController::class, 'dispute'])->name('admin.dispute');
    Route::get('/admin/analytics', [App\Http\Controllers\AdminDashboardController::class, 'analytics'])->name('admin.analytics');
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerDashboardController::class, '__invoke'])->name('customer.dashboard');
    Route::put('/customer/booking/cancel/{id}', [CustomerDashboardController::class, 'cancel'])->name('customer.cancel');
    Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/available/{restaurant}', [BookingController::class, 'showAvailableTables'])->name('bookings.availableTables');
    Route::get('bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('bookings/confirmation/{id}', [BookingController::class, 'confirmation'])->name('bookings.confirmation');
    Route::get('bookings/api/available/{restaurant}', [BookingController::class, 'apiAvailableTables'])->name('bookings.apiAvailableTables');
    Route::post('waitlist', [WaitlistController::class, 'store'])->name('waitlist.store');
    Route::get('waitlist/confirmation/{id}', [WaitlistController::class, 'confirmation'])->name('waitlist.confirmation');
});

require __DIR__.'/auth.php';
