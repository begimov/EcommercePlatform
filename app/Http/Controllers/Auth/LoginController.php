<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\PrivateUserResource;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!$token = auth()->attempt($request->only('email', 'password'))) {

            return response()->json([
                'errors' => [
                    'email' => [
                        'Authentication failed'
                    ]
                ]
                    ], 422);

        }

        return (new PrivateUserResource($request->user()))
            ->additional([
                'meta' => [
                    'token' => $token,
                ]
            ]);
    }
}
