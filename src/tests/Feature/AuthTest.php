<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected static string $password = 'password';

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create(['role_id' => 1]);
    }


    /** @test */
    public function userCanRegisterSuccessfully(): void
    {
        //arrange
        $role=Role::factory()->create(['name' => 'Customer']);
        $user = User::factory()->make(['role_id'=>$role->id])->toArray();
        $user['email']='mohamed@gmail.com';
        $user['password']='password';
        $user['password_confirmation']='password';
        //act
        $response = $this->postJson(route('register'), $user);
        //assert
        $response->assertCreated();
    }

    public function userCanLoginSuccessfully(): void
    {
        $response = $this->postJson(route('login'), [
            'email' => $this->user->email,
            'password' => self::$password,
        ]);

        $response->assertOk();
    }

    /** @test */
    public function userCantLoginWithWrongPassword(): void
    {
        $response = $this->postJson(route('login'), [
            'email' => $this->user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertUnprocessable();
    }

    /** @test */
    public function userCantLoginWithWrongEmail(): void
    {
        $response = $this->postJson(route('login'), [
            'email' => 'test@test.com',
            'password' => 'password',
        ]);

        $response->assertUnauthorized();
    }

    /** @test */
    public function userLoginEmailIsRequired(): void
    {
        $response = $this->postJson(route('login'), [
            'password' => 'password',
        ]);

        $response->assertInvalid(['email']);
    }

    /** @test */
    public function userLoginPasswordIsRequired(): void
    {
        $response = $this->postJson(route('login'), [
            'email' => $this->user->email,
        ]);
        $response->assertInvalid(['password']);
    }

    /** @test */
    public function userLoginEmailIsEmail(): void
    {
        $response = $this->postJson(route('login'), [
            'email' => 'mohamed@wrong.con',
            'password' => 'password',
        ]);
        $response->assertInvalid(['email']);
    }
}
