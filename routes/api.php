<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Rotas públicas de autenticação
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('todos')->group(function () {
        Route::get('/', [TodoController::class, 'index']);
        Route::post('/', [TodoController::class, 'store']);
        Route::get('/{id}', [TodoController::class, 'show']);
        Route::put('/{id}', [TodoController::class, 'update']);
        Route::patch('/{id}/complete', [TodoController::class, 'complete']);
        Route::delete('/{id}', [TodoController::class, 'destroy']);
    });

    Route::prefix('ecommerce')->group(function () {
        Route::post('/create-category', [CategoryController::class, 'store']);
        Route::post('/create-product', [ProductController::class, 'store']);
        Route::post('/update-product/{id}', [ProductController::class, 'update']);
    });


});
