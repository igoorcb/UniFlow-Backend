<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use Faker\Factory as Faker;

class TodoSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Criar 10 tarefas fictícias
        for ($i = 0; $i < 10; $i++) {
            Todo::create([
                'id' => Uuid::uuid4()->toString(), // Gera um UUID único
                'title' => $faker->sentence(3), // Título com 3 palavras
                'description' => $faker->optional()->paragraph(), // Descrição opcional
                'status' => $faker->randomElement(['pending', 'completed']), // Status aleatório
                'created_at' => now(),
                'updated_at' => $faker->randomElement([null, now()]), // updated_at opcional
            ]);
        }
    }
}