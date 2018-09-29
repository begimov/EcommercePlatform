<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    public function test_email_is_required()
    {
        $this->json('POST', 'api/auth/login')
            ->assertJsonValidationErrors(['email']);
    }

    public function test_password_is_required()
    {
        $this->json('POST', 'api/auth/login')
            ->assertJsonValidationErrors(['email']);
    }

    public function test_user_signed_in()
    {
        $user = factory(User::class)->create([
            'password' => $password = 'password'
        ]);

        $this->json('POST', 'api/auth/login', [
            'email' => $user->email,
            'password' => $password
        ])
        ->assertJsonFragment([
            'id' => $user->id
        ])
        ->assertJsonStructure([
            'meta' => [
                'token'
            ]
        ]);
    }

    public function test_user_signin_in_failed()
    {
        $user = factory(User::class)->create();

        $this->json('POST', 'api/auth/login', [
            'email' => $user->email,
            'password' => 'wrong'
        ])->assertJsonValidationErrors(['email']);
    }
}
