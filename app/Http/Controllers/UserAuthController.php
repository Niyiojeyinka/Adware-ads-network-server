<?php

namespace App\Http\Controllers;

use App\User as User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class UserAuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        if ($request->validator->fails()) {
            return response()->json(
                [
                    'result' => 0,
                    'error' => $request->validator->messages(),
                    'data' => [],
                ],
                400
            );
        }

        User::create(
            array_merge($request->all(), [
                'password' => Hash::make($request->password),
            ])
        )->save();

        return response()->json(
            [
                'result' => 1,
                'data' => ['report' => 'User Registered Successfully'],
            ],
            201
        );
    }

    public function login(LoginRequest $request)
    {
        if ($request->validator->fails()) {
            return response()->json(
                [
                    'result' => 0,
                    'error' => $request->validator->messages(),
                    'data' => [],
                ],
                200
            );
        }

        $credentials = $request->only(['email', 'password']);

        if (!($token = auth()->attempt($credentials))) {
            return response()->json(
                ['result' => 0, 'error' => 'INVALID credentials'],
                401
            );
        }

        return response()->json(
            [
                'result' => 1,
                'data' => ['token' => $token, 'user_id' => Auth::user()->id],
            ],
            200
        );
    }

    public function logout(Request $request)
    {
        auth()->logout();

        return response()->json(
            ['result' => 1, 'data' => ['message' => 'Successfully logged out']],
            200
        );
    }
}