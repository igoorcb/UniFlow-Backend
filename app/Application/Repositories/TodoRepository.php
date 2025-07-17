<?php

namespace App\Application\Repositories;

use App\Application\DTOs\TodoDTO;
use App\Domain\Entities\Todo;
use App\Domain\Interfaces\TodoRepositoryInterface;
use App\Domain\ValueObjects\TodoId;
use App\Domain\ValueObjects\TodoStatus;
use Ramsey\Uuid\Uuid;

class TodoRepository
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
            new \DateTime(),
            null,
            $dto->user_id
        );
        $this->repository->save($todo);
        return $todo;
    }

    public function getAllTodos($userId): array
    {
        return $this->repository->all($userId);
    }

    public function getTodoById(string $id): ?Todo
    {
        return $this->repository->findById(new TodoId($id));
    }
    public function getTodosByStatus($status, $userId): array
    {
        return $this->repository->findByStatus($status, $userId);
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
            new \DateTime(),
            $todo->getUserId()
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

        $completedTodo = new Todo(
            $todo->getId(),
            $todo->getTitle(),
            $todo->getDescription(),
            new TodoStatus('completed'),
            $todo->getCreatedAt(),
            new \DateTime(),
            $todo->getUserId()
        );
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
