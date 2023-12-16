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
    protected User $driver;
    protected Role $driverRole;
    protected User $customer;
    protected Role $customerRole;
    protected function setUp(): void
    {
        parent::setUp();

        $this->driverRole = Role::factory()->create(['name' => 'driver']);
        $this->driver = User::factory()->create(['role_id' => $this->driverRole->id]);
        $this->customerRole = Role::factory()->create(['name' => 'customer']);
        $this->customer = User::factory()->create(['role_id' => $this->customerRole->id]);
        $this->car = Car::factory()->make(['user_id' => $this->driver->id]);
    }

    /** @test */
    public function userCanCreateCar()
    {
        //act
        $this->actingAs($this->driver);
        $response = $this->postJson(route('car.store'), $this->car->toArray());
        //assert
        $response->assertCreated();
        $this->assertDatabaseHas('cars', [
            'model' => $this->car->model,
            'plate_code' => $this->car->plate_code,
            'user_id' => $this->driver->id,
        ]);
    }

    /** @test */
    public function userCantHaveTwoCars()
    {
        //arrange
        Car::factory()->create(['user_id' => $this->driver->id]);
        //act
        $this->actingAs($this->driver);
        $response = $this->postJson(route('car.store'), $this->car->toArray());
        //assert
        $response->assertForbidden();
        $this->assertDatabaseMissing('cars', [
            'model' => $this->car->model,
            'plate_code' => $this->car->plate_code,
            'user_id' => $this->driver->id,
        ]);
    }

    /** @test */
    public function userCanGetHisCar()
    {
        //arrange
        $car = Car::factory()->create(['user_id' => $this->driver->id]);
        //act
        $this->actingAs($this->driver);
        $response = $this->getJson(route('car.show', $car->id));
        //assert
        $response->assertOk();
        $response->assertJson([
            'data' => $car->toArray()
        ]);
        $this->assertDatabaseHas('cars', [
            'id' => $car->id,
            'model' => $car->model,
            'plate_code' => $car->plate_code,
            'user_id' => $this->driver->id,
        ]);
    }

    /** @test */
    public function carModelShouldBeString()
    {
        //arrange
        $this->car->model = 123;
        //act
        $this->actingAs($this->driver);
        $response = $this->postJson(route('car.store'), $this->car->toArray());
        //assert
        $response->assertUnprocessable();
        $this->assertDatabaseMissing('cars', [
            'model' => $this->car->model,
        ]);
    }

    /** @test */
    public function carPlateCodeShouldBeRequired()
    {
        $this->car->plate_code = null;
        //act
        $this->actingAs($this->driver);
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
        $this->actingAs($this->driver);
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
        $this->actingAs($this->driver);
        $response = $this->postJson(route('car.store'), $this->car->toArray());
        //assert
        $response->assertUnprocessable()
            ->assertInvalid(['brand']);
    }

    /** @test */
    public function userCanUpdateHisCar()
    {
        //arrange
        $newCar = Car::factory()->create(['user_id' => $this->driver->id]);
        $newCar->model = 'new model';
        //act
        $this->actingAs($this->driver);
        $response = $this->putJson(route('car.update', $newCar->id), $newCar->toArray());
        //assert
        $response->assertOk();
        $this->assertDatabaseHas('cars', [
            'model' => $newCar['model'],
            'user_id' => $this->driver->id,
        ]);
    }


    /** @test */
    public function userCanUpdateOnlyHisOwnCar()
    {
        //arrange
        $user = User::factory()->create(['role_id' => $this->driverRole->id]);
        $newCar = Car::factory()->create(['user_id' => $this->driver->id]);
        $newCar->model = 'new model';
        //act
        $this->actingAs($user);
        $response = $this->putJson(route('car.update', $newCar->id), $newCar->toArray());
        //assert
        $response->assertForbidden();
        $this->assertDatabaseMissing('cars', [
            'model' => $newCar['model'],
            'user_id' => $this->driver->id,
        ]);
    }

    /** @test */
    public function userCanDeleteHisCar()
    {
        //arrange
        $car = Car::factory()->create(['user_id' => $this->driver->id]);
        //act
        $this->actingAs($this->driver);
        $response = $this->deleteJson(route('car.destroy', $car->id));
        //assert
        $response->assertNoContent();
        $this->assertDatabaseEmpty('cars');
        $this->assertDatabaseMissing('cars', [
            'id' => $car->id,
        ]);
    }

    /** @test */
    public function userCanDeleteOnlyHisOwnCar()
    {
        //arrange
        $user = User::factory()->create(['role_id' => $this->driverRole->id]);
        $car = Car::factory()->create(['user_id' => $this->driver->id]);
        //act
        $this->actingAs($user);
        $response = $this->deleteJson(route('car.destroy', $car->id));
        //assert
        $response->assertForbidden();
        $this->assertDatabaseHas('cars', [
            'id' => $car->id,
        ]);
    }

    /** @test */
    public function userShouldBeDriverToHaveACar()
    {
        //arrange
        $car = Car::factory()->make();
        //act
        $this->actingAs($this->driver);
        $response = $this->postJson(route('car.store'), $car->toArray());
        //assert
        $response = $response->assertCreated();
        $this->assertDatabaseHas('cars', [
            'model' => $car->model,
            'plate_code' => $car->plate_code,
            'user_id' => $this->driver->id,
        ]);
    }

    /** @test */
    public function customerCanNotHaveACar()
    {
        //arrange
        $car = Car::factory()->make();
        //act
        $this->actingAs($this->customer);
        $response = $this->postJson(route('car.store'), $car->toArray());
        //assert
        $response = $response->assertForbidden()->assertJson([
            'message' => 'Only drivers can create a car.'
        ]);
        $this->assertDatabaseMissing('cars', [
            'model' => $car->model,
            'plate_code' => $car->plate_code,
            'user_id' => $this->customer->id,
        ]);
    }
}
