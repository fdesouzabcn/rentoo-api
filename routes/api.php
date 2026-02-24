<?php

declare(strict_types=1);

// use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

// Public routes (no token required)
Route::prefix('v1')->group(function (): void {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login',    [AuthController::class, 'login']);

    // Protected routes (Passport token required)
    Route::middleware('auth:api')->group(function (): void {
        Route::post('/logout', [AuthController::class, 'logout']);

        // User endpoints
        Route::get('/users',           [UserController::class, 'index']);
        Route::get('/users/{uuid}',    [UserController::class, 'show']);
        Route::delete('/users/{uuid}', [UserController::class, 'destroy']);
    });

});
