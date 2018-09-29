<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MeTest extends TestCase
{
    public function test_failing_for_unauthenticated_user()
    {
        $this->json('GET', 'api/auth/me')
            ->assertStatus(401);
    }

    public function test_returns_user_data()
    {
        $user = factory(User::class)->create([
            'email' => 'test@test.com',
            'password' => $password = 'password'
        ]);

        $this->jsonAs(
            $user, 
            'GET', 
            'api/auth/me'
            )->assertJsonFragment([
            'id' => $user->id
        ]);
    }
}
