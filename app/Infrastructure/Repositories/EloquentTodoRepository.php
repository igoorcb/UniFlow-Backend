<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Todo;
use App\Domain\Interfaces\TodoRepositoryInterface;
use App\Domain\ValueObjects\TodoId;
use App\Domain\ValueObjects\TodoStatus;
use App\Models\Todo as TodoModel;

class EloquentTodoRepository implements TodoRepositoryInterface
{
    public function save(Todo $todo): void
    {
        TodoModel::updateOrCreate(
            ['id' => $todo->getId()->value()],
            [
                'title' => $todo->getTitle(),
                'description' => $todo->getDescription(),
                'status' => $todo->getStatus()->value(),
                'created_at' => $todo->getCreatedAt(),
                'updated_at' => $todo->getUpdatedAt(),
            ]
        );
    }
    public function findByStatus(string $status): array
    {
        return \App\Models\Todo::where('status', $status)->get()->all();
    }
    public function findById(TodoId $id): ?Todo
    {
        $todoModel = TodoModel::find($id->value());
        if (!$todoModel) {
            return null;
        }

        return new Todo(
            new TodoId($todoModel->id),
            $todoModel->title,
            $todoModel->description,
            new TodoStatus($todoModel->status),
            $todoModel->created_at,
            $todoModel->updated_at,
            $todoModel->user_id
        );
    }

    public function all(string $userId): array
    {
        return \App\Models\Todo::where('user_id', $userId)->get()->map(function (\App\Models\Todo $todoModel) {
            return new Todo(
                new TodoId($todoModel->id),
                $todoModel->title,
                $todoModel->description,
                new TodoStatus($todoModel->status),
                $todoModel->created_at,
                $todoModel->updated_at,
                $todoModel->user_id
            );
        })->toArray();
    }

    public function delete(TodoId $id): void
    {
        TodoModel::destroy($id->value());
    }
}
