<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_by' => User::inRandomOrder()->first()->id,
            'assigned_to' => User::inRandomOrder()->first()->id,
            'title' => $this->faker->text(10),
            'description' => $this->faker->text(150),
            'index' => $this->faker->randomDigit(),
            'status' => array_rand([0, 1, 2, 3], 1),
            'created_at' => $this->faker->dateTimeBetween('now', '+365 days'),
        ];
    }
}
