<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\Role;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $this->role = Role::factory()->create();
        $this->user = User::factory()->create(['role_id' => $this->role->id]);

        config(['database.default' => 'mysql']);
        config(['database.connections.mysql.database' => 'wassalny']);
    }

    /** @test */
    public function userCanCreateTripSuccessfully()
    {
        //arrange
        $trip = Trip::factory()->make();
        //act
        $this->actingAs($this->user);
        $response = $this->postJson(route('trip.store'), [
            'beginning_lat' => $trip->beginning->latitude,
            'beginning_lng' => $trip->beginning->longitude,
            'destination_lat' => $trip->destination->latitude,
            'destination_lng' => $trip->destination->longitude,
            'available_seats' => $trip->available_seats
        ]);
        //assert
        $response->assertOk();
        $this->assertTrue(
            Trip::whereEquals('beginning', $trip->beginning)
                ->whereEquals('destination', $trip->destination)
                ->where('available_seats', $trip->available_seats)
                ->exists()
        );
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
            'destination_lat' => $trip->destination->latitude,
            'destination_lng' => $trip->destination->longitude,
            'available_seats' => 5
        ]);
        //assert
        $response->assertOk();
        $this->assertTrue(
            Trip::whereEquals('beginning', new Point(35.99, 33.11))
                ->whereEquals('destination', $trip->destination)
                ->where('available_seats', 5)
                ->exists()
        );
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
