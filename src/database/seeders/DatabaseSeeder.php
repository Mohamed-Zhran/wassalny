<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Car;
use App\Models\Role;
use App\Models\Trip;
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
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            TripSeeder::class,
            AddressSeeder::class,
        ]);
    }
}
