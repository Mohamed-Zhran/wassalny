<?php

namespace Tests\Feature;

use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function user_can_have_a_car(): void
    {
        $user = User::factory()->create(['role_id'=>1]);
        $car=Car::factory()->make()->toArray();
        $c=$user->car()->create($car);
        $this->assertDatabaseHas('cars', [
            'user_id' => $user->id,
            'id' => $c->id,
        ]);
    }
}
