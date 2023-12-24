<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::factory(50)
            ->hasTrips(10)
            ->hasAddress()
            ->forRole(['name' => 'Customer'])
            ->create();
            
        User::factory()->create(['role_id' => 1, 'email' => 'x3U3c@gmail.com']);

        $roleId = Role::where('name', 'Customer')->value('id');
        User::factory(10)
            ->hasAddress()
            ->create(['role_id' => $roleId]);

        User::factory(25)
            ->hasCar()
            ->hasAddress()
            ->forRole(['name' => 'Driver'])
            ->create();
    }
}
