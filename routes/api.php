<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProgramController;
use App\Models\Programa;

// public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// private routes
Route::middleware('auth:sanctum')->group(function () {
    Route::delete('/logout', [AuthController::class, 'logout']);
    Route::get('/programas', [ProgramController::class, 'index']);
    Route::post('/novo-programa', [ProgramController::class, 'store']);
    Route::get('/programa/{id}', [ProgramController::class, 'show']);
    Route::delete('/apagar/{id}', [ProgramController::class, 'destroy']);
});
