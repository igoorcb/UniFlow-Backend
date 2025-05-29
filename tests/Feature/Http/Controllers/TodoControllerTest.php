<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Todo;

class TodoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreValidatesTitle()
    {
        $response = $this->postJson('/api/todos', [
            'title' => '',
            'description' => 'desc'
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['title']);
    }

    public function testStoreCreatesTodo()
    {
        $response = $this->postJson('/api/todos', [
            'title' => 'Novo Todo',
            'description' => 'desc'
        ]);

        $response->assertStatus(201);
        $response->assertJsonFragment(['title' => 'Novo Todo']);
    }

    public function testIndexListsTodos()
    {
        Todo::factory()->count(2)->create();

        $response = $this->getJson('/api/todos');

        $response->assertStatus(200);
        $response->assertJsonCount(2);
    }

    public function testUpdateStatus()
    {
        $todo = Todo::factory()->create(['status' => 'pending']);

        $response = $this->patchJson("/api/todos/{$todo->id}/complete");

        $response->assertStatus(200);
        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'status' => 'completed'
        ]);
    }

    public function testDeleteTodo()
    {
        $todo = Todo::factory()->create();

        $response = $this->deleteJson("/api/todos/{$todo->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('todos', [
            'id' => $todo->id
        ]);
    }

    public function testFilterTodosByStatus()
    {
        Todo::factory()->create(['status' => 'pending']);
        Todo::factory()->create(['status' => 'completed']);

        $response = $this->getJson('/api/todos?status=completed');

        $response->assertStatus(200);
        $response->assertJsonFragment(['status' => 'completed']);
        $response->assertJsonMissing(['status' => 'pending']);
    }
}