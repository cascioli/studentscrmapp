<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'citta' => fake()->unique()->safeEmail(),
            'inizio_corso' => fake()->date(),
            'fine_corso' => fake()->date(),
            'its_id' => \App\Models\ItsCenter::inRandomOrder()->first()->id,
        ];
    }
}
