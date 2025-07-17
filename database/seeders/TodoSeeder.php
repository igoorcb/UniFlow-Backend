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

        // Pega o primeiro usuário existente
        $userId = \DB::table('users')->value('id') ?? 1;
        // Criar 10 tarefas fictícias
        for ($i = 0; $i < 10; $i++) {
            Todo::create([
                'id' => Uuid::uuid4()->toString(),
                'title' => $faker->sentence(3),
                'description' => $faker->optional()->paragraph(),
                'status' => $faker->randomElement(['pending', 'completed']),
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => $faker->randomElement([null, now()]),
            ]);
        }
    }
}