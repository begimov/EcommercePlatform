<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PrivateUserResource;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (!$token = auth()->attempt($request->only('email', 'password'))) {

            return 'error';

        }

        return (new PrivateUserResource($request->user()))
            ->additional([
                'meta' => [
                    'token' => $token,
                ]
            ]);
    }
}
