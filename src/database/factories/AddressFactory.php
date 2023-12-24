<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'city' => fake()->city(),
            'country' => fake()->country(),
            'street' => fake()->streetAddress(),
            'postal_code' => fake()->postcode(),
            'lat' => fake()->randomFloat(5, 30, 34),
            'lng' => fake()->randomFloat(5, 30, 34),
            'user_id' => User::factory(),
        ];
    }
}
