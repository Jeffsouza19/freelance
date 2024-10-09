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
            'description' => htmlspecialchars(fake()->randomHtml()),
            'ends_at' => fake()->dateTimeBetween('now', '+1 days'),
            'status' => fake()->randomElement(['open', 'closed']),
            'tech_stack' => fake()->randomElements(['react', 'php', 'laravel', 'vue', 'java', 'javascript'], random_int(1,5)),
            'created_by' => User::factory()
        ];
    }
}