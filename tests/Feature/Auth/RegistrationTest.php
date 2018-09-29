<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    public function test_username_is_required()
    {
        $this->json('POST', 'api/auth/register')
            ->assertJsonValidationErrors(['name']);
    }

    public function test_email_is_required()
    {
        $this->json('POST', 'api/auth/register')
            ->assertJsonValidationErrors(['email']);
    }

    public function test_password_is_required()
    {
        $this->json('POST', 'api/auth/register')
            ->assertJsonValidationErrors(['password']);
    }

    public function test_password_min_6_chars()
    {
        $this->json('POST', 'api/auth/register', [
            'password' => '123'
        ])->assertJsonValidationErrors(['password']);
    }

    public function test_valid_email_is_required()
    {

        $this->json('POST', 'api/auth/register', [
            'email' => 'test@test'
        ])->assertJsonValidationErrors(['email']);
    }
    
    public function test_unique_email_is_required()
    {
        $user = factory(User::class)->create();

        $this->json('POST', 'api/auth/register', [
            'email' => $user->email
        ])->assertJsonValidationErrors(['email']);
    }

    public function test_user_registered()
    {
        $this->json('POST', 'api/auth/register', [
            'email' => $email = 'test@test.com',
            'name' => $name = 'name',
            'password' => '123456',
        ])->assertJsonFragment([
            'email' => $email,
            'name' => $name
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $email,
            'name' => $name
        ]);
    }
}
