<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PrivateUserResource;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->only('name', 'email', 'password'));

        return new PrivateUserResource($user);
    }
}
