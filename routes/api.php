<?php

declare(strict_types=1);

// use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ContractController;
use App\Http\Controllers\Api\V1\FinancialSummaryController;
use App\Http\Controllers\Api\V1\PropertyController;
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

        // Property endpoints
        Route::post('/properties',          [PropertyController::class, 'store']);
        Route::get('/properties',           [PropertyController::class, 'index']);
        Route::get('/properties/{uuid}',    [PropertyController::class, 'show']);
        Route::put('/properties/{uuid}',    [PropertyController::class, 'update']);
        Route::delete('/properties/{uuid}', [PropertyController::class, 'destroy']);

        // Contract endpoints
        Route::post('/contracts',          [ContractController::class, 'store']);
        Route::get('/contracts',           [ContractController::class, 'index']);
        Route::get('/contracts/{uuid}',    [ContractController::class, 'show']);
        Route::put('/contracts/{uuid}',    [ContractController::class, 'update']);
        Route::delete('/contracts/{uuid}', [ContractController::class, 'destroy']);

        // Business Logic endpoints
        Route::get('/users/{uuid}/financial-summary', [FinancialSummaryController::class, 'show']);

    });

});
