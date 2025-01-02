<?php

use App\Http\Controllers\UserController;

// Protect routes with Sanctum middleware
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    //Route::post('/users', [UserController::class, 'store']); // Public access

});




