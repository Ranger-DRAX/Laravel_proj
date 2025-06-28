<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\ClientBookingController;
use App\Http\Controllers\Api\TableController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProfileController;

// Authentication
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    // Profile
    Route::get('profile', [ProfileController::class, 'show']);
    Route::put('profile', [ProfileController::class, 'update']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);

    // Restaurants
    Route::apiResource('restaurants', RestaurantController::class);
    // Branches
    Route::apiResource('branches', BranchController::class);

    // Client bookings
    Route::get('client-bookings', [ClientBookingController::class, 'index']);
    Route::post('client-bookings', [ClientBookingController::class, 'store']);
    Route::get('client-bookings/{id}', [ClientBookingController::class, 'show']);
        Route::patch('client-bookings/{id}', [ClientBookingController::class,'update']);
    Route::put('client-bookings/{id}/pay', [ClientBookingController::class, 'pay']);

    // Tables
    Route::apiResource('tables', TableController::class);
    // Bookings
    Route::apiResource('bookings', BookingController::class);
    // Payments
    Route::apiResource('payments', PaymentController::class);
}); 