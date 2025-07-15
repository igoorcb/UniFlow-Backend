<?php

namespace Tests\Unit\Application\Services;

use App\Application\DTOs\TodoDTO;
use App\Application\Repository\TodoService;
use App\Domain\Entities\Todo;
use App\Domain\Repositories\TodoRepositoryInterface;
use App\Domain\ValueObjects\TodoId;
use App\Domain\ValueObjects\TodoStatus;
use PHPUnit\Framework\TestCase;

class TodoServiceTest extends TestCase
{
    public function testCreateTodo()
    {
        $mockRepo = $this->createMock(TodoRepositoryInterface::class);
        $mockRepo->expects($this->once())->method('save');

        $service = new TodoService($mockRepo);

        $dto = new TodoDTO('Título Teste', 'Descrição Teste');
        $todo = $service->createTodo($dto);

        $this->assertInstanceOf(Todo::class, $todo);
        $this->assertEquals('Título Teste', $todo->getTitle());
        $this->assertEquals('Descrição Teste', $todo->getDescription());
        $this->assertEquals('pending', $todo->getStatus()->value());
    }
}
