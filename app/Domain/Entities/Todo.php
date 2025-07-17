<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\TodoId;
use App\Domain\ValueObjects\TodoStatus;
use JsonSerializable;

class Todo implements JsonSerializable
{
    private TodoId $id;
    private string $title;
    private ?string $description;
    private TodoStatus $status;
    private \DateTime $createdAt;
    private ?\DateTime $updatedAt;
    private string $userId;

    public function __construct(
        TodoId $id,
        string $title,
        ?string $description,
        TodoStatus $status,
        \DateTime $createdAt,
        ?\DateTime $updatedAt = null,
        string $userId
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->userId = $userId;
    }

    public function getId(): TodoId
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getStatus(): TodoStatus
    {
        return $this->status;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function markAsCompleted(): self
    {
        return new self(
            $this->id,
            $this->title,
            $this->description,
            new TodoStatus(TodoStatus::COMPLETED),
            $this->createdAt,
            new \DateTime()
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status->value(),
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt ? $this->updatedAt->format('Y-m-d H:i:s') : null,
        ];
    }

    // Novo método exigido pela interface JsonSerializable
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}