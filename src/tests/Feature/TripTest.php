<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\Role;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TripTest extends TestCase
{
    use RefreshDatabase;

    protected Role $driverRole;
    protected User $driver;
    protected Role $customerRole;
    protected User $customer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->driverRole = Role::factory()->create(['name' => 'driver']);
        $this->driver = User::factory()->create(['role_id' => $this->driverRole->id]);
        $this->customerRole = Role::factory()->create(['name' => 'customer']);
        $this->customer = User::factory()->create(['role_id' => $this->customerRole->id]);
    }

    /** @test */
    public function driverCanCreateTripSuccessfully()
    {
        //arrange
        $trip = Trip::factory()->make();
        //act
        $this->actingAs($this->driver);
        $response = $this->postJson(route('trip.store'), $trip->toArray());
        //assert
        $response->assertOk();
        $this->assertDatabaseHas('trips', [
            'beginning_lat' => $trip->beginning_lat,
            'beginning_lng' => $trip->beginning_lng,
            'destination_lat' => $trip->destination_lat,
            'destination_lng' => $trip->destination_lng,
            'available_seats' => $trip->available_seats,
        ]);
        $this->assertDatabaseHas('trip_user', [
            'trip_id' => $response['data']['id'],
            'user_id' => $this->driver->id,
        ]);
    }

    /** @test */
    public function customerCantCreateTrip()
    {
        //arrange
        $trip = Trip::factory()->make();
        //act
        $this->actingAs($this->customer);
        $response = $this->postJson(route('trip.store'), $trip->toArray());
        //assert
        $response->assertForbidden();
        $this->assertDatabaseMissing('trips', $trip->toArray());
    }

    /** @test */
    public function userCanGetHisTrips()
    {
        //arrange
        $trip = Trip::factory()->hasAttached($this->driver)->create();
        //act
        $this->actingAs($this->driver);
        $response = $this->getJson(route('trip.index'));
        //assert
        $response->assertOk();
        $response->assertJson(['data' => [$trip->toArray()]]);
    }

    /** @test */
    public function userCanUpdateTripSuccessfully()
    {
        //arrange
        $trip = Trip::factory()->create();
        //act
        $this->actingAs($this->driver);
        $response = $this->putJson(route('trip.update', ['trip' => $trip->id]), [
            'beginning_lat' => 35.99,
            'beginning_lng' => 33.11,
            'destination_lat' => $trip->destination_lat,
            'destination_lng' => $trip->destination_lng,
            'available_seats' => 5
        ]);
        //assert
        $response->assertOk();
        $this->assertDatabaseHas('trips', [
            'beginning_lat' => 35.99,
            'beginning_lng' => 33.11,
            'destination_lat' => $trip->destination_lat,
            'destination_lng' => $trip->destination_lng,
            'available_seats' => 5,
        ]);
    }

    /** @test */
    public function userCanDeleteTrip()
    {
        //arrange
        $trip = Trip::factory()->create();
        //act
        $this->actingAs($this->driver);
        $response = $this->deleteJson(route('trip.destroy', ['trip' => $trip->id]));
        //assert
        $response->assertNoContent();
        $this->assertFalse(Trip::where('id', $trip->id)->exists());
    }

    /** @test */
    public function userCanBookTripSuccessfully()
    {
        //arrange
        $trip = Trip::factory()->hasAttached($this->driver)->create();
        //act
        $this->actingAs($this->customer);
        $response = $this->postJson(route('trip.book', ['trip' => $trip->id]));
        //assert
        $response->assertOk();
        $response->assertJson(['message' => 'You have successfully booked this trip.']);
        $this->assertDatabaseHas('trip_user', [
            'trip_id' => $trip->id,
            'user_id' => $this->customer->id
        ]);
    }

    /** @test */
    public function customerOnlyCanBookTrip()
    {
        //arrange
        $trip = Trip::factory()->create();
        //act
        $this->actingAs($this->driver);
        $response = $this->postJson(route('trip.book', ['trip' => $trip->id]));
        //assert
        $response->assertForbidden();
        $this->assertDatabaseMissing('trip_user', [
            'trip_id' => $trip->id,
            'user_id' => $this->driver->id
        ]);
    }

    /** @test */
    public function tripCantHaveMoreThanAvailableSeats()
    {
        //arrange
        $trip = Trip::factory()->hasAttached([$this->driver, User::factory(2)->create(['role_id' => $this->customerRole->id])])->create(['available_seats' => 2]);
        //act
        $this->actingAs($this->customer);
        $response = $this->postJson(route('trip.book', ['trip' => $trip->id]));
        //assert
        $response->assertForbidden();
        $this->assertDatabaseMissing('trip_user', [
            'trip_id' => $trip->id,
            'user_id' => $this->customer->id
        ]);
    }
}
