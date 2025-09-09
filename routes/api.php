<?php

use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProgramController;

// public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// private routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    // PROGRAMA
    Route::get('/programas', [ProgramController::class, 'index']);
    Route::post('/novo-programa', [ProgramController::class, 'store']);
    Route::get('/programa/{id}', [ProgramController::class, 'show']);
    Route::delete('/programa/{id}', [ProgramController::class, 'destroy']);
    Route::post('/programa/{id}', [ProgramController::class, 'update']);
    // CANDIDATURA
    Route::get('/candidaturas', [ApplicationController::class, 'index']);    
    Route::post('/candidaturas', [ApplicationController::class, 'store']);
    // Candidatura de um unico usario
    Route::get('/candidaturas/{id}', [ApplicationController::class, 'view']);

});
