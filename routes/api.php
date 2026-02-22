<?php

declare(strict_types=1);

// use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Support\Facades\Route;

// Public routes (no token required)
Route::prefix('v1')->group(function (): void {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login',    [AuthController::class, 'login']);

    // Protected routes (Passport token required)
    Route::middleware('auth:api')->group(function (): void {
        Route::post('/logout', [AuthController::class, 'logout']);
    });

});
