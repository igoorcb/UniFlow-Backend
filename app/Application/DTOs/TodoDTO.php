<?php

namespace App\Application\DTOs;

class TodoDTO
{
    public string $title;
    public ?string $description;
    public string $status;
    public string $user_id;

    public function __construct(string $title, ?string $description, string $status = 'pending', string $user_id)
    {
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->user_id = $user_id;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['title'],
            $data['description'] ?? null,
            $data['status'] ?? 'pending',
            $data['user_id']
        );
    }
}