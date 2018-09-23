<?php

namespace Tests\Unit\Models\Users;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    public function test_password_auto_hashed()
    {
        $user = factory(User::class)->create([
            'password' => $password = '123456'
        ]);

        $this->assertNotEquals($password, $user->password);
        $this->assertTrue(password_verify($password, $user->password));
    }
}
