<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::factory(10)->hasAttached(Trip::factory(10))->hasAddress()->forRole(['name' => 'Driver'])->create();
        User::factory(3)->hasCar()->forRole(['name' => 'Customer'])->create();
    }
}
