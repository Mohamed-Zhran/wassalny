<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleId = Role::where('name', 'Customer')->value('id');
        Trip::factory(10)
            ->hasAttached(User::factory(3)->create(['role_id' => $roleId]))
            ->create();
    }
}
