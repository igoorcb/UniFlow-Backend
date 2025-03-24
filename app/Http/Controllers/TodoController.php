<?php

namespace App\Http\Controllers;

use App\Application\DTOs\TodoDTO;
use App\Application\Services\TodoService;
use App\Http\Requests\TodoRequest;
use Illuminate\Http\JsonResponse;

class TodoController extends Controller
{
    private TodoService $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function index(): JsonResponse
    {
        $todos = $this->todoService->getAllTodos();
        return response()->json($todos); // Serialização automática
    }

    public function store(TodoRequest $request): JsonResponse
    {
        $dto = TodoDTO::fromArray($request->validated());
        $todo = $this->todoService->createTodo($dto);
        return response()->json($todo, 201); // Serialização automática
    }

    public function show(string $id): JsonResponse
    {
        $todo = $this->todoService->getTodoById($id);
        return $todo ? response()->json($todo) : response()->json(['error' => 'Todo not found'], 404);
    }

    public function update(TodoRequest $request, string $id): JsonResponse
    {
        $dto = TodoDTO::fromArray($request->validated());
        $todo = $this->todoService->updateTodo($id, $dto);
        return $todo ? response()->json($todo) : response()->json(['error' => 'Todo not found'], 404);
    }

    public function complete(string $id): JsonResponse
    {
        $todo = $this->todoService->completeTodo($id);
        return $todo ? response()->json($todo) : response()->json(['error' => 'Todo not found'], 404);
    }

    public function destroy(string $id): JsonResponse
    {
        $deleted = $this->todoService->deleteTodo($id);
        return $deleted ? response()->json(null, 204) : response()->json(['error' => 'Todo not found'], 404);
    }
}