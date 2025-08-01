<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;

// Route::get('/sanctum/csrf-cookie', function (Request $request) {
//     return response()->json(['message' => 'CSRF cookie set']);
// });

// Login & Register
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public routes (no auth required)
Route::get('/menus', [MenuController::class, 'index']);
Route::get('/menus/search', [MenuController::class, 'search']);
Route::get('/menus/{id}', [MenuController::class, 'show']);

// Protected routes (require auth)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Profile
    Route::put('/user/update', [AuthController::class, 'updateProfile']);
    
    // Cart routes
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/store', [CartController::class, 'storeOrUpdateCart']);
    Route::delete('/cart/remove/{cart}', [CartController::class, 'removeFromCart']);
});