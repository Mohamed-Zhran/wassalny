<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\Role;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Tests\TestCase;

class TripTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Role $role;

    protected function setUp(): void
    {
        parent::setUp();
        $this->role = Role::factory()->create(['name' => 'driver']);
        $this->user = User::factory()->create(['role_id' => $this->role->id]);
    }

    /** @test */
    public function userCanCreateTripSuccessfully()
    {
        //arrange
        $trip = Trip::factory()->make();
        //act
        $this->actingAs($this->user);
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
            'user_id' => $this->user->id,
        ]);
    }

    /** @test */
    public function userCanGetHisTrips()
    {
        //arrange
        $trip = Trip::factory()->create();
        $trip->users()->attach($this->user->id);
        //act
        $this->actingAs($this->user);
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
        $this->actingAs($this->user);
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
        $this->actingAs($this->user);
        $response = $this->deleteJson(route('trip.destroy', ['trip' => $trip->id]));
        //assert
        $response->assertNoContent();
        $this->assertFalse(Trip::where('id', $trip->id)->exists());
    }
}
