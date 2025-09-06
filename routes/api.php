<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// private routes
Route::middleware('auth:sanctum')->group(function () {
    Route::delete('logout', [AuthController::class, 'logout']);
   
});