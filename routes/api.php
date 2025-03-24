<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::prefix('todos')->group(function () {
    Route::get('/', [TodoController::class, 'index']);         // Listar todos
    Route::post('/', [TodoController::class, 'store']);        // Criar
    Route::get('/{id}', [TodoController::class, 'show']);      // Mostrar um
    Route::put('/{id}', [TodoController::class, 'update']);    // Atualizar
    Route::patch('/{id}/complete', [TodoController::class, 'complete']); // Marcar como concluído
    Route::delete('/{id}', [TodoController::class, 'destroy']); // Deletar
});