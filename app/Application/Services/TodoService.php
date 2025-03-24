<?php

namespace App\Application\Services;

use App\Application\DTOs\TodoDTO;
use App\Domain\Entities\Todo;
use App\Domain\Repositories\TodoRepositoryInterface;
use App\Domain\ValueObjects\TodoId;
use App\Domain\ValueObjects\TodoStatus;
use Ramsey\Uuid\Uuid;

class TodoService
{
    private TodoRepositoryInterface $repository;

    public function __construct(TodoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function createTodo(TodoDTO $dto): Todo
    {
        $todo = new Todo(
            new TodoId(Uuid::uuid4()->toString()),
            $dto->title,
            $dto->description,
            new TodoStatus($dto->status),
            new \DateTime()
        );
        $this->repository->save($todo);
        return $todo;
    }

    public function getAllTodos(): array
    {
        return $this->repository->all();
    }

    public function getTodoById(string $id): ?Todo
    {
        return $this->repository->findById(new TodoId($id));
    }

    public function updateTodo(string $id, TodoDTO $dto): ?Todo
    {
        $todo = $this->repository->findById(new TodoId($id));
        if (!$todo) {
            return null;
        }

        $updatedTodo = new Todo(
            $todo->getId(),
            $dto->title,
            $dto->description,
            new TodoStatus($dto->status),
            $todo->getCreatedAt(),
            new \DateTime()
        );
        $this->repository->save($updatedTodo);
        return $updatedTodo;
    }

    public function completeTodo(string $id): ?Todo
    {
        $todo = $this->repository->findById(new TodoId($id));
        if (!$todo) {
            return null;
        }

        $completedTodo = $todo->markAsCompleted();
        $this->repository->save($completedTodo);
        return $completedTodo;
    }

    public function deleteTodo(string $id): bool
    {
        $todo = $this->repository->findById(new TodoId($id));
        if (!$todo) {
            return false;
        }

        $this->repository->delete(new TodoId($id));
        return true;
    }
}