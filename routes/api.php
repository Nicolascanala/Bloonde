<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\HobbyistsController;

// Auth routes
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::get('/me', 'me')->middleware('auth:sanctum');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});

// Sólo Admin
// Nota: normalmente agregaría un Model Policy para mayor seguridad.
Route::middleware(['auth:sanctum', 'abilities:admin'])->group(function () {
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy']);
});

// Admin y datos propios del User
// Nota: normalmente agregaría un Model Policy para mayor seguridad.
Route::middleware(['auth:sanctum', 'ability:admin,customer'])->group(function () {
    Route::get('/customers/{customer}', [CustomerController::class, 'show']);
    Route::put('/customers/{customer}', [CustomerController::class, 'update']);
});

// Endpoint para los hobbyists asociados a un hobby.
Route::get('/hobbyists/{hobbie}', HobbyistsController::class)->middleware(['auth:sanctum', 'abilities:admin']);

// Endpoint para exportar PDF.
Route::get('/report', ReportController::class)->middleware(['auth:sanctum', 'abilities:admin']);
