<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model' => fake()->name(),
            'color' => fake()->colorName(),
            'brand' => fake()->name(),
            'cc' => fake()->biasedNumberBetween(100,10000),
            'plate_code' => fake()->word(),
        ];
    }
}
