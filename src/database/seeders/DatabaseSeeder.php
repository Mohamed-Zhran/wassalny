<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Car;
use App\Models\Role;
use App\Models\Trips;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(50)->create();
         Trips::factory(10)->create();
         Address::factory(50)->create();
         Car::factory(50)->create();
         Role::factory(2)->create();
    }
}
