<?php

namespace App\Http\Controllers;

use App\Application\DTOs\TodoDTO;
use App\Application\Repository\TodoService;
use App\Http\Requests\TodoRequest;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Schema(
 *     schema="Task",
 *     type="object",
 *     required={"id", "title", "status"},
 *     @OA\Property(property="id", type="string", example="1"),
 *     @OA\Property(property="title", type="string", example="Comprar pão"),
 *     @OA\Property(property="description", type="string", example="Ir à padaria e comprar pão"),
 *     @OA\Property(property="status", type="string", example="pending"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-05-29T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-05-29T12:00:00Z")
 * )
 */
class TodoController extends Controller
{
    private TodoService $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     summary="List user tasks",
     *     tags={"Tasks"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Filter tasks by status",
     *         required=false,
     *         @OA\Schema(type="string", enum={"pending", "in_progress", "completed"})
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of tasks",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Task")),
     *             @OA\Property(property="meta", type="object",
     *                 @OA\Property(property="total", type="integer"),
     *                 @OA\Property(property="status_filter", type="string")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function index(): JsonResponse
    {
        $status = request()->query('status');
        $todos = $status ? $this->todoService->getTodosByStatus($status) : $this->todoService->getAllTodos();
        return response()->json($todos);
    }

    /**
     * @OA\Post(
     *     path="/api/tasks",
     *     summary="Create a new task",
     *     tags={"Tasks"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "description"},
     *             @OA\Property(property="title", type="string", example="Comprar pão"),
     *             @OA\Property(property="description", type="string", example="Ir à padaria")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Task created", @OA\JsonContent(ref="#/components/schemas/Task")),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function store(TodoRequest $request): JsonResponse
    {
        $dto = TodoDTO::fromArray($request->validated());
        $todo = $this->todoService->createTodo($dto);
        return response()->json($todo, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/tasks/{id}",
     *     summary="Get a task by ID",
     *     tags={"Tasks"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="Task found", @OA\JsonContent(ref="#/components/schemas/Task")),
     *     @OA\Response(response=404, description="Task not found"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function show(string $id): JsonResponse
    {
        $todo = $this->todoService->getTodoById($id);
        return $todo ? response()->json($todo) : response()->json(['error' => 'Todo not found'], 404);
    }

    /**
     * @OA\Put(
     *     path="/api/tasks/{id}",
     *     summary="Update a task",
     *     tags={"Tasks"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "description"},
     *             @OA\Property(property="title", type="string", example="Novo título"),
     *             @OA\Property(property="description", type="string", example="Nova descrição")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Task updated", @OA\JsonContent(ref="#/components/schemas/Task")),
     *     @OA\Response(response=404, description="Task not found"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function update(TodoRequest $request, string $id): JsonResponse
    {
        $dto = TodoDTO::fromArray($request->validated());
        $todo = $this->todoService->updateTodo($id, $dto);
        return $todo ? response()->json($todo) : response()->json(['error' => 'Todo not found'], 404);
    }

    /**
     * @OA\Patch(
     *     path="/api/tasks/{id}/complete",
     *     summary="Mark a task as completed",
     *     tags={"Tasks"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="Task completed", @OA\JsonContent(ref="#/components/schemas/Task")),
     *     @OA\Response(response=404, description="Task not found"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function complete(string $id): JsonResponse
    {
        $todo = $this->todoService->completeTodo($id);
        return $todo ? response()->json($todo) : response()->json(['error' => 'Todo not found'], 404);
    }

    /**
     * @OA\Delete(
     *     path="/api/tasks/{id}",
     *     summary="Delete a task",
     *     tags={"Tasks"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\Response(response=204, description="Task deleted"),
     *     @OA\Response(response=404, description="Task not found"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function destroy(string $id): JsonResponse
    {
        $deleted = $this->todoService->deleteTodo($id);
        return $deleted ? response()->json(null, 204) : response()->json(['error' => 'Todo not found'], 404);
    }
}
