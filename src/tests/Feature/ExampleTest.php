<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function user_can_have_a_car(): void
    {
        $user = User::factory()->create(['role_id' => 1]);
        $car = Car::factory()->make()->toArray();
        $c = $user->car()->create($car);
        $this->assertDatabaseHas('cars', [
            'user_id' => $user->id,
            'id' => $c->id,
        ]);
    }
}
