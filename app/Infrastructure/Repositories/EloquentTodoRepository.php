<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Todo;
use App\Domain\Repositories\TodoRepositoryInterface;
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
            $todoModel->updated_at
        );
    }

    public function all(): array
    {
        return TodoModel::all()->map(function (TodoModel $todoModel) {
            return new Todo(
                new TodoId($todoModel->id),
                $todoModel->title,
                $todoModel->description,
                new TodoStatus($todoModel->status),
                $todoModel->created_at,
                $todoModel->updated_at
            );
        })->toArray();
    }

    public function delete(TodoId $id): void
    {
        TodoModel::destroy($id->value());
    }
}