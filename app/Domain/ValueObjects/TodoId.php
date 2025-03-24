<?php

namespace App\Domain\ValueObjects;

use InvalidArgumentException;

class TodoId
{
    private string $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Todo ID cannot be empty');
        }
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}