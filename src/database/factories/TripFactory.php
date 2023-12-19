<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MatanYadaev\EloquentSpatial\Objects\Point;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'beginning_lat' => fake()->randomFloat(5, 30, 34),
            'beginning_lng' => fake()->randomFloat(5, 30, 34),
            'destination_lat' => fake()->randomFloat(5, 30, 34),
            'destination_lng' => fake()->randomFloat(5, 30, 34),
            'available_seats' => fake()->numberBetween(2, 54),
        ];
    }
}
