<?php

namespace App\Domain\ValueObjects;

use InvalidArgumentException;

class TodoStatus
{
    public const PENDING = 'pending';
    public const COMPLETED = 'completed';

    private string $value;

    public function __construct(string $value)
    {
        if (!in_array($value, [self::PENDING, self::COMPLETED])) {
            throw new InvalidArgumentException('Invalid status value');
        }
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}