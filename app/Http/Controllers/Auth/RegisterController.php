<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PrivateUserResource;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create($request->only('name', 'email', 'password'));

        return new PrivateUserResource($user);
    }
}
