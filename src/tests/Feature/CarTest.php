<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Car;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarTest extends TestCase
{
    use RefreshDatabase;

    protected Car $car;

    protected User $user;

    protected Role $role;

    protected function setUp(): void
    {
        parent::setUp();

        $this->role = Role::factory()->create();
        $this->user = User::factory()->create(['role_id' => $this->role->id]);
        $this->car = Car::factory()->make();
    }

    /** @test */
    public function userCanCreateCar()
    {
        //act
        $this->actingAs($this->user);
        $response = $this->postJson(route('car.store'), $this->car->toArray());
        //assert
        $response->assertCreated();
        $this->assertDatabaseHas('cars', [
            'model' => $this->car->model,
            'plate_code' => $this->car->plate_code,
            'user_id' => $this->user->id,
        ]);
    }

    /** @test */
    public function userCantHaveTwoCars()
    {
        //arrange
        Car::factory()->create();
        //act
        $this->actingAs($this->user);
        $response = $this->postJson(route('car.store'), $this->car->toArray());
        //assert
        $response->assertUnprocessable();
        $this->assertDatabaseMissing('cars', [
            'model' => $this->car->model,
            'plate_code' => $this->car->plate_code,
            'user_id' => $this->user->id,
        ]);
    }

    /** @test */
    public function carModelShouldBeString()
    {
        //arrange
        $this->car->model = 123;
        //act
        $this->actingAs($this->user);
        $response = $this->postJson(route('car.store'), $this->car->toArray());
        //assert
        $response->assertUnprocessable();
    }

    /** @test */
    public function carPlateCodeShouldBeRequired()
    {
        $this->car->plate_code = null;
        //act
        $this->actingAs($this->user);
        $response = $this->postJson(route('car.store'), $this->car->toArray());
        //assert
        $response->assertUnprocessable()
            ->assertInvalid(['plate_code']);
    }

    /** @test */
    public function carModelCodeShouldBeRequired()
    {
        $this->car->model = null;
        //act
        $this->actingAs($this->user);
        $response = $this->postJson(route('car.store'), $this->car->toArray());
        //assert
        $response->assertUnprocessable()
            ->assertInvalid(['model']);
    }

    /** @test */
    public function carBrandShouldBeRequired()
    {
        $this->car->brand = null;
        //act
        $this->actingAs($this->user);
        $response = $this->postJson(route('car.store'), $this->car->toArray());
        //assert
        $response->assertUnprocessable()
            ->assertInvalid(['brand']);
    }

    /** @test */
    public function userCanUpdateHisCar()
    {
        //arrange
        $newCar = Car::factory()->create();
        $newCar->model = 'new model';
        //act
        $this->actingAs($this->user);
        $response = $this->putJson(route('car.update', $newCar->id), $newCar->toArray());
        //assert
        $response->assertOk();
        $this->assertDatabaseHas('cars', [
            'model' => $newCar['model'],
            'user_id' => $this->user->id,
        ]);
    }

    /** @test */
    public function userCanDeleteHisCar()
    {
        //arrange
        $car = Car::factory()->create();
        //act
        $this->actingAs($this->user);
        $response = $this->deleteJson(route('car.destroy', $car->id));
        //assert
        $response->assertNoContent();
        $this->assertDatabaseEmpty('cars');
        $this->assertDatabaseMissing('cars', [
            'id' => $car->id,
        ]);
    }
}
