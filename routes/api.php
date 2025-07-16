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
        Route::delete('/{id}', [TodoController::class, 'destroy']);
        Route::patch('/{id}/complete', [TodoController::class, 'complete']);
    });

    /*
       Usando ApiResource ->

        //GET               /example           → index
        //POST              /example           → store
        //GET               /example/{id}      → show
        //PUT ou Patch      /example/{id}      → update
        //DELETE            /example/{id}      → destroy
    */

    Route::prefix('ecommerce')->group(function () {
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('products', ProductController::class);
    });


});
