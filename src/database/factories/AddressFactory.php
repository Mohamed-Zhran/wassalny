<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

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
            'coordinates' => DB::raw('POINT(32.299402, 30.625076)'),
            'user_id' => fake()->unique()->randomElement(User::pluck('id')->all())
        ];
    }
}
