<?php

namespace App\Domain\Interfaces;

use App\Domain\Entities\Todo;
use App\Domain\ValueObjects\TodoId;

interface TodoRepositoryInterface
{
    public function save(Todo $todo): void;
    public function findById(TodoId $id): ?Todo;
    public function all(string $userId): array;
    public function delete(TodoId $id): void;
    public function findByStatus(string $status, string $userId): array;
}
