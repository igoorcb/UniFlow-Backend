<?php

namespace App\Application\DTOs;

class TodoDTO
{
    public string $title;
    public ?string $description;
    public string $status;

    public function __construct(string $title, ?string $description, string $status = 'pending')
    {
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['title'],
            $data['description'] ?? null,
            $data['status'] ?? 'pending'
        );
    }
}