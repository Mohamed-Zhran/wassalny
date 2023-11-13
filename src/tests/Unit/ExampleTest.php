<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Domain\Services\Interfaces\IUserService;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_users_index_gets_all_users(): void
    {
        $this->assertEquals(User::all(), $this->app->makeWith(IUserService::class)->index());
    }
}
