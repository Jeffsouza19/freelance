<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws RandomException
     */
    public function definition(): array
    {

        return [
            'title' => fake()->text(30),
            'description' => fake()->text(200),
            'ends_at' => fake()->dateTimeBetween('now', '+1 days'),
            'status' => fake()->randomElement(['open', 'closed']),
            'tech_stack' => fake()->randomElements(['react', 'nodejs', 'vite', 'nextjs', 'javascript'], random_int(1,5)),
            'created_by' => User::factory()
        ];
    }
}
