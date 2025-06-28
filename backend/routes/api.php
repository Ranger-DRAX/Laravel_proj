<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\BranchController;
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
    // Tables
    Route::apiResource('tables', TableController::class);
    // Bookings
    Route::apiResource('bookings', BookingController::class);
    // Payments
    Route::apiResource('payments', PaymentController::class);
}); 