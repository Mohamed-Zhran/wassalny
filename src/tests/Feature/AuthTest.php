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
    protected Role $role;
    protected static string $password = 'password';

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create(['role_id' => 1, 'email'=>'mohamed2@gmail.com']);
        $this->role = Role::factory()->create(['name' => 'Customer']);
    }

    /** @test */
    public function userCanRegisterSuccessfully(): void
    {
        //arrange
        $user = User::factory()->raw(['role_id' => $this->role->id, 'password' => self::$password, 'password_confirmation' => self::$password, 'email' => 'mohamed@gmail.com']);
        //act
        $response = $this->postJson(route('register'), $user);
        //assert
        $response->assertCreated();
    }

    /** @test */
    public function registerEmailIsRealEmail()
    {
        //arrange
        $user = User::factory()->raw(['role_id' => $this->role->id, 'password' => self::$password, 'password_confirmation' => self::$password, 'email' => 'mohamed@wrong.com']);
        //act
        $response = $this->postJson(route('register'), $user);
        //assert
        $response->assertInvalid(['email']);
    }

    /** @test */
    public function registerPasswordShouldBeConfirmed()
    {
        //arrange
        $user = User::factory()->raw(['role_id' => $this->role->id, 'password' => self::$password, 'password_confirmation' => 'different', 'email' => 'mohamed@gmail.com']);
        //act
        $response = $this->postJson(route('register'), $user);
        //assert
        $response->assertInvalid(['password']);
    }

    /** @test */
    public function registerRoleIdIsExistsInRoles()
    {
        //arrange
        $user = User::factory()->raw(['role_id' => 5, 'password' => self::$password, 'password_confirmation' => self::$password, 'email' => 'mohamed@gmail.com']);
        //act
        $response = $this->postJson(route('register'), $user);
        //assert
        $response->assertInvalid(['role_id']);
    }

    /** @test */
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

        $response->assertUnauthorized();
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
    public function userLoginEmailIsValidEmail(): void
    {
        $response = $this->postJson(route('login'), [
            'email' => 'mohamed@wrong.con',
            'password' => 'password',
        ]);
        $response->assertInvalid(['email']);
    }
}
