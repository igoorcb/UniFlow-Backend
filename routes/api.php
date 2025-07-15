<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->prefix('todos')->group(function () {
    Route::get('/', [TodoController::class, 'index']);
    Route::post('/', [TodoController::class, 'store']);
    Route::get('/{id}', [TodoController::class, 'show']);
    Route::put('/{id}', [TodoController::class, 'update']);
    Route::patch('/{id}/complete', [TodoController::class, 'complete']);
    Route::delete('/{id}', [TodoController::class, 'destroy']);
});
